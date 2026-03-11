    $(document).ready(function() {
        // Event ketika nama dipilih
        $('#nama').change(function() {
            var selectedOption = $(this).find('option:selected');
            var nik = selectedOption.data('nik'); // Ambil nilai NIK dari data-nik
            var rt = selectedOption.data('rt');   // Ambil nilai RT dari data-rt
            var rw = selectedOption.data('rw');   // Ambil nilai RW dari data-rw

            if (nik) {
                // Isi kolom NIK, RT, dan RW dengan nilai yang sesuai
                $('#nik').val(nik);
                $('#rt').val(rt);
                $('#rw').val(rw);
            } else {
                // Kosongkan kolom jika tidak ada data
                $('#nik').val('');
                $('#rt').val('');
                $('#rw').val('');
            }
        });
    });

        // Konfirmasi Hapus
    $(".delete").click(function (e) {
        e.preventDefault();
        let url = $(this).attr("href");

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data diatas akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            didOpen: () => {
                const icon = document.querySelector(".swal2-icon");
                if (icon) {
                    icon.style.marginTop = "30px";
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    $(document).ready(function() {
    // When clicking the "Tambah Data" button (Add)
    $('#addDataBtn').click(function() {
        // Set modal for adding new data
        $('#modalTitle').text('Tambah Akun Ketua RT');
        // Use @route helper to generate the URL correctly within the JavaScript string
       // Action untuk store (POST)
        $('#modalForm').find('[name="_method"]').remove();  // Remove method for POST request
   
        // Clear all input fields for adding new data
        $('#id_rtrw').val(id);
        $('#nama').val('');
        $('#no_hp').val('');
        $('#nik').val('');
        $('#rt').val('');
        $('#rw').val('');
    });

    // When clicking the "Edit" button
    $('.btn-edit').click(function() {
        var id_rtrw = $(this).data('id_rtrw');
        var nik = $(this).data('nik');
        var nama = $(this).data('nama');
        var no_hp = $(this).data('no_hp');
        var rt = $(this).data('rt');
        var rw = $(this).data('rw');

        // Set the modal to Edit mode
        $('#modalTitle').text('Edit Akun Ketua RT');
        // Use @route helper to generate the correct URL with the id
        $('#modalForm').attr('action', "{{ route('akun.update', ':id') }}".replace(':id', id_rtrw));
        $('#modalForm').find('[name="_method"]').remove();  // Remove existing method
        $('#modalForm').append('<input type="hidden" name="_method" value="PUT">');  // Method PUT

        // Populate the form fields with current data
        $('#id_rtrw').val(id_rtrw);
        $('#nama').val(nama);
        $('#no_hp').val(no_hp);
        $('#nik').val(nik);
        $('#rt').val(rt);
        $('#rw').val(rw);

        // Open the modal
        $('#modal').modal('show');
    });
    });

    $(document).ready(function () {
        $(".select-nama").select2({
            placeholder: "Pilih Nama",
            allowClear: false,
            width: "100%",
            dropdownParent: $("#modal"),
        });

        $("#nama").on("change", function () {
            let selected = $(this).find(":selected");
            $("#nik").val(selected.data("nik") || "");
            $("#rw").val(selected.data("rw") || "");
            $("#rt").val(selected.data("rt") || "");
        });

        // Autofokus saat modal dibuka
        $("#modal").on("shown.bs.modal", function () {
            $("#nama").select2("open");
        });
    });

