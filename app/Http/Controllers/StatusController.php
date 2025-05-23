<?php

namespace App\Http\Controllers;

use App\Models\Datambkm;
use App\Models\Documents;
use App\Models\Pemberkasan;
use App\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function approveRekomendasi($id)
    {
        $pemberkasan = Pemberkasan::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '2';
        $user->save();
        $pemberkasan->status_surat_rekomendasi = 'approved';
        $pemberkasan->save();

        return redirect()->back()->with('success', 'Surat Rekomendasi di approve');
    }
    public function rejectRekomendasi($id)
    {
        $pemberkasan = Pemberkasan::where('NIM_id', $id)->first();
        $pemberkasan->status_surat_rekomendasi = 'rejected';
        $pemberkasan->save();

        return redirect()->back()->with('success', 'Surat Rekomendasi di tolak');
    }
    public function approvePernyataan($id)
    {

        $pemberkasan = Pemberkasan::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '3';
        $user->save();

        $pemberkasan->status_surat_pernyataan = 'approved';
        $pemberkasan->save();

        return redirect()->back()->with('success', 'Surat Pernyataan di approve');
    }
    public function rejectPernyataan($id)
    {

        $pemberkasan = Pemberkasan::where('NIM_id', $id)->first();

        $pemberkasan->status_surat_pernyataan = 'rejected';
        $pemberkasan->save();

        return redirect()->back()->with('success', 'Surat Pernyataan di tolak');
    }
    public function approveLoA($id)
    {

        $mbkm = Datambkm::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '4';
        $user->save();

        $mbkm->status_LoA = 'approved';
        $mbkm->save();

        return redirect()->back()->with('success', 'Surat LoA di approve');
    }
    public function rejectLoA($id)
    {

        $mbkm = Datambkm::where('NIM_id', $id)->first();

        $mbkm->status_LoA = 'rejected';
        $mbkm->save();

        return redirect()->back()->with('success', 'Surat LoA di tolak');
    }
    public function approveLaporan_pertengahan($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '5';
        $user->save();

        $documents->status_laporan_pertengahan = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Laporan Pertengahan di approve');
    }
    public function rejectLaporan_pertengahan($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();

        $documents->status_laporan_pertengahan = 'rejected';
        $documents->save();

        return redirect()->back()->with('success', 'Laporan Pertengahan di tolak');
    }
    public function approveLaporan_akhir($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '6';
        $user->save();

        $documents->status_laporan_akhir = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Laporan akhir di approve');
    }
    public function rejectLaporan_akhir($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();

        $documents->status_laporan_akhir = 'rejected';
        $documents->save();

        return redirect()->back()->with('success', 'Laporan akhir di tolak');
    }
    public function approveSertifikat($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '7';
        $user->save();

        $documents->status_sertifikat = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Sertifikat di approve');
    }
    public function rejectSertifikat($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();

        $documents->status_sertifikat = 'rejected';
        $documents->save();

        return redirect()->back()->with('success', 'Sertifikat di tolak');
    }

    public function approvePenilaian($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();

        $documents->status_penilaian = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Penilaian di approve');
    }
    public function rejectPenilaian($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();

        $documents->status_penilaian = 'rejected';
        $documents->save();

        return redirect()->back()->with('success', 'Penilaian di tolak');
    }
}
