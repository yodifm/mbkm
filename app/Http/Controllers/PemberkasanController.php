<?php

namespace App\Http\Controllers;

use App\Models\Pemberkasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemberkasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pemberkasan';
        $data = Pemberkasan::with('user')->get();
        $active = 'pemberkasan';
        $subActive = 'pemberkasan';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);

        $user = auth()->user();
        $pemberkasan = Pemberkasan::where('NIK_id', $user->NIK)->first();

        $canAdd = $pemberkasan ? false : true;
        return view('pages.pemberkasan.index', compact('title', 'data', 'active', 'subActive', 'canAdd'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add pemberkasan';
        $active = 'pemberkasan';
        $subActive = 'pemberkasan';
        return view('pages.pemberkasan.create', compact('title', 'active', 'subActive'));
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
        $userData->status = '1';
        $userData->save();

        // Tambahkan NIK_id ke dalam data yang akan disimpan
        $credential['NIK_id'] = $user->NIK;


        if ($request->hasFile('surat_rekomendasi')) {
            $file = $request->file('surat_rekomendasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasan/surat_rekomendasi/', $filename);
            $url = url('/files/pemberkasan/surat_rekomendasi/' . $filename);
            $credential['surat_rekomendasi'] = $url;
        }

        if ($request->hasFile('surat_pernyataan')) {
            $file = $request->file('surat_pernyataan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasan/surat_pernyataan/', $filename);
            $url = url('/files/pemberkasan/surat_pernyataan/' . $filename);
            $credential['surat_pernyataan'] = $url;
        }

        Pemberkasan::create($credential);
        return redirect('/dashboard/pemberkasan')->with('success', 'pemberkasan created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit pemberkasan';
        $data = Pemberkasan::with('user')->find($id);
        $active = 'pemberkasan';
        $subActive = 'pemberkasan';
        // dd($data);
        return view('pages.pemberkasan.edit', compact('title', 'data', 'active', 'subActive'));
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

        $certificate = Pemberkasan::findOrFail($id);


        if ($request->hasFile('surat_rekomendasi')) {
            // Delete the old file if it exists
            if (basename($certificate->file) && file_exists('files/pemberkasan/' . basename($certificate->file))) {
                unlink('files/pemberkasan/' . basename($certificate->file));
            }

            $file = $request->file('surat_rekomendasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasan/', $filename);
            $url = url('/files/pemberkasan/' . $filename);
            $credential['surat_rekomendasi'] = $url;
        }

        if ($request->hasFile('surat_pernyataan')) {
            // Delete the old file if it exists
            if (basename($certificate->file) && file_exists('files/pemberkasan/' . basename($certificate->file))) {
                unlink('files/pemberkasan/' . basename($certificate->file));
            }

            $file = $request->file('surat_pernyataan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasan/', $filename);
            $url = url('/files/pemberkasan/' . $filename);
            $credential['surat_pernyataan'] = $url;
        }

        $certificate->update($credential);

        return redirect('/dashboard/pemberkasan')->with('success', 'Certificate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Pemberkasan::find($id);
        if (basename($certificate->image) && file_exists('images/pemberkasan/' . basename($certificate->image))) {
            unlink('images/pemberkasan/' . basename($certificate->image));
        }
        $certificate->delete();
        return redirect('/dashboard/pemberkasan')->with('success', 'Certificate deleted successfully');
    }
}