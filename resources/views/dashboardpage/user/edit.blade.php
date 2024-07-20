@extends('layoutdashboard.main')
@section('dashboard')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>MENGUBAH USER</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">User</li>
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
                <form action="{{route('dashboardpage.user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="noinduk">Nomor Induk</label>
                            <input type="text" class="form-control" id="noinduk" name="noinduk" placeholder="Nomor Induk" value="{{ $user->id }}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" aria-label="role" id="role" name="role">
                                <option selected disabled>- Pilih Role -</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group">
                          <label for="image" class="form-label">Avatar</label>
                          <input type="hidden" class="form-control" id="old_image" name="old_image"  value="{{ $user->image }}">
                          <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image">
                          @error('image')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                          @enderror
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{route('dashboardpage.user.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
