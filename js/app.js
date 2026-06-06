// Vanilla JS for DIN Frontend

document.addEventListener('DOMContentLoaded', () => {

    // ─── Mobile Menu Toggle ──────────────────────────────────────────────────
    const btn  = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const nav  = document.querySelector('nav');

    if (btn && menu) {
        let isMenuOpen = false;

        btn.addEventListener('click', () => {
            if (!isMenuOpen) {
                // OPEN
                menu.classList.remove('menu-closing');
                menu.classList.add('menu-open');
                btn.classList.add('menu-is-open');   // triggers ham→X animation
                isMenuOpen = true;
            } else {
                // CLOSE: play slide-up, then truly hide
                menu.classList.remove('menu-open');
                menu.classList.add('menu-closing');
                btn.classList.remove('menu-is-open');
                menu.addEventListener('animationend', () => {
                    menu.classList.remove('menu-closing');
                }, { once: true });
                isMenuOpen = false;
            }
        });

        // Close menu when a link is tapped
        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (isMenuOpen) {
                    menu.classList.remove('menu-open');
                    menu.classList.add('menu-closing');
                    btn.classList.remove('menu-is-open');
                    menu.addEventListener('animationend', () => {
                        menu.classList.remove('menu-closing');
                    }, { once: true });
                    isMenuOpen = false;
                }
            });
        });
    }

    // ─── Scroll-aware navbar shadow ──────────────────────────────────────────
    if (nav) {
        const onScroll = () => {
            if (window.scrollY > 10) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll(); // run on load
    }

    // ─── Auto-dismiss flash messages after 5 seconds ─────────────────────────
    document.querySelectorAll('[role="alert"]').forEach(msg => {
        setTimeout(() => {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    });

});

