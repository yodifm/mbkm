@if ($data == 'approved')
    <td class="text-success">{{ $data }}</td>
@elseif($data == 'rejected')
    <td class="text-danger">{{ $data }}</td>
@elseif ($data == 'submited')
    <td class="text-secondary">in Review</td>
@else
    <td>-</td>
@endif
