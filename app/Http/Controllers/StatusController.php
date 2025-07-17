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

        return redirect()->back()->with('success', 'Surat Rekomendasi Disetujui');
    }

    public function approvePernyataan($id)
    {

        $pemberkasan = Pemberkasan::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '3';
        $user->save();

        $pemberkasan->status_surat_pernyataan = 'approved';
        $pemberkasan->save();

        return redirect()->back()->with('success', 'Surat Pernyataan di Disetujui');
    }

    public function approveLoA($id)
    {

        $mbkm = Datambkm::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '4';
        $user->save();

        $mbkm->status_LoA = 'approved';
        $mbkm->save();

        return redirect()->back()->with('success', 'Surat LoA di Disetujui');
    }

    public function approveLaporan_pertengahan($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '5';
        $user->save();

        $documents->status_laporan_pertengahan = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Laporan Pertengahan di Disetujui');
    }

    public function approveLaporan_akhir($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '6';
        $user->save();

        $documents->status_laporan_akhir = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Laporan akhir di Disetujui');
    }

    public function approveSertifikat($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();
        $user = User::where('NIM', $id)->first();
        $user->status = '7';
        $user->save();

        $documents->status_sertifikat = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Sertifikat di Disetujui');
    }

    public function approvePenilaian($id)
    {

        $documents = Documents::where('NIM_id', $id)->first();

        $documents->status_penilaian = 'approved';
        $documents->save();

        return redirect()->back()->with('success', 'Penilaian di Disetujui');
    }
}
