@extends('layouts.app')

@section('content')
<div class="header-waves">
    <div class="container pt-3">
        <h1 class="text-center"><b>PRAMUSAJI</b></h1>
        <h6 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h6>
    </div>

    <svg class="waves_pantry" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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


<div class="container justify-content-center" id="monitoringPantry">
    <div class="card mb-3" v-for="(item,index) in monitoring">
        <div class="card-header">
            <div class="gap-1 d-flex justify-content-start"><b>@{{ item.nama }}</b></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive col-6">
                    <table class="table table-striped-columns align-middle">
                        <tbody>
                            <tr>
                                <th class="col-3">Makanan</th>
                                <td>@{{ item.makanan }} @{{ item.ket_makanan }}
                                    @{{ item.ops_ket_makanan !== null ? '(' + item.ops_ket_makanan + ')' : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="col-3">Minuman</th>
                                <td>@{{ item.minuman }} @{{ item.ket_minuman }}
                                    @{{ item.ops_ket_minuman !== null ? '(' + item.ops_ket_minuman + ')' : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="col-3">Status pemesanan</th>
                                <td v-if="item.status=='Belum Diproses'" class="blink">
                                    <b>@{{ item.status }}</b>
                                </td>
                                <td v-else-if="item.status=='Sedang Diproses'" class="text-white"
                                    style="background-color: #FF6D00;">
                                    <b>@{{ item.status }}</b>
                                </td>
                                <td v-else-if="item.status=='Menunggu Pengantaran'" style="background-color: #FFAB00;">
                                    <b>@{{ item.status }}</b>
                                </td>
                                <td v-else-if="item.status=='Sedang Diantar'" style="background-color: #FFEA00;">
                                    <b>@{{ item.status }}</b>
                                </td>
                                <td v-else style="background-color: #00C853;">
                                    <b>@{{ item.status }}</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive col-6">
                    <table class="table table-striped-columns align-middle">
                        <tbody>
                            <tr>
                                <th class="col-6">Waktu pemesanan</th>
                                <td>@{{ item.belum_diproses | tgl}} @{{ item.belum_diproses | jam}}</td>
                            </tr>
                            <tr>
                                <th class="col-6">Waktu disajikan</th>
                                <td>@{{ item.tanggal_disajikan | tgl}} @{{ item.waktu_disajikan}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="row justify-content-sm-center">
                <div class="col-6 d-grid">
                    <a href="javascript:void(0)" @click="updateStatus(monitoring, +item.id, 3)"
                        :class="`${item.sedang_diproses !== null && item.menunggu_pengantaran !== null && item.sedang_diantar === null && item.selesai === null ? 'btn btn-sm sedangdiantar' : 'btn btn-sm tombolmati'}`">Sedang
                        Diantar</a>
                </div>
                <div class="col-6 d-grid">
                    <a href="javascript:void(0)" @click="updateStatus(monitoring, +item.id, 4)"
                        :class="`${item.sedang_diproses !== null && item.menunggu_pengantaran !== null && item.sedang_diantar !== null && item.selesai === null ? 'btn btn-sm selesai' : 'btn btn-sm tombolmati'}`">Selesai</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const tgl = function (str) {
        if (str != null) {
            return moment(str).format("DD/MM/YYYY");
        }
        return "-";
    };
        const jam = function (str) {
            if (str != null) {
        return moment(str).format("HH:mm");
        }
        return "-";
    };
        const tglIndo = function (str) {
            if (str != null) {
        return moment(str).format("DD/MM/YYYY HH:mm");
        }
        return "-";
    };
    
    const filters = {
    tgl, jam, tglIndo
    };
    
    Vue.filter('tgl', function (date) {
        return moment(date).format('DD/MM/YYYY');
    })
    Vue.filter('jam', function (date) {
        return moment(date).format('HH:mm');
    })
    Vue.filter('tglIndo', function (date) {
        return moment(date).format('DD/MM/YYYY HH:mm');
    })
    
    Object.keys(filters).forEach(k => Vue.filter(k, filters[k]));

    var vueMonitoring = new Vue({
        el: "#monitoringPantry",
        data: {
            monitoring: []
        },
        mounted() {
            this.getData();
            this.updateStatus();
        },
        methods: {
            getData: function() {
                let url = "{{ route('monitoringPantry') }}";

                axios.get(url)
                .then(resp => {
                    // console.log(resp);
                    this.monitoring = resp.data.monitoring;
                })
                .catch(err => {
                    console.log(err);
                    alert('error');
                })
            },

            updateStatus(monitoring, id, status)
            {
                var route = '';
                if (status == 1) {
                    route = "sedangdiproses/" + id ;
                }
                if (status == 2) {
                    route = "menunggupengantaran/" + id ;
                }
                if (status == 3) {
                    route = "sedangdiantar/" + id ;
                }
                if (status == 4) {
                    route = "selesai/" + id ;
                }
                // console.log(monitoring, id, status);
                $.ajax({
                    method: "GET",
                    url: route,
                    data: {
                        // '_token': '{{ csrf_token() }}',
                        'monitoring' : monitoring
                    },
                        success:function(data){
                        // updateStatus(monitoring, id, status);
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat memperbarui status');
                    }
                });
            }
        }
    })
</script>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    window.Echo.channel("messages").listen("DokterOrderCreated", (event) => {
            console.log(event);
            // alert('sukses');
            vueMonitoring.getData();
        });
</script>
@endsection

{{-- @extends('layouts.footer') --}}