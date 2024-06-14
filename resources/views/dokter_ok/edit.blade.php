<div class="modal fade" id="editdokter{{$data->id}}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($data, [ 'method' => 'patch','route' => ['editDokterOk', $data->id] ]) !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('nama', $data->dokter, ['style' => 'height: auto', 'class' => 'form-control',
                    'id' => 'nama', 'placeholder' => 'Nama', 'required']) !!}
                    {!! Form::label('nama', 'Nama') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Batal</button>
                {{Form::button('<i class="fa-solid fa-check"></i> Ubah Data', ['class' => 'btn btn-sm
                btn-success', 'type' => 'submit'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>