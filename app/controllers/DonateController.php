<?php
declare(strict_types=1);

final class DonateController
{
    private function render(
        string $pageTitle,
        string $pageCategory,
        string $pageHeading,
        string $pageSubtitle,
        string $pageDescription,
        ?string $pageContentHtml = null,
        array $pageItems = [],
        ?string $pageBackUrl = null,
        ?string $pageBackLabel = null
    ): void {
        $contentPartial = __DIR__ . '/../views/placeholder.php';
        require __DIR__ . '/../views/layout.php';
    }

    public function index(): void
    {
        $this->render(
            'Donation Panel',
            'Support the Realm',
            'Donation Panel',
            'Support server hardware, bandwidth, and ongoing development.',
            'Donations directly offset hosting costs and administration fees. Donors receive Immortal Coins (IC) as a gift of appreciation.',
            '<p>Please review our donation policy before proceeding. All contributions are voluntary gifts to help maintain realm operations.</p>',
            [
                ['icon' => 'donateicon.png', 'title' => 'Make a Donation', 'description' => 'Select a contribution tier and support server hosting costs.', 'url' => 'donate/donate.php'],
                ['icon' => 'donatecheckicon.png', 'title' => 'Donation Packages', 'description' => 'Browse custom packages, vanity rewards, and bonus coin tiers.', 'url' => 'donate/packages.php'],
                ['icon' => 'statsicon.png', 'title' => 'Donation History', 'description' => 'Inspect your past contributions, receipts, and credited coin amounts.', 'url' => 'donate/history.php'],
                ['icon' => 'rulesicon.png', 'title' => 'Donation Agreement', 'description' => 'Read our terms, conditions, and non-refundable policy.', 'url' => 'donate/agree.php'],
            ]
        );
    }

    public function rootDonate(): void
    {
        $this->index();
    }

    public function agree(): void
    {
        $this->render(
            'Donation Agreement',
            'Donation Panel',
            'Donation Terms & Conditions',
            'Official guidelines governing voluntary contributions.',
            'By choosing to donate, you acknowledge that you are contributing of your own free will without expectation of goods or commercial services.',
            '<p><strong>1. Voluntary Nature:</strong> Donations are strictly gifts used to offset server infrastructure and operational fees.</p>'
            . '<p><strong>2. In-Game Gifts:</strong> Any rewards received are voluntary gifts from staff and do not constitute purchased merchandise.</p>'
            . '<p><strong>3. Non-Refundable:</strong> All donations are non-refundable. Chargebacks will result in permanent account and IP sanctions.</p>',
            [],
            'donate/index.php',
            'Back to Donation Panel'
        );
    }

    public function donate(): void
    {
        $this->render(
            'Contribute',
            'Donation Panel',
            'Select Donation Tier',
            'Choose your contribution amount and target character.',
            'Select a package tier to receive bonus Immortal Coins credited directly to your account.',
            '<p>The donation processing form will integrate safe payment gateways once financial configurations are finalized.</p>',
            [
                ['title' => 'Tier 1 - Explorer Support', 'description' => '$10.00 contribution &bull; 100 Immortal Coins + 10 Bonus Coins', 'badge' => '$10.00'],
                ['title' => 'Tier 2 - Champion Support', 'description' => '$25.00 contribution &bull; 250 Immortal Coins + 35 Bonus Coins', 'badge' => '$25.00'],
                ['title' => 'Tier 3 - Immortal Patron', 'description' => '$50.00 contribution &bull; 500 Immortal Coins + 100 Bonus Coins', 'badge' => '$50.00']
            ],
            'donate/index.php',
            'Back to Donation Panel'
        );
    }

    public function history(): void
    {
        $this->render(
            'Donation History',
            'Donation Panel',
            'My Contribution History',
            'Review past transactions and credited reward points.',
            'Keep track of transaction IDs, dates, payment methods, and coin balances assigned to your account.',
            '<p>No previous transactions found for the current session. Transaction logs will populate when active gateway transactions occur.</p>',
            [],
            'donate/index.php',
            'Back to Donation Panel'
        );
    }

    public function packages(): void
    {
        $this->render(
            'Donation Packages',
            'Donation Panel',
            'Rewards & Packages Catalog',
            'Explore vanity rewards, mounts, bags, and convenience services.',
            'Redeem your Immortal Coins for cosmetic companions, heirloom equipment, and quality-of-life perks.',
            null,
            [
                ['icon' => 'donatecheckicon.png', 'title' => 'Faction Change / Race Change', 'description' => 'Switch your character faction or race seamlessly without losing reputation.'],
                ['icon' => 'donatecheckicon.png', 'title' => 'Rare Vanity Mounts', 'description' => 'Acquire prestigious Wrath of the Lich King flying and ground mounts.'],
                ['icon' => 'donatecheckicon.png', 'title' => 'Guild Renaming Service', 'description' => 'Update your guild name or transfer guild leadership.']
            ],
            'donate/index.php',
            'Back to Donation Panel'
        );
    }

    public function preview(): void
    {
        $this->render(
            'Donation Preview',
            'Donation Panel',
            'Review Donation Summary',
            'Confirm your selected package before proceeding to payment checkout.',
            'Verify your contribution amount, bonus tier, and character designation before being forwarded to the secure payment provider.',
            null,
            [],
            'donate/donate.php',
            'Modify Selection'
        );
    }

    public function paypal(): void
    {
        $this->render(
            'PayPal Checkout',
            'Payment Gateway',
            'Redirecting to Secure Checkout',
            'Connecting to PayPal payment services.',
            'You are being redirected to the payment processor to complete your transaction in a secure environment.',
            '<p>Placeholder payment gateway endpoint. No charges will be processed in this development phase.</p>',
            [],
            'donate/index.php',
            'Return to Donation Panel'
        );
    }

    public function postback(): void
    {
        $this->render(
            'Payment Postback',
            'Payment Gateway',
            'Instant Payment Notification (IPN)',
            'Automated webhook receiver for payment confirmations.',
            'This endpoint receives asynchronous server-to-server transaction notifications to verify and credit account points.',
            '<p>Status: Ready for gateway webhook integration.</p>',
            [],
            'donate/index.php',
            'Back to Donation Panel'
        );
    }

    public function accepted(): void
    {
        $this->render(
            'Payment Accepted',
            'Donation Panel',
            'Thank You for Your Donation!',
            'Your contribution has been successfully confirmed.',
            'We sincerely appreciate your support for the World of Immortality realm. Your Immortal Coins will be credited to your account shortly.',
            '<p>A copy of your contribution details has been logged in your account donation history.</p>',
            [],
            'index.php',
            'Return to Homepage'
        );
    }

    public function cancelled(): void
    {
        $this->render(
            'Payment Cancelled',
            'Donation Panel',
            'Transaction Cancelled',
            'No charges were made to your account.',
            'The payment process was cancelled before completion. You may return to the donation panel whenever you are ready.',
            null,
            [],
            'donate/index.php',
            'Return to Donation Panel'
        );
    }
}
