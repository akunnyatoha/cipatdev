@extends('layoutlanding.main')
@section('landing')
<section class="py-5">
    <div class="container px-5">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Peminjaman Ruangan</h1>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="alert alert-primary" role="alert">
                                {{session('success')}}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Peminjaman Ruangan</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama Ruangan / Barang</th>
                                <th>Keperluan</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjamans as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->kategori }}</td>
                                    <td>{{ $peminjaman->name }}</td>
                                    <td>{{ $peminjaman->description }}</td>
                                    <td>{{ $peminjaman->start_datetime }}</td>
                                    <td>{{ $peminjaman->end_datetime }}</td>
                                    <td>{{ $peminjaman->status }}</td>
                                    <td>
                                        @if ($peminjaman->status == 'pending')
                                            <form onsubmit="return confirm('Are you sure? ');" action="{{ route('landingpage.histori.destroy',$peminjaman->id) }}" method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.invoice -->
                </div><!-- /.col -->
        </section>
    </div>
</section>
@endsection
