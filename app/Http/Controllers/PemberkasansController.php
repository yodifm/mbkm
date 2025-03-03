<?php

namespace App\Http\Controllers;

use App\Models\Pemberkasans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemberkasansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pemberkasans';
        $data = Pemberkasans::with('user')->get();
        $active = 'pemberkasans';
        $subActive = 'pemberkasans';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);
        return view('pages.pemberkasans.index', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add pemberkasans';
        $active = 'pemberkasans';
        $subActive = 'pemberkasans';
        return view('pages.pemberkasans.create', compact('title', 'active', 'subActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credential = $request->validate([
            'semester' => 'required',
            'dosen_pembimbing' => 'required',
            'surat_rekomendasi' => 'required|mimes:pdf|max:2048',
            'surat_pernyataan' => 'required|mimes:pdf|max:2048',
        ]);
        
        // Pastikan user sudah login sebelum mengakses Auth::user()
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        $user = Auth::user(); // Ambil data user yang sedang login
        
        // Pastikan NIK tersedia di dalam database
        $userData = User::where('NIK', $user->NIK)->first();
        if (!$userData) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        
        // Update status user
        $userData->status = 'surat_rekomendasi';
        $userData->save();
        
        // Tambahkan NIK_id ke dalam data yang akan disimpan
        $credential['NIK_id'] = $user->NIK;
       
        
        if ($request->hasFile('surat_rekomendasi')) {
            $file = $request->file('surat_rekomendasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasans/surat_rekomendasi/', $filename);
            $url = url('/files/pemberkasans/surat_rekomendasi/' . $filename);
            $credential['surat_rekomendasi'] = $url;
        }
        
        if ($request->hasFile('surat_pernyataan')) {
            $file = $request->file('surat_pernyataan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasans/surat_pernyataan/', $filename);
            $url = url('/files/pemberkasans/surat_pernyataan/' . $filename);
            $credential['surat_pernyataan'] = $url;
        }
        
        Pemberkasans::create($credential);
        // $user->save();
        return redirect('/dashboard/pemberkasans')->with('success', 'pemberkasans created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit pemberkasans';
        $data = Pemberkasans::find($id);
        $active = 'pemberkasans';
        $subActive = 'pemberkasans';
        return view('pages.pemberkasans.edit', compact('title', 'data', 'active', 'subActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'name' => 'required',
            'NIK' => 'required',
            'semester' => 'required',
            'dosen_pembimbing' => 'required',
            'surat_rekomendasi' => 'required|mimes:pdf|max:2048',
            'surat_pernyataan' => 'required|mimes:pdf|max:2048',
        ]);

        $certificate = Pemberkasans::findOrFail($id);

        
        if ($request->hasFile('surat_rekomendasi')) {
            // Delete the old file if it exists
            if (basename($certificate->file) && file_exists('files/pemberkasans/' . basename($certificate->file))) {
                unlink('files/pemberkasans/' . basename($certificate->file));
            }

            $file = $request->file('surat_rekomendasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasans/', $filename);
            $url = url('/files/pemberkasans/' . $filename);
            $credential['surat_rekomendasi'] = $url;
        }

        if ($request->hasFile('surat_pernyataan')) {
            // Delete the old file if it exists
            if (basename($certificate->file) && file_exists('files/pemberkasans/' . basename($certificate->file))) {
                unlink('files/pemberkasans/' . basename($certificate->file));
            }

            $file = $request->file('surat_pernyataan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasans/', $filename);
            $url = url('/files/pemberkasans/' . $filename);
            $credential['surat_pernyataan'] = $url;
        }

        $certificate->update($credential);

        return redirect('/dashboard/pemberkasans')->with('success', 'Certificate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Pemberkasans::find($id);
        if (basename($certificate->image) && file_exists('images/pemberkasans/' . basename($certificate->image))) {
            unlink('images/pemberkasans/' . basename($certificate->image));
        }
        $certificate->delete();
        return redirect('/dashboard/pemberkasans')->with('success', 'Certificate deleted successfully');
    }
}
