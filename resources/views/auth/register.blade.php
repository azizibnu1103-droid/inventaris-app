@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5 class="mb-0 fw-bold">DAFTAR AKUN BARU</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        {{-- PILIHAN 3 TINGKAT ROLE --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Daftar Sebagai</label>
                            <select name="role" class="form-select" required>
                                <option value="guru">Guru (Hanya Lihat & Pinjam)</option>
                                <option value="admin">Admin Biasa (Kelola Barang)</option>
                                <option value="super_admin">Super Admin (Akses Penuh)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">DAFTAR SEKARANG</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-primary">Login di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection