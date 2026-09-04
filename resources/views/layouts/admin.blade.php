<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Traveline Turen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --tl-orange: #FF6B35; --tl-blue: #0B3C5D; }
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
        .sidebar {
            width: 240px; min-height: 100vh; background: var(--tl-blue); position: fixed; top: 0; left: 0;
        }
        .sidebar .brand { color: #fff; font-weight: 800; font-size: 1.25rem; }
        .sidebar .brand span { color: var(--tl-orange); }
        .sidebar a { color: #cfe3f0; text-decoration: none; display: block; padding: .65rem 1.25rem; border-radius: .5rem; }
        .sidebar a.active, .sidebar a:hover { background: rgba(255,255,255,.1); color: #fff; }
        .content { margin-left: 240px; padding: 2rem; }
        .btn-tl-orange { background-color: var(--tl-orange); border-color: var(--tl-orange); color: #fff; font-weight: 600; }
        .btn-tl-orange:hover { background-color: #e85a26; border-color: #e85a26; color: #fff; }
        .text-tl-blue { color: var(--tl-blue); }
        @media (max-width: 768px) {
            .sidebar { width: 100%; min-height: auto; position: relative; }
            .content { margin-left: 0; padding: 1rem; }
        }
    </style>
</head>
<body>

<div class="sidebar p-3 d-flex flex-column">
    <a href="{{ route('admin.dashboard') }}" class="brand mb-4 d-block">Travel<span>ine</span> Admin</a>
    <nav class="flex-grow-1">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
        <a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"><i class="bi bi-images me-2"></i>Banner</a>
        <a href="{{ route('admin.layanans.index') }}" class="{{ request()->routeIs('admin.layanans.*') ? 'active' : '' }}"><i class="bi bi-signpost-split me-2"></i>Layanan / Rute</a>
        <a href="{{ route('admin.armadas.index') }}" class="{{ request()->routeIs('admin.armadas.*') ? 'active' : '' }}"><i class="bi bi-bus-front me-2"></i>Armada</a>
        <a href="{{ route('admin.ketersediaan.index') }}" class="{{ request()->routeIs('admin.ketersediaan.*') ? 'active' : '' }}"><i class="bi bi-ticket-perforated me-2"></i>Ketersediaan Kursi</a>
        <a href="{{ route('admin.testimonis.index') }}" class="{{ request()->routeIs('admin.testimonis.*') ? 'active' : '' }}"><i class="bi bi-chat-quote me-2"></i>Testimoni</a>
        <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="bi bi-gear me-2"></i>Pengaturan Situs</a>
        <a href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right me-2"></i>Lihat Situs</a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="btn btn-outline-light btn-sm w-100" type="submit"><i class="bi bi-box-arrow-right me-1"></i>Keluar</button>
    </form>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-tl-blue fw-bold mb-0">@yield('title', 'Dashboard')</h3>
        <span class="text-muted small">Halo, {{ auth()->user()->name ?? 'Admin' }}</span>
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
