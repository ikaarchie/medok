@extends('layouts.kuesioner')

@section('kuesioner')

<div class="container justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="monitoring">
        <table class="table table-bordered table-striped w-100 align-middle">
            <thead class="sticky">
                <tr class="sticky text-light text-center align-middle">
                    <th>Kode</th>
                    <th>Attribute</th>
                    <th>Importance (I)</th>
                    <th>Performance (P)</th>
                    <th>Score (I x P)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A1</td>
                    <td>Website mudah diakses oleh pengguna</td>
                    <td>{{ $rataRataKepentinganA1 }}</td>
                    <td>{{ $rataRataKepuasanA1 }}</td>
                    <td>{{ $perkalianA1 }}</td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td>Desain menarik dan mudah dimengerti</td>
                    <td>{{ $rataRataKepentinganA2 }}</td>
                    <td>{{ $rataRataKepuasanA2 }}</td>
                    <td>{{ $perkalianA2 }}</td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td>Website memberikan informasi yang mudah dipahami</td>
                    <td>{{ $rataRataKepentinganA3 }}</td>
                    <td>{{ $rataRataKepuasanA3 }}</td>
                    <td>{{ $perkalianA3 }}</td>
                </tr>
                <tr>
                    <td>A4</td>
                    <td>Website memberikan informasi sesuai dengan kadar yang dibutuhkan pengguna</td>
                    <td>{{ $rataRataKepentinganA4 }}</td>
                    <td>{{ $rataRataKepuasanA4 }}</td>
                    <td>{{ $perkalianA4 }}</td>
                </tr>
                <tr>
                    <td>A5</td>
                    <td>Website menciptakan rasa personalisasi</td>
                    <td>{{ $rataRataKepentinganA5 }}</td>
                    <td>{{ $rataRataKepuasanA5 }}</td>
                    <td>{{ $perkalianA5 }}</td>
                </tr>
                <tr>
                    <td>A6</td>
                    <td>Website memberikan kemudahan untuk menyampaikan informasi</td>
                    <td>{{ $rataRataKepentinganA6 }}</td>
                    <td>{{ $rataRataKepuasanA6 }}</td>
                    <td>{{ $perkalianA6 }}</td>
                </tr>
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{ $rataRataKepentinganA1 + $rataRataKepentinganA2 + $rataRataKepentinganA3 +
                        $rataRataKepentinganA4 + $rataRataKepentinganA5 + $rataRataKepentinganA6 }}</td>
                    <td>{{ $rataRataKepuasanA1 + $rataRataKepuasanA2 + $rataRataKepuasanA3 +
                        $rataRataKepuasanA4 + $rataRataKepuasanA5 + $rataRataKepuasanA6 }}</td>
                    <td>{{ $perkalianA1 + $perkalianA2 + $perkalianA3 +
                        $perkalianA4 + $perkalianA5 + $perkalianA6 }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

@extends('layouts.footer')