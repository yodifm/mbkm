<?php

namespace App\Http\Controllers;

use App\Models\Datambkm;
use App\Models\Pemberkasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatambkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data MBKM';
        $user = auth()->user();
        $data = Datambkm::with('user')->where('NIM_id', $user->NIM)->first();
        // dd($data);
        $active = 'datambkm';
        $subActive = 'datambkm';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);

        $pemberkasan = Pemberkasan::where('NIM_id', $user->NIM)->first();

        $status2 = $pemberkasan ? $pemberkasan->status_surat_pernyataan : null;
        $status3  = $data ? $data->status_LoA : null;
        return view('pages.datambkm.index', compact('title', 'data', 'active', 'subActive', 'status2', 'status3'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Data MBKM';
        $active = 'datambkm';
        $subActive = 'datambkm';
        return view('pages.datambkm.create', compact('title', 'active', 'subActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credential = $request->validate([

            'program_mbkm' => 'required',
            'mitra_mbkm' => 'required',
            'posisi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'LoA' => 'required|mimes:pdf|max:2048',

        ]);

        $credential['NIM_id'] = Auth::user()->NIM;
        $pemberkasan = Pemberkasan::where('NIM_id', Auth::user()->NIM)->first();
        $credential['pemberkasan_id'] = $pemberkasan->id;

        // dd($credential['NIM']);

        if ($request->hasFile('LoA')) {
            $file = $request->file('LoA');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/datambkm/LoA/', $filename);
            $url = url('/files/datambkm/LoA/' . $filename);
            $credential['LoA'] = $url;
        }



        datambkm::create($credential);
        return redirect('/dashboard/datambkm')->with('success', 'datambkm created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Data MBKM';
        $data = Datambkm::find($id);
        $active = 'datambkm';
        $subActive = 'datambkm';
        return view('pages.datambkm.edit', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'program_mbkm' => 'required',
            'mitra_mbkm' => 'required',
            'posisi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'LoA' => 'required|mimes:pdf|max:2048',
        ]);

        $data_mbkm = Datambkm::findOrFail($id);


        if ($request->hasFile('LoA')) {
            if (basename($data_mbkm->file) && file_exists('files/datambkm/LoA/' . basename($data_mbkm->file))) {
                unlink('files/datambkm/LoA/' . basename($data_mbkm->file));
            }

            $data_mbkm->status_LoA = 'submited';
            $data_mbkm->save();

            $file = $request->file('LoA');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/datambkm/LoA/', $filename);
            $url = url('/files/datambkm/LoA/' . $filename);
            $credential['LoA'] = $url;
        }

        $data_mbkm->update($credential);

        return redirect('/dashboard/datambkm')->with('success', 'data mbkm updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_mbkm = Datambkm::find($id);
        if (basename($data_mbkm->image) && file_exists('images/pemberkasan/' . basename($data_mbkm->image))) {
            unlink('images/pemberkasan/' . basename($data_mbkm->image));
        }
        $data_mbkm->delete();
        return redirect('/dashboard/datambkm')->with('success', 'data mbkm deleted successfully');
    }
}