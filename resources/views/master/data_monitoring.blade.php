@extends('layouts.master')

@section('masterContent')

<div class="container-fluid justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="monitoring">
        <table class="table table-bordered table-striped w-100 align-middle">
            <thead class="sticky">
                <tr class="sticky text-light text-center align-middle">
                    <th scope="col">No</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Minuman</th>
                    <th scope="col">Waktu Disajikan</th>
                    <th scope="col">Waktu Pesanan</th>
                    <th scope="col">Sedang Diproses</th>
                    <th scope="col">Menunggu Pengantaran</th>
                    <th scope="col">Sedang Diantar</th>
                    <th scope="col">Selesai</th>
                    <th scope="col">Status Saat Ini</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in monitoring">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ item.nama }}</td>
                    <td>@{{ item.makanan }} @{{ item.ket_makanan }}</br>(@{{ item.ops_ket_makanan }})</td>
                    <td>@{{ item.minuman }} @{{ item.ket_minuman }}</br>(@{{ item.ops_ket_minuman }})</td>
                    <td class="text-center">@{{ item.waktu_disajikan}}</br>@{{ item.tanggal_disajikan| tgl }}</td>
                    <td class="text-center">@{{ item.belum_diproses | jam}}</br>@{{ item.belum_diproses | tgl}}</td>
                    <td class="text-center">@{{ item.sedang_diproses | jam}}</br>@{{ item.sedang_diproses | tgl}}</td>
                    <td class="text-center">@{{ item.menunggu_pengantaran | jam}}</br>@{{ item.menunggu_pengantaran |
                        tgl}}</td>
                    <td class="text-center">@{{ item.sedang_diantar | jam}}</br>@{{ item.sedang_diantar | tgl}}</td>
                    <td class="text-center">@{{ item.selesai | jam}}</br>@{{ item.selesai | tgl}}</td>
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
    const tgl = function (str) {
        if (str != null) {
            return moment(str).format("DD/MM/YYYY");
        }
        return "-";
    };
    const jam = function (str) {
        if (str != null) {
            return moment(str).format("hh:mm");
        }
        return "-";
    };
    const tglIndo = function (str) {
        if (str != null) {
            return moment(str).format("DD/MM/YYYY hh:mm");
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
        el: "#monitoring",
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