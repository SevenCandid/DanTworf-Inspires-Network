// Vanilla JS for DIN Frontend

document.addEventListener('DOMContentLoaded', () => {

    // ─── Mobile Menu Toggle ──────────────────────────────────────────────────
    const btn  = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const nav  = document.querySelector('nav');

    function closeMenu() {
        menu.classList.remove('menu-open');
        menu.classList.add('menu-closing');
        btn.classList.remove('menu-is-open');
        document.body.style.overflow = '';   // unlock page scroll
        menu.addEventListener('animationend', () => {
            menu.classList.remove('menu-closing');
        }, { once: true });
        isMenuOpen = false;
    }

    let isMenuOpen = false;

    if (btn && menu) {
        // Hamburger button click
        btn.addEventListener('click', () => {
            if (!isMenuOpen) {
                menu.classList.remove('menu-closing');
                menu.classList.add('menu-open');
                btn.classList.add('menu-is-open');
                document.body.style.overflow = 'hidden'; // lock page scroll
                isMenuOpen = true;
            } else {
                closeMenu();
            }
        });

        // ── Close on link tap using EVENT DELEGATION (works on dynamic content) ──
        // We listen on the menu CONTAINER, not each individual link
        menu.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && isMenuOpen) {
                closeMenu();
                // Small delay lets animation start before browser navigates
                // (only needed for same-page anchors; regular hrefs are fine)
            }
        });
    }

    // ─── Scroll-aware navbar shadow ──────────────────────────────────────────
    if (nav) {
        const onScroll = () => {
            nav.classList.toggle('scrolled', window.scrollY > 10);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
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
