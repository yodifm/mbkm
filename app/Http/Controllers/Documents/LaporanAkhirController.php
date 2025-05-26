<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\RejectionReasons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Laporan Akhir';
        $user = auth()->user();
        $data = Documents::with('user')->where('NIM_id', $user->NIM)->first();
        $active = 'documents';
        $subActive = 'laporanAkhir';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);

        $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'laporan_akhir')->first();


        $status4 = $data ? $data->status_laporan_pertengahan : null;
        $status5 = $data ? $data->status_laporan_akhir : null;
        return view('pages.documents.laporanAkhir.index', compact('title', 'data', 'active', 'subActive', 'status5', 'status4', 'reject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit($id)
    {
        $title = 'Dokumen Laporan Akhir';
        $data = Documents::find($id);
        $active = 'documents';
        $subActive = 'laporanAkhir';
        return view('pages.documents.laporanAkhir.create', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'laporan_akhir' => 'required|mimes:pdf|max:2048',
        ]);

        $laporan_akhir = Documents::findOrFail($id);


        if ($request->hasFile('laporan_akhir')) {
            if (basename($laporan_akhir->file) && file_exists('files/documents/laporan_akhir/' . basename($laporan_akhir->file))) {
                unlink('files/documents/laporan_akhir/' . basename($laporan_akhir->file));
            }

            $laporan_akhir->status_laporan_akhir = 'submited';
            $laporan_akhir->save();
            $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'laporan_akhir')->first();
            if ($reject != null) {
                $reject->status = 'completed';
                $reject->save();
            }

            $file = $request->file('laporan_akhir');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/documents/laporan_akhir/', $filename);
            $url = url('/files/documents/laporan_akhir/' . $filename);
            $credential['laporan_akhir'] = $url;
        }
        $laporan_akhir->update($credential);

        return redirect()->route('laporan-akhir.index')->with('success', 'laporan akhir added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
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