@extends('layoutlanding.main')
@section('landing')
@if(session('hola'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('hola') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 ps-md-4">
                <div class="row">
                    <div class="col-12 bg-white px-3 mb-3 pb-3">
                        <form action="{{ route('change-password.update') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            <a href="{{route('landingpage.profile')}}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
