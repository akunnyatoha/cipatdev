@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>LAPORAN PEMINJAMAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Barang</li>
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
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <tr>
                                  <th>No</th>
                                  <th>Kategori</th>
                                  <th>Email</th>
                                  <th>Nama Peminjam</th>
                                  <th>Telefon</th>
                                  <th>Nama Ruangan/Barang</th>
                                  <th>Tgl.Mulai</th>
                                  <th>Tgl.Selesai</th>
                                  <th>Kapasitas / Quantity</th>
                                  <th>Keperluan</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($laporanFix) > 0)
                                <?php $no = 1; ?>
                                @foreach ($laporanFix as $i)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$i->kategori}}</td>
                                        <td>{{$i->email}}</td>
                                        <td>{{$i->name_peminjam}}</td>
                                        <td>{{$i->phone}}</td>
                                        <td>{{$i->title}}</td>
                                        <td>{{$i->tgl_mulai}}</td>
                                        <td>{{$i->tgl_akhir}}</td>
                                        <td>{{$i->capacity_quantity}}</td>
                                        <td>{{$i->keperluan}}</td>
                                    </tr>
                                    <?php $no++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">Kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
