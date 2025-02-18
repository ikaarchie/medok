@extends('layouts.kuesioner')

@section('kuesioner')

<div class="container-fluid justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="monitoring">
        <table class="table table-bordered table-striped w-100 align-middle">
            <thead class="sticky">
                <tr class="sticky text-light text-center align-middle">
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>MEDOK mudah diakses menggunakan smartphone anda.</th>
                    <th>MEDOK mempunyai tampilan yang menarik dan responsif.</th>
                    <th>Pemilihan menu di MEDOK terasa mudah dan cepat.</th>
                    <th>MEDOK dapat memberikan informasi status pesanan anda dengan tepat.</th>
                    <th>Anda dapat memberikan keterangan tambahan pada pesanan anda.</th>
                    <th>MEDOK menyampaikan informasi ke dapur yang sesuai dengan permintaan anda, sehingga
                        makanan yang datang sesuai dengan makanan yang anda pesan.</th>
                    <th>Seberapa penting kemudahan akses MEDOK?</th>
                    <th>Seberapa penting desain tampilan aplikasi MEDOK?</th>
                    <th>Seberapa penting pemilihan menu pada aplikasi MEDOK?</th>
                    <th>Seberapa penting informasi status pesanan pada aplikasi MEDOK?</th>
                    <th>Seberapa penting form keterangan tambahan pada aplikasi MEDOK?</th>
                    <th>Seberapa penting kesesuaian informasi pesanan dari aplikasi MEDOK?</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse($kuesioner as $key => $isi)
                <tr class="font-tabel">
                    <td>{{ $kuesioner->firstItem() + $key }}</td>
                    <td>{{ $isi->nama }}</td>
                    <td>{{ $isi->kepuasan_1 }}</td>
                    <td>{{ $isi->kepuasan_2 }}</td>
                    <td>{{ $isi->kepuasan_3 }}</td>
                    <td>{{ $isi->kepuasan_4 }}</td>
                    <td>{{ $isi->kepuasan_5 }}</td>
                    <td>{{ $isi->kepuasan_6 }}</td>
                    <td>{{ $isi->kepentingan_1 }}</td>
                    <td>{{ $isi->kepentingan_2 }}</td>
                    <td>{{ $isi->kepentingan_3 }}</td>
                    <td>{{ $isi->kepentingan_4 }}</td>
                    <td>{{ $isi->kepentingan_5 }}</td>
                    <td>{{ $isi->kepentingan_6 }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="14" class="text-center"><b>Tidak ada data</b></td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="btn-toolbar justify-content-between">
            <div>
                {{ $kuesioner->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')