<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Desa Kalipait</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #ffffff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .reset-card {
            width: 400px;
            height: 300px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .input-group-text {
            background: #4A90E2;
            color: white;
            border: none;
        }
        .btn-reset {
            background: #145DA0;
            color: white;
            transition: 0.3s;
            font-weight: bold;
        }
        .btn-reset:hover {
            background: #0E4B7F;
        }
        .form-group {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="reset-card">
        <h3 class="mb-4 fw-bold text-primary">Lupa Password</h3>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-reset w-100 py-2 mt-3">Kirim Link Reset</button>
        </form>
        
        <div class="mt-4">
            <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
