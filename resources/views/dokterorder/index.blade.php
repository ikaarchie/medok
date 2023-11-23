@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center vh-100 align-items-center">
    <div class="d-grid gap-5 col-10 mx-auto">
        <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-utensils"></i><b> Tambah Pesanan</b>
        </button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa-solid fa-truck-fast"></i><b> Cek Status
                Pesanan</b></button>
    </div>
</div>
@include('dokterorder.add_order')
@endsection

@extends('layouts.footer')