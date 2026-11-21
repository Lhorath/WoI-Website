<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/Environment.php';

final class PageController
{
    private function discordUrl(): string
    {
        Environment::load(dirname(__DIR__, 2) . '/.env');
        $url = Environment::get('DISCORD_INVITE_URL', Environment::get('DISCORD_URL', 'https://discord.gg/G3rKQfQ'));
        if (!preg_match('#^https?://#i', $url)) {
            $url = 'https://' . ltrim($url, '/');
        }
        return $url;
    }
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

    public function connect(): void
    {
        $realmlistNotice = '<p><strong>Server Realmlist:</strong> <code>set realmlist woilogon.nerdygamertools.com</code></p>'
            . '<p>To connect to World of Immortality, you must have a clean <strong>World of Warcraft 3.3.5a (Wrath of the Lich King)</strong> client installation.</p>'
            . '<ol>'
            . '<li>Navigate to your World of Warcraft directory (e.g., <code>C:\Program Files\World of Warcraft</code>).</li>'
            . '<li>Open the <code>Data</code> folder, then your locale folder (e.g., <code>enUS</code> or <code>enGB</code>).</li>'
            . '<li>Locate the <code>realmlist.wtf</code> file, open it with Notepad, and set the contents to: <code>set realmlist woilogon.nerdygamertools.com</code></li>'
            . '<li>Save the file, launch the game, and log in with your account credentials.</li>'
            . '</ol>';

        $this->render(
            'Connection Guide',
            'Getting Started',
            'Connection Guide',
            'Step-by-step instructions to connect to World of Immortality.',
            'Follow the instructions below to configure your 3.3.5a game client and begin your adventure.',
            $realmlistNotice,
            [
                ['icon' => 'rulesicon.png', 'title' => 'Server Rules', 'description' => 'Review the server rules and policies before entering the realm.', 'url' => 'tos.php'],
                ['icon' => 'ucpicon.png', 'title' => 'Create an Account', 'description' => 'Sign up for a free game account to log in and start playing.', 'url' => 'register.php'],
            ]
        );
    }

    public function about(): void
    {
        $this->render(
            'About Us',
            'General Information',
            'About World of Immortality',
            'Setting a new standard for private server emulation.',
            'World of Immortality is a community-driven 3.3.5a Wrath of the Lich King private realm dedicated to high-rate progression, custom events, blizzlike stability, and balanced PvP and PvE content.',
            '<p>Originally founded in 2009, World of Immortality has returned with upgraded server infrastructure, active administration, restored legacy characters, and continuous improvements to the player experience.</p>'
        );
    }

    public function contact(): void
    {
        $this->render(
            'Contact Staff',
            'Support',
            'Contact Our Staff',
            'Get in touch with the World of Immortality team.',
            'Our volunteer staff is dedicated to assisting players with questions, bug reports, and realm administration.',
            null,
            [
                ['icon' => 'stafficon.png', 'title' => 'In-Game Tickets', 'description' => 'Submit a ticket in-game for prompt assistance with your character or gameplay inquiries.'],
                ['icon' => 'newsiteicon.png', 'title' => 'Community Hub', 'description' => 'Join our Discord, visit external forums, and connect with players on our community page.', 'url' => 'community.php'],
                ['icon' => 'statsicon.png', 'title' => 'Discord Voice & Chat', 'description' => 'Join our official Discord channels to interact with players and staff in real time.', 'url' => $this->discordUrl()]
            ]
        );
    }

    public function faq(): void
    {
        $this->render(
            'FAQ',
            'Help & Information',
            'Frequently Asked Questions',
            'Answers to common questions about World of Immortality.',
            'Find quick answers regarding currencies, vote points, donation rewards, and server policies.',
            null,
            [
                ['title' => 'What are Immortal Coins (IC)?', 'description' => 'Immortal Coins are earned through donations and special events, and can be redeemed in the donation panel for exclusive rewards.'],
                ['title' => 'What are Vote Points (VP)?', 'description' => 'Vote Points are awarded every 12 hours when you support the realm on toplist sites. Spend them in the Vote Rewards shop.'],
                ['title' => 'What client version do I need?', 'description' => 'World of Immortality requires World of Warcraft client version 3.3.5a (build 12340).', 'url' => 'connect.php'],
                ['title' => 'How do I unstuck my character?', 'description' => 'Use the Offline Teleporter or Revive tools in the Player Tools panel to safely recover your character.', 'url' => 'account/index.php']
            ]
        );
    }

    public function tos(): void
    {
        $this->render(
            'Terms of Service',
            'Policies & Rules',
            'Terms of Service & Server Rules',
            'Guidelines and policies governing play on World of Immortality.',
            'By accessing World of Immortality servers and website, you agree to abide by all player rules and community guidelines.',
            '<p><strong>1. Account Responsibility:</strong> You are strictly responsible for all actions conducted under your account. Never share your password with any third party.</p>'
            . '<p><strong>2. In-Game Conduct & Chat:</strong> Respect your fellow players and staff. Hate speech, harassment, spamming, and illicit advertising are strictly forbidden.</p>'
            . '<p><strong>3. Exploits & Cheating:</strong> Use of speed hacks, fly hacks, botting software, or third-party automation tools results in immediate account termination.</p>'
            . '<p><strong>4. Staff Authority:</strong> Staff decisions regarding realm moderation are final. Inquiries may be escalated respectfully through official support channels.</p>'
        );
    }

