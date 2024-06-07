<!DOCTYPE html>
<html lang="en">

<body>
    <table style="width:100%; height:100%; font-size: 80%;" border="1">
        @foreach($data as $print)
        <tr align="left">
            <th>Nama</th>
            <td>{{ $print->nama }}</td>
        </tr>
        <tr align="left">
            <th>Makanan</th>
            <td>{{ $print->makanan }} {{ $print->ket_makanan }}</br>
                {{ $print->ops_ket_makanan !== null ? '(' . $print->ops_ket_makanan . ')' : '' }}
            </td>
        </tr>
        <tr align="left">
            <th>Minuman</th>
            <td>{{ $print->minuman }} {{ $print->ket_minuman }}</br>
                {{ $print->ops_ket_minuman !== null ? '(' . $print->ops_ket_minuman . ')' : '' }}
            </td>
        </tr>
        @endforeach
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>