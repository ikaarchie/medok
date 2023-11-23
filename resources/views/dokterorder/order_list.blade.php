@extends('layouts.app')

@section('content')
<div class="header-waves">
    <div class="container pt-3">
        <h1 class="text-center"><b>DAFTAR PESANAN DOKTER</b></h1>
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
    <div class="table-responsive mt-1 table-data tbl-fixed" id="appVue">
        <table class="table table-bordered table-striped align-middle w-100">
            <thead>
                <tr class="sticky text-light text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Waktu Pesanan</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Minuman</th>
                    <th scope="col">Waktu Tindakan</th>
                    <th scope="col">Status Saat Ini</th>
                    <th scope="col">Ubah Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in order_list">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ item.nama }}</td>
                    <td>@{{ item.belum_diproses | tglIndo}}</td>
                    <td>@{{ item.makanan }}</td>
                    <td>@{{ item.minuman }}</td>
                    <td>@{{ item.waktu_tindakan | tglIndo}}</td>
                    <td v-if="item.status=='Belum Diproses'" class="text-center text-white"
                        style="background-color: #D50000;">
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
                    <td class="text-center">
                        <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                            <a :href=`{{ route('sedangdiproses', '' ) }}/${item.id}`
                                :class="`${item.sedang_diproses === null ? 'btn sedangdiproses' : 'btn tombolmati'}`">
                                Sedang Diproses</a>
                            <a :href=`{{ route('menunggupengantaran', '' ) }}/${item.id}`
                                :class="`${item.menunggu_pengantaran === null ? 'btn menunggupengantaran' : 'btn tombolmati'}`">
                                Menunggu Pengantaran</a>
                            <a :href=`{{ route('sedangdiantar', '' ) }}/${item.id}`
                                :class="`${item.sedang_diantar === null ? 'btn sedangdiantar' : 'btn tombolmati'}`">
                                Sedang Diantar</a>
                            <a :href=`{{ route('selesai', '' ) }}/${item.id}`
                                :class="`${item.selesai === null ? 'btn selesai' : 'btn tombolmati'}`">
                                Selesai</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    var vueDataDokterOrder = new Vue({
            el: "#appVue",
            data: {
                order_list: []
            },
            mounted() {
                this.getData();
            },
            methods: {
                getData: function() {
                    let url = "{{ route('listDokterOrder') }}";

                    axios.get(url)
                        .then(resp => {
                            // console.log(resp);
                            this.order_list = resp.data.order_list;
                        })
                        .catch(err => {
                            console.log(err);
                            alert('error');
                        })
                }
            }
        })
</script>

<script>
    Vue.filter('tglIndo', function (date) {
        return moment(date).format('D MMMM Y hh:mm');
    })
</script>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    window.Echo.channel("messages").listen("DokterOrderCreated", (event) => {
            console.log(event);
            // alert('sukses');
            vueDataDokterOrder.getData();
        });
</script>
@endsection

@extends('layouts.footer')