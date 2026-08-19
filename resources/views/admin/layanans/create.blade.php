@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.layanans.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.layanans._form')
            <button type="submit" class="btn btn-tl-orange">Simpan</button>
            <a href="{{ route('admin.layanans.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
