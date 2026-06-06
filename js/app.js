// Vanilla JS for DIN Frontend

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        let isMenuOpen = false;
        btn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                menu.classList.remove('max-h-0', 'opacity-0');
                menu.classList.add('max-h-[500px]', 'opacity-100'); // max-h big enough to hold content
            } else {
                menu.classList.remove('max-h-[500px]', 'opacity-100');
                menu.classList.add('max-h-0', 'opacity-0');
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
