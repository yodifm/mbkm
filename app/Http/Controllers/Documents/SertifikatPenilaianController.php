<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\RejectionReasons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SertifikatPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Sertifikat dan Penilaian';
        $user = auth()->user();
        $data = Documents::with('user')->where('NIM_id', $user->NIM)->first();
        $active = 'documents';
        $subActive = 'sertifikatPenilaian';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);


        $status5 = $data ? $data->status_laporan_akhir : null;
        $status6 = $data ? $data->status_sertifikat : null;
        $status7 = $data ? $data->status_penilaian : null;

        $reject1 = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'sertifikat')->first();
        $reject2 = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'penilaian')->first();
        return view('pages.documents.sertifikatPenilaian.index', compact('title', 'data', 'active', 'subActive', 'status5', 'status6', 'status7', 'reject1', 'reject2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit($id)
    {
        $title = 'Tambah Data Sertifikat & Penilaian';
        $active = 'documents';
        $data = Documents::find($id);
        $subActive = 'sertifikatPenilaian';
        return view('pages.documents.sertifikatPenilaian.create', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'sertifikat' => 'nullable|mimes:pdf|max:2048',
            'penilaian' => 'nullable|mimes:pdf|max:2048',
        ]);

        $sertifikatPenilaian = Documents::findOrFail($id);


        if ($request->hasFile('sertifikat')) {
            if (basename($sertifikatPenilaian->file) && file_exists('files/documents/sertifikat/' . basename($sertifikatPenilaian->file))) {
                unlink('files/documents/sertifikat/' . basename($sertifikatPenilaian->file));
            }

            $sertifikatPenilaian->status_sertifikat = 'submited';
            $sertifikatPenilaian->save();
            $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'sertifikat')->first();
            if ($reject != null) {
                $reject->status = 'completed';
                $reject->save();
            }
            $file = $request->file('sertifikat');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/documents/sertifikat/', $filename);
            $url = url('/files/documents/sertifikat/' . $filename);
            $credential['sertifikat'] = $url;
        }

        if ($request->hasFile('penilaian')) {
            if (basename($sertifikatPenilaian->file) && file_exists('files/documents/penilaian/' . basename($sertifikatPenilaian->file))) {
                unlink('files/documents/penilaian/' . basename($sertifikatPenilaian->file));
            }

            $sertifikatPenilaian->status_penilaian = 'submited';
            $sertifikatPenilaian->save();
            $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'penilaian')->first();
            if ($reject != null) {
                $reject->status = 'completed';
                $reject->save();
            }

            $file = $request->file('penilaian');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/documents/penilaian/', $filename);
            $url = url('/files/documents/penilaian/' . $filename);
            $credential['penilaian'] = $url;
        }
        $sertifikatPenilaian->update($credential);

        return redirect()->route('sertifikat.index')->with('success', 'Sertifikat & Penilaian added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
