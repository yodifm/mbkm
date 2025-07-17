@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('pemberkasan.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->user->name }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="NIM" class="form-label">NIM</label>
                    <input type="number" class="form-control" id="NIM" name="NIM" value="{{ $data->user->NIM }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="text" class="form-control" id="semester" name="semester" value="{{ $data->semester }}">
                </div>
                <div class="mb-3">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan" value="{{ $data->angkatan }}">
                </div>
                <div class="mb-3">
                    <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing</label>
                    <input type="text" class="form-control" id="dosen_pembimbing" name="dosen_pembimbing"
                        value="{{ $data->dosen_pembimbing }}">
                </div>
                @if ($data->status_surat_rekomendasi == 'rejected')
                    <div class="mb-3">
                        <label for="surat_rekomendasi" class="form-label">Surat Rekomendasi</label>
                        <input type="file" class="basic-filepond" id="surat_rekomendasi" name="surat_rekomendasi">
                    </div>
                @endif

                @if ($data->status_surat_pernyataan == 'rejected')
                    <div class="mb-3">
                        <label for="surat_pernyataan" class="form-label">Surat Pernyataan Tanggung Jawab Mutlak
                            (SPTJM)</label>
                        <input type="file" class="basic-filepond" id="surat_pernyataan" name="surat_pernyataan">
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/dist/assets/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/assets/extensions/toastify-js/src/toastify.css') }}">
@endsection

@section('script')
    <script
        src="{{ asset('/dist/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
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
    <script
        src="{{ asset('/dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script src="{{ asset('/dist/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}">
    </script>
    <script src="{{ asset('/dist/assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('/dist/assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('/dist/assets/static/js/pages/filepond.js') }}"></script>
@endsection
