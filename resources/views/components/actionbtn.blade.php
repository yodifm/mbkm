<div class="d-flex">
    @if ($edit)
        <a class="w-100 btn btn-warning me-2" href=" {{ $edit }}">Ubah</a>
    @endif
    @if ($delete)
        <a class="w-100 btn btn-danger" href="{{ $delete }}" data-confirm-delete="true">Hapus</a>
    @endif
</div>
