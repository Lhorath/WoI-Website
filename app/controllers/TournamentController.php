<?php
declare(strict_types=1);

final class TournamentController
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
            'Tournaments',
            'PvP Championships',
            'World of Immortality Tournaments',
            'Competitive arena and battleground championship events.',
            'Compete against the greatest gladiators on the realm for prizes, exclusive titles, and Immortal Coins.',
            null,
            [
                ['icon' => 'tourneyicon.png', 'title' => 'Tournament Information', 'description' => 'Rules, brackets, eligibility criteria, and event schedules.', 'url' => 'tournament/info/index.php'],
                ['icon' => 'ucpicon.png', 'title' => 'Team Registration', 'description' => 'Register your arena team or solo entry for the upcoming championship.', 'url' => 'tournament/info/register.php'],
                ['icon' => 'statsicon.png', 'title' => 'Championship Ladder', 'description' => 'Current tournament seedings, match results, and live standings.', 'url' => 'tournament/ladder/index.php'],
                ['icon' => 'statsicon.png', 'title' => 'Tournament Statistics', 'description' => 'Class representation, win/loss stats, and top-performing players.', 'url' => 'tournament/statistics/index.php'],
                ['icon' => 'launchericon.png', 'title' => 'Tournament Media', 'description' => 'Featured highlights, match replays, and championship screenshots.', 'url' => 'tournament/media/index.php'],
            ]
        );
    }

    public function info(): void
    {
        $this->render(
            'Tournament Info',
            'Tournaments',
            'Tournament Rules & Overview',
            'Schedule, formatting, and competition guidelines.',
            'All registered teams must check in with the tournament marshal 30 minutes prior to first round matches.',
            '<p><strong>Match Format:</strong> Best of 3 double elimination bracket.<br>'
            . '<strong>Gear Restrictions:</strong> Standard seasonal PvP gear restrictions apply.<br>'
            . '<strong>Prizes:</strong> 1st Place: Exclusive Gladiator title, 1,000 IC, and custom vanity mount.</p>',
            [],
            'tournament/index.php',
            'Back to Tournament Home'
        );
    }

    public function register(): void
    {
        $this->render(
            'Tournament Registration',
            'Tournaments',
            'Team Registration',
            'Sign up your roster for the upcoming realm tournament.',
            'Enter your team name, roster members, captain contact info, and preferred bracket.',
            '<p>Registration is open to all characters level 80 with minimum season rating requirements.</p>',
            [],
            'tournament/index.php',
            'Back to Tournament Home'
        );
    }

    public function ladder(): void
    {
        $this->render(
            'Tournament Ladder',
            'Tournaments',
            'Championship Bracket & Ladder',
            'Track tournament progress from qualifiers to finals.',
            'Interactive bracket and match history will be displayed as matches conclude.',
            null,
            [],
            'tournament/index.php',
            'Back to Tournament Home'
        );
    }

    public function media(): void
    {
        $this->render(
            'Tournament Media',
            'Tournaments',
            'Highlights, Replays & Screenshots',
            'Relive the most memorable moments from realm championships.',
            'Stream links, vods, and commemorative screenshot galleries.',
            null,
            [],
            'tournament/index.php',
            'Back to Tournament Home'
        );
    }

    public function statistics(): void
    {
        $this->render(
            'Tournament Statistics',
            'Tournaments',
            'Competition Analytics & Metrics',
            'Detailed statistics on class compositions, round durations, and win percentages.',
            'Breakdown of team strategies and dominant specs across all rounds.',
            null,
            [],
            'tournament/index.php',
            'Back to Tournament Home'
        );
    }
}
