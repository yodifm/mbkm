<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Datambkm;
use App\Models\Documents;
use App\Models\RejectionReasons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPertengahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Laporan Pertengahan';
        $user = auth()->user();
        $data = Documents::with('user')->where('NIM_id', $user->NIM)->first();
        $active = 'documents';
        $subActive = 'laporanPertengahan';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);

        $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'laporan_pertengahan')->first();
        $mbkm = Datambkm::with('user')->where('NIM_id', $user->NIM)->first();
        $status3  = $mbkm ? $mbkm->status_LoA : null;
        $status4 = $data ? $data->status_laporan_pertengahan : null;
        return view('pages.documents.laporanPertengahan.index', compact('title', 'data', 'active', 'subActive', 'status3', 'status4', 'reject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data Laporan Pertengahan';
        $active = 'documents';
        $subActive = 'laporanPertengahan';
        return view('pages.documents.laporanPertengahan.create', compact('title', 'active', 'subActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credential = $request->validate([
            'laporan_pertengahan' => 'required|mimes:pdf|max:2048',

        ]);

        $credential['NIM_id'] = Auth::user()->NIM;
        $data_mbkm = Datambkm::where('NIM_id', Auth::user()->NIM)->first();
        $credential['data_mbkm_id'] = $data_mbkm->id;


        if ($request->hasFile('laporan_pertengahan')) {
            $file = $request->file('laporan_pertengahan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/documents/laporan_pertengahan/', $filename);
            $url = url('/files/documents/laporan_pertengahan/' . $filename);
            $credential['laporan_pertengahan'] = $url;
        }



        Documents::create($credential);
        $data = Documents::where('NIM_id', Auth::user()->NIM)->first();
        $data->status_laporan_pertengahan = "submited";
        $data->save();
        return redirect('/dashboard/documents/laporan-pertengahan')->with('success', 'Laporan Pertengahan Berhasil Ditambahkan');
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
    public function edit(string $id)
    {
        $title = 'Tambah Data Laporan Pertengahan';
        $data = Documents::find($id);
        $active = 'documents';
        $subActive = 'laporanPertengahan';
        return view('pages.documents.laporanPertengahan.edit', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $credential = $request->validate([
            'laporan_pertengahan' => 'required|mimes:pdf|max:2048',
        ]);

        $laporan_pertengahan = Documents::findOrFail($id);


        if ($request->hasFile('laporan_pertengahan')) {
            if (basename($laporan_pertengahan->file) && file_exists('files/documents/laporan_pertengahan/' . basename($laporan_pertengahan->file))) {
                unlink('files/documents/laporan_pertengahan/' . basename($laporan_pertengahan->file));
            }

            $laporan_pertengahan->status_laporan_pertengahan = 'submited';
            $laporan_pertengahan->save();
            $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'laporan_pertengahan')->first();
            if ($reject != null) {
                $reject->status = 'completed';
                $reject->save();
            }

            $file = $request->file('laporan_pertengahan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/documents/laporan_pertengahan/', $filename);
            $url = url('/files/documents/laporan_pertengahan/' . $filename);
            $credential['laporan_pertengahan'] = $url;
        }
        $laporan_pertengahan->update($credential);

        return redirect()->route('laporan-pertengahan.index')->with('success', 'Laporan Pertengahan Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
