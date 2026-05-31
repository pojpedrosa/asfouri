// asfouri — light, dependency-free interactions.

// Mobile navigation toggle
function initMobileNav() {
    const btn = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    if (!btn || !panel) return;

    const close = () => {
        panel.dataset.open = 'false';
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    };
    const open = () => {
        panel.dataset.open = 'true';
        btn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    };

    btn.addEventListener('click', () => {
        (panel.dataset.open === 'true' ? close : open)();
    });
    panel.querySelectorAll('a').forEach((a) => a.addEventListener('click', close));
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close();
    });
}

// Reveal-on-scroll
function initReveal() {
    const els = document.querySelectorAll('.reveal');
    if (!els.length || !('IntersectionObserver' in window)) {
        els.forEach((el) => el.classList.add('is-visible'));
        return;
    }
    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.08 }
    );
    els.forEach((el) => io.observe(el));
}

// Shrink / shadow the header once the page is scrolled
function initHeaderScroll() {
    const header = document.querySelector('[data-site-header]');
    if (!header) return;
    const onScroll = () => header.toggleAttribute('data-scrolled', window.scrollY > 24);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

document.addEventListener('DOMContentLoaded', () => {
    initMobileNav();
    initReveal();
    initHeaderScroll();
});
