$(document).ready(function () {
    // Handle tombol Tambah
    $('#btnTambahSurat').on('click', function () {
        const idSuratBaru = $(this).data('id_surat');

        $('#formSurat').trigger('reset'); // Reset semua input
        $('#formSurat').attr('action', $('#formSurat').data('store-url')); // Kembali ke store
        $('#formMethod').val('POST'); // Method POST

        $('#inputIdSurat').val(idSuratBaru);
        $('#modalTitle').text('Tambah Surat');

        // Sembunyikan gambar lama
        $('#previewGambarLama').addClass('d-none');
        $('#gambarLama').attr('src', '');

        $('#modalForm').modal('show');
    });

    // Handle tombol Edit
    $('.btnEditSurat').on('click', function () {
        const action = $(this).data('action');
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const gambar = $(this).data('gambar'); // Pastikan kamu passing data-gambar di button!

        $('#formSurat').attr('action', action);
        $('#formMethod').val('PUT'); // Method PUT

        $('#inputIdSurat').val(id);
        $('#inputNamaSurat').val(nama);
        $('#modalTitle').text('Edit Surat');

        // Tampilkan gambar lama
        if (gambar) {
            $('#previewGambarLama').removeClass('d-none');
            $('#gambarLama').attr('src', '/storage/surat/' + gambar);
        } else {
            $('#previewGambarLama').addClass('d-none');
            $('#gambarLama').attr('src', '');
        }

        $('#modalForm').modal('show');
    });




    // Konfirmasi Hapus (opsional)
    $(".btnDeleteSurat").click(function (e) {
        e.preventDefault();
        const nama = $(this).data("nama");
        const form = $(this).closest("form");

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: 'Data surat "' + nama + '" akan dihapus!',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6", 
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
