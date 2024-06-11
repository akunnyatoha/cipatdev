@extends('layoutdashboard.main')
@section('dashboard')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $pendingOrder }}</h3>

                <p>Pending Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-inbox"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ round($rate) }}<sup style="font-size: 20px">%</sup></h3>

                <p>Accepted Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ round($userCount) }}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $rejectOrder }}</h3>

                <p>Reject Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-inbox"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- TABLE: LATEST ORDERS -->
            <section class="col-lg-7 connectedSortable">
                <div class="card">
                    <div class="card-header border">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Peminjaman Data</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">{{ $peminjamanThisWeek }}</span>
                                <span>Peminjaman Minggu Ini</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-lg text-bold">{{ $peminjamanLastWeek }}</span>
                                <span>Peminjaman Minggu Lalu</span>
                            </p>
                        </div>

                        <!-- Tambahkan bagian grafik di sini -->
                        <canvas id="peminjamanChart" height="100"></canvas>

                    </div>
                </div>
                <!-- /.card -->
            </section>
            <section class="col-lg-5 connectedSortable">
                <div class="card">
                    <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Orders</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjamans as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->email }}</td>
                                    <td>{{ $peminjaman->name }}</td>
                                    <td>{{ $peminjaman->description }}</td>
                                    <td>
                                        @if ($peminjaman->status == 'accepted')
                                            <span class="badge bg-success">{{ $peminjaman->status }}</span>
                                        @elseif ($peminjaman->status == 'pending')
                                            <span class="badge bg-primary">{{ $peminjaman->status }}</span>
                                        @elseif ($peminjaman->status == 'reject')
                                            <span class="badge bg-danger">{{ $peminjaman->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                  <!-- /.table-responsive -->
                    </div>
                <!-- /.card-body -->

                <!-- /.card-footer -->
                </div>
                    <!-- /.card -->
            </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('peminjamanChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Minggu Lalu', 'Minggu Ini'],
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: [
                            {{ $peminjamanLastWeek }},
                            {{ $peminjamanThisWeek }}
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    <!-- /.content -->
<!-- ./wrapper -->
@endsection
