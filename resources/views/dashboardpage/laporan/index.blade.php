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
            <li class="breadcrumb-item active">Laporan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
 {{-- @php
     dd($laporanFix);
 @endphp --}}

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
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
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                  @for($i = 0; $i < count($laporanFix); $i++)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$laporanFix[$i]['kategori']}}</td>
                                        <td>{{$laporanFix[$i]['email']}}</td>
                                        <td>{{$laporanFix[$i]['name_peminjam']}}</td>
                                        <td>{{$laporanFix[$i]['phone']}}</td>
                                        <td>{{$laporanFix[$i]['title']}}</td>
                                        <td>{{$laporanFix[$i]['tgl_mulai']}}</td>
                                        <td>{{$laporanFix[$i]['tgl_selesai']}}</td>
                                        <td>{{$laporanFix[$i]['capacity_quantity']}}</td>
                                        <td>{{$laporanFix[$i]['keperluan']}}</td>
                                    </tr>
                                    <?php $no++; ?>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
