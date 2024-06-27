@extends('layouts.tracking')

@section('content')
{{-- {{ dd($coba) }} --}}

<div class="container justify-content-center align-items-center mt-3">
    <div class="d-grid gap-3 mx-auto">
        <a href="{{ url('/dokterorder') }}" type="button" class="btn btn-sm blur text-white col-2">
            <i class="fa-solid fa-angles-left"></i></a>

        <div id="tracking">
            <select class="form-select form-select blur" name="filter" id="filter" v-model="filter">
                <option value="" selected>-- Pilih nama dokter --</option>
                @if(count($dokter) > 0)
                @foreach($dokter as $nama)
                <option value="{{ $nama->nama }}">{{ $nama->nama }}</option>
                @endforeach
                @endif
            </select>

            <div v-for="item in filteredTracking" :key="item.id" class="card mb-3 blur">
                <div class="card-header text-white">
                    <div class="gap-1 d-flex justify-content-start"><b>@{{ item.nama }}</b></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped-columns align-middle">
                            <tbody class="text-white">
                                <tr>
                                    <th class="col-3">Makanan</th>
                                    <td class="text-white">
                                        @{{ item.makanan }}
                                        <span v-if="item.ket_makanan && item.ops_ket_makanan">@{{ item.ket_makanan }}
                                            (@{{
                                            item.ops_ket_makanan }})</span>
                                        <span v-else-if="item.ket_makanan">@{{ item.ket_makanan }}</span>
                                        <span v-else-if="item.ops_ket_makanan">(@{{ item.ops_ket_makanan }})</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-3">Minuman</th>
                                    <td class="text-white">
                                        @{{ item.minuman }}
                                        <span v-if="item.ket_minuman && item.ops_ket_minuman">@{{ item.ket_minuman }}
                                            (@{{
                                            item.ops_ket_minuman }})</span>
                                        <span v-else-if="item.ket_minuman">@{{ item.ket_minuman }}</span>
                                        <span v-else-if="item.ops_ket_minuman">(@{{ item.ops_ket_minuman }})</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-3">Waktu pemesanan</th>
                                    <td class="text-white">@{{ formatDateTime(item.belum_diproses) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center"
                    :style="{ backgroundColor: getStatusColor(item.status), color: getStatusFontColor(item.status) }">
                    <b>@{{ item.status }}</b>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var dataTracking = new Vue({
        el: "#tracking",
        data: {
        tracking: [], // Pastikan tracking diinisialisasi jika digunakan di template lain
        filter: '' // Pastikan filter diinisialisasi dengan nilai yang sesuai
        },
        mounted() {
        this.getData();
        },
        methods: {
        getData() {
        let url = "{{ route('trackingOrder') }}";
        axios.get(url)
        .then(resp => {
        this.tracking = resp.data.tracking;
        })
        .catch(err => {
        console.log(err);
        alert('error');
        });
        },
        formatDateTime(dateTime) {
        var tanggalObjek = new Date(dateTime);
        return ("0" + tanggalObjek.getDate()).slice(-2) + "/" +
        ("0" + (tanggalObjek.getMonth() + 1)).slice(-2) + "/" +
        tanggalObjek.getFullYear() + " " +
        ("0" + tanggalObjek.getHours()).slice(-2) + ":" +
        ("0" + tanggalObjek.getMinutes()).slice(-2);
        },
        getStatusColor(status) {
        if (status == 'Belum Diproses') {
        return '#D50000';
        } else if (status == 'Sedang Diproses') {
        return '#FF6D00';
        } else if (status == 'Menunggu Pengantaran') {
        return '#FFAB00';
        } else if (status == 'Sedang Diantar') {
        return '#FFEA00';
        } else {
        return '#00C853';
        }
        },
        getStatusFontColor(status) {
        if (status == 'Belum Diproses' || status == 'Sedang Diproses') {
        return 'white';
        } else {
        return 'black';
        }
        }
        },
        computed: {
        filteredTracking() {
        if (this.filter === '') {
        return this.tracking;
        }
        return this.tracking.filter(item => item.nama === this.filter);
        }
        }
        });
        });
    </script>

    @endsection

    {{-- @extends('layouts.footer') --}}