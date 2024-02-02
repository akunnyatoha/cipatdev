@extends('layoutlanding.main')
@section('landing')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-12 bg-white p-0 px-3 py-3 mb-3">
                        <div class="d-flex flex-column align-items-center">
                            @if (Auth::user()->image == null)
                                    <a class="btn btn-app disabled">
                                        <i class="fas fa-users"></i> No Image
                                    </a>
                                @else
                                <img class="photo" src="{{ asset('storage/user/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                                @endif
                            <p class="fw-bold h4 mt-3 profile">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 ps-md-4">
                <div class="row">
                    <div class="col-12 bg-white px-3 mb-3 pb-3">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="py-2 profile">Name</p>
                            <p class="py-2 text-muted profile">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="py-2 profile">Email</p>
                            <p class="py-2 text-muted profile">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="py-2 profile">Phone</p>
                            <p class="py-2 text-muted profile">{{ Auth::user()->phone }}</p>
                        </div>
                        <div class="py-2">
                            <a href="{{route('landingpage.editprofile') }}" class="btn btn-warning">Edit Profile</a>
                            <a href="{{route('landingpage.change-password') }}" class="btn btn-primary">Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
