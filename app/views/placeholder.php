<?php
declare(strict_types=1);
?>
<main class="page-container">
    <article class="panel page-card">
        <header class="page-header">
            <?php if (!empty($pageCategory)): ?>
                <p class="eyebrow"><?= $escape($pageCategory) ?></p>
            <?php endif; ?>
            <h1><?= $escape($pageHeading ?? $pageTitle) ?></h1>
            <?php if (!empty($pageSubtitle)): ?>
                <p class="page-subtitle"><?= $escape($pageSubtitle) ?></p>
            <?php endif; ?>
        </header>

        <div class="placeholder-notice">
            <span class="placeholder-badge">Placeholder</span>
            <p><?= $escape($placeholderMessage ?? 'This page from the classic World of Immortality website has been prepared in the modern MVC architecture. Functional features will be integrated in an upcoming phase.') ?></p>
        </div>

        <div class="page-content article-body">
            <?php if (!empty($pageDescription)): ?>
                <p><?= $escape($pageDescription) ?></p>
            <?php endif; ?>

            <?php if (!empty($pageContentHtml)): ?>
                <?= $pageContentHtml ?>
            <?php endif; ?>

            <?php if (!empty($pageItems) && is_array($pageItems)): ?>
                <div class="placeholder-grid">
                    <?php foreach ($pageItems as $item): ?>
                        <div class="placeholder-item">
                            <?php if (!empty($item['icon'])): ?>
                                <img src="<?= $basePath ?>assets/images/icons/<?= $escape($item['icon']) ?>" alt="" class="placeholder-icon">
                            <?php endif; ?>
                            <div class="placeholder-item-content">
                                <h3>
                                    <?php if (!empty($item['url'])): ?>
                                        <?php $isExternal = preg_match('#^(?:https?:)?//#i', $item['url']) === 1; ?>
                                        <a href="<?= $isExternal ? $escape($item['url']) : ($basePath . $escape($item['url'])) ?>"<?= $isExternal ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
                                            <?= $escape($item['title']) ?><?= $isExternal ? ' <span aria-hidden="true">&nearr;</span>' : '' ?>
                                        </a>
                                    <?php else: ?>
                                        <?= $escape($item['title']) ?>
                                    <?php endif; ?>
                                </h3>
                                <p><?= $escape($item['description']) ?></p>
                                <?php if (!empty($item['badge'])): ?>
                                    <span class="item-badge"><?= $escape($item['badge']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <footer class="page-footer-actions">
            <a class="button view-all-news" href="<?= $basePath ?>index.php">&larr; Return to Home</a>
            <?php if (!empty($pageBackUrl) && !empty($pageBackLabel)): ?>
                <a class="text-link" href="<?= $basePath . $escape($pageBackUrl) ?>"><?= $escape($pageBackLabel) ?></a>
            <?php endif; ?>
        </footer>
    </article>
</main>
