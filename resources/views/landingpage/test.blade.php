@extends('layoutlanding.main')
@section('landing')
<section class="py-5">
    <div class="container px-5">
        <h2 class="text-center">Form Peminjaman Ruangan</h2><br>
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6">
                <form action="{{ route('show.available.rooms') }}" method="POST">
                    @csrf
                    <div class="form-label">
                        @if(isset($availableRooms))
                        <label for="tanggal">Tanggal dan Waktu Peminjaman</label>
                        <br>Mulai dari:
                        <input type="datetime-local" class="form-control" id="tanggalawal" name="tanggalawal" value="{{ $startDatetime }}">
                        Hingga Selesai:
                        <input type="datetime-local" class="form-control" id="tanggalakhir" name="tanggalakhir" value="{{ $endDatetime }}">
                        @else
                        <label for="tanggal">Tanggal dan Waktu Peminjaman</label>
                        <br>Mulai dari:
                        <input type="datetime-local" class="form-control" id="tanggalawal" name="tanggalawal">
                        Hingga Selesai:
                        <input type="datetime-local" class="form-control" id="tanggalakhir" name="tanggalakhir">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Cek Ketersediaan Ruangan</button>
                </form>
                <form action="{{route('landingpage.peminjaman.store')}}" method="POST">
                    @csrf
                    @if(isset($availableRooms))
                    <div class="form-label">
                        <label for="capacity">Kapasitas</label>
                        <input type="text" class="form-control" aria-label="capacity" id="capacity" name="capacity">
                    </div>
                    <div class="form-label">
                        <label for="room">Ruangan Yang Tersedia</label>
                        <select class="form-select" aria-label="ruangan" id="room" name="room">
                            <option selected disabled>- Pilih Ruangan -</option>
                            @forelse($availableRooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }} - {{ $room->capacity }}</option>
                            @empty
                                <option disabled>No available rooms during the specified time range.</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-label">
                        <label for="description">Keperluan</label>
                        <input type="text" class="form-control" id="description" name="description">
                        </select>
                    </div>
                    @else
                    <div class="form-label">
                        <label for="capacity">Kapasitas</label>
                        <input type="text" class="form-control" aria-label="capacity" id="capacity" name="capacity" disabled>
                    </div>
                    <div class="form-label">
                        <label for="room">Ruangan</label>
                        <select class="form-select" aria-label="ruangan" id="room" name="room" disabled>
                            <option selected disabled>- Pilih Ruangan -</option>
                        </select>
                    </div>
                    <div class="form-label">
                        <label for="description">Keperluan</label>
                        <input type="text" class="form-control" id="description" name="description" disabled>
                        </select>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary" onclick="showSuccessAlert()">Submit</button>
                </form>



            </div>
            <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="{{asset('storage/landing/kelas.jpg')}}" alt="..." />
            </div>
        </div>
    </div>
</section>
@endsection
