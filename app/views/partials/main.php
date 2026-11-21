<main>
    <section class="home-slider" aria-label="Featured images" data-slider>
        <div class="slider-track">
            <?php foreach ($page['slides'] as $index => $slide): ?>
                <figure class="slider-slide"<?= $index === 0 ? '' : ' hidden' ?>>
                    <img src="assets/images/<?= $escape($slide['image']) ?>"
                         alt="World of Immortality - featured image <?= $index + 1 ?>">
                    <figcaption class="slider-caption">
                        <h1><?= $escape($slide['heading']) ?></h1>
                        <p><?= $escape($slide['subheading']) ?></p>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
        <button class="slider-button slider-previous" type="button" data-slider-previous
                aria-label="Show previous image">&lsaquo;</button>
        <button class="slider-button slider-next" type="button" data-slider-next
                aria-label="Show next image">&rsaquo;</button>
        <div class="slider-indicators" data-slider-indicators aria-label="Choose an image"></div>
    </section>

    <div class="content-grid">
        <div class="main-column">
            <?php require __DIR__ . '/body-content.php'; ?>
        </div>
        <?php require __DIR__ . '/aside.php'; ?>
    </div>
</main>
