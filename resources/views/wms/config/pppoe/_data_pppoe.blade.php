@forelse ($data as $key => $dt)
    <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $dt['router_id'] }}</td>
        <td>{{ $dt['profile_ppp_id'] }}</td>
        <td>{{ $dt['username'] }}</td>
        <td>{{ $dt['password'] }}</td>
        <td>{{ $dt['name'] }}</td>
        <td>{{ $dt['whatsapp'] }}</td>
        <td>{{ $dt['address'] }}</td>
        <td>{{ $dt['active_date'] }}</td>
        <td>{{ $dt['payment_type'] }}</td>
        <td>{{ $dt['status'] }}</td>
        <td>
            <span class="btn btn-warning btn-sm" id="edit" onclick='edit(@json($dt))'><i class='bx  bx-edit'></i></span>
            <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/pppoe/delete/{{ $dt['id'] }}')"><i class='bx  bx-trash'></i></span>
        </td>
    </tr>
@empty
    <x-dataNotFound colspan="12" />
@endforelse