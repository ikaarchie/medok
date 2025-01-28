<table class="table">
    <tr>
        <th colspan="11">Data MEDOK</th>
    </tr>
    <tr>
        <td colspan="11">{{ $tanggal }}</td>
    </tr>
</table>
{{-- {{ dd($data) }} --}}
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokter</th>
            <th>Makanan</th>
            <th>Minuman</th>
            <th>Waktu Disajikan</th>
            <th>Waktu Pesanan</th>
            <th>Sedang Diproses</th>
            <th>Menunggu Pengantaran</th>
            <th>Sedang Diantar</th>
            <th>Selesai</th>
            <th>Status Saat Ini</th>
        </tr>
    </thead>
    <tbody>

        <?php
                $no = 1;
                foreach ($data as $item) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $item['nama'] . "</td>";
                    echo "<td>" . $item['makanan'] . " " . $item['ket_makanan'] . " " . ($item['ops_ket_makanan'] !== null ? "(" . $item['ops_ket_makanan'] . ")" : "") . "</td>";
                    echo "<td>" . $item['minuman'] . " " . $item['ket_minuman'] . " " . ($item['ops_ket_minuman'] !== null ? "(" . $item['ops_ket_minuman'] . ")" : "") . "</td>";
                    echo "<td>" . $item['waktu_disajikan'] . " " . $item['tanggal_disajikan'] . "</td>";
                    echo "<td>" . $item['belum_diproses'] . "</td>";
                    echo "<td>" . $item['sedang_diproses'] . "</td>";
                    echo "<td>" . $item['menunggu_pengantaran'] . "</td>";
                    echo "<td>" . $item['sedang_diantar'] . "</td>";
                    echo "<td>" . $item['selesai'] . "</td>";
                    echo "<td>" . $item['status'] . "</td>";
                    echo "</tr>";
                }
                ?>
    </tbody>
</table>