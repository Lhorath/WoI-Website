<div class="FBG">
    <div class="FBG_resize">
        <div class="left">
            <h2>Getting Started </h2>
            <ul>
                <li><a href="<?= $basePath ?? '' ?>connect.php">Connection Guide</a></li>
                <li><a href="<?= $basePath ?? '' ?>register.php">Create an Account</a></li>
                <li><a href="<?= $basePath ?? '' ?>tos.php">Server Rules</a></li>
            </ul>
        </div>
        <div class="left">
            <h2>Player Tools</h2>
            <ul>
                <li><a href="<?= $basePath ?? '' ?>vote/index.php">Vote Panel</a></li>
                <li><a href="<?= $basePath ?? '' ?>donate/index.php">Donation Panel</a></li>
                <li><a href="<?= $basePath ?? '' ?>account/teleport.php">Offline Teleport</a></li>
                <li><a href="<?= $basePath ?? '' ?>account/bancheck.php">Ban Check</a></li>
            </ul>
        </div>
        <div class="left">
            <h2>Server Status</h2>
            <ul>
                <li><a href="<?= $basePath ?? '' ?>status.php">Players Online</a></li>
                <li><a href="<?= $basePath ?? '' ?>arena.php">Arena Ladder</a></li>
                <li><a href="<?= $basePath ?? '' ?>news.php">Changelogs & News</a></li>
                <li><a href="<?= $basePath ?? '' ?>status.php">Realm Info</a></li>
            </ul>
        </div>
        <div class="left">
            <h2>Community & Support</h2>
            <ul>
                <li><a href="<?= $basePath ?? '' ?>community.php">Community Hub</a></li>
                <li><a href="<?= $escape($discordUrl ?? 'https://discord.gg/G3rKQfQ') ?>" target="_blank" rel="noopener noreferrer">Discord Server <span aria-hidden="true">&nearr;</span></a></li>
                <li><a href="<?= $basePath ?? '' ?>contact.php">Contact our Staff</a></li>
            </ul>
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>