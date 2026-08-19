@extends('layouts.admin')

@section('title', 'Tambah Banner')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.banners._form')
            <button type="submit" class="btn btn-tl-orange">Simpan</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
