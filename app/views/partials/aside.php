<aside class="sidebar">
    <section class="panel status-card" aria-labelledby="status-title">
        <p class="eyebrow">Realm status</p>
        <h2 id="status-title" class="realm-state <?= $realmStatus['online'] ? 'online' : 'offline' ?>">
            <span class="status-dot"></span>
            <?= $realmStatus['online'] ? 'Online' : 'Offline' ?>
        </h2>
        <div class="realm-status-details">
            <dl class="realm-rate-list player-count">
                <div><dt>Players online</dt><dd><?= $realmStatus['onlinePlayers'] === null ? 'Unavailable' : $realmStatus['onlinePlayers'] ?></dd></div>
            </dl>
            <section class="realm-rate-group" aria-labelledby="xp-rate-title">
                <h3 id="xp-rate-title">XP rates</h3>
                <dl class="realm-rate-list">
                    <?php foreach ($realmStatus['xpRates'] as $rate): ?>
                        <div><dt><?= $escape($rate['label']) ?></dt><dd><?= $escape($rate['value']) ?></dd></div>
                    <?php endforeach; ?>
                </dl>
            </section>
            <section class="realm-rate-group" aria-labelledby="drop-rate-title">
                <h3 id="drop-rate-title">Drop rates</h3>
                <dl class="realm-rate-list">
                    <?php foreach ($realmStatus['dropRates'] as $rate): ?>
                        <div><dt><?= $escape($rate['label']) ?></dt><dd><?= $escape($rate['value']) ?></dd></div>
                    <?php endforeach; ?>
                </dl>
            </section>
        </div>
    </section>

    <section class="panel sidebar-card">
        <p class="eyebrow">New here?</p>
        <h2>Find your next step</h2>
        <p>Create an account, then add your own setup guide or community links here.</p>
        <a class="text-link" href="register.php">Register now <span aria-hidden="true">&rarr;</span></a>
    </section>
</aside>
