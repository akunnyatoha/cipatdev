@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>RUANGAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Ruangan</li>
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
              <h2><a class="btn btn-block bg-gradient-primary btn-lg" href="{{route('dashboardpage.ruangan.create')}}">Tambah Baru</a></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode Ruangan</th>
                  <th>Nama Ruangan</th>
                  <th>Lantai</th>
                  <th>Gedung</th>
                  <th>Kapasitas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->floor }}</td>
                            <td>{{ $room->building }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>
                                <form onsubmit="return confirm('Are you sure? ');" action="{{ route('dashboardpage.ruangan.destroy', $room->id) }}" method="POST">
                                    <a href="{{route('dashboardpage.ruangan.edit',$room->id)}}" class="btn btn-warning">Edit</a>
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
