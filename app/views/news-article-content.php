<main class="news-page">
    <a class="text-link back-to-news" href="news.php">&larr; Back to News</a>

    <article class="panel news-article">
        <header class="news-article-header">
            <p class="eyebrow">Realm news</p>
            <h1><?= $escape($post['title']) ?></h1>
            <p class="post-meta">
                Posted <?= $escape($post['date_label']) ?> by
                <span class="post-author"><?= $escape($post['author_name']) ?></span>
            </p>
        </header>
        <div class="article-content-layout">
            <?php if ($post['icon_path'] !== null): ?>
                <img class="news-icon" src="<?= $escape($post['icon_path']) ?>" alt="">
            <?php endif; ?>
            <div class="article-body"><?= $articleHtml ?></div>
        </div>
    </article>
</main>
