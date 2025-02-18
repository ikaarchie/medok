@extends('layouts.kuesioner')

@section('kuesioner')

<div class="d-grid gap-1 d-flex justify-content-center">
    <div class="container justify-content-center bg-white">
        <table class="table table-bordered border-dark align-middl">
            <thead class="sticky text-white text-center align-middle">
                <tr>
                    <th>No</th>
                    <th>Nilai CSI (%)</th>
                    <th>Keterangan (CSI)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>81% - 100%</td>
                    <td>Sangat Puas</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>66% - 80.99%</td>
                    <td>Puas</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>51% - 65.99%</td>
                    <td>Cukup Puas</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>35% - 50.99%</td>
                    <td>Kurang Puas</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>0% - 34.99%</td>
                    <td>Tidak Puas</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container text-center justify-content-center bg-white">
        <div class="container mt-5">
            <h1><strong>CSI = \( \frac{T}{5Y} \times 100 \)</strong></h1>
            <h1><strong>CSI = \( \frac{ {{ $t }} }{5 \times {{ $y }} } \times 100\)</strong></h1>
            <h1><strong>CSI = {{ round((($t / (5 * $y)) * 100), 2) }}</strong></h1>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')