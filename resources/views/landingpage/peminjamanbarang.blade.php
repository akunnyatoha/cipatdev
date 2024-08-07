@extends('layoutlanding.main')
@section('landing')
<section class="py-5">
    <div class="container px-5">
        <h2 class="text-center">Form Peminjaman Barang</h2><br>
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
            </div>
        @endif
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6">
                @if(isset($availableBarangs))
                <form action="{{route('landingpage.peminjaman.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-label">
                        <label for="tanggal">Tanggal dan Waktu Peminjaman</label>
                        <br>Mulai dari:
                        <input type="datetime-local" class="form-control" id="tanggalawal" name="tanggalawal" value="{{ $startDatetime }}">
                        Hingga Selesai:
                        <input type="datetime-local" class="form-control" id="tanggalakhir" name="tanggalakhir" value="{{ $endDatetime }}">
                    </div>
                    <div class="form-label">
                        <label for="room">Barang Yang Tersedia</label>
                        <select class="form-select" aria-label="barang" id="barang" name="barang">
                            <option selected disabled>- Pilih Barang -</option>
                            @forelse($availableBarangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->name }} - {{ $barang->quantity }}</option>
                            @empty
                                <option disabled>No available Barang during the specified time range.</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-label">
                        <label for="capacity">Quantity</label>
                        <input type="number" class="form-control" aria-label="quantity" id="quantity" name="quantity">
                    </div>
                    <div class="form-label">
                        <label for="description">Keperluan</label>
                        <input type="text" class="form-control" id="description" name="description">
                        </select>
                    </div>
                    <div class="form-label">
                        <label for="description">File Pendukung</label>
                        <input type="file" class="form-control" id="file_pendukung" name="file_pendukung">
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="showSuccessAlert()">Submit</button>
                </form>
                @else
                <form action="{{ route('show.available.barangs') }}" method="POST">
                    @csrf
                    <div class="form-label">
                        <label for="tanggal">Tanggal dan Waktu Peminjaman</label>
                        <br>Mulai dari:
                        <input type="datetime-local" class="form-control" id="tanggalawal" name="tanggalawal">
                        Hingga Selesai:
                        <input type="datetime-local" class="form-control" id="tanggalakhir" name="tanggalakhir">
                    </div>
                    <button type="submit" class="btn btn-primary">Cek Ketersediaan Barang</button>
                </form>
                <div class="form-label">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" aria-label="quantity" id="quantity" name="quantity" disabled>
                </div>
                <div class="form-label">
                    <label for="barang">Barang</label>
                    <select class="form-select" aria-label="barang" id="barang" name="barang" disabled>
                        <option selected disabled>- Pilih Barang -</option>
                    </select>
                </div>
                <div class="form-label">
                    <label for="description">Keperluan</label>
                    <input type="text" class="form-control" id="description" name="description" disabled>
                    </select>
                </div>
                <div class="form-label">
                    <label for="description">File Pendukung</label>
                    <input type="file" class="form-control" id="file_pendukung" name="file_pendukung" disabled>
                </div>
                @endif
            </div>
            <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="{{asset('storage/landing/barang.png')}}" alt="..." />
            </div>
        </div>
    </div>
</section>
@endsection
