@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>PEMINJAMAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Peminjaman</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h2><a class="btn btn-block bg-gradient-primary btn-lg" href={{route('dashboardpage.peminjamanbarang.create')}}>Tambah Baru</a></h2>
              <h2><a class="btn btn-block bg-gradient-primary btn-lg" href={{route('dashboardpage.peminjamanbarang.datacsv')}}>Tambah Data CSV</a></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Peminjaman</th>
                  <th>Email</th>
                  <th>Nama</th>
                  <th>Telefon</th>
                  <th>Barang</th>
                  <th>Keperluan</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Quantity</th>
                  <th>File Pendukung</th>
                  <th>Status</th>
                  <th>Approve</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peminjaman->code }}</td>
                            <td>{{ $peminjaman->email }}</td>
                            <td>{{ $peminjaman->name }}</td>
                            <td>{{ $peminjaman->phone }}</td>
                            <td>{{ $peminjaman->barangs->name }}</td>
                            <td>{{ $peminjaman->description }}</td>
                            <td>{{ $peminjaman->start_datetime }}</td>
                            <td>{{ $peminjaman->end_datetime }}</td>
                            <td>{{ $peminjaman->quantity }}</td>
                            @if (isset($peminjaman->file_pendukung) && $peminjaman->file_pendukung != null)
                              <td>
                                <a href="{{url('/download-file-pendukung?file=' . $peminjaman->file_pendukung)}}" class="btn btn-primary">Download</a>
                                {{-- <form action="{{route('dashboardpage.peminjaman.download', $peminjaman->code)}}" method="post">
                                  <button class="btn btn-primary" type="submit">Donload File</button>
                                </form> --}}
                              </td>
                            @else
                              <td>-</td>
                            @endif
                            <td>
                                @if ($peminjaman->status == 'accepted')
                                    <span class="badge bg-success">{{ $peminjaman->status }}</span>
                                @elseif ($peminjaman->status == 'pending')
                                    <span class="badge bg-primary">{{ $peminjaman->status }}</span>
                                @elseif ($peminjaman->status == 'reject')
                                    <span class="badge bg-danger">{{ $peminjaman->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-grid gap d-md-flex justify-content-md-start">
                                    @if ($peminjaman->status == 'pending')
                                        <form method="POST" action="{{route('dashboardpage.peminjamanbarang.accept',$peminjaman->id)}}">
                                            @csrf
                                            <button class="btn btn-success me-md-2" type="submit">Accept</button>
                                        </form>
                                    @endif
                                    @if ($peminjaman->status == 'pending')
                                        <form method="POST" action="{{route('dashboardpage.peminjamanbarang.reject',$peminjaman->id)}}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    @endif
                                  </div>
                            </td>
                            <td>
                                <form onsubmit="return confirm('Are you sure? ');" action="{{ route('dashboardpage.peminjamanbarang.destroy', $peminjaman->id) }}" method="POST" class="d-inline">
                                    <a href="{{route('dashboardpage.peminjamanbarang.edit', $peminjaman->id) }})}}" class="btn btn-warning">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- jQuery -->
@endsection
