/**
 * NBA PLAYOFFS 2026 - Hlavní skript
 * Zajišťuje animace při scrollování a jednoduché interaktivní prvky.
 */

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Animace prvků při scrollování (Scroll Reveal)
    const reveals = document.querySelectorAll('.reveal');
    const revealOnScroll = () => {
        reveals.forEach(el => {
            const isVisible = el.getBoundingClientRect().top < window.innerHeight - 150;
            if (isVisible) el.classList.add('active');
        });
    };

    // 2. Parallax efekt pro Hero sekci (pouze pokud existuje obrázek s třídou .hero-img)
    const heroImg = document.querySelector('.hero-img');
    const handleScrollEffects = () => {
        revealOnScroll();
        if (heroImg) {
            const scrolled = window.pageYOffset;
            heroImg.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
    };

    // 3. Interaktivita pro anketu (simulace kliknutí)
    document.querySelectorAll('.poll-option').forEach(option => {
        option.addEventListener('click', () => {
            option.style.transform = 'scale(0.98)';
            setTimeout(() => option.style.transform = '', 100);
            console.log('Hlas zaznamenán');
        });
    });

    // Registrace událostí
    window.addEventListener('scroll', handleScrollEffects);
    handleScrollEffects(); // Spustit hned po načtení
});
