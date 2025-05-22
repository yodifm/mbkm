@if ($data == 'approved')
    <td class="text-success">{{ $data }}</td>
@elseif($data == 'rejected')
    <td class="text-danger">{{ $data }}</td>
@else
    <td class="text-secondary">in Review</td>
@endif
