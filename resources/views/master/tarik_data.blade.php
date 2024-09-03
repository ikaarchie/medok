@extends('layouts.master')

@section('masterContent')

<div class="container justify-content-center mt-1">
    <form action="{{ route('tarikData') }}" method="GET">
        <div class="d-grid gap-1 d-sm-flex justify-content-sm-center align-self-center">
            <div class="col-sm-2 text-center">
                <input type="date" name="dari" id="dari" value="{{ request()->get('dari') ?? date('Y-m-d')}}"
                    class="form-control input-sm" style="border-color: #E91E63" required />
            </div>
            <h2 class="text-center">-</h2>
            <div class="col-sm-2 text-center">
                <input type="date" name="sampai" id="sampai" value="{{ request()->get('sampai') ?? date('Y-m-d')}}"
                    class="form-control input-sm" style="border-color: #E91E63" required />
            </div>

            <div class="col-sm-3 text-center">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
                    Search</button>
                {{-- <button formaction="{{ route('excelCuciTangan') }}" class="btn btn-success" type="submit">
                    <i class="fa-solid fa-table"></i> Excel</button>
                <button formaction="{{ route('pdfCuciTangan') }}" class="btn btn-danger" type="submit">
                    <i class="fa-solid fa-file-pdf"></i> PDF</button> --}}
            </div>
        </div>
        @if($errors->any())
        <div class="alert alert-danger align-items-center text-center" role="33alert">
            <strong>{{$errors->first()}}</strong>
        </div>
        @endif
    </form>
</div>

<div class="container-fluid justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="monitoring">
        <table class="table table-bordered table-striped w-100 align-middle">
            <thead class="sticky">
                <tr class="sticky text-light text-center align-middle">
                    <th scope="col">No</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Minuman</th>
                    <th scope="col">Waktu</br>Disajikan</th>
                    <th scope="col">Waktu</br>Pesanan</th>
                    <th scope="col">Sedang</br>Diproses</th>
                    <th scope="col">Menunggu</br>Pengantaran</th>
                    <th scope="col">Sedang</br>Diantar</th>
                    <th scope="col">Selesai</th>
                    <th scope="col">Status Saat Ini</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @php $no = 1; @endphp
                @forelse($data as $key => $isi)
                <tr class="font-tabel">
                    <td>{{ $data->firstItem() + $key }}</td>
                    <td>{{ $isi->nama }}</td>
                    <td>{{ $isi->makanan }} {{ $isi->ket_makanan }}</br>
                        {{ $isi->ops_ket_makanan !== null ? $isi->ops_ket_makanan : '' }}
                    </td>
                    <td>{{ $isi->minuman }} {{ $isi->ket_minuman }}</br>
                        {{ $isi->ops_ket_minuman !== null ? $isi->ops_ket_minuman : '' }}
                    </td>
                    <td class=" text-center">{{ $isi->waktu_disajikan}}</br>
                        {{ \Carbon\Carbon::parse($isi->tanggal_disajikan)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($isi->belum_diproses)->format('H:i') }}
                        <br>
                        {{ \Carbon\Carbon::parse($isi->belum_diproses)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($isi->sedang_diproses)->format('H:i') }}
                        <br>
                        {{ \Carbon\Carbon::parse($isi->sedang_diproses)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($isi->menunggu_pengantaran)->format('H:i') }}
                        <br>
                        {{ \Carbon\Carbon::parse($isi->menunggu_pengantaran)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($isi->sedang_diantar)->format('H:i') }}
                        <br>
                        {{ \Carbon\Carbon::parse($isi->sedang_diantar)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($isi->selesai)->format('H:i') }}
                        <br>
                        {{ \Carbon\Carbon::parse($isi->selesai)->format('d/m/Y') }}
                    </td>

                    @if ($isi->status == 'Belum Diproses')
                    <td class="text-center blink">
                        <b>{{ $isi->status }}</b>
                    </td>

                    @elseif ($isi->status == 'Sedang Diproses')
                    <td class="text-center text-white" style="background-color: #FF6D00;">
                        <b>{{ $isi->status }}</b>
                    </td>

                    @elseif ($isi->status == 'Menunggu Pengantaran')
                    <td class="text-center" style="background-color: #FFAB00;">
                        <b>{{ $isi->status }}</b>
                    </td>

                    @elseif ($isi->status == 'Sedang Diantar')
                    <td class="text-center" style="background-color: #FFEA00;">
                        <b>{{ $isi->status }}</b>
                    </td>

                    @else
                    <td class="text-center" style="background-color: #00C853;">
                        <b>{{ $isi->status }}</b>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center"><b>Tidak ada data</b></td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="btn-toolbar justify-content-between">
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')