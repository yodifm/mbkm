@extends('layouts.layout')

@section('section')
    @include('components.pagetitle', ['title' => $title])

    {{-- Profile Section --}}
    <div class="mb-3 card">
        <div class="card-body">
            <div class="px-3 py-2 text-white rounded d-inline-block bg-success">
                <h5 class="mb-0" style="color: #fff">Profil</h5>
            </div>
            <div class="mt-3 row">
                <div class="col-md-4">
                    <p><strong>Nama Lengkap</strong><br> {{ $data->name }}</p>
                    <p><strong>Angkatan</strong><br> {{ $data->pemberkasan?->angkatan }}</p>
                    <p><strong>Mitra MBKM</strong><br> {{ $data->mbkm?->mitra_mbkm }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Nomor Induk Mahasiswa</strong><br> {{ $data->NIM }}</p>
                    <p><strong>Dosen PA</strong><br> {{ $data->pemberkasan?->dosen_pembimbing }}</p>
                    <p><strong>Posisi</strong><br> {{ $data->mbkm?->posisi }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Semester</strong><br>
                        {{ $data->pemberkasan ? 'Semester ' . $data->pemberkasan->semester : '-' }}
                    </p>
                    <p><strong>Program MBKM</strong><br> {{ $data->mbkm?->program_mbkm }}</p>
                </div>
            </div>
        </div>
    </div>


    {{-- Document Section --}}
    <div class="mb-3 card">
        <div class="card-body">
            <!-- Header Dokumen -->
            <div class="px-3 py-2 rounded d-inline-block bg-success">
                <h5 class="mb-0" style="color: #fff">Dokumen</h5>
            </div>

            <!-- Tabel -->
            <div class="mt-3 table-responsive">
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Unggah</th>
                            <th>Jenis Dokumen</th>
                            <th>File</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $status1 ? $status1->updated_at : '-' }}</td>
                            <td>Surat Rekomendasi</td>
                            <td class="text-center">
                                @if ($status1)
                                    <a href="{{ asset($status1->surat_rekomendasi) }}"
                                        download="{{ basename($status1->surat_rekomendasi) }}">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                    </a>
                                @else
                                    <i class="cursor-not-allowed bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>
                                @include('components.approvalButton', [
                                    'id' => $data->NIM,
                                    'file' => 'rekomendasi',
                                    'statusUser' => '1',
                                    'user' => $data,
                                    'status' => $status1 ? $status1->status_surat_rekomendasi : null,
                                ])

                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>{{ $status2 ? $status2->updated_at : '-' }}</td>
                            <td>Surat Pernyataan Tanggung Jawab Mutlak</td>
                            <td class="text-center">
                                @if ($status2)
                                    <a href="{{ asset($status2->surat_pernyataan) }}"
                                        download="{{ basename($status2->surat_pernyataan) }}">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                    </a>
                                @else
                                    <i class="cursor-not-allowed bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>
                                @include('components.approvalButton', [
                                    'id' => $data->NIM,
                                    'file' => 'pernyataan',
                                    'statusUser' => '2',
                                    'user' => $data,
                                    'status' => $status2 ? $status2->status_surat_pernyataan : null,
                                ])

                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>{{ $status3 ? $status3->updated_at : '-' }}</td>
                            <td><em>Letter of Acceptance</em></td>
                            <td class="text-center">
                                @if ($status3)
                                    <a href="{{ asset($status3->LoA) }}" download="{{ basename($status3->LoA) }}">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                    </a>
                                @else
                                    <i class="cursor-not-allowed bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>
                                @include('components.approvalButton', [
                                    'id' => $data->NIM,
                                    'file' => 'LoA',
                                    'statusUser' => '3',
                                    'user' => $data,
                                    'status' => $status3 ? $status3->status_LoA : null,
                                ])

                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>{{ $status4 ? $status4->updated_at : '-' }}</td>
                            <td>Laporan Pertengahan</td>
                            <td class="text-center">
                                @if ($status4 && $status4->status_laporan_pertengahan != 'pending')
                                    <a href="{{ asset($status4->laporan_pertengahan) }}"
                                        download="{{ basename($status4->laporan_pertengahan) }}">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                    </a>
                                @else
                                    <i class="cursor-not-allowed bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>
                                @include('components.approvalButton', [
                                    'id' => $data->NIM,
                                    'file' => 'laporan_pertengahan',
                                    'statusUser' => '4',
                                    'user' => $data,
                                    'status' => $status4 ? $status4->status_laporan_pertengahan : null,
                                ])

                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>{{ $status5 ? $status5->updated_at : '-' }}</td>
                            <td>Laporan Akhir</td>
                            <td class="text-center">
                                @if ($status5 && $status5->status_laporan_akhir != 'pending')
                                    <a href="{{ asset($status5->laporan_akhir) }}"
                                        download="{{ basename($status5->laporan_akhir) }}">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                    </a>
                                @else
                                    <i class="cursor-not-allowed bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>
                                @include('components.approvalButton', [
                                    'id' => $data->NIM,
                                    'file' => 'laporan_akhir',
                                    'statusUser' => '5',
                                    'user' => $data,
                                    'status' => $status5 ? $status5->status_laporan_akhir : null,
                                ])

                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>{{ $status6 ? $status6->updated_at : '-' }}</td>
                            <td>Sertifikat</td>
                            <td class="text-center">
                                @if ($status6 && $status6->status_sertifikat != 'pending')
                                    <a href="{{ asset($status6->sertifikat) }}"
                                        download="{{ basename($status6->sertifikat) }}">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                    </a>
                                @else
                                    <i class="cursor-not-allowed bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>
                                @include('components.approvalButton', [
                                    'id' => $data->NIM,
                                    'file' => 'sertifikat',
                                    'statusUser' => '6',
                                    'user' => $data,
                                    'status' => $status6 ? $status6->status_sertifikat : null,
                                ])

                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>{{ $status7 ? $status7->updated_at : '-' }}</td>
                            <td>Penilaian</td>
                            <td class="text-center">
                                @if ($status7 && $status7->status_penilaian != 'pending')
                                    <a href="{{ asset($status7->penilaian) }}"
                                        download="{{ basename($status7->penilaian) }}">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                    </a>
                                @else
                                    <i class="cursor-not-allowed bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>
                                @include('components.approvalButton', [
                                    'id' => $data->NIM,
                                    'file' => 'penilaian',
                                    'statusUser' => '7',
                                    'user' => $data,
                                    'status' => $status7 ? $status7->status_penilaian : null,
                                ])
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .cursor-not-allowed:hover {
            cursor: not-allowed;
        }
    </style>
@endsection
