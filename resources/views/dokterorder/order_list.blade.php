@extends('layouts.app')

@section('content')

<div class="container" id="appVue">
    <table class="table">
        <thead>
            <tr>
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
                    style="background-color: #FF1744;">
                    <b>@{{ item.status }}</b>
                </td>
                <td v-else-if="item.status=='Sedang Diproses'" class="text-center" style="background-color: #FF6D00;">
                    <b>@{{ item.status }}</b>
                </td>
                <td v-else-if="item.status=='Menunggu Pengantaran'" class="text-center"
                    style="background-color: #FFAB00;">
                    <b>@{{ item.status }}</b>
                </td>
                <td v-else-if="item.status=='Sedang Diantar'" class="text-center" style="background-color: #FFEA00;">
                    <b>@{{ item.status }}</b>
                </td>
                <td v-else class="text-center" style="background-color: #00C853;">
                    <b>@{{ item.status }}</b>
                </td>
                <td class="text-center">
                    <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                        <a :href=`{{ route('sedangdiproses', '' ) }}/${item.id}`
                            :class="`${item.sedang_diproses === null ? 'btn btn-sm sedangdiproses' : 'btn btn-sm tombolmati'}`">
                            Sedang Diproses</a>
                        <a :href=`{{ route('menunggupengantaran', '' ) }}/${item.id}`
                            :class="`${item.menunggu_pengantaran === null ? 'btn btn-sm menunggupengantaran' : 'btn btn-sm tombolmati'}`">
                            Menunggu Pengantaran</a>
                        <a :href=`{{ route('sedangdiantar', '' ) }}/${item.id}`
                            :class="`${item.sedang_diantar === null ? 'btn btn-sm sedangdiantar' : 'btn btn-sm tombolmati'}`">
                            Sedang Diantar</a>
                        <a :href=`{{ route('selesai', '' ) }}/${item.id}`
                            :class="`${item.selesai === null ? 'btn btn-sm selesai' : 'btn btn-sm tombolmati'}`">
                            Selesai</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
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