    public function agree(): void
    {
        $this->tos();
    }

    public function status(): void
    {
        $this->render(
            'Server Status',
            'Realm Information',
            'Realm Status & Statistics',
            'Live server state, uptime, and player population.',
            'Monitor real-time status and operational metrics for the World of Immortality realms.',
            '<p><strong>Active Realm:</strong> Immortality (High-Rate 3.3.5a)<br>'
            . '<strong>XP Multipliers:</strong> Kill 10x | Quest 10x | Exploration 25x<br>'
            . '<strong>Drop Multipliers:</strong> Normal 10x | Poor 6x | Uncommon 12x | Rare 8x | Epic 4x | Legendary 2x | Gold 8x</p>',
            [
                ['icon' => 'statsicon.png', 'title' => 'Players Online', 'description' => 'Inspect the list of active players currently exploring the realm.', 'url' => 'online.php'],
                ['icon' => 'tourneyicon.png', 'title' => 'Arena Ladder', 'description' => 'View competitive 2v2, 3v3, and 5v5 arena team rankings.', 'url' => 'arena.php']
            ]
        );
    }

    public function online(): void
    {
        $this->render(
            'Players Online',
            'Realm Community',
            'Players Online',
            'Active heroes currently logged into World of Immortality.',
            'View characters currently online, their faction, race, class, and level.',
            '<p>The online player directory will display real-time roster data queried directly from the realm world database.</p>',
            [],
            'status.php',
            'View Realm Status'
        );
    }

    public function arena(): void
    {
        $this->render(
            'Arena Ladder',
            'Competitive Rankings',
            'Arena Rankings & Ladder',
            'Top gladiators and arena team standings across all brackets.',
            'Track top-ranking teams in 2v2, 3v3, and 5v5 competitive arena gameplay.',
            '<p>Select a bracket to filter ladder standings once live data synchronization is activated.</p>',
            [
                ['icon' => 'tourneyicon.png', 'title' => '2v2 Bracket', 'description' => 'Two-versus-two duo team standings and win rates.'],
                ['icon' => 'tourneyicon.png', 'title' => '3v3 Bracket', 'description' => 'Three-versus-three competitive championship rankings.'],
                ['icon' => 'tourneyicon.png', 'title' => '5v5 Bracket', 'description' => 'Five-versus-five team battles and rating leaders.']
            ]
        );
    }

    public function vent(): void
    {
        $this->render(
            'Voice Server',
            'Community',
            'Voice Communication Server',
            'Voice-over-IP details for World of Immortality players and guilds.',
            'Connect with your guild and realm friends during raids, dungeons, and battlegrounds.',
            '<p><strong>Legacy Service:</strong> Ventrilo voice communication.<br>'
            . 'Modern realm voice channels and community discussion are hosted on our official community Discord.</p>',
            [],
            'community.php',
            'Visit Community Hub'
        );
    }

    public function community(): void
    {
        $communityHtml = '<p>The World of Immortality community spans multiple interactive platforms. Join our voice and text chat, take part in external forum discussions, submit your gameplay highlights, and stay up to date on all social feeds.</p>';

        $this->render(
            'Community',
            'Community Hub',
            'World of Immortality Community',
            'Forums, Discord, Social Media, Screenshots, and Community Media.',
            'Welcome to the official community gathering place. Connect with fellow players, staff, content creators, and guilds across all our official channels.',
            $communityHtml,
            [
                [
                    'icon' => 'newsiteicon.png',
                    'title' => 'External Community Forums',
                    'description' => 'Visit our dedicated external forums for detailed class guides, raid strategy discussions, guild recruitment, and trading.',
                    'url' => 'https://forums.worldofimmortality.com/',
                    'badge' => 'External Forum'
                ],
                [
                    'icon' => 'statsicon.png',
                    'title' => 'Official Discord Server',
                    'description' => 'Join our active Discord community with 24/7 text and voice rooms, event reminders, raid grouping, and staff support.',
                    'url' => $this->discordUrl(),
                    'badge' => 'Voice & Chat'
                ],
                [
                    'icon' => 'launchericon.png',
                    'title' => 'Social Media & Feeds',
                    'description' => 'Follow our YouTube channel, Twitch live streams, and Twitter/X accounts for patch previews, teaser trailers, and giveaways.',
                    'url' => '#social-media',
                    'badge' => 'Social Feeds'
                ],
                [
                    'icon' => 'tourneyicon.png',
                    'title' => 'Community Screenshots Gallery',
                    'description' => 'Player-submitted moments: world first raid boss kills, hilarious arena encounters, transmog showcases, and scenic Azeroth views.',
                    'url' => '#screenshots',
                    'badge' => 'Gallery'
                ],
                [
                    'icon' => 'statsicon.png',
                    'title' => 'Community Videos & Streams',
                    'description' => 'Curated collection of PvP montages, Wrath raid guides, speedrun records, and content creator stream highlights.',
                    'url' => '#videos',
                    'badge' => 'Videos & VODs'
                ],
                [
                    'icon' => 'stafficon.png',
                    'title' => 'Bug Reports & Player Suggestions',
                    'description' => 'Help shape the future of World of Immortality by submitting bug reproduction steps and community feature requests.',
                    'url' => 'contact.php',
                    'badge' => 'Support'
                ],
            ]
        );
    }
}
