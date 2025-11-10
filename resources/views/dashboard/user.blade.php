@extends('layouts.app')

@section('content')
<style>
    body {
    }
    .welcome-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 60px 40px;
        max-width: 700px;
        margin: 80px auto;
        transition: transform 0.3s ease;
    }
    .welcome-card:hover {
        transform: scale(1.02);
    }
    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        color: #004aad;
    }
    .welcome-subtitle {
        color: #007bff;
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    .welcome-text {
        font-size: 1rem;
        color: #555;
        margin-bottom: 30px;
    }
    .btn-continue {
        background-color: #1462c1;
        color: #fff;
        font-size: 1.1rem;
        padding: 12px 35px;
        border-radius: 30px;
        transition: background 0.3s ease;
    }
    .btn-continue:hover {
        background-color: #121b1e;
    }
</style>

<div class="welcome-card text-center">
    <img src="{{ asset('images/logoLp.png') }}" alt="LP3I Logo" width="70" class="mb-4">
    
    <h1 class="welcome-title mb-3">Selamat Datang di Pendaftaran Kampus</h1>
    <h2 class="welcome-subtitle">LP3I College Purwakarta</h2>
    <p class="welcome-text">
        Terima kasih telah memilih LP3I College Purwakarta sebagai langkah awal menuju masa depanmu.  
        Silakan lanjutkan untuk melakukan verifikasi data E-KYC sebagai proses awal pendaftaran mahasiswa baru.
    </p>
    <a href="{{ route('ekyc.step1') }}" class="btn btn-continue">
        Mulai Pendaftaran
    </a>
</div>
@endsection
