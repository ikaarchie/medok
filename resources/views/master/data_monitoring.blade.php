@extends('layouts.master')

@section('masterContent')

<div class="container-fluid justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="appMonitoring">
        <table class="table table-bordered table-striped align-middle w-100">
            <thead class="sticky">
                <tr class="sticky text-light text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Minuman</th>
                    <th scope="col">Waktu Tindakan</th>
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
                    <td>@{{ item.makanan }}</td>
                    <td>@{{ item.minuman }}</td>
                    <td>@{{ item.tanggal_tindakan | tgl }} @{{ item.waktu_tindakan }}</td>
                    <td>@{{ item.belum_diproses | tglIndo }}</td>
                    <td>@{{ item.sedang_diproses | tglIndo }}</td>
                    <td>@{{ item.menunggu_pengantaran | tglIndo }}</td>
                    <td>@{{ item.sedang_diantar | tglIndo }}</td>
                    <td>@{{ item.selesai | tglIndo }}</td>
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