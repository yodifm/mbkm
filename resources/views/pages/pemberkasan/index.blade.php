@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <div class="mb-4 w-100 d-flex justify-content-end">
                {!! $canAdd ? '<a href="' . route('pemberkasan.create') . '" class="btn btn-primary">Add Documents</a>' : '' !!}

            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Dosen Pembimbing</th>
                            <th scope="col">Dokumen Surat Rekomendasi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dokumen Surat Pernyataan Tanggung Jawab Mutlak (SPTJM)</th>
                            <th scope="col">Status</th>
                            @if ($data?->status_surat_rekomendasi == 'rejected' || $data?->status_surat_pernyataan == 'rejected')
                                <th scope="col">Revisi</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @if ($data == null)
                            <tr>
                                <td colspan="10" class="text-center">No Data Found.</td>
                            </tr>
                        @else
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->user->NIM }}</td>
                                <td>{{ $data->semester }}</td>
                                <td>{{ $data->angkatan }}</td>
                                <td>{{ $data->dosen_pembimbing }}</td>
                                <td>
                                    <a href="{{ asset($data->surat_rekomendasi) }}"
                                        download="{{ basename($data->surat_rekomendasi) }}"
                                        class="btn btn-primary btn-sm">Download Surat Rekomendasi</a>
                                </td>
                                @include('components.statusFile', [
                                    'data' => $data->status_surat_rekomendasi,
                                ])
                                <td>
                                    <a href="{{ asset($data->surat_pernyataan) }}"
                                        download="{{ basename($data->surat_pernyataan) }}"
                                        class="btn btn-danger btn-sm">Download Surat Pernyataan</a>
                                </td>
                                @include('components.statusFile', [
                                    'data' => $data->status_surat_pernyataan,
                                ])
                                @if ($data?->status_surat_rekomendasi == 'rejected' || $data?->status_surat_pernyataan == 'rejected')
                                    <td>
                                        @include('components.actionbtn', [
                                            'edit' => route('pemberkasan.edit', $data->id),
                                            'id' => $data->id,
                                            'delete' => null,
                                        ])
                                    </td>
                                @endif
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
