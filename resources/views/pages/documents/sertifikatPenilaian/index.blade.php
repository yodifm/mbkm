@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <div class="mb-4 w-100 d-flex justify-content-end">
                {!! $status5 == 'approved' && ($status6 == 'pending' || $status7 == 'pending')
                    ? '<a href="' . route('sertifikat.edit', $data->id) . ' " class="btn btn-primary ">Add Documents</a>'
                    : '' !!}

            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Sertifikat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Penilaian</th>
                            <th scope="col">Status</th>
                            @if ($data?->status_sertifikat == 'rejected' || $data?->status_penilaian == 'rejected')
                                <th scope="col">Revisi</th>
                            @endif


                        </tr>
                    </thead>
                    <tbody>
                        @if ($data == null || $data->sertifikat == null || $data->penilaian == null)
                            <tr>
                                <td colspan="12" class="text-center">No Data Found.</td>
                            </tr>
                        @else
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->user->NIM }}</td>
                                <td>
                                    <a href="{{ asset($data->sertifikat) }}" download="{{ basename($data->sertifikat) }}"
                                        class="btn btn-primary btn-sm">Download Sertifikat</a>
                                </td>
                                @include('components.statusFile', [
                                    'data' => $data->status_sertifikat,
                                ])
                                <td>
                                    <a href="{{ asset($data->penilaian) }}" download="{{ basename($data->penilaian) }}"
                                        class="btn btn-primary btn-sm">Download Penilaian</a>
                                </td>
                                @include('components.statusFile', [
                                    'data' => $data->status_penilaian,
                                ])
                                @if ($data?->status_sertifikat == 'rejected' || $data?->status_penilaian == 'rejected')
                                    <td>
                                        @include('components.actionbtn', [
                                            'edit' => route('sertifikat.edit', $data->id),
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

    @include('components.rejectCard', ['reject' => $reject1])
    @include('components.rejectCard', ['reject' => $reject2])

@endsection
