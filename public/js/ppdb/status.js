document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const baseUrl = '/ppdb/dashboard';
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ===================== 1. Upload berkas (logic lama, dipertahankan) ===================== */
    document.querySelectorAll('.berkas-input').forEach(input => {
        input.addEventListener('change', async function () {
            if (!input.files.length) return;

            const jenis = input.dataset.jenis;
            const formData = new FormData();
            formData.append('file', input.files[0]);
            formData.append('jenis_dokumen', jenis);

            const subEl = document.querySelector(`[data-doc-sub="${jenis}"]`);
            const originalText = subEl.textContent;
            subEl.innerHTML = '<span class="pp-spinner"></span> Mengunggah...';

            try {
                const res = await fetch(`${baseUrl}/berkas`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: formData,
                });

                const result = await res.json();

                if (!result.success) {
                    subEl.textContent = originalText;
                    alert(result.message || 'Gagal mengunggah berkas.');
                    return;
                }

                subEl.textContent = `Sudah diunggah: ${result.nama_asli}`;
            } catch (err) {
                subEl.textContent = originalText;
                alert('Terjadi kesalahan koneksi saat mengunggah.');
            }
        });
    });

    /* ===================== 2. Reveal bertahap (stepper + card) ===================== */
    const revealTargets = document.querySelectorAll('.reveal-on-scroll, .reveal-on-load');

    if (prefersReducedMotion) {
        revealTargets.forEach(el => el.classList.add('is-visible'));
    } else {
        // hero langsung muncul begitu load, sisanya nunggu kelihatan di layar
        document.querySelectorAll('.reveal-on-load').forEach((el, i) => {
            setTimeout(() => el.classList.add('is-visible'), 80 + i * 100);
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('is-visible'), i * 90);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
    }

    /* ===================== 3. Shimmer sekali jalan di nomor kartu ===================== */
    const ticket = document.querySelector('.ppdb-ticket');
    if (ticket && !prefersReducedMotion) {
        setTimeout(() => ticket.classList.add('is-shimmering'), 400);
    }

    /* ===================== 4. Partikel di hero (canvas, ringan) ===================== */
    const canvas = document.querySelector('.ticket-particles');
    if (canvas && !prefersReducedMotion) {
        initTicketParticles(canvas);
    }

    function initTicketParticles(canvas) {
        const ctx = canvas.getContext('2d');
        const parent = canvas.parentElement;
        let particles = [];
        let width, height, rafId;

        function resize() {
            width = canvas.width = parent.offsetWidth;
            height = canvas.height = parent.offsetHeight;
        }

        function makeParticle() {
            return {
                x: Math.random() * width,
                y: height + Math.random() * 20,
                r: 1 + Math.random() * 2,
                speed: 0.25 + Math.random() * 0.5,
                drift: (Math.random() - 0.5) * 0.3,
                alpha: 0.15 + Math.random() * 0.35,
                gold: Math.random() < 0.35,
            };
        }

        function initParticles() {
            const count = Math.max(18, Math.round((width * height) / 18000));
            particles = Array.from({ length: count }, makeParticle);
        }

        function tick() {
            ctx.clearRect(0, 0, width, height);
            particles.forEach(p => {
                p.y -= p.speed;
                p.x += p.drift;
                if (p.y < -10) Object.assign(p, makeParticle(), { y: height + 10 });

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = p.gold
                    ? `rgba(214, 175, 54, ${p.alpha})`
                    : `rgba(255, 255, 255, ${p.alpha})`;
                ctx.fill();
            });
            rafId = requestAnimationFrame(tick);
        }

        resize();
        initParticles();
        tick();

        window.addEventListener('resize', () => {
            resize();
            initParticles();
        });

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) cancelAnimationFrame(rafId);
            else tick();
        });
    }
});

/* ===================== 5. Confetti khusus hasil LULUS ===================== */
(function () {
    const canvas = document.querySelector('.hasil-confetti');
    if (!canvas) return; // cuma ada kalau lulus

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return; // hormati setting aksesibilitas, nggak maksa nyala

    const ctx = canvas.getContext('2d');
    const parent = canvas.parentElement;
    const colors = ['#2e7d32', '#d6af36', '#ffffff', '#1b5e3a'];

    let width, height, pieces, rafId, startTime;
    const DURATION = 2600; // ms — sekali burst, nggak loop selamanya

    function resize() {
        width = canvas.width = parent.offsetWidth;
        height = canvas.height = parent.offsetHeight;
    }

    function makePiece() {
        return {
            x: Math.random() * width,
            y: -20 - Math.random() * height * 0.4,
            w: 4 + Math.random() * 4,
            h: 6 + Math.random() * 6,
            speedY: 1.5 + Math.random() * 2.5,
            speedX: (Math.random() - 0.5) * 1.5,
            rot: Math.random() * 360,
            rotSpeed: (Math.random() - 0.5) * 8,
            color: colors[Math.floor(Math.random() * colors.length)],
        };
    }

    function init() {
        resize();
        const count = Math.max(40, Math.round(width / 6));
        pieces = Array.from({ length: count }, makePiece);
        startTime = performance.now();
        tick(startTime);
    }

    function tick(now) {
        const elapsed = now - startTime;
        ctx.clearRect(0, 0, width, height);

        const fadeOut = elapsed > DURATION - 500
            ? Math.max(0, 1 - (elapsed - (DURATION - 500)) / 500)
            : 1;

        pieces.forEach(p => {
            p.y += p.speedY;
            p.x += p.speedX;
            p.rot += p.rotSpeed;

            ctx.save();
            ctx.translate(p.x, p.y);
            ctx.rotate((p.rot * Math.PI) / 180);
            ctx.globalAlpha = fadeOut;
            ctx.fillStyle = p.color;
            ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
            ctx.restore();
        });

        if (elapsed < DURATION) {
            rafId = requestAnimationFrame(tick);
        } else {
            ctx.clearRect(0, 0, width, height);
        }
    }

    // Mulai sedikit delay biar nyusul setelah stamp animation kelihatan dulu
    setTimeout(init, 350);

    window.addEventListener('resize', resize);
})();