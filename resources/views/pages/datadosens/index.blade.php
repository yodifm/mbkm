@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    <div class="card">
        <div class="card-header bg-success text-white d-flex align-items-center">
            <img src={{ asset('histo.png') }} alt="Logo" style="width: 25px; height: 25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <h5 class="mb-0" style="color: #fff">Data Dosen</h5>
        </div> <br/>
        <div class="card-body">
            <div class="mb-3 d-flex">
                <input type="text" class="form-control me-2" placeholder="NIM">
                <button class="btn btn-success">Cari</button>
            </div>
            <div class="mb-4 w-100 d-flex justify-content-end">
                <a href="{{ route('datadosens.create') }}" class="btn btn-primary ">Tambah Data Dosen</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Nomor Induk</th>
                            <th>Nama Lengkap</th>
                            <th>Program MBKM</th>
                            <th>Status</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">No Data Found.</td>
                            </tr>
                        @else
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->NIK }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->program_mbkm }}</td>
                                    <td>
                                        @if ($item->status == 'Sertifikat dan Penilaian')
                                            <i class="bi bi-check-circle text-success"></i> {{ $item->status }}
                                        @else
                                            <i class="bi bi-exclamation-circle text-danger"></i> {{ $item->status }}
                                        @endif
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
