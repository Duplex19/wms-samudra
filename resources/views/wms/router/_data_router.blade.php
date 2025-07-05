@forelse ($data as $key => $dt)
    <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $dt['name'] }}</td>
        <td>{{ $dt['ip'] }}</td>
        <td>{{ $dt['port'] }}</td>
        <td>
            @if ($dt['status'] == 'pending')
            <span class="badge bg-warning rounded-pill">{{ $dt['status'] }}</span>
            @elseif($dt['status'] == 'connected')
            <span class="badge bg-success rounded-pill">{{ $dt['status'] }}</span>
            @else
            <span class="badge bg-danger rounded-pill">{{ $dt['status'] }}</span>
            @endif
        </td>
        <td>
            <span class="btn btn-primary btn-sm" id="connectionTest" onclick='connectionTest(@json($dt["id"]))'><i class='bx  bx-link'></i></span>
            <span class="btn btn-warning btn-sm" id="edit" onclick='edit(@json($dt))'><i class='bx  bx-edit'></i></span>
            <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/router/delete/{{ $dt['id'] }}')"><i class='bx  bx-trash'></i></span>
        </td>
    </tr>
@empty
    
@endforelse