<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            timer: 3000,  // Durasi 5 detik
            showConfirmButton: false, 
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
        });
    @elseif (session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: '{{ session('warning') }}',
            confirmButtonColor: '#ffc107',
        });
    @endif

   @if ($errors->any())
    let errorText = `{!! implode('<br>', $errors->all()) !!}`;
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        html: errorText,
        confirmButtonColor: '#d33',
    });
@endif
</script>
