@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-body">
            <div class="mb-4 w-100 d-flex justify-content-end">
                <a href="{{ route('datambkms.create') }}" class="btn btn-primary ">Add Documents</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">Name</th> --}}
                            <th scope="col">NIK</th>
                            {{-- <th scope="col">Semester</th> --}}
                            {{-- <th scope="col">Dosen Pembimbing</th> --}}
                            <th scope="col">Program MBKM</th>
                            <th scope="col">Mitra MBKM</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Berakhir</th>
                            <th scope="col">LoA</th>
                           
                            <th scope="col">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() == 0)
                            <tr>
                                <td colspan="12" class="text-center">No Data Found.</td>
                            </tr>
                        @else
                            @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                {{-- <td>{{ $item->name }}</td> --}}
                                <td>{{ $item->NIK }}</td>
                                {{-- <td>{{ $item->semester }}</td> --}}
                                {{-- <td>{{ $item->dosen_pembimbing }}</td> --}}
                                <td>{{ $item->program_mbkm }}</td>
                                <td>{{ $item->mitra_mbkm }}</td>
                                <td>{{ $item->posisi }}</td>
                                <td>{{ $item->tanggal_mulai }}</td>
                                <td>{{ $item->tanggal_berakhri }}</td>
                               
                                <td>
                                    <a href="{{ asset($item->LoA) }}" download="{{ basename($item->LoA) }}" class="btn btn-primary btn-sm">Download LoA</a>
                                </td>
                                
                                <td>
                                    @include('components.actionbtn', [
                                        'edit' => route('datambkms.edit', $item->id),
                                        'id' => $item->id,
                                        'delete' => route('datambkms.destroy', $item->id),
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
