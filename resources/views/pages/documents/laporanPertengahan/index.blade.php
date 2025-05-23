@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <div class="mb-4 w-100 d-flex justify-content-end">
                {!! $status3 == 'approved' && $status4 == null
                    ? '<a href="' . route('laporan-pertengahan.create') . ' " class="btn btn-primary ">Add Documents</a>'
                    : '' !!}

            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Laporan Pertengahan</th>
                            <th scope="col">Status</th>
                            @if ($data?->status_laporan_pertengahan == 'rejected')
                                <th scope="col">Revisi</th>
                            @endif


                        </tr>
                    </thead>
                    <tbody>
                        @if ($data == null)
                            <tr>
                                <td colspan="12" class="text-center">No Data Found.</td>
                            </tr>
                        @else
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->user->NIM }}</td>
                                <td>
                                    <a href="{{ asset($data->laporan_pertengahan) }}"
                                        download="{{ basename($data->laporan_pertengahan) }}"
                                        class="btn btn-primary btn-sm">Download Laporan Pertengahan</a>
                                </td>
                                @include('components.statusFile', [
                                    'data' => $data->status_laporan_pertengahan,
                                ])
                                @if ($data?->status_laporan_pertengahan == 'rejected')
                                    <td>
                                        @include('components.actionbtn', [
                                            'edit' => route('laporan-pertengahan.edit', $data->id),
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
