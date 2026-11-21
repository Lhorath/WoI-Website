<?php
declare(strict_types=1);

function createTrinityCoreSrp6Credentials(string $username, string $password): array
{
    $modulus = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);
    $generator = gmp_init(7);
    $salt = random_bytes(32);
    $passwordHash = sha1(strtoupper($username) . ':' . strtoupper($password), true);
    $xHash = sha1($salt . $passwordHash, true);
    $privateKey = gmp_import($xHash, 1, GMP_LSW_FIRST | GMP_LITTLE_ENDIAN);
    $verifierNumber = gmp_powm($generator, $privateKey, $modulus);
    $verifier = gmp_export($verifierNumber, 1, GMP_LSW_FIRST | GMP_LITTLE_ENDIAN);

    return [
        'salt' => str_pad($salt, 32, "\0", STR_PAD_RIGHT),
        'verifier' => str_pad($verifier, 32, "\0", STR_PAD_RIGHT),
    ];
}
