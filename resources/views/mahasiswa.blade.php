<table>
    <tr>
        <th>
            Nama
        </th>
        <th>NPM</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
    </tr>
    
    @foreach($mahasiswa as $row)
    
    <tr>
    <td>{{ $row->nama }}</td>
    <td>{{ $row->npm }}</td>
    <td>{{ $row->jenis_kelamin }}</td>
    <td>{{ $row->alamat }}</td>
    <td></td>
    <td></td>
    </tr>
    @endforeach
</table>