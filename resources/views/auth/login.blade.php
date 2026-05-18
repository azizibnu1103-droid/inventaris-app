@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h5 class="mb-0 fw-bold">LOGIN SISTEM INVENTARIS</h5>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Alert jika berhasil logout atau registrasi --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Menampilkan Error Jika Login Gagal --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            {{-- Gunakan old('email') bukan $user->email --}}
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">MASUK</button>
                        </div>
                    </form>
                    
                    <hr>

                    <div class="text-center mt-3">
                        <small class="text-muted">Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary">Daftar di sini</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection