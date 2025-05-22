<?php

namespace App\Http\Controllers;

use App\Models\Datambkm;
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
}