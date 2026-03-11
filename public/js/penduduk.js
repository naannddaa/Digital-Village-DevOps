document.addEventListener("DOMContentLoaded", function () {
    const kewarganegaraan = document.querySelector(
        'select[name="kewarganegaraan"]'
    );
    const noKitap = document.querySelector('input[name="no_kitap"]');

    function toggleKitap() {
        if (kewarganegaraan.value === "WNI") {
            noKitap.value = "";
            noKitap.setAttribute("disabled", true);
        } else if (kewarganegaraan.value === "WNA") {
            noKitap.removeAttribute("disabled");
        } else {
            noKitap.setAttribute("disabled", true);
            noKitap.value = "";
        }
    }

    toggleKitap();
    kewarganegaraan.addEventListener("change", toggleKitap);
});

$(document).ready(function () {
    $(".btn-edit").click(function () {
        const data = $(this).data();

        $("#exampleModalLabel").text("Edit Anggota Keluarga");
        $("#anggotaForm").attr("action", "/admin/master_penduduk/" + data.nik);
        $("#formMethod").val("PUT");

        $('[name="nik"]').val(data.nik).prop("readonly", true);
        $('[name="nama_lengkap"]').val(data.nama_lengkap);
        $('[name="tempat_lahir"]').val(data.tempat_lahir);
        $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
        $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
        $('[name="agama"]').val(data.agama);
        $('[name="pendidikan"]').val(data.pendidikan);
        $('[name="pekerjaan"]').val(data.pekerjaan);
        $('[name="golongan_darah"]').val(data.golongan_darah);
        $('[name="status_perkawinan"]').val(data.status_perkawinan);
        $('[name="tanggal_perkawinan"]').val(data.tanggal_perkawinan);
        $('[name="status_keluarga"]').val(data.status_keluarga);
        $('[name="kewarganegaraan"]')
            .val(data.kewarganegaraan)
            .trigger("change");
        $('[name="no_paspor"]').val(data.no_paspor);
        $('[name="no_kitap"]').val(data.no_kitap);
        $('[name="nama_ayah"]').val(data.nama_ayah);
        $('[name="nama_ibu"]').val(data.nama_ibu);

        $("#exampleModal").modal("show");
    });

    $("#exampleModal").on("hidden.bs.modal", function () {
        $("#anggotaForm")[0].reset();
        $("#formMethod").val("POST");
        $("#anggotaForm").attr("action", "/admin/master_penduduk/masuk");
        $("#exampleModalLabel").text("Tambah Anggota Keluarga");
        $('[name="nik"]').prop("readonly", false);
    });

    $(".delete").click(function (e) {
        e.preventDefault();
        let nama = $(this).data("nama_lengkap");
        let url = $(this).attr("href");

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data atas nama " + nama + " akan dihapus!",
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
});
