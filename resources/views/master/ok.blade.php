@extends('layouts.app')

@section('content')
<div class="header-waves">
    <div class="container pt-3">
        <h1 class="text-center"><b>MONITORING</b></h1>
        <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
    </div>

    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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

<div class="container-fluid justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="appMonitoring">
        <table class="table table-bordered table-striped align-middle w-100">
            <thead class="sticky">
                <tr class="sticky text-light text-center">
                    <th scope="col" style="width: 1%">No</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Minuman</th>
                    <th scope="col" style="width: 8%">Waktu Tindakan</th>
                    <th scope="col" style="width: 8%">Waktu Pesanan</th>
                    <th scope="col" style="width: 11%">Status Saat Ini</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in monitoring">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ item.nama }}</td>
                    <td>@{{ item.makanan }}</td>
                    <td>@{{ item.minuman }}</td>
                    <td>@{{ item.tanggal_tindakan | tgl }} @{{ item.waktu_tindakan }}</td>
                    <td>@{{ item.belum_diproses | tglIndo }}</td>
                    <td v-if="item.status=='Belum Diproses'" class="text-center blink">
                        <b>@{{ item.status }}</b>
                    </td>
                    <td v-else-if="item.status=='Sedang Diproses'" class="text-center text-white"
                        style="background-color: #FF6D00;">
                        <b>@{{ item.status }}</b>
                    </td>
                    <td v-else-if="item.status=='Menunggu Pengantaran'" class="text-center"
                        style="background-color: #FFAB00;">
                        <b>@{{ item.status }}</b>
                    </td>
                    <td v-else-if="item.status=='Sedang Diantar'" class="text-center"
                        style="background-color: #FFEA00;">
                        <b>@{{ item.status }}</b>
                    </td>
                    <td v-else class="text-center" style="background-color: #00C853;">
                        <b>@{{ item.status }}</b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    const tglIndo = function (str) {
        if (str != null) {
            return moment(str).format("DD/MM/YYYY hh:mm");
        }
        return "-";
    };
    
    const filters = {
        tglIndo
    };
    
    Vue.filter('tgl', function (date) {
    return moment(date).format('DD/MM/YYYY');
    })
    
    Object.keys(filters).forEach(k => Vue.filter(k, filters[k]));

    var vueMonitoring = new Vue({
        el: "#appMonitoring",
        data: {
            monitoring: []
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData: function() {
                let url = "{{ route('monitoringMaster') }}";

                axios.get(url)
                .then(resp => {
                    // console.log(resp);
                    this.monitoring = resp.data.monitoring;
                })
                .catch(err => {
                    console.log(err);
                    alert('error');
                })
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

@extends('layouts.footer')