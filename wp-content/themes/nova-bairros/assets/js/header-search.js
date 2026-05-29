document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.header-search');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const input = form.querySelector('input[name="s"]');
        const termo = input.value.trim();
        if (!termo) return;

        window.location.href = `/noticias/?s=${encodeURIComponent(termo)}`;
    });
});