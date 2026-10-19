document.querySelectorAll('.service-flip-button').forEach((button) => {
    button.addEventListener('click', () => {
        const card = button.closest('.service-card');
        card.classList.toggle('is-flipped');
        card.setAttribute('aria-label', card.classList.contains('is-flipped')
            ? 'Detalles del servicio'
            : 'Vista general del servicio');
    });
});
