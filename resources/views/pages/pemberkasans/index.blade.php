@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <div class="mb-4 w-100 d-flex justify-content-end">
                <a href="{{ route('pemberkasans.create') }}" class="btn btn-primary ">Add Documents</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Dosen Pembimbing</th>
                            <th scope="col">Dokumen Surat Rekomendasi</th>
                            <th scope="col">Dokumen Surat Pernyataan Tanggung Jawab Mutlak (SPTJM)</th>
                            <th scope="col">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() == 0)
                            <tr>
                                <td colspan="8" class="text-center">No Data Found.</td>
                            </tr>
                        @else
                            @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->NIK }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ $item->dosen_pembimbing }}</td>
                                <td>
                                    <a href="{{ asset($item->surat_rekomendasi) }}" download="{{ basename($item->surat_rekomendasi) }}" class="btn btn-primary btn-sm">Download Surat Rekomendasi</a>
                                </td>
                                <td>
                                    <a href="{{ asset($item->surat_pernyataan) }}" download="{{ basename($item->surat_pernyataan) }}" class="btn btn-danger btn-sm">Download Surat Pernyataan</a>
                                </td>
                                <td>
                                    @include('components.actionbtn', [
                                        'edit' => route('pemberkasans.edit', $item->id),
                                        'id' => $item->id,
                                        'delete' => route('pemberkasans.destroy', $item->id),
                                    ])
                                </td>
                            </tr>
                            
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
