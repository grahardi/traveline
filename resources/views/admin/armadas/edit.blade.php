@extends('layouts.admin')

@section('title', 'Ubah Armada')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.armadas.update', $armada) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.armadas._form')
            <button type="submit" class="btn btn-tl-orange mt-3">Perbarui</button>
            <a href="{{ route('admin.armadas.index') }}" class="btn btn-outline-secondary mt-3">Batal</a>
        </form>
    </div>
</div>
@endsection
