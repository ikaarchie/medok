@extends('layouts.app')

@section('content')
{{-- {{ dd($coba) }} --}}

<div class="container d-flex justify-content-center align-items-center">
    <div class="d-grid gap-2 col-10 mx-auto">
        <a href="{{ url()->previous() }}" type="button" class="btn btn-primary btn-sm col-2">
            <i class="fa-solid fa-angles-left"></i></a>

        <select class="form-select form-select" name="filter" id="filter">
            <option selected>-- Pilih nama dokter --</option>
            @if(count($dokter) > 0)
            @foreach($dokter as $nama)
            <option value="{{ $nama['nama'] }}">{{ $nama->nama }}</option>
            @endforeach
            @endif
        </select>

        {{-- <div id="kartu">
            @if(count($tracking) > 0)
            @php $no = 1; @endphp
            @foreach($tracking as $key => $data)
            <div class="card mb-2">
                <div class="card-header">
                    <div class="gap-1 d-flex justify-content-start">{{ $data['nama'] }}</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped-columns align-middle">
                            <tbody>
                                <tr>
                                    <th class="col-2">Makanan</th>
                                    <td>{{ $data['makanan'] }}</td>
                                </tr>
                                <tr>
                                    <th class="col-2">Minuman</th>
                                    <td>{{ $data['minuman'] }}</td>
                                </tr>
                                <tr>
                                    <th class="col-2">Waktu pemesanan</th>
                                    <td>{{ $data['belum_diproses'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($data['status'] == "Belum Diproses")
                <div class="card-footer text-center blink">
                    <b>{{ $data['status'] }}</b>
                </div>

                @elseif($data['status'] == "Sedang Diproses")
                <div class="card-footer text-center text-white" style="background-color: #FF6D00;">
                    <b>{{ $data['status'] }}</b>
                </div>

                @elseif($data['status'] == "Menunggu Pengantaran")
                <div class="card-footer text-center" style="background-color: #FFAB00;">
                    <b>{{ $data['status'] }}</b>
                </div>

                @elseif($data['status'] == "Sedang Diantar")
                <div class="card-footer text-center" style="background-color: #FFEA00;">
                    <b>{{ $data['status'] }}</b>
                </div>

                @else
                <div class="card-footer text-center" style="background-color: #00C853;">
                    <b>{{ $data['status'] }}</b>
                </div>
                @endif
            </div>
            @endforeach
            @endif
        </div> --}}

        <div class="table-responsive table-data tbl-fixed">
            <table class="table table-bordered bg-white align-middle" id="tabel" style="display:none">
                <thead>
                    <tr class="sticky text-light text-center">
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Makanan</th>
                        <th>Minuman</th>
                        <th>Waktu Tindakan</th>
                        <th>Status Pesanan</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @if(count($tracking) > 0)
                    @php $no = 1; @endphp
                    @foreach($tracking as $key => $data)
                    <tr>
                        <td>{{ $tracking->firstItem() + $key }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['makanan'] }} {{ $data['ket_makanan'] }}</td>
                        <td>{{ $data['minuman'] }} {{ $data['ket_minuman'] }}</td>
                        <td>{{ date("d/m/Y hh:mm", strtotime($data['waktu_tindakan'])) }}</td>
                        <td>{{ $data['status'] }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#filter").on('change', function(){
            var filter = $(this).val();
            $.ajax({
                url:"{{ route('trackingOrder') }}",
                type:"GET",
                data:{'dokter' : filter},
                success:function(data){
                    $("#tabel").css({'display': ''});
                    var tracking = data.tracking;
                    var html = '';

                    if(tracking.length > 0){
                        for(let i=0; i<tracking.length; i++){
                            var warna = '';
                            var font = '';
                            if (tracking[i]['status'] == 'Belum Diproses') {
                                warna = '#D50000';
                                font = 'white';
                            } else if (tracking[i]['status'] == 'Sedang Diproses') {
                                warna = '#FF6D00';
                                font = 'white';
                            } else if (tracking[i]['status'] == 'Menunggu Pengantaran') {
                                warna = '#FFAB00';
                                font = 'black';
                            } else if (tracking[i]['status'] == 'Sedang Diantar') {
                                warna = '#FFEA00';
                                font = 'black';
                            } else {
                                warna = '#00C853';
                                font = 'black';
                            }

                            html += '<tr>';
                            html += '<td>'+(i+1)+'</td>';
                            html += '<td>'+tracking[i]['nama']+'</td>';
                            html += '<td>' + tracking[i]['makanan'];
                                if (tracking[i]['ket_makanan'] !== null) {
                                    html += ' ' + tracking[i]['ket_makanan'];
                                }
                            html += '<td>' + tracking[i]['minuman'];
                                if (tracking[i]['ket_minuman'] !== null) {
                                    html += ' ' + tracking[i]['ket_minuman'];
                                }
                            html += '<td>'+tracking[i]['tanggal_tindakan']+' '+tracking[i]['waktu_tindakan']+'</td>';
                            html += '<td class="text-center" style="background-color: '+warna+'; color: '+font+'"><b>'+tracking[i]['status']+'</b></td>';
                            html += '</tr>';
                        }
                    } else {
                        html += '<tr>\
                                    <td colspan="7" class="bg-danger text-white text-center">Tidak ada data</td>\
                                </tr>';
                    }

                    $("#tbody").html(html);
                }
            });
        });
    });
</script>

@endsection

@extends('layouts.footer')