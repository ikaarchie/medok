<div class="modal fade" id="editminuman{{$item->id}}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($item, [ 'method' => 'patch','route' => ['editMaster', $item->id] ]) !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('item', $item->item, ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'item', 'placeholder' => 'Item', 'required']) !!}
                    {!! Form::label('item', 'Item') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('jenis', ['Minuman' => 'Minuman'],
                    $item->jenis, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                    'jenis', 'placeholder' => '-- Pilih jenis item --','required']) !!}
                    {!! Form::label('jenis', 'Jenis Item') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('keterangan', ['Aktif' => 'Aktif', 'Nonaktif' => 'Nonaktif'], $item->keterangan,
                    ['style' => 'height: auto', 'class' => 'form-select', 'id' => 'keterangan',
                    'placeholder' => '-- Pilih keterangan item --','required']) !!}
                    {!! Form::label('keterangan', 'Keterangan Item') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('status', [
                    'Aktif' => 'Aktif', 'Nonaktif' => 'Nonaktif'
                    ], $item->status, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                    'status', 'placeholder' => '-- Pilih status item --','required']) !!}
                    {!! Form::label('status', 'Status Item') !!}
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