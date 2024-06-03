@extends('layouts.indexdokter')

@section('content')

<div class="area">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <div class="container d-flex justify-content-center vh-100 align-items-center">
        <div class="d-grid gap-5 col-10 mx-auto">
            <h1 class="text-center">
                <b class="display-1 text-white"
                    style="font-family: 'Baloo Bhaijaan 2', serif; font-size: 5rem;">MeDok</b>
                {{-- <img src="{{ url('img/medok.png') }}" width="500" class=" fill-current text-gray-500" /> --}}
                <div class="roller">
                    <span id="rolltext">
                        {{-- <b style=" font-family: 'Itim' , serif;">Sistem Informasi</b><br /> --}}
                        <b style="font-family: 'Itim', serif;">Menu Dokter OK</b><br />
                        <b style=" font-family: 'Jura' , serif;">RS Hermina Banyumanik</b><br />
                        {{-- <span id="spare-time">
                            <p style="font-family: 'Bungee', serif;">RS Hermina</p><br />
                            <p style="font-family: 'Bungee', serif;">Banyumanik</p>
                        </span><br /> --}}
                </div>
            </h1>

            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-lg blur text-white">
                <i class="fa-solid fa-utensils"></i><b> Tambah Pesanan</b>
            </button>
            <a href="{{ route('trackingOrder') }}" type="button" class="btn btn-lg blur text-white"><i
                    class="fa-solid fa-truck-fast"></i><b> Cek Status Pesanan</b></a>
        </div>
    </div>
    @include('dokterorder.add_order')
    @include('sweetalert::alert')
</div>
@endsection

@extends('layouts.footer_blur')