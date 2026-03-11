$(document).ready(function () {
    // Event ketika nama dipilih
    $("#nama").change(function () {
        var selectedOption = $(this).find("option:selected");
        var nik = selectedOption.data("nik"); // Ambil nilai NIK dari data-nik
        var rw = selectedOption.data("rw"); // Ambil nilai RW dari data-rw

        if (nik) {
            // Isi kolom NIK, dan RW dengan nilai yang sesuai
            $("#nik").val(nik);
            $("#rw").val(rw);
        } else {
            // Kosongkan kolom jika tidak ada data
            $("#nik").val("");
            $("#rw").val("");
        }
    });
});

$(".delete").click(function (e) {
    e.preventDefault();
    const form = $(this).closest("form");

    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data di atas akan dihapus secara permanen!",
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
            form.submit();
        }
    });
});


$(document).ready(function () {
    // Tombol Tambah Data
    $("#btn-add").click(function () {
        $("#modalTitle").text("Tambah Akun Ketua RW");
        $("#modalForm").find('[name="_method"]').remove();
        $("#modalForm")[0].reset();
        $("#modal").modal("show");
    });

    // Tombol Edit
    $(".btn-edit").click(function () {
        var id_rtrw = $(this).data("id_rtrw");
        var nik = $(this).data("nik");
        var nama = $(this).data("nama");
        var no_hp = $(this).data("no_hp");
        var rw = $(this).data("rw");
        var updateUrl = $(this).data("url");

        $("#modalTitle").text("Edit Akun Ketua RW");
        $("#modalForm").attr("action", updateUrl);
        $("#modalForm").find('[name="_method"]').remove();
        $("#modalForm").append(
            '<input type="hidden" name="_method" value="PUT">'
        );

        $("#id_rtrw").val(id_rtrw);
        $("#nik").val(nik);
        $("#nama").val(nama);
        $("#no_hp").val(no_hp);
        $("#rw").val(rw);

        $("#modal").modal("show");
    });

    // Auto isi NIK dan RW dari Pilihan Nama
    $("#nama").change(function () {
        var selectedOption = $(this).find("option:selected");
        var nik = selectedOption.data("nik") || "";
        var rw = selectedOption.data("rw") || "";
        $("#nik").val(nik);
        $("#rw").val(rw);
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
    });

    // Autofokus saat modal dibuka
    $("#modal").on("shown.bs.modal", function () {
        $("#nama").select2("open");
    });
});
