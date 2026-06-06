// Vanilla JS for DIN Frontend

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle - using inline styles for reliable animation with Tailwind CDN
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        let isMenuOpen = false;

        // Set initial collapsed state via inline style
        menu.style.maxHeight = '0px';
        menu.style.opacity = '0';
        menu.style.overflow = 'hidden';
        menu.style.transition = 'max-height 0.35s ease, opacity 0.25s ease';

        btn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                menu.style.maxHeight = menu.scrollHeight + 'px';
                menu.style.opacity = '1';
                // Animate hamburger to X
                btn.classList.add('menu-open');
            } else {
                menu.style.maxHeight = '0px';
                menu.style.opacity = '0';
                btn.classList.remove('menu-open');
            }
        });
    }

    // Auto-dismiss flash messages after 5 seconds
    const flashMessages = document.querySelectorAll('[role="alert"]');
    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    });
});
