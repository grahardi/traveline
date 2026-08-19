<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Traveline Turen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --tl-orange: #FF6B35; --tl-blue: #0B3C5D; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, var(--tl-blue), #145C8C, var(--tl-orange));
        }
        .login-card { max-width: 400px; width: 100%; border-radius: 1rem; }
        .btn-tl-orange { background-color: var(--tl-orange); border-color: var(--tl-orange); font-weight: 600; }
        .btn-tl-orange:hover { background-color: #e85a26; border-color: #e85a26; }
    </style>
</head>
<body>
    <div class="card shadow-lg border-0 login-card p-4">
        <div class="card-body">
            <h4 class="text-center fw-bold mb-1" style="color:var(--tl-blue);">Travel<span style="color:var(--tl-orange);">ine</span> Admin</h4>
            <p class="text-center text-muted small mb-4">Masuk untuk mengelola situs</p>

            @if($errors->any())
                <div class="alert alert-danger small">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Ingat saya</label>
                </div>
                <button type="submit" class="btn btn-tl-orange w-100 text-white">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>
