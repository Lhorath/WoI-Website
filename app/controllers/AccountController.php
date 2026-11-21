<?php
declare(strict_types=1);

final class AccountController
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
            'Player Tools',
            'Account Management',
            'Player Tools & Control Panel',
            'Manage your game characters, vote rewards, and account settings.',
            'Access self-service utilities designed to keep your characters active and in top fighting shape.',
            null,
            [
                ['icon' => 'voteicon.png', 'title' => 'Vote Panel', 'description' => 'Cast votes for the server every 12 hours to earn Vote Points.', 'url' => 'vote/index.php'],
                ['icon' => 'donateicon.png', 'title' => 'Donation Panel', 'description' => 'Support server upkeep and browse custom item rewards.', 'url' => 'donate/index.php'],
                ['icon' => 'teleporticon.png', 'title' => 'Offline Teleporter', 'description' => 'Safely teleport a stuck character back to your home faction capital.', 'url' => 'account/teleport.php'],
                ['icon' => 'instancereseticon.png', 'title' => 'Offline Revive', 'description' => 'Revive your character and cure resurrection sickness when stuck.', 'url' => 'account/revive.php'],
                ['icon' => 'banicon.png', 'title' => 'Ban Checker', 'description' => 'Check account status, active sanctions, reasons, and expiry dates.', 'url' => 'account/bancheck.php'],
                ['icon' => 'passwordicon.png', 'title' => 'Account Details', 'description' => 'Update your registered email or change your game account password.', 'url' => 'account/userdetails.php'],
            ]
        );
    }

    public function ucp(): void
    {
        $this->index();
    }

    public function bancheck(): void
    {
        $this->render(
            'Ban Checker',
            'Player Tools',
            'Account Ban Status Checker',
            'Verify account standing and standing history.',
            'Enter your username or log in to inspect any active sanctions, reasons, and duration.',
            '<p>The ban verification service queries the TrinityCore <code>account_banned</code> table to report status in real time.</p>',
            [],
            'account/index.php',
            'Back to Player Tools'
        );
    }

    public function teleport(): void
    {
        $this->render(
            'Offline Teleporter',
            'Player Tools',
            'Offline Character Teleporter',
            'Stuck in an inaccessible zone or disconnected in a crash loop? Teleport safely.',
            'Select your character and choose a safe recall destination (e.g., Dalaran, Stormwind, or Orgrimmar) while logged out of the game.',
            '<p>Characters must be completely logged out for at least two minutes before initiating an offline teleport coordinate update.</p>',
            [
                ['title' => 'Alliance Safe Haven', 'description' => 'Teleport to Stormwind Trade District or Ironforge Commons.'],
                ['title' => 'Horde Safe Haven', 'description' => 'Teleport to Orgrimmar Valley of Strength or Undercity.'],
                ['title' => 'Neutral Sanctuary', 'description' => 'Teleport to Dalaran or Shattrath City.']
            ],
            'account/index.php',
            'Back to Player Tools'
        );
    }

    public function revive(): void
    {
        $this->render(
            'Offline Revive',
            'Player Tools',
            'Offline Character Revive & Unstuck',
            'Restore dead or ghost characters trapped in the spirit realm.',
            'If your ghost is stuck or your corpse cannot be reached, trigger an offline resurrection to return your character to life at the nearest graveyard.',
            '<p>Please ensure your character is logged out before submitting a revive request.</p>',
            [],
            'account/index.php',
            'Back to Player Tools'
        );
    }

    public function userdetails(): void
    {
        $this->render(
            'Account Details',
            'Account Management',
            'Account Details & Password Changer',
            'Manage your account credentials and security preferences.',
            'Regularly changing your password protects your characters and items from unauthorized access.',
            '<p>Password updates use the TrinityCore SRP6 hashing protocol to update the auth database directly.</p>',
            [],
            'account/index.php',
            'Back to Player Tools'
        );
    }

    public function logout(): void
    {
        $this->render(
            'Logout',
            'Session',
            'Logged Out Successfully',
            'Your session has been securely closed.',
            'Thank you for visiting World of Immortality. You have been logged out of your account on this device.',
            null,
            [],
            'index.php',
            'Return to Homepage'
        );
    }
}
