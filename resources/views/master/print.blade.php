<!DOCTYPE html>
<html lang="en">

<body>
    <table style="width:100%; height:100%; font-size: 80%;" border="1">
        {{-- @foreach($data as $print) --}}
        <tr align="left">
            <th>Nama</th>
            <td>{{ $data->nama }}</td>
        </tr>
        <tr align="left">
            <th>Makanan</th>
            <td>{{ $data->makanan }} {{ $data->ket_makanan }}</br>
                {{ $data->ops_ket_makanan !== null ? '(' . $data->ops_ket_makanan . ')' : '' }}
            </td>
        </tr>
        <tr align="left">
            <th>Minuman</th>
            <td>{{ $data->minuman }} {{ $data->ket_minuman }}</br>
                {{ $data->ops_ket_minuman !== null ? '(' . $data->ops_ket_minuman . ')' : '' }}
            </td>
        </tr>
        {{-- @endforeach --}}
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>