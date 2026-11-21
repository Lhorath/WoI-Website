<?php
declare(strict_types=1);

final class RealmStatus
{
    public function current(): array
    {
        $status = [
            'online' => false,
            'onlinePlayers' => null,
            'xpRates' => $this->rates([
                'Kill' => 'RATE_1_XP_KILL',
                'Quest' => 'RATE_1_XP_QUEST',
                'Explore' => 'RATE_1_XP_EXPLORE',
            ]),
            'dropRates' => $this->rates([
                'Normal' => 'RATE_1_DROP_NORMAL',
                'Poor' => 'RATE_1_DROP_POOR',
                'Uncommon' => 'RATE_1_DROP_UNCOMMON',
                'Rare' => 'RATE_1_DROP_RARE',
                'Epic' => 'RATE_1_DROP_EPIC',
                'Legendary' => 'RATE_1_DROP_LEGENDARY',
                'Gold' => 'RATE_1_DROP_GOLD',
            ]),
        ];

        try {
            $host = Environment::get('REALM_1_IP');
            $port = Environment::get('REALM_1_SOAP_PORT');
            $username = Environment::get('REALM_1_SOAP_USER');
            $password = Environment::get('REALM_1_SOAP_PASSWORD');

            if ($host === '' || $port === '' || $username === '' || $password === '') {
                throw new RuntimeException('Realm SOAP settings are incomplete.');
            }
            if (!class_exists(SoapClient::class)) {
                throw new RuntimeException('The PHP SOAP extension is not available.');
            }

            $client = new SoapClient(null, [
                'location' => 'http://' . $host . ':' . $port . '/',
                'uri' => 'urn:TC',
                'style' => SOAP_RPC,
                'use' => SOAP_ENCODED,
                'login' => $username,
                'password' => $password,
                'connection_timeout' => 2,
                'stream_context' => stream_context_create([
                    'http' => ['timeout' => 3],
                ]),
                'exceptions' => true,
            ]);
            $response = $client->__soapCall(
                'executeCommand',
                [new SoapParam('server info', 'command')]
            );
            $serverInfo = self::responseText($response);

            if (preg_match('/Online players:\s*(\d+)/i', $serverInfo, $matches) !== 1) {
                throw new RuntimeException('The server-info response did not contain an online-player count.');
            }

            $status['online'] = true;
            $status['onlinePlayers'] = (int) $matches[1];
        } catch (SoapFault | RuntimeException $exception) {
            $detail = $exception instanceof SoapFault
                ? (string) $exception->faultcode
                : $exception->getMessage();
            error_log('Realm status SOAP check failed: ' . $detail);
        }

        return $status;
    }

    private function rates(array $rateSettings): array
    {
        $rates = [];
        foreach ($rateSettings as $label => $setting) {
            $value = trim(Environment::get($setting));
            $rates[] = [
                'label' => $label,
                'value' => $value === '' ? 'Not configured' : $value . 'x',
            ];
        }

        return $rates;
    }

    private static function responseText(mixed $response): string
    {
        if (is_string($response)) {
            return $response;
        }
        if (is_object($response) && isset($response->result) && is_string($response->result)) {
            return $response->result;
        }
        if (is_array($response) && isset($response['result']) && is_string($response['result'])) {
            return $response['result'];
        }

        throw new RuntimeException('The SOAP server returned an unexpected response.');
    }
}
