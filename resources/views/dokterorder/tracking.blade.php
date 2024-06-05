@extends('layouts.tracking')

@section('content')
{{-- {{ dd($coba) }} --}}

<div class="container justify-content-center align-items-center mt-3">
    <div class="d-grid gap-3 mx-auto">
        <a href="{{ url()->previous() }}" type="button" class="btn btn-sm blur text-white col-2">
            <i class="fa-solid fa-angles-left"></i></a>

        <select class="form-select form-select blur" name="filter" id="filter">
            <option selected>-- Pilih nama dokter --</option>
            @if(count($dokter) > 0)
            @foreach($dokter as $nama)
            <option value="{{ $nama['nama'] }}">{{ $nama->nama }}</option>
            @endforeach
            @endif
        </select>

        <div id="kartu">
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
                    // $("#tabel").css({'display': ''});
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

                            var tanggalAwal = tracking[i]['belum_diproses'];
                            var tanggalObjek = new Date(tanggalAwal);
                            var tanggalDanWaktu =   ("0" + tanggalObjek.getDate()).slice(-2) + "/" +
                                                    ("0" + (tanggalObjek.getMonth() + 1)).slice(-2) + "/" +
                                                    tanggalObjek.getFullYear() + " " +
                                                    ("0" + tanggalObjek.getHours()).slice(-2) + ":" +
                                                    ("0" + tanggalObjek.getMinutes()).slice(-2);

                            html += '<div class="card mb-3 blur">';
                            html += '<div class="card-header text-white">';
                            html += '<div class="gap-1 d-flex justify-content-start"><b>'+tracking[i]['nama']+'</b></div>';
                            html += '</div>';
                            html += '<div class="card-body">';
                            html += '<div class="table-responsive">';
                            html += '<table class="table table-striped-columns align-middle">';
                            html += '<tbody class="text-white">';
                            html += '<tr>';
                            html += '<th class="col-2">Makanan</th>';
                            html += '<td class="text-white">' + tracking[i]['makanan'];
                                if (tracking[i]['ket_makanan'] !== null) {
                                    html += ' ' + tracking[i]['ket_makanan'] + ' (' + tracking[i]['ops_ket_makanan'] + ')';
                                }else{
                                    html += ' (' + tracking[i]['ops_ket_makanan'] + ')';
                                }
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th class="col-2">Minuman</th>';
                            html += '<td class="text-white">' + tracking[i]['minuman'];
                                if (tracking[i]['ket_minuman'] !== null) {
                                    html += ' ' + tracking[i]['ket_minuman'] + ' (' + tracking[i]['ops_ket_minuman'] + ')';
                                }else{
                                    html += ' (' + tracking[i]['ops_ket_minuman'] + ')';
                                }
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th class="col-2">Waktu pemesanan</th>';
                            html += '<td class="text-white">'+ tanggalDanWaktu +'</td>';
                            html += '</tr>';
                            html += '</tbody>';
                            html += '</table>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="card-footer text-center" style="background-color: '+warna+'; color: '+font+'">';
                            html += '<b>'+tracking[i]['status']+'</b>';
                            html += '</td>';
                            html += '</div>';
                            html += '</div>';
                        }
                    }

                    $("#kartu").html(html);
                }
            });
        });
    });
</script>

@endsection

{{-- @extends('layouts.footer') --}}