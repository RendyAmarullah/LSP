<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa Baru - Universitas Teknologi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-microchip me-2"></i> TechUni
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#majors">Program Studi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#admission">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-lg-3" href="{{ url('/pendaftaran') }}">Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        
    </nav>

    <section id="hero" class="hero-section d-flex align-items-center">
        <div class="container text-center text-white">
            <h1 class="display-3 fw-bold mb-4 animate-up">Masa Depan Teknologi Dimulai Di Sini</h1>
            <p class="lead mb-5 animate-up delay-1">Jadilah inovator berikutnya di Universitas Teknologi terkemuka kami.</p>
            <a href="{{ url('/pendaftaran') }}" class="btn btn-lg btn-primary animate-up delay-2 shadow-lg">Gabung Sekarang!</a>
        </div>
    </section>

    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://via.placeholder.com/600x400/007bff/ffffff?text=Tech+Campus" class="img-fluid rounded shadow-sm" alt="Tentang Universitas Teknologi">
                </div>
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4">Membangun Fondasi Inovasi</h2>
                    <p class="lead">Universitas Teknologi kami berkomitmen untuk mencetak lulusan yang siap menghadapi tantangan dunia digital.</p>
                    <p>Dengan kurikulum yang relevan, fasilitas laboratorium terkini, dan pengajar ahli di bidangnya, kami memastikan setiap mahasiswa mendapatkan pengalaman belajar terbaik.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Kurikulum Berbasis Industri</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Laboratorium Canggih</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Jaringan Alumni Kuat</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="majors" class="py-5 bg-white">
        <div class="container">
            <h2 class="display-5 fw-bold text-center mb-5">Program Studi Unggulan Kami</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="card h-100 shadow-sm text-center major-card animate-up">
                        <div class="card-body">
                            <i class="fas fa-laptop-code major-icon mb-3"></i>
                            <h5 class="card-title fw-bold">Ilmu Komputer</h5>
                            <p class="card-text">Mempelajari dasar-dasar komputasi, algoritma, dan rekayasa perangkat lunak.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm text-center major-card animate-up delay-1">
                        <div class="card-body">
                            <i class="fas fa-network-wired major-icon mb-3"></i>
                            <h5 class="card-title fw-bold">Jaringan & Keamanan Siber</h5>
                            <p class="card-text">Fokus pada infrastruktur jaringan, keamanan sistem, dan perlindungan data.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm text-center major-card animate-up delay-2">
                        <div class="card-body">
                            <i class="fas fa-robot major-icon mb-3"></i>
                            <h5 class="card-title fw-bold">Kecerdasan Buatan & Data Sains</h5>
                            <p class="card-text">Mengembangkan sistem cerdas, analisis data besar, dan pembelajaran mesin.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm text-center major-card animate-up delay-3">
                        <div class="card-body">
                            <i class="fas fa-lightbulb major-icon mb-3"></i>
                            <h5 class="card-title fw-bold">Sistem Informasi</h5>
                            <p class="card-text">Mengintegrasikan teknologi informasi dengan kebutuhan bisnis dan organisasi.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                 <div class="col">
                    <div class="card h-100 shadow-sm text-center major-card animate-up delay-4">
                        <div class="card-body">
                            <i class="fas fa-cubes major-icon mb-3"></i>
                            <h5 class="card-title fw-bold">Teknik Komputer</h5>
                            <p class="card-text">Desain hardware, embedded system, dan rekayasa perangkat keras.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                 <div class="col">
                    <div class="card h-100 shadow-sm text-center major-card animate-up delay-5">
                        <div class="card-body">
                            <i class="fas fa-mobile-alt major-icon mb-3"></i>
                            <h5 class="card-title fw-bold">Pengembangan Aplikasi</h5>
                            <p class="card-text">Membangun aplikasi web dan mobile yang inovatif dan *user-friendly*.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="admission" class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="display-5 fw-bold mb-4">Siap Bergabung dengan Komunitas Teknologi Kami?</h2>
            <p class="lead mb-5">Jadwal pendaftaran mahasiswa baru telah dibuka. Jangan lewatkan kesempatan Anda!</p>
            <a href="{{ url('/pendaftaran') }}" class="btn btn-lg btn-light shadow-lg animate-pulse">Daftar Sekarang!</a>
        </div>
    </section>

    <section id="contact" class="py-5 bg-light">
        
        <div class="container">
            <div class="row">
               <div class="col-lg-8">
                    
                     {{-- BAGIAN PENGUMUMAN --}}
            <div class="d-flex align-items-center mb-3 mt-5">
                <h5 class="fw-bold text-secondary m-0">📢 Papan Pengumuman</h5>
                <span class="badge bg-primary ms-2">{{ $pengumuman->count() }} Baru</span>
            </div>
            
            <div class="row">
                @forelse($pengumuman as $info)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm"> 
                            <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h5 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 150px;" title="{{ $info->judul }}">
                                        {{ $info->judul }}
                                    </h5>
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        <i class="far fa-clock me-1"></i> {{ $info->created_at->format('d M') }}
                                    </small>
                                </div>
                            </div>
            
                            <div class="card-body d-flex flex-column">
                                @if($info->gambar)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $info->gambar) }}" class="img-fluid rounded w-100" 
                                             alt="Gambar Pengumuman" style="height: 150px; object-fit: cover;">
                                    </div>
                                @endif
                                
                                <p class="card-text text-secondary flex-grow-1">
                                    {{ Str::limit($info->isi, 100) }}
                                </p>

                                <button type="button" class="btn btn-sm btn-outline-primary mt-3 stretched-link" 
                                        data-bs-toggle="modal" data-bs-target="#pengumumanModal{{ $info->id }}">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-secondary d-flex align-items-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>Belum ada pengumuman dari pihak kampus saat ini.</div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
{{-- MODAL DETAIL PENGUMUMAN --}}
@foreach($pengumuman as $info)
<div class="modal fade" id="pengumumanModal{{ $info->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark w-100">
                    {{ $info->judul }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3 text-muted border-bottom pb-2">
                    <i class="far fa-calendar-alt me-2"></i> Diposting pada: {{ $info->created_at->translatedFormat('l, d F Y') }}
                </div>
                @if($info->gambar)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $info->gambar) }}" class="img-fluid rounded shadow-sm" alt="Detail Gambar">
                    </div>
                @endif
                <div class="text-dark" style="line-height: 1.8; white-space: pre-wrap;">{{ $info->isi }}</div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2023 Universitas Teknologi. Hak Cipta Dilindungi.</p>
            <p>Didesain dengan <i class="fas fa-heart text-danger"></i> oleh Tim TechUni.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/landing-page.js') }}"></script>
</body>
</html>