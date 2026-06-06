// Vanilla JS for DIN Frontend

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle — CSS class-driven animation
    const btn  = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        let isMenuOpen = false;

        btn.addEventListener('click', () => {
            if (!isMenuOpen) {
                // OPEN: remove closing class, add open class
                menu.classList.remove('menu-closing');
                menu.classList.add('menu-open');
                isMenuOpen = true;
            } else {
                // CLOSE: swap to closing animation, hide when it finishes
                menu.classList.remove('menu-open');
                menu.classList.add('menu-closing');
                // Wait for slideUp animation (250ms) then truly hide
                menu.addEventListener('animationend', function onEnd() {
                    menu.classList.remove('menu-closing');
                    menu.removeEventListener('animationend', onEnd);
                }, { once: true });
                isMenuOpen = false;
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

