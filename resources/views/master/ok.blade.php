@extends('layouts.ok')

@section('okContent')

<div class="container-fluid justify-content-center bg-white">
    <div class="table-responsive mt-1 table-data tbl-fixed" id="monitoringOk">
        <table class="table table-bordered table-striped align-middle w-100">
            <thead class="sticky">
                <tr class="sticky text-light text-center align-middle">
                    <th scope="col" style="width: 1%">No</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Minuman</th>
                    <th scope="col" style="width: 8%">Waktu Disajikan</th>
                    <th scope="col" style="width: 8%">Waktu Pesanan</th>
                    <th scope="col" style="width: 11%">Status Saat Ini</th>
                    <th scope="col" style="width: 8%">Ubah Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in monitoring">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ item.nama }}</td>
                    <td>@{{ item.makanan }} @{{ item.ket_makanan }}</br>
                        @{{ item.ops_ket_makanan !== null ? '(' + item.ops_ket_makanan + ')' : '' }}
                    </td>
                    <td>@{{ item.minuman }} @{{ item.ket_minuman }}</br>
                        @{{ item.ops_ket_minuman !== null ? '(' + item.ops_ket_minuman + ')' : '' }}
                    </td>
                    <td class="text-center">@{{ item.waktu_disajikan}}</br>@{{ item.tanggal_disajikan| tgl }}</td>
                    <td class="text-center">@{{ item.belum_diproses | jam}}</br>@{{ item.belum_diproses | tgl}}</td>
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
                    <td class="text-center justify-content-center">
                        <a href="javascript:void(0)" @click="updateStatus(monitoring, +item.id, 4)"
                            :class="`${item.sedang_diantar !== null && item.selesai === null ? 'btn selesai' : 'btn tombolmati'}`">Selesai</a>
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
        el: "#monitoringOk",
        data: {
            monitoring: []
        },
        mounted() {
            this.getData();
            this.updateStatus();
        },
        methods: {
            getData: function() {
                let url = "{{ route('monitoringOK') }}";

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

@extends('layouts.footer')