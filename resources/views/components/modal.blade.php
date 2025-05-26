<!-- Modal -->
<div class="modal fade" id="{{ 'rejectModal' . $statusUser }}" tabindex="-1"
    aria-labelledby="{{ 'rejectModal' . $statusUser . 'Label' }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('rejection', $id) }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ 'rejectModal' . $statusUser . 'Label' }}">Berikan Penyebab Penolakan
                </h1>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <textarea name="reason" class="form-control" id="reason" cols="30" rows="10"
                    placeholder="Alasan penolakan"></textarea>
                <input type="hidden" name="file_type" value="{{ $file }}">
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
