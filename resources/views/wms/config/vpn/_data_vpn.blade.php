@forelse ($data as $key => $dt)
    <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $dt['name'] }}</td>
        <td>{{ $dt['ip_server'] }}</td>
        <td>{{ $dt['secret'] }}</td>
        <td>{{ $dt['username'] }}</td>
        <td>{{ $dt['password'] }}</td>
        <td>{{ $dt['ip_client'] }}</td>
        <td><span class="btn btn-warning btn-sm" id="edit"><i class='bx  bx-edit'></i></span></td>
        <td><span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/vpn/delete/{{ $dt['id'] }}')"><i class='bx  bx-trash'></i></span></td>
    </tr>
@empty
    <x-dataNotFound colspan="9" />
@endforelse