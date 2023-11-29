@extends('layouts.indexdokter')

@section('content')

<div class="area">
    <ul class="circles">
        <li></li>
        {{-- <li></li> --}}
        <li></li>
        {{-- <li></li> --}}
        <li></li>
        {{-- <li></li> --}}
        <li></li>
        {{-- <li></li> --}}
        <li></li>
        {{-- <li></li> --}}
        <li></li>
        {{-- <li></li> --}}
        <li></li>
        {{-- <li></li> --}}
        <li></li>
    </ul>

    <div class="container d-flex justify-content-center vh-100 align-items-center">
        <div class="d-grid gap-5 col-10 mx-auto">
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-lg blur">
                <i class="fa-solid fa-utensils"></i><b> Tambah Pesanan</b>
            </button>
            <a href="{{ route('trackingOrder') }}" type="button" class="btn btn-primary btn-lg blur"><i
                    class="fa-solid fa-truck-fast"></i><b> Cek Status Pesanan</b></a>
        </div>
    </div>
    @include('dokterorder.add_order')
</div>
@endsection

@extends('layouts.footer')