@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>PENGEMBALIAN RUANGAN</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Daftar Pengembalian Ruangan</a></li>
                <li class="breadcrumb-item active">Pengembalian Ruangan</li>
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
                                <form action="{{route('dashboardpage.pengembalian.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="code_peminjaman">Kode Peminjaman</label>
                                                <input type="text" class="form-control" id="code_peminjaman" name="code_peminjaman" value="{{$peminjamans->code}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{$peminjamans->email}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Nama Peminjam</label>
                                                <input type="name" class="form-control" id="name" name="name" value="{{$peminjamans->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="phone">No. Telp</label>
                                                <input type="phone" class="form-control" id="phone" name="phone" value="{{$peminjamans->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="room">Ruangan</label>
                                                <input type="room" class="form-control" id="room" name="room" value="{{$peminjamans->rooms->name}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group" hidden>
                                                <label for="room_id">Id Ruangan</label>
                                                <input type="room_id" class="form-control" id="room_id" name="room_id" value="{{$peminjamans->rooms->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tgl_pengembalian">Tangal Pengembalian</label>
                                                <input type="datetime-local" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" value="{{$peminjamans->tgl_pengembalian}}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="description">Keterangan</label>
                                                <input type="text" class="form-control" id="description" name="description" value="{{$peminjamans->description}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{route('dashboardpage.pengembalian.index')}}" class="btn btn-primary">Batal</a>
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
