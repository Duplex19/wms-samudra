@forelse ($data as $key => $dt)
    <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $dt['name'] }}</td>
        <td>{{ $dt['group'] }}</td>
        <td>{{ $dt['price'] }}</td>
        <td>
            <span class="btn btn-warning btn-sm" id="edit" onclick='edit(@json($dt))'><i class='bx  bx-edit'></i></span>
            <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/profile_ppp/delete/{{ $dt['id'] }}')"><i class='bx  bx-trash'></i></span>
        </td>
    </tr>
@empty
    <x-dataNotFound colspan="5" />
@endforelse