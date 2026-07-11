document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const baseUrl = '/ppdb/dashboard';
    let currentStep = 1;

    const panels = document.querySelectorAll('.step-panel');
    const trackerNodes = document.querySelectorAll('.step-node');
    const btnNext = document.getElementById('btnNext');
    const btnBack = document.getElementById('btnBack');

    const formState = {};
    const uploadedJenis = new Set();
    document.querySelectorAll('.upload-row[data-uploaded="1"]').forEach(row => {
        uploadedJenis.add(row.dataset.jenisRow);
    });
    function showStep(step) {
        panels.forEach(p => p.classList.toggle('active', Number(p.dataset.step) === step));
        trackerNodes.forEach(n => {
            const num = Number(n.dataset.step);
            n.classList.toggle('active', num === step);
            n.classList.toggle('done', num < step);
        });
        currentStep = step;
        btnBack.style.visibility = step === 1 ? 'hidden' : 'visible';
        btnNext.style.display = step === 5 ? 'none' : 'inline-block';

        // NEW: setiap kali masuk step 5, render ulang ringkasan dari state terbaru
        if (step === 5) {
            updateReviewPanel();
        }
    }

    function updateReviewPanel() {
        const namaEl = document.querySelector('[data-review="nama_lengkap"]');
        if (namaEl) namaEl.textContent = formState.nama_lengkap || '-';

        const asalEl = document.querySelector('[data-review="asal_sekolah"]');
        if (asalEl) asalEl.textContent = formState.asal_sekolah || '-';

        const jurusanEl = document.querySelector('[data-review="jurusan"]');
        if (jurusanEl) jurusanEl.textContent = formState.jurusan_name || '-';

        const berkasEl = document.getElementById('reviewBerkasCount');
        if (berkasEl) berkasEl.textContent = `${uploadedJenis.size} / 7`;
    }

    function clearErrors(panel) {
        panel.querySelectorAll('.error-text').forEach(el => el.textContent = '');
        panel.querySelectorAll('input, select, textarea').forEach(el => el.classList.remove('is-invalid'));
    }

    function showErrors(panel, errors) {
        Object.keys(errors).forEach(field => {
            const errEl = panel.querySelector(`[data-error="${field}"]`);
            if (errEl) errEl.textContent = errors[field][0];
            const input = panel.querySelector(`[name="${field}"]`);
            if (input) input.classList.add('is-invalid');
        });
    }

    function collectStepData(panel) {
        const data = {};
        panel.querySelectorAll('input, select, textarea').forEach(el => {
            if (el.type === 'radio') {
                if (el.checked) data[el.name] = el.value;
            } else if (el.name) {
                data[el.name] = el.value;
            }
        });
        return data;
    }

    async function saveStep(step) {
        const panel = document.querySelector(`.step-panel[data-step="${step}"]`);
        clearErrors(panel);

        const data = collectStepData(panel);

        try {
            const res = await fetch(`${baseUrl}/step/${step}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const result = await res.json();

            if (res.status === 422) {
                showErrors(panel, result.errors);
                return false;
            }

            if (!result.success) {
                alert(result.message || 'Gagal menyimpan data.');
                return false;
            }

            // NEW: simpan data step ini ke state, biar bisa dipakai di review
            Object.assign(formState, data);

            // NEW: khusus step jurusan (step 3), ambil juga nama jurusan dari card yang dipilih
            if (step === 3) {
                const selectedCard = panel.querySelector('.jurusan-card.selected');
                if (selectedCard) {
                    formState.jurusan_name = selectedCard.dataset.name;
                }
            }

            return true;
        } catch (err) {
            alert('Terjadi kesalahan koneksi. Coba lagi.');
            return false;
        }
    }

    btnNext.addEventListener('click', async function () {
        if (currentStep >= 5) return;

        btnNext.disabled = true;
        btnNext.textContent = 'Menyimpan...';

        const success = await saveStep(currentStep);

        btnNext.disabled = false;
        btnNext.textContent = 'Lanjut';

        if (success) {
            showStep(currentStep + 1);
        }
    });

    btnBack.addEventListener('click', function () {
        if (currentStep > 1) showStep(currentStep - 1);
    });

    document.querySelectorAll('.jurusan-card').forEach(card => {
        card.addEventListener('click', function () {
            document.querySelectorAll('.jurusan-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            card.querySelector('input[type="radio"]').checked = true;
        });
    });

    document.querySelectorAll('.berkas-input').forEach(input => {
        input.addEventListener('change', async function () {
            if (!input.files.length) return;

            const jenis = input.dataset.jenis;
            const formData = new FormData();
            formData.append('file', input.files[0]);
            formData.append('jenis_dokumen', jenis);

            const subEl = document.querySelector(`[data-doc-sub="${jenis}"]`);
            const originalText = subEl.textContent;
            subEl.textContent = 'Mengunggah...';

            try {
                const res = await fetch(`${baseUrl}/berkas`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const result = await res.json();

                if (!result.success) {
                    subEl.textContent = originalText;
                    alert(result.message || 'Gagal mengunggah berkas.');
                    return;
                }

                subEl.textContent = `Sudah diunggah: ${result.nama_asli}`;
                uploadedJenis.add(jenis);
                updateReviewPanel();

                // NEW: bersihkan pesan error submit kalau ada, karena user baru saja upload dokumen
                const submitErrorEl = document.getElementById('submitError');
                if (submitErrorEl) submitErrorEl.textContent = '';
            } catch (err) {
                subEl.textContent = originalText;
                alert('Terjadi kesalahan koneksi saat mengunggah.');
            }
        });
    });

    const btnSubmitFinal = document.getElementById('btnSubmitFinal');
    if (btnSubmitFinal) {
        btnSubmitFinal.addEventListener('click', async function () {
            const errorEl = document.getElementById('submitError');
            errorEl.textContent = '';
            btnSubmitFinal.disabled = true;
            btnSubmitFinal.textContent = 'Mengirim...';

            try {
                const res = await fetch(`${baseUrl}/submit`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });

                const result = await res.json();

                if (!result.success) {
                    errorEl.textContent = result.message;
                    if (result.kurang && result.kurang.length) {
                        errorEl.textContent += ' (' + result.kurang.join(', ') + ')';
                    }
                    return;
                }

                window.location.reload();
            } catch (err) {
                errorEl.textContent = 'Terjadi kesalahan koneksi.';
            } finally {
                btnSubmitFinal.disabled = false;
                btnSubmitFinal.textContent = 'Kirim Pendaftaran';
            }
        });
    }

    const initialStep = Number(document.querySelector('#tracker').dataset.currentStep || 1);
    showStep(Math.min(initialStep, 5));
});