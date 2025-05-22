<div class="dropdown">
    @if ($status == 'rejected')
        <button disabled class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Rejected
        </button>
    @elseif ($status == 'approved')
        <button {{ $statusUser < $user->status ? 'disabled' : '' }} class="btn btn-success dropdown-toggle" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Approved
        </button>
    @elseif ($status == 'submited')
        <button {{ $statusUser == $user->status ? '' : 'disabled' }} class="btn btn-danger dropdown-toggle"
            type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Belum Disetujui
        </button>
    @else
        <button disabled class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Belum ada document
        </button>
    @endif
    <ul class="dropdown-menu">
        <form method="POST" action="{{ route('status.a' . $file, $id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="dropdown-item" href="#">Approve</button>
        </form>
        <form method="POST" action="{{ route('status.r' . $file, $id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="dropdown-item" href="#">Reject</button>
        </form>
    </ul>
</div>
