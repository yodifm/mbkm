@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <div class="mb-4 w-100 d-flex justify-content-end">
                {!! $status2 == 'approved' && $status3 == null
                    ? '<a href="' . route('datambkm.create') . ' " class="btn btn-primary ">Add Documents</a>'
                    : '' !!}

            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Program MBKM</th>
                            <th scope="col">Mitra MBKM</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Berakhir</th>
                            <th scope="col">LoA</th>
                            <th scope="col">Status</th>
                            @if ($data?->status_LoA == 'rejected')
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
                                <td>{{ $data->program_mbkm }}</td>
                                <td>{{ $data->mitra_mbkm }}</td>
                                <td>{{ $data->posisi }}</td>
                                <td>{{ $data->tanggal_mulai }}</td>
                                <td>{{ $data->tanggal_berakhir }}</td>

                                <td>
                                    <a href="{{ asset($data->LoA) }}" download="{{ basename($data->LoA) }}"
                                        class="btn btn-primary btn-sm">Download LoA</a>
                                </td>
                                @include('components.statusFile', [
                                    'data' => $data->status_LoA,
                                ])
                                @if ($data?->status_LoA == 'rejected')
                                    <td>
                                        @include('components.actionbtn', [
                                            'edit' => route('datambkm.edit', $data->id),
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
