@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>MENAMBAH PEMINJAMAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Peminjaman</li>
            <li class="breadcrumb-item active">Create</li>
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
                <form action="{{route('dashboardpage.peminjaman.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon">
                        </div>
                        <div class="form-group">
                            <label for="room">Ruangan</label>
                            <select class="form-control" aria-label="room" id="room" name="room">
                                <option selected disabled>- Pilih Ruangan -</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="description">Keperluan</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="form-group">
                            <label for="capacity">Kapasitas</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Kapasitas">
                        </div>
                        <div class="form-group">
                            <label for="tanggalawal">Mulai dari</label>
                            <input type="datetime-local" class="form-control" id="tanggalawal" name="tanggalawal">
                        </div>
                        <div class="form-group">
                            <label for="tanggalakhir">Sampai dengan</label>
                            <input type="datetime-local" class="form-control" id="tanggalakhir" name="tanggalakhir">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{route('dashboardpage.peminjaman.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
