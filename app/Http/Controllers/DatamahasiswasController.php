<?php

namespace App\Http\Controllers;

use App\Models\Datamahasiswas;
use App\Models\Datambkm;
use App\Models\Documents;
use App\Models\Pemberkasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class datamahasiswasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Mahasiswa';
        $data = User::with('mbkm')->where('role', 'mahasiswa')->orderBy('updated_at', 'desc')->get();
        $active = 'datamahasiswas';
        $subActive = 'datamahasiswas';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);
        return view('pages.datamahasiswas.index', compact('title', 'data', 'active', 'subActive'));
    }


    public function show($id)
    {
        $title = 'Data Mahasiswa';
        $data = User::with(['mbkm', 'pemberkasan'])->where('NIM', $id)->first();
        $active = 'datamahasiswas';
        $subActive = 'datamahasiswas';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);

        // $user = auth()->user();
        $pemberkasan = Pemberkasan::where('NIM_id', $data->NIM)->first();
        $mbkm = Datambkm::where('NIM_id', $data->NIM)->first();
        $documents = Documents::where('NIM_id', $data->NIM)->first();

        $status1 = $pemberkasan;
        $status2 = $pemberkasan;
        $status3  = $mbkm;
        $status4  = $documents;
        $status5  = $documents;
        $status6  = $documents;
        $status7  = $documents;
        return view('pages.datamahasiswas.detail', compact('title', 'data', 'active', 'subActive', 'status1', 'status2', 'status3', 'status4', 'status5', 'status6', 'status7'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Data mahasiswa';
        $active = 'datamahasiswas';
        $subActive = 'datamahasiswas';
        return view('pages.datamahasiswas.create', compact('title', 'active', 'subActive'));
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

        $credential['NIM'] = Auth::user()->NIM;


        user::create($credential);
        return redirect('/dashboard/datamahasiswas')->with('success', 'datamahasiswas created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Data Mahasiswa';
        $data = User::find($id);
        $active = 'datamahasiswas';
        $subActive = 'datamahasiswas';
        return view('pages.datamahasiswas.edit', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'NIM' => 'required',
            'program_mbkm' => 'required',
            'mitra_mbkm' => 'required',
            'posisi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'LoA' => 'required|mimes:pdf|max:2048',
        ]);

        $mahasiswa = user::findOrFail($id);


        if ($request->hasFile('LoA')) {
            if (basename($mahasiswa->file) && file_exists('files/datamahasiswas/' . basename($mahasiswa->file))) {
                unlink('files/datamahasiswas/' . basename($mahasiswa->file));
            }

            $file = $request->file('surat_rekomendasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/datamahasiswas/', $filename);
            $url = url('/files/datamahasiswas/' . $filename);
            $credential['surat_rekomendasi'] = $url;
        }

        if ($request->hasFile('surat_pernyataan')) {
            // Delete the old file if it exists
            if (basename($mahasiswa->file) && file_exists('files/datamahasiswas/' . basename($mahasiswa->file))) {
                unlink('files/datamahasiswas/' . basename($mahasiswa->file));
            }

            $file = $request->file('surat_pernyataan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/datamahasiswas/', $filename);
            $url = url('/files/datamahasiswas/' . $filename);
            $credential['surat_pernyataan'] = $url;
        }

        $mahasiswa->update($credential);

        return redirect('/dashboard/datamahasiswas')->with('success', 'Certificate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = user::find($id);
        $mahasiswa->delete();
        return redirect('/dashboard/pemberkasan')->with('success', 'Certificate deleted successfully');
    }
}