@forelse ($data as $key => $dt)
    <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $dt['name'] }}</td>
        <td>{{ $dt['username'] }}</td>
        <td>{{ $dt['password'] }}</td>
        <td>{{ $dt['profile'] }}</td>
        <td>{{ $dt['router'] }}</td>
        <td>
            @if ($dt['status'] == 'active')
            <span class="badge bg-success rounded-pill cursor-pointer" onclick='setStatus(@json([$dt["id"], $dt["status"]]))'>{{ $dt['status'] }}</span>
            @else
            <span class="badge bg-warning rounded-pill cursor-pointer" onclick='setStatus(@json([$dt["id"], $dt["status"]]))'>{{ $dt['status'] }}</span>
            @endif
        </td>
        <td>
            <span class="btn btn-warning btn-sm" id="edit" onclick='edit(@json($dt))'><i class='bx  bx-edit'></i></span>
            <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/pppoe/delete/{{ $dt['id'] }}')"><i class='bx  bx-trash'></i></span>
        </td>
    </tr>
@empty
    <x-dataNotFound colspan="12" />
@endforelse