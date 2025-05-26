@if ($reject)
    <div class="card">
        <div class="card-body">
            <div class="px-3 py-2 mb-3 rounded d-inline-block bg-danger">
                <h5 class="mb-0" style="color: #fff">Berkas Ditolak</h5>
            </div>
            <textarea name="reason" class="form-control" id="reason" cols="30" rows="10" readonly>{{ $reject?->reason }}</textarea>
        </div>
    </div>
@endif
