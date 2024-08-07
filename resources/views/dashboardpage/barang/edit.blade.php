@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>MENGUBAH BARANG</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Barang</li>
            <li class="breadcrumb-item active">Edit</li>
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
                <form action="{{ route('dashboardpage.barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div class="form-group">
                        <label for="code">Kode Barang</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Kode Barang" value="{{ $barang->code }}">
                      </div>
                      <div class="form-group">
                        <label for="name">Nama Barang</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Barang" value="{{ $barang->name }}">
                      </div>
                      <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{ $barang->quantity }}">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{route('dashboardpage.barang.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
