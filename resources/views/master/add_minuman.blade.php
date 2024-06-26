<div class="modal fade" id="tambahminuman" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalTambahMinuman"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMinuman">Tambah Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'master/add']) !!}
                {!! Form::hidden('id') !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('item', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'item', 'placeholder' => 'Item', 'required']) !!}
                    {!! Form::label('item', 'Item') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('jenis', ['Minuman' => 'Minuman'], '',
                    ['style' => 'height: auto', 'class' => 'form-select', 'id' => 'jenis',
                    'placeholder' => '-- Pilih jenis item --','required']) !!}
                    {!! Form::label('jenis', 'Jenis Item') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('keterangan', ['Aktif' => 'Aktif', 'Nonaktif' => 'Nonaktif'], '',
                    ['style' => 'height: auto', 'class' => 'form-select', 'id' => 'keterangan',
                    'placeholder' => '-- Pilih keterangan item --','required']) !!}
                    {!! Form::label('keterangan', 'Keterangan Item') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('status', ['Tersedia' => 'Tersedia', 'Tidak Tersedia' => 'Tidak Tersedia'], '',
                    ['style' => 'height: auto', 'class' => 'form-select', 'id' => 'status',
                    'placeholder' => '-- Pilih status item --','required']) !!}
                    {!! Form::label('status', 'Status Item') !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i> Batal</button>
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fa-solid fa-check"></i> Simpan</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>