<?php
declare(strict_types=1);

final class GmController
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
            'GM Panel',
            'Staff Administration',
            'Game Master Control Center',
            'Administrative utilities for realm staff and gamemasters.',
            'Restricted tools for verifying player promos, reviewing donation logs, managing instance locks, and conducting player support.',
            '<p>Access to staff tools requires authorized GM account privileges authenticated through TrinityCore security levels.</p>',
            [
                ['icon' => 'promocheckicon.png', 'title' => 'Promo Checker', 'description' => 'Verify player eligibility for Level 80 promo tickets and initial gear packages.', 'url' => 'gm/promo.php'],
                ['icon' => 'votecheckicon.png', 'title' => 'Vote Checker', 'description' => 'Search and audit player vote logs and reward delivery status.', 'url' => 'gm/vote.php'],
                ['icon' => 'donatecheckicon.png', 'title' => 'Donation Checker', 'description' => 'Review transaction history to verify item swap and reroll eligibility.', 'url' => 'gm/donation.php'],
                ['icon' => 'instancereseticon.png', 'title' => 'Instance Reset', 'description' => 'Trigger server instance reset procedures or inspect lockouts.', 'url' => 'gm/instance.php'],
                ['icon' => 'banicon.png', 'title' => 'GM Ban Checker', 'description' => 'Inspect comprehensive player ban histories, IP associations, and sanction notes.', 'url' => 'gm/banchecker.php'],
                ['icon' => 'passwordicon.png', 'title' => 'Staff Password Utility', 'description' => 'Administrative account recovery and password reset verification.', 'url' => 'gm/passchange.php'],
            ]
        );
    }

    public function promo(): void
    {
        $this->render(
            'Promo Checker',
            'GM Tools',
            'Promo Eligibility Checker',
            'Verify player character counts and promo qualification.',
            'Enter a player account name to determine if they already possess an existing Level 80 character before granting promotional level-ups.',
            null,
            [],
            'gm/index.php',
            'Back to GM Panel'
        );
    }

    public function vote(): void
    {
        $this->render(
            'Vote Checker',
            'GM Tools',
            'Player Vote History Audit',
            'Audit vote timestamps, IP logs, and point deliveries.',
            'Search by account name or character name to confirm legitimate vote submissions and troubleshoot missing points.',
            null,
            [],
            'gm/index.php',
            'Back to GM Panel'
        );
    }

    public function donation(): void
    {
        $this->render(
            'Donation Checker',
            'GM Tools',
            'Donation Verification & Swaps',
            'Check transaction dates and item delivery records.',
            'Staff tool to confirm transaction authenticity before granting item rerolls or gear swaps according to server policies.',
            null,
            [],
            'gm/index.php',
            'Back to GM Panel'
        );
    }

    public function instance(): void
    {
        $this->render(
            'Instance Reset',
            'GM Tools',
            'Instance Reset Utility',
            'Administrative raid and dungeon lockout management.',
            'Use SOAP commands or database operations to reset specific instance IDs or clear global daily raid lockouts.',
            null,
            [],
            'gm/index.php',
            'Back to GM Panel'
        );
    }

    public function banchecker(): void
    {
        $this->render(
            'Staff Ban Checker',
            'GM Tools',
            'Comprehensive Ban & Sanction Tool',
            'Inspect account bans, IP bans, character mutes, and past corrective actions.',
            'Search by account, character name, or IP address to review disciplinary records and sanction reasons.',
            null,
            [],
            'gm/index.php',
            'Back to GM Panel'
        );
    }

    public function passchange(): void
    {
        $this->render(
            'Staff Password Utility',
            'GM Tools',
            'Account Security & Recovery',
            'Administrative password reset and verification tool.',
            'Assists players with verified ownership in recovering compromised or locked accounts.',
            null,
            [],
            'gm/index.php',
            'Back to GM Panel'
        );
    }
}
