@extends('layouts.kuesioner')

@section('kuesioner')

<div class="container justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="monitoring">
        <table class="table table-bordered table-striped w-100 align-middle">
            <thead class="sticky">
                <tr class="sticky text-light text-center align-middle">
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>A6</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kepuasan as $index => $isi)
                <tr>
                    <!-- Nomor urut -->
                    <td>{{ $index + 1 }}</td>

                    <!-- Nama Dokter, sesuaikan dengan field nama dokter di database -->
                    <td>{{ $isi->nama }}</td>

                    <!-- Penilaian Kepuasan A1, A2, A3, dll. -->
                    @for ($i = 1; $i <= 6; $i++) <td>{{ $isi->{'kepuasan_' . $i} }}</td>
                        @endfor
                </tr>
                @endforeach

                <tr class="align-middle">
                    <th colspan="2">Total</th>
                    <th>{{ $totalKepuasanA1 }}</th>
                    <th>{{ $totalKepuasanA2 }}</th>
                    <th>{{ $totalKepuasanA3 }}</th>
                    <th>{{ $totalKepuasanA4 }}</th>
                    <th>{{ $totalKepuasanA5 }}</th>
                    <th>{{ $totalKepuasanA6 }}</th>
                </tr>

                <tr class="align-middle">
                    <th colspan="2">Rata-rata</th>
                    <th>{{ $rataRataKepuasanA1 }}</th>
                    <th>{{ $rataRataKepuasanA2 }}</th>
                    <th>{{ $rataRataKepuasanA3 }}</th>
                    <th>{{ $rataRataKepuasanA4 }}</th>
                    <th>{{ $rataRataKepuasanA5 }}</th>
                    <th>{{ $rataRataKepuasanA6 }}</th>
                </tr>
            </tbody>
        </table>

        <div class="btn-toolbar justify-content-between">
            <div>
                {{ $kepuasan->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')