@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DENAH</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Denah</li>
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
              <h2><a class="btn btn-block bg-gradient-primary btn-lg" href="{{route('dashboardpage.denah.create')}}">Tambah Baru</a></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Caption</th>
                    <th>Image</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->caption }}</td>
                            <td>
                                @if ($slider->image == null)
                                    <span class="badge bg-primary">No Image</span>
                                @else
                                    <img src="{{ asset('storage/' . $slider->image) }}" class="img-fluid" style="max-width: 100px;"alt="{{ $slider->image }}">
                                @endif
                            </td>
                            <td>
                                <form onsubmit="return confirm('Are you sure? ');" action="{{ route('dashboardpage.denah.destroy', $slider->id) }}" method="POST">
                                    <a href="{{route('dashboardpage.denah.edit',$slider->id)}}" class="btn btn-warning">Edit</a>
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
