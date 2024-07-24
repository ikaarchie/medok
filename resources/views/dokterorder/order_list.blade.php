@extends('layouts.app')

@section('content')
<div class="header-waves">
    <h6 class="text-start">{{ request()->ip() }}</h6>
    <div class="container">
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
    <div class="table-responsive mt-1 table-data tbl-fixed" id="orderlist">
        <table class="table table-bordered table-striped align-middle w-100">
            <thead>
                <tr class="sticky text-light text-center align-middle">
                    <th scope="col" style="width: 1%">No</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Minuman</th>
                    <th scope="col" style="width: 8%">Waktu Pesanan</th>
                    <th scope="col" style="width: 8%">Waktu Disajikan</th>
                    <th scope="col" style="width: 11%">Status Saat Ini</th>
                    <th scope="col" style="width: 30%">Ubah Status</th>
                    <th scope="col" style="width: 5%">Print</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in order_list" class="align-middle font-tabel">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ item.nama }}</td>
                    <td>@{{ item.makanan }} @{{ item.ket_makanan }}</br>
                        @{{ item.ops_ket_makanan !== null ? '(' + item.ops_ket_makanan + ')' : '' }}
                    </td>
                    <td>@{{ item.minuman }} @{{ item.ket_minuman }}</br>
                        @{{ item.ops_ket_minuman !== null ? '(' + item.ops_ket_minuman + ')' : '' }}
                    </td>
                    <td class="text-center">@{{ item.belum_diproses | jam}}</br>@{{ item.belum_diproses | tgl}}</td>
                    <td class="text-center">@{{ item.waktu_disajikan}}</br>@{{ item.tanggal_disajikan| tgl }}</td>
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
                    {{-- <td class="text-center">
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
                    </td> --}}

                    <td class="text-center">
                        <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                            <a href="javascript:void(0)" @click="updateStatus(order_list, +item.id, 1)"
                                :class="`${item.sedang_diproses === null && item.menunggu_pengantaran === null && item.sedang_diantar === null && item.selesai === null ? 'btn btn-sm sedangdiproses' : 'btn btn-sm tombolmati'}`">Sedang
                                Diproses</a>
                            <a href="javascript:void(0)" @click="updateStatus(order_list, +item.id, 2)"
                                :class="`${item.sedang_diproses !== null && item.menunggu_pengantaran === null && item.sedang_diantar === null && item.selesai === null ? 'btn btn-sm menunggupengantaran' : 'btn btn-sm tombolmati'}`">Menunggu
                                Pengantaran</a>
                            <a href="javascript:void(0)" @click="updateStatus(order_list, +item.id, 3)"
                                :class="`${item.sedang_diproses !== null && item.menunggu_pengantaran !== null && item.sedang_diantar === null && item.selesai === null ? 'btn btn-sm sedangdiantar' : 'btn btn-sm tombolmati'}`">Sedang
                                Diantar</a>
                            {{-- <a href="javascript:void(0)" @click="updateStatus(order_list, +item.id, 4)"
                                :class="`${item.selesai === null ? 'btn selesai' : 'btn tombolmati'}`">Selesai</a> --}}
                        </div>
                    </td>

                    {{-- <td class="text-center">
                        <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                            <form :action="`{{ route('sedangdiproses', '') }}/${item.id}`" method="post">
                                <input type="hidden" name="order_list" :value="order_list">
                                <input type="hidden" name="item_id" :value="item.id">
                                <input type="hidden" name="status" value="1">
                                <button type="submit" :id="'sedangdiproses_'+index"
                                    :class="`${item.sedang_diproses === null ? 'btn sedangdiproses' : 'btn tombolmati'}`">Sedang
                                    Diproses</button>
                            </form>
                        </div>
                    </td> --}}

                    <td class="text-center">
                        <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                            {{-- <a :href="'{{ route('print', '') }}/' + item.id" class="btn btn-outline-success btn-sm"
                                :id="item.id" target="print_frame">
                                <b><i class="fa-solid fa-print"></i></b>
                            </a> --}}

                            <a href="#" class="btn btn-outline-success btn-sm" @click.prevent="printItem(item.id)">
                                <b><i class="fa-solid fa-print"></i></b>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-for="(item,index) in order_list">
            <audio autoplay loop v-if="item.status=='Belum Diproses'">
                <source src="../public/audio/oi.mp3" type="audio/mp3">
            </audio>
        </div>
    </div>
</div>

<script>
    var vueDataDokterOrder = new Vue({
            el: "#orderlist",
            data: {
                order_list: []
            },
            mounted() {
                this.getData();
                this.updateStatus();
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
                },

                updateStatus(order_list, id, status)
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
                    // console.log(order_list, id, status);
                    $.ajax({
                        method: "GET",
                        url: route,
                        data: {
                            // '_token': '{{ csrf_token() }}',
                            'order_list' : order_list
                        },
                        success:function(data){
                        // updateStatus(order_list, id, status);
                        },
                        error: function(error) {
                            alert('Terjadi kesalahan saat memperbarui status');
                        }
                    });
                },

                printItem(itemId) {
                    const printUrl = `{{ route('print', '') }}/${itemId}`;
                    
                    fetch(printUrl)
                    .then(response => response.text())
                    .then(html => {
                        const printFrame = document.createElement('iframe');
                        printFrame.style.position = 'absolute';
                        printFrame.style.width = '0';
                        printFrame.style.height = '0';
                        printFrame.style.border = 'none';
                        document.body.appendChild(printFrame);
                        
                        const printDocument = printFrame.contentWindow.document;
                        printDocument.open();
                        printDocument.write(html);
                        printDocument.close();
                        
                        printFrame.contentWindow.focus();
                        printFrame.contentWindow.print();
                        
                        setTimeout(() => {
                            document.body.removeChild(printFrame);
                        }, 1000);
                    })
                    .catch(error => console.error('Error:', error));
                }
            }
        })
</script>

<script>
    Vue.filter('tgl', function (date) {
        return moment(date).format('DD/MM/YYYY');
    })
    Vue.filter('jam', function (date) {
        return moment(date).format('HH:mm');
    })
    Vue.filter('tglIndo', function (date) {
        return moment(date).format('DD/MM/YYYY HH:mm');
    })
</script>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    window.Echo.channel("messages").listen("DokterOrderCreated", (event) => {
            // console.log(event);
            // alert('sukses');
            vueDataDokterOrder.getData();
        });
</script>
@endsection

@extends('layouts.footer')