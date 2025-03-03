@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('pemberkasans.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->name}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="NIK_id" class="form-label">NIK</label>
                    <input type="number" class="form-control" id="NIK_id" name="NIK_id" value="{{auth()->user()->NIK}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="text" class="form-control" id="semester" name="semester">
                </div>
                <div class="mb-3">
                    <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing</label>
                    <input type="text" class="form-control" id="dosen_pembimbing" name="dosen_pembimbing">
                </div>
               
                <div class="mb-3">
                    <label for="surat_rekomendasi" class="form-label fw-bold">Surat Rekomendasi</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="surat_rekomendasi" name="surat_rekomendasi">
                        <label class="input-group-text" for="surat_rekomendasi">Upload</label>
                    </div>
                    <small class="text-muted">Format: PDF, Max: 2MB</small>
                </div>
                
                
                <div class="mb-3">
                    <label for="surat_pernyataan" class="form-label fw-bold">Surat Rekomendasi</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="surat_pernyataan" name="surat_pernyataan">
                        <label class="input-group-text" for="surat_pernyataan">Upload</label>
                    </div>
                    <small class="text-muted">Format: PDF, Max: 2MB</small>
                </div>
                

                {{-- <div class="mb-3">
                    <label for="surat_pernyataan" class="form-label">Surat Pernyataan</label>
                    <input type="file" class="filepond" id="surat_pernyataan" name="surat_pernyataan">
                </div> --}}
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('style')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/dist/assets/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/assets/extensions/toastify-js/src/toastify.css') }}">
@endsection

@section('script')
    <script
        src="{{ asset('/dist/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        // Aktifkan FilePond pada input
        FilePond.create(document.querySelector('.filepond'));
    </script>
    <script
        src="{{ asset('/dist/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}">
    </script>
    <script src="{{ asset('/dist/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}">
    </script>
    <script
        src="{{ asset('/dist/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('/dist/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}">
    </script>
    <script src="{{ asset('/dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script src="{{ asset('/dist/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}">
    </script>
    <script src="{{ asset('/dist/assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('/dist/assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('/dist/assets/static/js/pages/filepond.js') }}"></script>
@endsection
