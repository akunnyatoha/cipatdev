@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>PENGEMBALIAN Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Daftar Pengembalian Barang</a></li>
                <li class="breadcrumb-item active">Pengembalian Barang</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('dashboardpage.pengembalianbarang.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="code_peminjaman">Kode Peminjaman</label>
                                                <input type="text" class="form-control" id="code_peminjaman" name="code_peminjaman" value="{{$getPeminjaman->code}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{$getPeminjaman->email}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Nama Peminjam</label>
                                                <input type="name" class="form-control" id="name" name="name" value="{{$getPeminjaman->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="phone">No. Telp</label>
                                                <input type="phone" class="form-control" id="phone" name="phone" value="{{$getPeminjaman->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="barang">Barang</label>
                                                <input type="barang" class="form-control" id="barang" name="barang" value="{{$getPeminjaman->barang_name}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="quantity" class="form-control" id="quantity" name="quantity">
                                            </div>
                                        </div>
                                        <div class="col-4" hidden>
                                            <div class="form-group">
                                                <label for="barang_id">Id Barang</label>
                                                <input type="barang_id" class="form-control" id="barang_id" name="barang_id" value="{{$getPeminjaman->barang_id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tgl_pengembalian">Tangal Pengembalian</label>
                                                <input type="datetime-local" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="description">Keterangan</label>
                                                <input type="text" class="form-control" id="description" name="description">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{route('dashboardpage.pengembalianbarang.index')}}" class="btn btn-primary">Batal</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
