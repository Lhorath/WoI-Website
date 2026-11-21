document.querySelectorAll('[data-slider]').forEach((slider) => {
    const slides = Array.from(slider.querySelectorAll('.slider-slide'));
    const indicators = slider.querySelector('[data-slider-indicators]');
    const previousButton = slider.querySelector('[data-slider-previous]');
    const nextButton = slider.querySelector('[data-slider-next]');

    if (slides.length < 2 || !indicators || !previousButton || !nextButton) {
        return;
    }

    let activeIndex = 0;
    const indicatorButtons = slides.map((slide, index) => {
        const button = document.createElement('button');
        button.className = 'slider-indicator';
        button.type = 'button';
        button.setAttribute('aria-label', `Show image ${index + 1}`);
        button.setAttribute('aria-pressed', index === activeIndex ? 'true' : 'false');
        button.addEventListener('click', () => showSlide(index));
        indicators.appendChild(button);
        return button;
    });

    function showSlide(index) {
        activeIndex = (index + slides.length) % slides.length;
        slides.forEach((slide, slideIndex) => {
            slide.hidden = slideIndex !== activeIndex;
            indicatorButtons[slideIndex].setAttribute(
                'aria-pressed',
                slideIndex === activeIndex ? 'true' : 'false'
            );
        });
    }

    previousButton.addEventListener('click', () => showSlide(activeIndex - 1));
    nextButton.addEventListener('click', () => showSlide(activeIndex + 1));
});
