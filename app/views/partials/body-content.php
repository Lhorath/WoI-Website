<section class="panel feature-card">
    <h2><?= $escape($page['featureTitle']) ?></h2>
    <p><?= $escape($page['featureText']) ?></p>
</section>

<section class="news-section" id="news">
    <div class="section-heading">
        <h2 class="news-heading">Latest news</h2>
    </div>
    <?php if ($newsError): ?>
        <p class="news-message" role="status">News is temporarily unavailable. Please try again later.</p>
    <?php elseif ($page['updates'] === []): ?>
        <p class="news-message">No news has been published yet.</p>
    <?php else: ?>
        <?php foreach ($page['updates'] as $update): ?>
            <article class="panel news-card">
                <header class="news-card-header">
                    <?php if ($update['icon_path'] !== null): ?>
                        <img class="news-icon" src="<?= $escape($update['icon_path']) ?>" alt="">
                    <?php endif; ?>
                    <h3 class="news-card-title"><a href="news.php?id=<?= $update['id'] ?>"><?= $escape($update['title']) ?></a></h3>
                    <p class="post-meta">
                        Posted <?= $escape($update['date_label']) ?> by
                        <span class="post-author"><?= $escape($update['author_name']) ?></span>
                    </p>
                </header>
                <div class="news-card-body article-body">
                    <?= $update['body_html'] ?>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
    <a class="button view-all-news" href="news.php">View all news <span aria-hidden="true">&rarr;</span></a>
</section>
