<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Desa Kalipait</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #89d4ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        .btn-login {
            background: #145DA0;
            color: white;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #0E4B7F;
        }

        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Bagian Login -->
        <div class="col">
            <h3 class="mb-4 fw-bold">Login</h3>

           @if(session('success'))
                <div class="alert alert-success" id="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" id="alert-error">
                    {{ session('error') }}
                </div>
            @endif


            <form action="{{ route('login.proses') }}" method="POST">
                @csrf

                <!-- Input NIK -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" value="{{ old('nik') }}" required>
                    </div>
                </div>

                <!-- Input Password dengan Show/Hide -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                        <span class="input-group-text" id="togglePassword">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <!-- Tombol Login -->
                <button type="submit" class="btn btn-login w-100 py-2">Login</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });

    setTimeout(function() {
        var successAlert = document.getElementById('alert-success');
        var errorAlert = document.getElementById('alert-error');

        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 3000); 
</script>

</body>
</html>