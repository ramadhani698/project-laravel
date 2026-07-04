document.addEventListener('DOMContentLoaded', function () {

    const steps = document.querySelectorAll('.step-panel');
    const totalSteps = steps.length;
    let current = 1;

    const btnBack = document.getElementById('btnBack');
    const btnNext = document.getElementById('btnNext');
    const tracker = document.getElementById('tracker');

    function updateTracker() {
        tracker.querySelectorAll('.step-node').forEach(function (node) {
            const n = Number(node.dataset.step);
            node.classList.remove('done', 'active');
            if (n < current) node.classList.add('done');
            if (n === current) node.classList.add('active');
        });
    }

    function showStep(n) {
        steps.forEach(function (panel) {
            panel.classList.toggle('active', Number(panel.dataset.step) === n);
        });
        btnBack.disabled = n === 1;
        btnNext.textContent = n === totalSteps ? 'Kirim pendaftaran' : 'Lanjut';
        updateTracker();
    }

    function fillReview() {
        const namaLengkap = document.querySelector('[name="nama_lengkap"]');
        const asalSekolah = document.querySelector('[name="asal_sekolah"]');
        const jurusanTerpilih = document.querySelector('input[name="jurusan"]:checked');

        const reviewNama = document.querySelector('[data-review="nama_lengkap"]');
        const reviewAsal = document.querySelector('[data-review="asal_sekolah"]');
        const reviewJurusan = document.querySelector('[data-review="jurusan"]');

        if (reviewNama) reviewNama.textContent = namaLengkap && namaLengkap.value ? namaLengkap.value : '-';
        if (reviewAsal) reviewAsal.textContent = asalSekolah && asalSekolah.value ? asalSekolah.value : '-';
        if (reviewJurusan && jurusanTerpilih) {
            const namaJurusan = jurusanTerpilih.closest('.jurusan-card').querySelector('.name').textContent;
            reviewJurusan.textContent = namaJurusan;
        }
    }

    btnNext.addEventListener('click', function () {
        if (current < totalSteps) {
            current++;
            showStep(current);
            if (current === totalSteps) fillReview();
        } else {
            alert('Pratinjau desain — proses pengiriman belum aktif.');
        }
    });

    btnBack.addEventListener('click', function () {
        if (current > 1) {
            current--;
            showStep(current);
        }
    });

    document.querySelectorAll('.jurusan-card').forEach(function (card) {
        card.addEventListener('click', function () {
            document.querySelectorAll('.jurusan-card').forEach(function (c) {
                c.classList.remove('selected');
            });
            card.classList.add('selected');
        });
    });

    showStep(current);
});