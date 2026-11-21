<main class="news-page">
    <header class="page-heading">
        <p class="eyebrow">From the realm</p>
        <h1>Latest News</h1>
        <p>Updates and announcements from the World of Immortality.</p>
    </header>

    <?php if ($listing['posts'] === []): ?>
        <section class="panel empty-news">
            <h2>No news yet</h2>
            <p>Check back later for realm updates and announcements.</p>
        </section>
    <?php else: ?>
        <div class="news-list">
            <?php foreach ($listing['posts'] as $post): ?>
                <article class="panel news-post">
                    <div class="news-post-layout">
                        <?php if ($post['icon_path'] !== null): ?>
                            <img class="news-icon" src="<?= $escape($post['icon_path']) ?>" alt="">
                        <?php endif; ?>
                        <div class="news-post-content">
                            <h2>
                                <a href="news.php?id=<?= $post['id'] ?>"><?= $escape($post['title']) ?></a>
                            </h2>
                            <p class="post-meta">
                                Posted <?= $escape($post['date_label']) ?> by
                                <span class="post-author"><?= $escape($post['author_name']) ?></span>
                            </p>
                            <?php if ($post['excerpt'] !== ''): ?>
                                <p><?= $escape($post['excerpt']) ?></p>
                            <?php endif; ?>
                            <a class="text-link" href="news.php?id=<?= $post['id'] ?>">Read article <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <?php if ($listing['pageCount'] > 1): ?>
            <nav class="news-pagination" aria-label="News pages">
                <?php if ($listing['page'] > 1): ?>
                    <a class="text-link" href="news.php?page=<?= $listing['page'] - 1 ?>">Newer articles</a>
                <?php endif; ?>
                <span>Page <?= $listing['page'] ?> of <?= $listing['pageCount'] ?></span>
                <?php if ($listing['page'] < $listing['pageCount']): ?>
                    <a class="text-link" href="news.php?page=<?= $listing['page'] + 1 ?>">Older articles</a>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</main>
