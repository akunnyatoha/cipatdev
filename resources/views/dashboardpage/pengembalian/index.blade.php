@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DAFTAR PENGEMBALIAN RUANGAN</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Daftar Pengembalian Ruangan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session()->has('warning'))
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="alert alert-warning" role="alert">
                                        {{session('warning')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="alert alert-success" role="alert">
                                        {{session('success')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Peminjaman</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Telefon</th>
                                        <th>Ruangan</th>
                                        <th>Tgl. Pengembalian</th>
                                        <th>Keteragan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                        @foreach ($pengembalians as $i)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$i->code_peminjaman}}</td>
                                                <td>{{$i->email}}</td>
                                                <td>{{$i->name}}</td>
                                                <td>{{$i->phone}}</td>
                                                <td>{{$i->room_name}}</td>
                                                <td>{{$i->tgl_pengembalian}}</td>
                                                <td>{{$i->description}}</td>
                                                <td>
                                                    <form onsubmit="return confirm('Are you sure? ');" action="{{ route('dashboardpage.pengembalian.destroy', $i->id) }}" method="POST" class="d-inline">
                                                        <a href="{{route('dashboardpage.pengembalian.edit', $i->id) }})}}" class="btn btn-warning">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <php $no++;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <form action="{{route('dashboardpage.pengembalian.create')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="code_peminjaman">Kode Peminjaman</label>
                                        <input type="text" class="form-control" id="code_peminjaman" name="code_peminjaman">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Input Pengembalian</button>
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
