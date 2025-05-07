<?php

namespace App\Http\Controllers;

use App\Models\Datadosens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class datadosensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $title = 'Data Dosen';
        $data = User::where('role','dosen')->get();
        $active = 'datadosens';
        $subActive = 'datadosens';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);
        return view('pages.datadosens.index', compact('title', 'data', 'active', 'subActive'));
    }


    public function detail()
    { 
        $title = 'Data Mahasiswa';
        $data = Datadosens::all();
        $active = 'datadosens';
        $subActive = 'datadosens';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);
        return view('pages.datadosens.detail', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Data Dosen';
        $active = 'datadosens';
        $subActive = 'datadosens';
        return view('pages.datadosens.create', compact('title', 'active', 'subActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credential = $request->validate([
            
            'NIK' => 'required',
            'name' => 'required',
            'password' => 'required',
            
            
        ]);

        $credential['NIK'] = Auth::user()->NIK;

        // dd($credential['NIK']);

        // if ($request->hasFile('LoA')) {
        //     $file = $request->file('LoA');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move('files/datadosens/LoA/', $filename);
        //     $url = url('/files/datadosens/LoA/' . $filename);
        //     $credential['LoA'] = $url;
        // }

      

        datadosens::create($credential);
        return redirect('/dashboard/datadosens')->with('success', 'datadosens created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Data MBKM';
        $data = Datadosens::find($id);
        $active = 'datadosens';
        $subActive = 'datadosens';
        return view('pages.datadosens.edit', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'NIK' => 'required',
            'name' => 'required',
            'password' => 'required',
        ]);

        // $certificate = Datadosens::findOrFail($id);

        
        // if ($request->hasFile('LoA')) {
        //     // Delete the old file if it exists
        //     if (basename($certificate->file) && file_exists('files/datadosens/' . basename($certificate->file))) {
        //         unlink('files/datadosens/' . basename($certificate->file));
        //     }

        //     $file = $request->file('surat_rekomendasi');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move('files/datadosens/', $filename);
        //     $url = url('/files/datadosens/' . $filename);
        //     $credential['surat_rekomendasi'] = $url;
        // }

        // if ($request->hasFile('surat_pernyataan')) {
        //     // Delete the old file if it exists
        //     if (basename($certificate->file) && file_exists('files/datadosens/' . basename($certificate->file))) {
        //         unlink('files/datadosens/' . basename($certificate->file));
        //     }

        //     $file = $request->file('surat_pernyataan');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move('files/datadosens/', $filename);
        //     $url = url('/files/datadosens/' . $filename);
        //     $credential['surat_pernyataan'] = $url;
        // }

        // $certificate->update($credential);

        return redirect('/dashboard/datadosens')->with('success', 'Certificate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Datadosens::find($id);
        if (basename($certificate->image) && file_exists('images/pemberkasans/' . basename($certificate->image))) {
            unlink('images/pemberkasans/' . basename($certificate->image));
        }
        $certificate->delete();
        return redirect('/dashboard/pemberkasans')->with('success', 'Certificate deleted successfully');
    }
}
