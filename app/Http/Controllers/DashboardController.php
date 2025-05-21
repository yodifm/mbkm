<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Datambkm;
use App\Models\Documents;
use App\Models\Educations;
use App\Models\experience;
use App\Models\Pemberkasan;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'CMS Portfolio Dashboard';
        $active = 'dashboard';
        $subActive = null;

        $user = auth()->user();
        $pemberkasan = Pemberkasan::where('NIM_id', $user->NIM)->first();
        $mbkm = Datambkm::where('NIM_id', $user->NIM)->first();
        $documents = Documents::where('NIM_id', $user->NIM)->first();

        $status1 = $pemberkasan ? $pemberkasan->status_surat_rekomendasi : null;
        $status2 = $pemberkasan ? $pemberkasan->status_surat_pernyataan : null;
        $status3  = $mbkm ? $mbkm->status_LoA : null;
        $status4  = $documents ? $documents->status_laporan_pertengahan : null;
        $status5  = $documents ? $documents->status_laporan_akhir : null;
        $status6  = $documents ? $documents->status_sertifikat_penilaian : null;

        return view('pages.dashboard', compact('title', 'active', 'subActive', 'status1', 'status2', 'status3', 'status4', 'status5', 'status6'));
    }
}