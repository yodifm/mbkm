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
                    <p><strong>Angkatan</strong><br> 2020</p>
                    <p><strong>Mitra MBKM</strong><br> {{ $data->mbkm?->mitra_mbkm }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Nomor Induk Mahasiswa</strong><br> 1103620048</p>
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
                            <td>01/06/2023</td>
                            <td>Surat Rekomendasi</td>
                            <td class="text-center">
                                <a href="#" target="_blank">
                                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger d-flex align-items-center">
                                    Belum Disetujui <i class="bi bi-caret-down-fill ms-2"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>01/06/2023</td>
                            <td>Surat Pernyataan Tanggung Jawab Mutlak</td>
                            <td class="text-center">
                                <a href="#" target="_blank">
                                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger d-flex align-items-center">
                                    Belum Disetujui <i class="bi bi-caret-down-fill ms-2"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>20/06/2023</td>
                            <td><em>Letter of Acceptance</em></td>
                            <td class="text-center">
                                <a href="#" target="_blank">
                                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger d-flex align-items-center">
                                    Belum Disetujui <i class="bi bi-caret-down-fill ms-2"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>25/08/2023</td>
                            <td>Laporan Pertengahan</td>
                            <td class="text-center">
                                <a href="#" target="_blank">
                                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger d-flex align-items-center">
                                    Belum Disetujui <i class="bi bi-caret-down-fill ms-2"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>31/12/2023</td>
                            <td>Laporan Akhir</td>
                            <td class="text-center">
                                <a href="#" target="_blank">
                                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger d-flex align-items-center">
                                    Belum Disetujui <i class="bi bi-caret-down-fill ms-2"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>20/01/2024</td>
                            <td>Sertifikat</td>
                            <td class="text-center">
                                <a href="#" target="_blank">
                                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger d-flex align-items-center">
                                    Belum Disetujui <i class="bi bi-caret-down-fill ms-2"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>20/01/2024</td>
                            <td>Penilaian</td>
                            <td class="text-center">
                                <a href="#" target="_blank">
                                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger d-flex align-items-center">
                                    Belum Disetujui <i class="bi bi-caret-down-fill ms-2"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
