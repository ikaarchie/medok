@extends('layouts.app')

@section('content')
<div class="header-waves">
    <h6 class="text-start">{{ request()->ip() }}</h6>
    <div class="container pt-3">
        <h1 class="text-center"><b>KUESIONER MEDOK</b></h1>
        <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
    </div>

    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
            <use xlink:href="#gentle-wave" x="48" y="1" fill="rgba(255,255,255,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="#fff" />
        </g>
    </svg>
</div>

<div class="container-fluid wrapper mb-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('kuesioner') ? 'active' : '' }}" aria-current="page"
                href="{{ route('dataKuesioner') }}">Kuesioner</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('kepentingan') ? 'active' : '' }}"
                href="{{ route('dataKepentingan') }}">Importance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('kepuasan') ? 'active' : '' }}"
                href="{{ route('dataKepuasan') }}">Performance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('hasil') ? 'active' : '' }}" href="{{ route('dataHasil') }}">Result</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('csi') ? 'active' : '' }}" href="{{ route('dataCsi') }}">Customer
                Satisfaction Index</a>
        </li>
    </ul>
</div>

@yield('kuesioner')

@endsection