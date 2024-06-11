@extends('layoutlanding.main')
@section('landing')
<!-- Header-->
<header class="bg-landing py-1">
    <div class="container px-1">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-5 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h4 class="display-7 fw-bolder text-white mb-2">PEMINJAMAN RUANGAN FAKULTAS TEKNIK</h4>
                    <h4 class="display-7 fw-bolder text-white mb-2">UNIVERSITAS MUHAMMADIYAH JAKARTA</h4>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="{{asset('storage/landing/umj.jpg')}}" alt="..." /></div>
        </div>
    </div>
</header>
<!-- Features section-->
<section class="py-5 border-bottom" id="features">
    <div class="container px-5 my-1">
        <div class="row gx-5">
            <div class="col-lg-3 mb-5 mb-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                <h2 class="h4 fw-bolder">Denah Ruangan</h2>
                <p>Agar peminjam lebih mudah Temukan nama, lokasi gedung perkuliahan, dan lebih banyak lagi melalui denah ruangan ini.</p>
                <a class="text-decoration-none" href="{{route('landingpage.denah')}}">
                    Click to action
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-3 mb-5 mb-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                <h2 class="h4 fw-bolder">Peminjaman Ruangan</h2>
                <p>Pinjam ruangan dengan mudah melalui layanan peminjaman ruangan kami. Temukan proses yang cepat dan sederhana untuk memenuhi kebutuhan acara yang diperlukan.</p>
                <a class="text-decoration-none" href="{{route('landingpage.peminjaman')}}">
                    Call to action
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-3 mb-5 mb-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                <h2 class="h4 fw-bolder">Peminjaman Barang</h2>
                <p>Pinjam barang dengan mudah melalui layanan peminjaman barang kami. Temukan proses yang cepat dan sederhana untuk memenuhi kebutuhan acara yang diperlukan.</p>
                <a class="text-decoration-none" href="{{route('landingpage.peminjamanbarang')}}">
                    Call to action
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-3">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                <h2 class="h4 fw-bolder">Tentang</h2>
                <p>Universitas Muhammadiyah Jakarta  yang berdiri pada tanggal 18 November 1955 merupakan salah satu perguruan tinggi Muhammadiyah tertua di Indonesia.</p>
                <a class="text-decoration-none" href="https://ft.umj.ac.id/ftumj/About.html" target="_blank">
                    Call to action
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
