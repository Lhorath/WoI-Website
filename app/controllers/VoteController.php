<?php
declare(strict_types=1);

final class VoteController
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
            'Vote For Us',
            'Community Support',
            'Vote for World of Immortality',
            'Earn Vote Points every 12 hours while helping new players find our realm.',
            'Voting on private server rankings increases realm visibility and awards Vote Points (VP) directly to your account.',
            '<p>Click on each voting portal below. You can vote on each site once every 12 hours. Accumulate points and spend them in the Vote Rewards shop!</p>',
            [
                ['icon' => 'voteicon.png', 'title' => 'OpenWoW Top 100', 'description' => 'Vote on OpenWoW &bull; Earn 2 Vote Points', 'badge' => '2 VP'],
                ['icon' => 'voteicon.png', 'title' => 'Xtremetop100 Rankings', 'description' => 'Vote on XtremeTop100 &bull; Earn 2 Vote Points', 'badge' => '2 VP'],
                ['icon' => 'voteicon.png', 'title' => 'TopG Private Servers', 'description' => 'Vote on TopG &bull; Earn 2 Vote Points', 'badge' => '2 VP'],
                ['icon' => 'votecheckicon.png', 'title' => 'Vote Rewards Shop', 'description' => 'Browse and redeem your accumulated Vote Points for in-game rewards.', 'url' => 'vote/rewards.php']
            ]
        );
    }

    public function rewards(): void
    {
        $this->render(
            'Vote Rewards',
            'Vote Panel',
            'Vote Points Rewards Shop',
            'Redeem your hard-earned Vote Points for in-game supplies and vanity perks.',
            'All items purchased with Vote Points are delivered straight to your selected character mailbox in-game.',
            null,
            [
                ['title' => 'Super Health & Mana Potions', 'description' => 'Essential raiding consumables bundle &bull; 10 Vote Points', 'badge' => '10 VP'],
                ['title' => 'Tabard of the Explorer', 'description' => 'Vanity tabard for dedicated realm supporters &bull; 25 Vote Points', 'badge' => '25 VP'],
                ['title' => 'Netherweave 16-Slot Bags', 'description' => 'Spacious inventory bags to store dungeon spoils &bull; 15 Vote Points', 'badge' => '15 VP'],
                ['title' => 'Companion Pets', 'description' => 'Assorted non-combat pets to accompany you on quests &bull; 30 Vote Points', 'badge' => '30 VP']
            ],
            'vote/index.php',
            'Back to Vote Panel'
        );
    }
}
