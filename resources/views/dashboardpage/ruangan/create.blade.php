@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>MENAMBAH RUANGAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Ruangan</li>
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
                <form action="{{route('dashboardpage.ruangan.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="code">Kode Ruangan</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Kode Ruang">
                      </div>
                      <div class="form-group">
                        <label for="name">Nama Ruangan</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Ruang">
                      </div>
                      <div class="form-group">
                        <label for="floor">Lantai</label>
                        <input type="text" class="form-control" id="floor" name="floor" placeholder="Lantai">
                      </div>
                      <div class="form-group">
                        <label for="building">Gedung</label>
                        <input type="text" class="form-control" id="building" name="building" placeholder="Gedung">
                      </div>
                      <div class="form-group">
                        <label for="capacity">Kapasitas</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Kapasitas">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{route('dashboardpage.ruangan.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
