<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Gagal Membuat PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            background-color: #fdfdfd;
            color: #333;
        }
        .error-box {
            border: 1px solid #ccc;
            padding: 30px;
            background-color: #fff3f3;
            border-left: 5px solid #f44336;
        }
        h1 {
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <h1>Gagal Membuat PDF</h1>
        <p>{{ $message }}</p>
        <a href="{{ url()->previous() }}">← Kembali</a>
    </div>
</body>
</html>
