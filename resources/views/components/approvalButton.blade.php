<div class="dropdown">
    @if ($status == 'rejected')
        <button disabled class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Ditolak
        </button>
    @elseif ($status == 'approved')
        <button disabled class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Disetujui
        </button>
    @elseif ($status == 'submited')
        <button {{ $statusUser == $user->status ? '' : 'disabled' }} class="btn btn-danger dropdown-toggle"
            type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Belum Disetujui
        </button>
    @else
        <button disabled class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Belum ada dokumen
        </button>
    @endif
    <ul class="dropdown-menu">
        <form method="POST" action="{{ route('status.a' . $file, $id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="dropdown-item" href="#">Disetujui</button>
        </form>
        <button type="submit" class="dropdown-item" href="#" data-bs-toggle="modal"
            data-bs-target="{{ '#rejectModal' . $statusUser }}">
            Ditolak
        </button>
        {{-- <form method="POST" action="{{ route('status.r' . $file, $id) }}" class="modal-content">
            @csrf
            @method('PATCH')
        </form> --}}
    </ul>
</div>

@include('components.modal', [
    'id' => $id,
    'file' => $file,
    'statusUser' => $statusUser,
])
