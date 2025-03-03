<?php

namespace App\Http\Controllers;

use App\Models\Datambkms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatambkmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data MBKM';
        $data = Datambkms::all();
        $active = 'datambkms';
        $subActive = 'datambkms';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);
        return view('pages.datambkms.index', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Data MBKM';
        $active = 'datambkms';
        $subActive = 'datambkms';
        return view('pages.datambkms.create', compact('title', 'active', 'subActive'));
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

        $credential['NIK'] = Auth::user()->NIK;

        // dd($credential['NIK']);

        if ($request->hasFile('LoA')) {
            $file = $request->file('LoA');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/datambkms/LoA/', $filename);
            $url = url('/files/datambkms/LoA/' . $filename);
            $credential['LoA'] = $url;
        }

      

        datambkms::create($credential);
        return redirect('/dashboard/datambkms')->with('success', 'datambkms created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Data MBKM';
        $data = Datambkms::find($id);
        $active = 'datambkms';
        $subActive = 'datambkms';
        return view('pages.datambkms.edit', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'NIK' => 'required',
            'program_mbkm' => 'required',
            'mitra_mbkm' => 'required',
            'posisi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'LoA' => 'required|mimes:pdf|max:2048',
        ]);

        $certificate = Datambkms::findOrFail($id);

        
        if ($request->hasFile('LoA')) {
            // Delete the old file if it exists
            if (basename($certificate->file) && file_exists('files/datambkms/' . basename($certificate->file))) {
                unlink('files/datambkms/' . basename($certificate->file));
            }

            $file = $request->file('surat_rekomendasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/datambkms/', $filename);
            $url = url('/files/datambkms/' . $filename);
            $credential['surat_rekomendasi'] = $url;
        }

        if ($request->hasFile('surat_pernyataan')) {
            // Delete the old file if it exists
            if (basename($certificate->file) && file_exists('files/datambkms/' . basename($certificate->file))) {
                unlink('files/datambkms/' . basename($certificate->file));
            }

            $file = $request->file('surat_pernyataan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/datambkms/', $filename);
            $url = url('/files/datambkms/' . $filename);
            $credential['surat_pernyataan'] = $url;
        }

        $certificate->update($credential);

        return redirect('/dashboard/datambkms')->with('success', 'Certificate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Datambkms::find($id);
        if (basename($certificate->image) && file_exists('images/pemberkasans/' . basename($certificate->image))) {
            unlink('images/pemberkasans/' . basename($certificate->image));
        }
        $certificate->delete();
        return redirect('/dashboard/pemberkasans')->with('success', 'Certificate deleted successfully');
    }
}
