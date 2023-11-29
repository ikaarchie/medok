@extends('layouts.app')

@section('content')
{{-- {{ dd($coba) }} --}}

<div class="container d-flex justify-content-center vh-100 align-items-center">
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
                        <td>{{ $data['makanan'] }}</td>
                        <td>{{ $data['minuman'] }}</td>
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

                            html += '<tr>\
                                    <td>'+(i+1)+'</td>\
                                    <td>'+tracking[i]['nama']+'</td>\
                                    <td>'+tracking[i]['makanan']+'</td>\
                                    <td>'+tracking[i]['minuman']+'</td>\
                                    <td class="tgl">'+tracking[i]['waktu_tindakan']+'</td>\
                                    <td class="text-center" style="background-color: '+warna+'; color: '+font+'"><b>'+tracking[i]['status']+'</b></td>\
                                </tr>';
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