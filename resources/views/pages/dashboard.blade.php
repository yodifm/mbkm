@extends('layouts.layout')

@section('section')
    {{-- @include('components.pagetitle', ['title' => $title]) --}}

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Selamat datang, Soraya Nuron Jamil!</h4>
                                <p style="text-decoration: none">SIP MBKM (Sistem Informasi Program Merdeka Belajar - Kampus
                                    Merdeka) Program Studi Manajemen Pendidikan FIP UNJ, semoga dapat membantu pada setiap
                                    kegiatan administrasi MBKM anda.</p>

                            </div>
                            <div class="card-body">
                                <div class="form-control-icon">
                                    <button type="button" class="btn btn-success"
                                        style="background-color: #34623F; border-color: #34623F;">
                                        <i class="bi bi-download" style="margin-right: 5px;"></i>
                                        Pedoman Kegiatan MBKM
                                    </button> &nbsp; &nbsp;
                                    <button type="button" class="btn btn-success"
                                        style="background-color: #34623F; border-color: #34623F;">
                                        <i class="bi bi-download" style="margin-right: 5px;"></i>
                                        Pedoman Kegiatan MBKM
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="form-control-icon" style="display: flex; align-items: center;">
                                    <img src={{ asset('Activity.png') }} alt="Icon"
                                        style="width: 24px; height: 24px; margin-right: 10px;">
                                    <h4 style="margin: 0;">Aktivitas</h4>
                                </div>

                            </div>

                            <div class="card-body">

                                <div class="steps-container"
                                    style="display: flex; justify-content: space-between; align-items: right; padding: 20px;">


                                    @if (auth()->user()->status != 'none')
                                        <!-- Langkah 1 -->
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #34623F; margin-bottom: 10px;">
                                                <i class="bi bi-check-circle-fill" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px; font">Langkah 1</p>
                                            <p style="margin: 0; font-size: 14px;">Surat Rekomendasi</p>
                                            <button class="btn btn-success"
                                                style="background-color: #D8EEC1; color: #34623F; border: none; margin-top: 5px;">Disetujui</button>
                                        </div>
                                    @else
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #D3D3D3; margin-bottom: 10px;">
                                                <i class="bi bi-clock" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px; font">Langkah 1</p>
                                            <p style="margin: 0; font-size: 14px;">Surat Rekomendasi</p>
                                            <button class="btn btn-secondary"
                                                style="background-color: #F2F2F2; color: #666; border: none; margin-top: 5px;">Pending</button>
                                        </div>
                                    @endif



                                    @if (auth()->user()->status != 'none' && (auth()->user()->status != 'surat_rekomendasi' ))
                                         <!-- Langkah 2 -->
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #34623F; margin-bottom: 10px;">
                                                <i class="bi bi-check-circle-fill" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 2</p>
                                            <p style="margin: 0; font-size: 14px;">Surat PTJM</p>
                                            <button class="btn btn-success"
                                                style="background-color: #D8EEC1; color: #34623F; border: none; margin-top: 5px;">Disetujui</button>
                                        </div>
                                    @else
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #D3D3D3; margin-bottom: 10px;">
                                                <i class="bi bi-clock" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px; font">Langkah 2</p>
                                            <p style="margin: 0; font-size: 14px;">Surat PTJM</p>
                                            <button class="btn btn-secondary"
                                                style="background-color: #F2F2F2; color: #666; border: none; margin-top: 5px;">Pending</button>
                                        </div>
                                    @endif


                                    @if (auth()->user()->status != 'none' && (auth()->user()->status != 'surat_rekomendasi' && auth()->user()->status != 'surat_ptjm'))
                                        <!-- Langkah 3 -->
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #34623F; margin-bottom: 10px;">
                                                <i class="bi bi-check-circle-fill" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 3</p>
                                            <p style="margin: 0; font-size: 14px;"><em>Letter of Acceptance</em></p>
                                            <button class="btn btn-success"
                                                style="background-color: #D8EEC1; color: #34623F; border: none; margin-top: 5px;">Disetujui</button>
                                        </div>
                                    @else
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #D3D3D3; margin-bottom: 10px;">
                                                <i class="bi bi-clock" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 3</p>
                                            <p style="margin: 0; font-size: 14px;"><em>Letter of Acceptance</em></p>
                                            <button class="btn btn-secondary"
                                                style="background-color: #F2F2F2; color: #666; border: none; margin-top: 5px;">Pending</button>
                                        </div>
                                    @endif





                                    @if (auth()->user()->status != 'none' && (auth()->user()->status != 'surat_rekomendasi' && auth()->user()->status != 'surat_ptjm' && auth()->user()->status != 'LoA'))
                                        <!-- Langkah 5 -->
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #34623F; margin-bottom: 10px;">
                                                <i class="bi bi-check-circle-fill" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 4</p>
                                            <p style="margin: 0; font-size: 14px;">Laporan Pertengahan</p>
                                            <button class="btn btn-success"
                                                style="background-color: #D8EEC1; color: #34623F; border: none; margin-top: 5px;">Disetujui</button>
                                        </div>
                                    @else
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #D3D3D3; margin-bottom: 10px;">
                                                <i class="bi bi-clock" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 4</p>
                                            <p style="margin: 0; font-size: 14px;">Laporan Pertengahan</p>
                                            <button class="btn btn-secondary"
                                                style="background-color: #F2F2F2; color: #666; border: none; margin-top: 5px;">Pending</button>
                                        </div>
                                    @endif


                                    @if (auth()->user()->status != 'none' && (auth()->user()->status != 'surat_rekomendasi' && auth()->user()->status != 'surat_ptjm' && auth()->user()->status != 'LoA' && auth()->user()->status != 'laporan_pertengahan'))
                                        <!-- Langkah 5 -->
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #34623F; margin-bottom: 10px;">
                                                <i class="bi bi-check-circle-fill" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 5</p>
                                            <p style="margin: 0; font-size: 14px;">Laporan Akhir</p>
                                            <button class="btn btn-success"
                                            style="background-color: #D8EEC1; color: #34623F; border: none; margin-top: 5px;">Disetujui</button>
                                        </div>
                                    @else
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #D3D3D3; margin-bottom: 10px;">
                                                <i class="bi bi-clock" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 5</p>
                                            <p style="margin: 0; font-size: 14px;">Laporan Akhir</p>
                                            <button class="btn btn-secondary"
                                                style="background-color: #F2F2F2; color: #666; border: none; margin-top: 5px;">Pending</button>
                                        </div>
                                    @endif



                                    @if (auth()->user()->status != 'none' && (auth()->user()->status != 'surat_rekomendasi' && auth()->user()->status != 'surat_ptjm' && auth()->user()->status != 'LoA' && auth()->user()->status != 'laporan_pertengahan' && auth()->user()->status != 'laporan_akhir'))
                                        <!-- Langkah 5 -->
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #34623F; margin-bottom: 10px;">
                                                <i class="bi bi-check-circle-fill" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 6</p>
                                            <p style="margin: 0; font-size: 14px;">Sertifikat & Penilaian</p>
                                            <button class="btn btn-success"
                                            style="background-color: #D8EEC1; color: #34623F; border: none; margin-top: 5px;">Disetujui</button>
                                        </div>
                                    @else
                                        <div class="step" style="text-align: left; flex: 1; position: relative;">
                                            <div class="icon" style="color: #D3D3D3; margin-bottom: 10px;">
                                                <i class="bi bi-clock" style="font-size: 36px;"></i>
                                            </div>
                                            <p style="margin: 5px 0; font-size: 10px;">Langkah 6</p>
                                            <p style="margin: 0; font-size: 14px;">Sertifikat & Penilaian</p>
                                            <button class="btn btn-secondary"
                                                style="background-color: #F2F2F2; color: #666; border: none; margin-top: 5px;">Pending</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-control-icon"
                            style="display: flex; flex-direction: column; align-items: start; padding-left: 20px;">
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset('unduhan.png') }}" alt="Icon" style="margin-right: 10px;">
                                <h4 style="margin: 0; color:#000">Unduhan</h4>
                            </div>
                            <div style="margin-top: 10px; display: flex; align-items: center; padding-left:40px">
                                <img src="{{ asset('unduh2.png') }}" alt="Icon" style margin-right: 10px;">&nbsp;
                                <ul style="margin: 0; padding-left: 0; list-style: none;">
                                    <li style="margin: 0; font-weight: bold; color: #2C7E98;">Unduh format Surat
                                        Rekomendasi</li>

                                </ul>
                            </div>
                            <div style="margin-top: 10px; display: flex; align-items: center; padding-left:40px">
                                <img src="{{ asset('unduh2.png') }}" alt="Icon" style margin-right: 10px;">&nbsp;
                                <ul style="margin: 0; padding-left: 0; list-style: none;">
                                    <li style="margin: 0; font-weight: bold; color:#2C7E98">Unduh format Surat Rekomendasi
                                    </li>
                                </ul>
                            </div>


                        </div>
                        <br />


                        <div class="form-control-icon"
                            style="display: flex; flex-direction: column; align-items: start; padding-left: 20px;">
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset('unduhan.png') }}" alt="Icon" style="margin-right: 10px;">
                                <h4 style="margin: 0; color:#000">Informasi MBKM</h4>
                            </div>
                            <div style="margin-top: 10px; display: flex; align-items: center; padding-left:40px">
                                <ul style="margin: 0; padding-left: 0; list-style: none;">
                                    <li style="margin: 0; color: #000;">
                                        <span style="font-style: italic;">National onboarding</span> MSIB Batch 7 dilakukan
                                        pada tanggal 10 Mei 2024
                                    </li>


                                </ul>
                            </div>
                            <div style="margin-top: 10px; display: flex; align-items: center; padding-left:40px">
                                <ul style="margin: 0; padding-left: 0; list-style: none;">
                                    <li style="margin: 0; color: #000;">
                                        Kunjungi laman
                                        <a href="https://kampusmerdeka.kemdikbud.go.id/"
                                            style="color: #2C7E98; text-decoration: none;">
                                            https://kampusmerdeka.kemdikbud.go.id/
                                        </a>
                                        untuk informasi program lebih lengkap.
                                    </li>

                                </ul>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="px-4 py-4 card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="./dist/assets/compiled/jpg/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name text-truncate">
                                <h5 class="font-bold text-truncate">{{ Auth::user()->name }}</h5>
                                <h6 class="mb-0 text-muted text-truncate">{{ Auth::user()->email }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Educations</h4>
                    </div>
                    {{-- <div class="pb-4 card-content">
                        <div class="px-4 py-3">
                            @if ($education->count() == 0)
                                <p>No Data</p>
                            @else
                                @foreach ($education as $item)
                                    <div class="mb-5">
                                        <h5 class="fs-5 fw-bold">{{ $item->name }}</h5>
                                        <p class="mb-0">{{ $item->start_date }} - {{ $item->end_date }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="px-4">
                            <a href="{{ route('educations.create') }}"
                                class='mt-3 font-bold btn btn-block btn-xl btn-outline-primary'>add education</a>
                        </div>
                    </div> --}}
                </div>

            </div>
        </section>
    </div>
@endsection
