{{-- @if ($data == 'approved')
    <td class="text-success">{{ $data }}</td>
@elseif($data == 'rejected')
    <td class="text-danger">{{ $data }}</td>
@elseif ($data == 'submited')
    <td class="text-secondary">Dalam Tinjauan</td>
@else
    <td>-</td>
@endif --}}


@if ($data == 'approved')
    <td class="text-success">Disetujui</td>
@elseif($data == 'rejected')
    <td class="text-danger">Ditolak</td>
@elseif ($data == 'submited')
    <td class="text-secondary">Dalam Tinjauan</td>
@else
    <td>-</td>
@endif