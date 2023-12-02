@extends('layouts.master')

@section('masterContent')

<div class="d-grid gap-1 d-flex justify-content-center">
    <div class="container justify-content-center bg-white">
        <div class="d-md-flex justify-content-between">
            <div class="gap-1 d-md-flex justify-content-md-start mt-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#tambahmakanan" class="btn"
                    style="background-color: #e73c7e;">
                    <i class="text-white fa-solid fa-plus"></i><b class="text-white"> Tambah Makanan</b>
                </button>
            </div>

            <div class="gap-1 d-md-flex justify-content-md-end mt-2">
                <div class="form-group w-10">
                    <div class="input-group">
                        <input type="text" class="form-control" style="outline: 0.5px solid; outline-color: #e73c7e;"
                            id="inputmakanan" onkeyup="carimakanan()" placeholder="Cari Makanan">
                        <span class="input-group-text"
                            style="outline: 0.5px solid; outline-color: #e73c7e; background-color: #e73c7e;">
                            <i class="text-white fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-1 table-data tbl-fixed">
            <table class="table table-bordered border-dark align-middle w-100" id="tabelmakanan">
                <thead class="sticky text-white text-center align-middle">
                    <tr>
                        <th style="width:1%">No</th>
                        <th>Makanan</th>
                        <th style="width:20%">Keterangan<br>Pedas / Tidak pedas</th>
                        <th style="width:15%">Status</th>
                        <th style="width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody style=" background-color: #F8BBD0">
                    @php $no = 1; @endphp
                    @forelse($makanan as $key => $item)
                    <tr>
                        <td>{{ $makanan->firstItem() + $key }}</td>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <a href="#editmakanan{{ $item->id }}" data-bs-toggle="modal"
                                    class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-danger deletemakanan" data-id="{{ $item->id }}"
                                    data-makanan="{{ $item->item }}"><i class="fa-solid fa-trash"></i> Delete</a>
                                @include('master.edit_makanan')
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="21" class="text-center"><b>Tidak ada data</b></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="container justify-content-center bg-white">
        <div class="d-md-flex justify-content-between">
            <div class="gap-1 d-md-flex justify-content-md-start mt-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#tambahminuman" class="btn"
                    style="background-color: #e73c7e;">
                    <i class="text-white fa-solid fa-plus"></i><b class="text-white"> Tambah Minuman</b>
                </button>
            </div>

            <div class="gap-1 d-md-flex justify-content-md-end mt-2">
                <div class="form-group w-10">
                    <div class="input-group">
                        <input type="text" class="form-control" style="outline: 0.5px solid; outline-color: #e73c7e;"
                            id="inputminuman" onkeyup="cariminuman()" placeholder="Cari Minuman">
                        <span class="input-group-text"
                            style="outline: 0.5px solid; outline-color: #e73c7e; background-color: #e73c7e;">
                            <i class="text-white fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-1 table-data tbl-fixed">
            <table class="table table-bordered border-dark align-middle w-100" id="tabelminuman">
                <thead class="sticky text-white text-center align-middle">
                    <tr>
                        <th style="width:1%">No</th>
                        <th>Minuman</th>
                        <th style="width:20%">Keterangan<br>Panas / Dingin</th>
                        <th style="width:15%">Status</th>
                        <th style="width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody style=" background-color: #F8BBD0">
                    @php $no = 1; @endphp
                    @forelse($minuman as $key => $item)
                    <tr>
                        <td>{{ $minuman->firstItem() + $key }}</td>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <a href="#editminuman{{ $item->id }}" data-bs-toggle="modal"
                                    class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-danger deleteminuman" data-id="{{ $item->id }}"
                                    data-minuman="{{ $item->item }}"><i class="fa-solid fa-trash"></i> Delete</a>
                                @include('master.edit_minuman')
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="21" class="text-center"><b>Tidak ada data</b></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('master.add_makanan')
@include('master.add_minuman')

{{-- fungsi search --}}
<script>
    function carimakanan() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("inputmakanan");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabelmakanan");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>

<script>
    function cariminuman() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("inputminuman");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabelminuman");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>

{{-- fungsi sweet alert --}}
<script>
    $('.deletemakanan').click(function(){  
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-makanan');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success me-md-2',
                cancelButton: 'btn btn-danger me-md-2'
            },
            buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
            title: "Yakin?",
            text: "Data "+nama+" akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "master/delete/"+id+""
                swalWithBootstrapButtons.fire(
                    'Terhapus!',
                    'Data berhasil dihapus',
                    'success'
                )
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan!',
                    'Data batal dihapus',
                    'error'
                    )
            }
        })
    })
</script>

<script>
    $('.deleteminuman').click(function(){  
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-minuman');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success me-md-2',
                cancelButton: 'btn btn-danger me-md-2'
            },
            buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
            title: "Yakin?",
            text: "Data "+nama+" akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "master/delete/"+id+""
                swalWithBootstrapButtons.fire(
                    'Terhapus!',
                    'Data berhasil dihapus',
                    'success'
                )
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan!',
                    'Data batal dihapus',
                    'error'
                    )
            }
        })
    })
</script>

{{-- fungsi toastr --}}
<script>
    // toastr.success('Have fun storming the castle!', 'Miracle Max Says')
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif
</script>
@endsection

@extends('layouts.footer')