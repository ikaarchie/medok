<div class="modal fade" id="tambah" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalTambah"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambah">Tambah Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'dokterorder/save']) !!}
                {!! Form::hidden('id') !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('nama', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'nama', 'placeholder' => 'Nama Dokter', 'required']) !!}
                    {!! Form::label('nama', 'Nama Dokter') !!}
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::date('tanggal_tindakan', '', ['style' => 'height: auto', 'class' =>
                        'form-control',
                        'id' => 'tanggal_tindakan', 'required']) !!}
                        {!! Form::label('tanggal_tindakan', 'Tanggal Tindakan') !!}
                    </div>

                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::time('waktu_tindakan', '', ['style' => 'height: auto', 'class' =>
                        'form-control',
                        'id' => 'waktu_tindakan', 'required']) !!}
                        {!! Form::label('waktu_tindakan', 'Waktu Tindakan') !!}
                    </div>
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('makanan', $list_makanan, '', ['style' => 'height: auto', 'class' =>
                    'form-select',
                    'id' => 'makanan', 'placeholder' => '-- Pilih makanan --','required']) !!}
                    {!! Form::label('makanan', 'Pilih makanan') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('minuman', $list_minuman, '', ['style' => 'height: auto', 'class' =>
                    'form-select',
                    'id' => 'minuman', 'placeholder' => '-- Pilih minuman --','required']) !!}
                    {!! Form::label('minuman', 'Pilih minuman') !!}
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