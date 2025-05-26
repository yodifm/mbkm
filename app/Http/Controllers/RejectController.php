<?php

namespace App\Http\Controllers;

use App\Models\Datambkm;
use App\Models\Documents;
use App\Models\Pemberkasan;
use App\Models\RejectionReasons;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function reject(Request $request, $id)
    {
        $credentials = $request->validate([
            'reason' => 'required',
            'file_type' => 'required',
        ]);

        $credentials['NIM_id'] = $id;
        // dd($credentials['file_type']);

        if ($credentials['file_type'] == 'pernyataan' || $credentials['file_type'] == 'rekomendasi') {
            if ($credentials['file_type'] == 'pernyataan') {
                $pemberkasan = Pemberkasan::where('NIM_id', $id)->first();

                $pemberkasan->status_surat_pernyataan = 'rejected';
                $pemberkasan->save();
            } elseif ($credentials['file_type'] == 'rekomendasi') {
                $pemberkasan = Pemberkasan::where('NIM_id', $id)->first();
                $pemberkasan->status_surat_rekomendasi = 'rejected';
                $pemberkasan->save();
            }
        } else if ($credentials['file_type'] == 'LoA') {
            $mbkm = Datambkm::where('NIM_id', $id)->first();

            $mbkm->status_LoA = 'rejected';
            $mbkm->save();
        } else {
            if ($credentials['file_type'] == 'laporan_pertengahan') {
                $documents = Documents::where('NIM_id', $id)->first();

                $documents->status_laporan_pertengahan = 'rejected';
                $documents->save();
            } elseif ($credentials['file_type'] == 'laporan_akhir') {
                $documents = Documents::where('NIM_id', $id)->first();

                $documents->status_laporan_akhir = 'rejected';
                $documents->save();
            } elseif ($credentials['file_type'] == 'sertifikat') {
                $documents = Documents::where('NIM_id', $id)->first();

                $documents->status_sertifikat = 'rejected';
                $documents->save();
            } elseif ($credentials['file_type'] == 'penilaian') {
                $documents = Documents::where('NIM_id', $id)->first();

                $documents->status_penilaian = 'rejected';
                $documents->save();
            }
        }

        RejectionReasons::create($credentials);

        return redirect()->back()->with('success', 'File di tolak');
    }
}