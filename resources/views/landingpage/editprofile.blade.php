@extends('layoutlanding.main')
@section('landing')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 ps-md-4">
                <div class="row">
                    <div class="col-12 bg-white px-3 mb-3 pb-3">
                        <!-- Formulir untuk mengedit profil -->
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="align-items-center justify-content-between">
                                <p class="py-2 profile">Name</p>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                            </div>
                            <div class="align-items-center justify-content-between">
                                <p class="py-2 profile">Phone</p>
                                <input type="tel" name="phone" value="{{ Auth::user()->phone }}" class="form-control">
                            </div>
                            <div class="align-items-center justify-content-between">
                                <p class="py-2 profile">Image</p>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="align-items-center justify-content-between">
                                <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
                            </div>
                        </form>
                        <div class="align-items-center justify-content-between">
                            <a href="{{route('landingpage.profile')}}" class="btn btn-secondary mt-3">Cancel</a>
                        </div>
                        <!-- Akhir formulir -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
