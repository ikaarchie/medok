<!-- Modal -->
<div class="modal fade" id="kuesionerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="kuesionerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content blur">
            <div class="modal-body">
                {!! Form::open(['url' => 'dokterorder/saveKuesioner']) !!}
                {!! Form::hidden('id') !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::select('nama', $list_dokter, '', ['style' => 'height: auto', 'class' =>
                    'form-select', 'id' => 'namaDokter', 'placeholder' => '-- Pilih nama dokter --','required']) !!}
                    {!! Form::label('namaDokter', 'Pilih nama dokter') !!}
                </div>

                <div id="pertanyaan" class="col-sm-12 mb-3" style="display: none;">
                    <div class="mt-2 mb-2 text-white"><strong>Halo<h6 class="fw-bold" id="namaDr1"></h6>Terimakasih
                            telah menggunakan layanan kami.<br>Sebagai peningkatan kualitas layanan kami, mohon untuk
                            meluangkan waktu
                            mengisi kuesioner ini.<br>Berikan tingkat kepuasan dokter selama menggunakan aplikasi MEDOK
                            di RS Hermina Banyumanik.<br>Terimakasih.</strong>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">MEDOK mudah diakses menggunakan smartphone anda.</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_1" id="sangat_tidak_puas"
                                    value="Sangat Tidak Puas" required>
                                <label class="form-check-label" for="sangat_tidak_puas"><b>Sangat Tidak
                                        Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_1" id="tidak_puas"
                                    value="Tidak Puas" required>
                                <label class="form-check-label" for="tidak_puas"><b>Tidak Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_1" id="cukup_puas"
                                    value="Cukup Puas" required>
                                <label class="form-check-label" for="cukup_puas"><b>Cukup Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_1" id="puas" value="Puas"
                                    required>
                                <label class="form-check-label" for="puas"><b>Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_1" id="sangat_puas"
                                    value="Sangat Puas" required>
                                <label class="form-check-label" for="sangat_puas"><b>Sangat Puas</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">MEDOK mempunyai tampilan yang menarik dan responsif.</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_2" id="sangat_tidak_puas"
                                    value="Sangat Tidak Puas" required>
                                <label class="form-check-label" for="sangat_tidak_puas"><b>Sangat Tidak
                                        Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_2" id="tidak_puas"
                                    value="Tidak Puas" required>
                                <label class="form-check-label" for="tidak_puas"><b>Tidak Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_2" id="cukup_puas"
                                    value="Cukup Puas" required>
                                <label class="form-check-label" for="cukup_puas"><b>Cukup Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_2" id="puas" value="Puas"
                                    required>
                                <label class="form-check-label" for="puas"><b>Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_2" id="sangat_puas"
                                    value="Sangat Puas" required>
                                <label class="form-check-label" for="sangat_puas"><b>Sangat Puas</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Pemilihan menu di MEDOK terasa mudah dan cepat.</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_3" id="sangat_tidak_puas"
                                    value="Sangat Tidak Puas" required>
                                <label class="form-check-label" for="sangat_tidak_puas"><b>Sangat Tidak
                                        Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_3" id="tidak_puas"
                                    value="Tidak Puas" required>
                                <label class="form-check-label" for="tidak_puas"><b>Tidak Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_3" id="cukup_puas"
                                    value="Cukup Puas" required>
                                <label class="form-check-label" for="cukup_puas"><b>Cukup Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_3" id="puas" value="Puas"
                                    required>
                                <label class="form-check-label" for="puas"><b>Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_3" id="sangat_puas"
                                    value="Sangat Puas" required>
                                <label class="form-check-label" for="sangat_puas"><b>Sangat Puas</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">MEDOK dapat memberikan informasi status pesanan anda dengan tepat.</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_4" id="sangat_tidak_puas"
                                    value="Sangat Tidak Puas" required>
                                <label class="form-check-label" for="sangat_tidak_puas"><b>Sangat Tidak
                                        Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_4" id="tidak_puas"
                                    value="Tidak Puas" required>
                                <label class="form-check-label" for="tidak_puas"><b>Tidak Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_4" id="cukup_puas"
                                    value="Cukup Puas" required>
                                <label class="form-check-label" for="cukup_puas"><b>Cukup Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_4" id="puas" value="Puas"
                                    required>
                                <label class="form-check-label" for="puas"><b>Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_4" id="sangat_puas"
                                    value="Sangat Puas" required>
                                <label class="form-check-label" for="sangat_puas"><b>Sangat Puas</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Anda dapat memberikan keterangan tambahan pada pesanan anda.</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_5" id="sangat_tidak_puas"
                                    value="Sangat Tidak Puas" required>
                                <label class="form-check-label" for="sangat_tidak_puas"><b>Sangat Tidak
                                        Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_5" id="tidak_puas"
                                    value="Tidak Puas" required>
                                <label class="form-check-label" for="tidak_puas"><b>Tidak Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_5" id="cukup_puas"
                                    value="Cukup Puas" required>
                                <label class="form-check-label" for="cukup_puas"><b>Cukup Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_5" id="puas" value="Puas"
                                    required>
                                <label class="form-check-label" for="puas"><b>Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_5" id="sangat_puas"
                                    value="Sangat Puas" required>
                                <label class="form-check-label" for="sangat_puas"><b>Sangat Puas</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">MEDOK menyampaikan informasi ke dapur yang sesuai dengan permintaan anda,
                            sehingga makanan yang datang sesuai dengan makanan yang anda pesan.</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_6" id="sangat_tidak_puas"
                                    value="Sangat Tidak Puas" required>
                                <label class="form-check-label" for="sangat_tidak_puas"><b>Sangat Tidak
                                        Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_6" id="tidak_puas"
                                    value="Tidak Puas" required>
                                <label class="form-check-label" for="tidak_puas"><b>Tidak Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_6" id="cukup_puas"
                                    value="Cukup Puas" required>
                                <label class="form-check-label" for="cukup_puas"><b>Cukup Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_6" id="puas" value="Puas"
                                    required>
                                <label class="form-check-label" for="puas"><b>Puas</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepuasan_6" id="sangat_puas"
                                    value="Sangat Puas" required>
                                <label class="form-check-label" for="sangat_puas"><b>Sangat Puas</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Seberapa penting kemudahan akses MEDOK?</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_1"
                                    id="sangat_tidak_penting" value="Sangat Tidak Penting" required>
                                <label class="form-check-label" for="sangat_tidak_penting"><b>Sangat Tidak
                                        Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_1" id="tidak_penting"
                                    value="Tidak Penting" required>
                                <label class="form-check-label" for="tidak_penting"><b>Tidak Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_1" id="cukup_penting"
                                    value="Cukup Penting" required>
                                <label class="form-check-label" for="cukup_penting"><b>Cukup Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_1" id="penting"
                                    value="Penting" required>
                                <label class="form-check-label" for="penting"><b>Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_1" id="sangat_penting"
                                    value="Sangat Penting" required>
                                <label class="form-check-label" for="sangat_penting"><b>Sangat Penting</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Seberapa penting desain tampilan aplikasi MEDOK?</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_2"
                                    id="sangat_tidak_penting" value="Sangat Tidak Penting" required>
                                <label class="form-check-label" for="sangat_tidak_penting"><b>Sangat Tidak
                                        Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_2" id="tidak_penting"
                                    value="Tidak Penting" required>
                                <label class="form-check-label" for="tidak_penting"><b>Tidak Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_2" id="cukup_penting"
                                    value="Cukup Penting" required>
                                <label class="form-check-label" for="cukup_penting"><b>Cukup Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_2" id="penting"
                                    value="Penting" required>
                                <label class="form-check-label" for="penting"><b>Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_2" id="sangat_penting"
                                    value="Sangat Penting" required>
                                <label class="form-check-label" for="sangat_penting"><b>Sangat Penting</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Seberapa penting pemilihan menu pada aplikasi MEDOK?</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_3"
                                    id="sangat_tidak_penting" value="Sangat Tidak Penting" required>
                                <label class="form-check-label" for="sangat_tidak_penting"><b>Sangat Tidak
                                        Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_3" id="tidak_penting"
                                    value="Tidak Penting" required>
                                <label class="form-check-label" for="tidak_penting"><b>Tidak Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_3" id="cukup_penting"
                                    value="Cukup Penting" required>
                                <label class="form-check-label" for="cukup_penting"><b>Cukup Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_3" id="penting"
                                    value="Penting" required>
                                <label class="form-check-label" for="penting"><b>Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_3" id="sangat_penting"
                                    value="Sangat Penting" required>
                                <label class="form-check-label" for="sangat_penting"><b>Sangat Penting</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Seberapa penting informasi status pesanan pada aplikasi MEDOK?</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_4"
                                    id="sangat_tidak_penting" value="Sangat Tidak Penting" required>
                                <label class="form-check-label" for="sangat_tidak_penting"><b>Sangat Tidak
                                        Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_4" id="tidak_penting"
                                    value="Tidak Penting" required>
                                <label class="form-check-label" for="tidak_penting"><b>Tidak Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_4" id="cukup_penting"
                                    value="Cukup Penting" required>
                                <label class="form-check-label" for="cukup_penting"><b>Cukup Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_4" id="penting"
                                    value="Penting" required>
                                <label class="form-check-label" for="penting"><b>Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_4" id="sangat_penting"
                                    value="Sangat Penting" required>
                                <label class="form-check-label" for="sangat_penting"><b>Sangat Penting</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Seberapa penting form keterangan tambahan pada aplikasi MEDOK?</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_5"
                                    id="sangat_tidak_penting" value="Sangat Tidak Penting" required>
                                <label class="form-check-label" for="sangat_tidak_penting"><b>Sangat Tidak
                                        Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_5" id="tidak_penting"
                                    value="Tidak Penting" required>
                                <label class="form-check-label" for="tidak_penting"><b>Tidak Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_5" id="cukup_penting"
                                    value="Cukup Penting" required>
                                <label class="form-check-label" for="cukup_penting"><b>Cukup Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_5" id="penting"
                                    value="Penting" required>
                                <label class="form-check-label" for="penting"><b>Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_5" id="sangat_penting"
                                    value="Sangat Penting" required>
                                <label class="form-check-label" for="sangat_penting"><b>Sangat Penting</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <b class="card-header">Seberapa penting kesesuaian informasi pesanan dari aplikasi MEDOK?</b>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_6"
                                    id="sangat_tidak_penting" value="Sangat Tidak Penting" required>
                                <label class="form-check-label" for="sangat_tidak_penting"><b>Sangat Tidak
                                        Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_6" id="tidak_penting"
                                    value="Tidak Penting" required>
                                <label class="form-check-label" for="tidak_penting"><b>Tidak Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_6" id="cukup_penting"
                                    value="Cukup Penting" required>
                                <label class="form-check-label" for="cukup_penting"><b>Cukup Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_6" id="penting"
                                    value="Penting" required>
                                <label class="form-check-label" for="penting"><b>Penting</b></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kepentingan_6" id="sangat_penting"
                                    value="Sangat Penting" required>
                                <label class="form-check-label" for="sangat_penting"><b>Sangat Penting</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-success">
                            <strong><i class="fa-solid fa-check"></i> Simpan</strong></button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div id="closebutton" class="col-sm-12 mb-3" style="display: none;">
                    <div class="mt-2 mb-2 text-white"><strong>Halo<h6 class="fw-bold" id="namaDr2"></h6>Terimakasih
                            telah mengisi kuesioner dari kami.</strong>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            aria-label="Close"><strong><i class="fa-solid fa-angles-right"></i> Lanjutkan
                                Pemesanan</strong></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#namaDokter').change(function() {
        var selectedValue = $(this).val();

        $.ajax({
            url: '{{ route("check_nama") }}', // Sesuaikan dengan URL endpoint Anda
            method: 'POST',
            data: {
                nama: selectedValue,
                _token: '{{ csrf_token() }}' // Token CSRF
            },
            success: function(response) {
                if (!response.exists) {
                    $('#namaDr1').text(selectedValue)
                    $('#pertanyaan').show();
                    $('#closebutton').hide();
                } else {
                    $('#namaDr2').text(selectedValue)
                    $('#pertanyaan').hide();
                    $('#closebutton').show();
                }
            }
        });
    });
});
</script>