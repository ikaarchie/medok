<div class="modal fade" id="tambah" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalTambah"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content blur">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="modalTambah">Tambah Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'dokterorder/save']) !!}
                {!! Form::hidden('id') !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('nama', $list_dokter, '', ['style' => 'height: auto', 'class' =>
                    'form-select', 'id' => 'nama', 'placeholder' => '-- Pilih nama dokter --','required']) !!}
                    {!! Form::label('nama', 'Pilih nama dokter') !!}
                </div>

                <div class="col-sm-12 mb-1 fw-bold text-white font-monospace">
                    <p>*Pemesanan minimal 30 menit sebelum waktu disajikan</p>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::date('tanggal_disajikan', '', ['style' => 'height: auto', 'class' =>
                        'form-control',
                        'id' => 'tanggal_disajikan', 'required']) !!}
                        {!! Form::label('tanggal_disajikan', 'Tanggal disajikan') !!}
                    </div>

                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::time('waktu_disajikan', '', ['style' => 'height: auto', 'class' =>
                        'form-control',
                        'id' => 'waktu_disajikan', 'required']) !!}
                        {!! Form::label('waktu_disajikan', 'Jam disajikan') !!}
                    </div>
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('makanan', $list_makanan, '', ['style' => 'height: auto', 'class' =>
                    'form-select',
                    'id' => 'makanan', 'placeholder' => '-- Pilih makanan --','required']) !!}
                    {!! Form::label('makanan', 'Pilih makanan') !!}
                </div>

                <div id="ketMakanan" class="col-sm-12 mb-3 form-floating" style="display: none;">
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('ops_ket_makanan', '', ['style' => 'height: auto', 'class' =>
                    'form-control', 'id' => 'ops_ket_makanan', 'placeholder' => '-']) !!}
                    {!! Form::label('ops_ket_makanan', 'Keterangan makanan (opsional)') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('minuman', $list_minuman, '', ['style' => 'height: auto', 'class' =>
                    'form-select',
                    'id' => 'minuman', 'placeholder' => '-- Pilih minuman --','required']) !!}
                    {!! Form::label('minuman', 'Pilih minuman') !!}
                </div>

                <div id="ketMinuman" class="col-sm-12 mb-3 form-floating" style="display: none;">
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('ops_ket_minuman', '', ['style' => 'height: auto', 'class' =>
                    'form-control', 'id' => 'ops_ket_minuman', 'placeholder' => '-']) !!}
                    {!! Form::label('ops_ket_minuman', 'Keterangan minuman (opsional)') !!}
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
{{-- {{ dd($ket_makanan) }} --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const makanan = document.getElementById('makanan');
    const ketMakanan = document.getElementById('ketMakanan');
    const minuman = document.getElementById('minuman');
    const ketMinuman = document.getElementById('ketMinuman');
    
    makanan.addEventListener('change', function () {
    if ('<?php echo implode(', ', $ket_makanan); ?>'.split(', ').indexOf(makanan.value) !== -1) {
    ketMakanan.innerHTML = 
    `<div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ket_makanan" id="pedas" value="pedas" required>
        <label class="form-check-label text-white" for="pedas"><b>Pedas</b></label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ket_makanan" id="tidak_pedas" value="tidak pedas" required>
        <label class="form-check-label text-white" for="tidak_pedas"><b>Tidak pedas</b></label>
    </div>`;
    } else {
    // Kosongkan opsi tambahan jika opsi lain dipilih
    ketMakanan.innerHTML = '';
    }
    
    // Tampilkan atau sembunyikan opsi tambahan sesuai dengan pilihan opsi utama
    ketMakanan.style.display = 'block';
    });
    
    minuman.addEventListener('change', function () {
    if (['Kopi', 'Kopi Susu', 'Susu Coklat', 'Teh'].includes(minuman.value)) {
    ketMinuman.innerHTML = 
    `<div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ket_minuman" id="dingin" value="dingin">
        <label class="form-check-label text-white" for="dingin"><b>Dingin</b></label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ket_minuman" id="panas" value="panas">
        <label class="form-check-label text-white" for="panas"><b>Panas</b></label>
    </div>`;
    } else {
    ketMinuman.innerHTML = '';
    }
    
    ketMinuman.style.display = 'block';
    });
});
</script>