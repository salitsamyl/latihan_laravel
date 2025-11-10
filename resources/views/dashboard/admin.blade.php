@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="fw-bold text-dark mb-1">Dashboard</h4>
    <p class="text-muted small mb-4">Ringkas & Cepat</p>

    <!-- Grid sejajar (1 baris 4 kotak) -->
    <div class="d-flex flex-wrap justify-content-center gap-4">

        <!-- Mahasiswa -->
        <div class="card dashboard-card text-center"
             style="background: linear-gradient(135deg, #e3f2fd, #bbdefb);">
            <i class="bi bi-people-fill text-primary fs-3 mb-2"></i>
            <h5 class="fw-bold text-primary mb-0">{{ $totalMahasiswa ?? 0 }}</h5>
            <small class="text-primary">Mahasiswa</small>
            <a href="{{ route('mahasiswa.index') }}" 
               class="btn btn-primary btn-sm rounded-pill mt-2 text-white">
               Lihat
            </a>
        </div>

        <!-- Dosen -->
        <div class="card dashboard-card text-center"
             style="background: linear-gradient(135deg, #e8f5e8, #c8e6c9);">
            <i class="bi bi-person-badge-fill text-success fs-3 mb-2"></i>
            <h5 class="fw-bold text-success mb-0">{{ $totalDosen ?? 0 }}</h5>
            <small class="text-success">Dosen</small>
            <a href="{{ route('dosen.index') }}" 
               class="btn btn-success btn-sm rounded-pill mt-2 text-white">
               Lihat
            </a>
        </div>

        <!-- Ruangan -->
        <div class="card dashboard-card text-center"
             style="background: linear-gradient(135deg, #fff8e1, #ffecb3);">
            <i class="bi bi-building text-warning fs-3 mb-2"></i>
            <h5 class="fw-bold text-warning mb-0">{{ $totalRuangan ?? 0 }}</h5>
            <small class="text-warning">Ruangan</small>
            <a href="{{ route('ruangan.index') }}" 
               class="btn btn-warning btn-sm rounded-pill mt-2 text-white">
               Lihat
            </a>
        </div>

        <!-- Mata Kuliah -->
        <div class="card dashboard-card text-center"
             style="background: linear-gradient(135deg, #fce4ec, #f8bbd0);">
            <i class="bi bi-journal-bookmark-fill text-danger fs-3 mb-2"></i>
            <h5 class="fw-bold text-danger mb-0">{{ $totalMatkul ?? 0 }}</h5>
            <small class="text-danger">Mata Kuliah</small>
            <a href="{{ route('matkul.index') }}" 
               class="btn btn-danger btn-sm rounded-pill mt-2 text-white">
               Lihat
            </a>
        </div>

    </div>
</div>

<style>
    .dashboard-card {
        width: 200px;
        border: none;
        border-radius: 1rem;
        padding: 1.5rem 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .btn-sm {
        font-size: 0.8rem;
        padding: 0.3rem 0.5rem;
    }
    small {
        font-size: 0.8rem;
    }
</style>
@endsection
