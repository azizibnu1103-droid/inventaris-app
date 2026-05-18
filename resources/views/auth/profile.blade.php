@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <div class="card-body">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle mb-3 shadow border" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 120px; height: 120px; font-size: 50px; font-weight: bold;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <span class="badge bg-secondary px-3 py-2 text-uppercase">{{ $user->role }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white fw-bold py-3">PENGATURAN DATA DIRI</div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Ganti Foto Profil</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Alamat Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">SIMPAN PERUBAHAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection