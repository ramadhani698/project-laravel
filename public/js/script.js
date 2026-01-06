// SHRINK EFFECT
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 10) {
        navbar.classList.add("shrink");
    } else {
        navbar.classList.remove("shrink");
    }
});

// ACTIVE MENU HIGHLIGHT AUTOMATIS
document.querySelectorAll(".nav-link").forEach((link) => {
    if (link.href === window.location.href) {
        link.classList.add("active");
    }
});

// COUNTER ANIMASI ANGKA STATISTIK
document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");
    const speed = 200; // semakin kecil semakin cepat

    const startCounter = (counter) => {
        const target = +counter.getAttribute("data-target");
        let count = 0;

        const updateCount = () => {
            const increment = target / speed;
            count += increment;

            if (count < target) {
                counter.innerText = Math.ceil(count);
                requestAnimationFrame(updateCount);
            } else {
                counter.innerText = target.toLocaleString("id-ID");
            }
        };

        updateCount();
    };

    // Jalankan saat section terlihat
    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    startCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.6 }
    );

    counters.forEach((counter) => observer.observe(counter));
});
