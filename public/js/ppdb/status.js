document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const baseUrl = '/ppdb/dashboard';

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
});