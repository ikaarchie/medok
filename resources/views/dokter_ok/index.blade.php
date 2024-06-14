@extends('layouts.ok')

@section('okContent')

<div class="container justify-content-center bg-white">
    <div class="d-md-flex justify-content-between">
        <div class="gap-1 d-md-flex justify-content-md-start mt-2">
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn"
                style="background-color: #e73c7e;">
                <i class="text-white fa-solid fa-plus"></i><b class="text-white"> Tambah Data</b>
            </button>
        </div>

        <div class="gap-1 d-md-flex justify-content-md-end mt-2">
            <div class="form-group w-10">
                <div class="input-group">
                    <input type="text" class="form-control" style="outline: 0.5px solid; outline-color: #e73c7e;"
                        id="inputdokter" onkeyup="caridokter()" placeholder="Cari Dokter">
                    <span class="input-group-text"
                        style="outline: 0.5px solid; outline-color: #e73c7e; background-color: #e73c7e;">
                        <i class="text-white fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-1 table-data tbl-fixed">
        <table class="table table-bordered border-dark align-middle w-100" id="tabeldokter">
            <thead class="sticky text-white text-center align-middle">
                <tr>
                    <th style="width:1%">No</th>
                    <th>Nama Dokter</th>
                    <th style="width:20%">Aksi</th>
                </tr>
            </thead>
            <tbody style=" background-color: #F8BBD0">
                @php $no = 1; @endphp
                @forelse($dokter as $key => $data)
                <tr>
                    <td>{{ $dokter->firstItem() + $key }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="#editdokter{{ $data->id }}" data-bs-toggle="modal"
                                class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="#" class="btn btn-sm btn-danger deletedokter" data-id="{{ $data->id }}"
                                data-dokter="{{ $data->nama }}"><i class="fa-solid fa-trash"></i> Delete</a>
                            @include('dokter_ok.edit')
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
@include('dokter_ok.add')

{{-- fungsi search --}}
<script>
    function caridokter() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("inputdokter");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabeldokter");
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
    $('.deletedokter').click(function(){  
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-dokter');
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
                window.location.href = "dokter_ok/delete/"+id+""
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