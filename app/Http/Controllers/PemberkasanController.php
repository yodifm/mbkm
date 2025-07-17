<?php

namespace App\Http\Controllers;

use App\Models\Pemberkasan;
use App\Models\RejectionReasons;
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
        $user = auth()->user();
        $data = Pemberkasan::with('user')->where('NIM_id', $user->NIM)->first();
        $active = 'pemberkasan';
        $subActive = 'pemberkasan';
        $titleModal = 'Delete ' . $title;
        $text = "Are you sure you want to delete?";
        confirmDelete($titleModal, $text);

        $reject1 = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'rekomendasi')->first();
        $reject2 = $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'pernyataan')->first();

        $canAdd = $data ? false : true;
        return view('pages.pemberkasan.index', compact('title', 'data', 'active', 'subActive', 'canAdd', 'reject1', 'reject2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add pemberkasan';
        $active = 'pemberkasan';
        $subActive = 'pemberkasan';
        $dosen = User::where('role', 'dosen')->get();
        return view('pages.pemberkasan.create', compact('title', 'active', 'subActive', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credential = $request->validate([
            'semester' => 'required',
            'angkatan' => 'required',
            'dosen_pembimbing' => 'required',
            'surat_rekomendasi' => 'required|mimes:pdf|max:2048',
            'surat_pernyataan' => 'required|mimes:pdf|max:2048',
        ]);

        // Pastikan user sudah login sebelum mengakses Auth::user()
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user(); // Ambil data user yang sedang login

        // Pastikan NIM tersedia di dalam database
        $userData = User::where('NIM', $user->NIM)->first();
        if (!$userData) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Update status user
        $userData->status = '1';
        $userData->save();

        // Tambahkan NIM_id ke dalam data yang akan disimpan
        $credential['NIM_id'] = $user->NIM;


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
        return redirect('/dashboard/pemberkasan')->with('success', 'pemberkasan Berhasil Dibuat');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Ubah pemberkasan';
        $data = Pemberkasan::with('user')->find($id);
        $active = 'pemberkasan';
        $subActive = 'pemberkasan';
        $dosen = User::where('role', 'dosen')->get();

        // dd($data);
        return view('pages.pemberkasan.edit', compact('title', 'data', 'active', 'subActive', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $credential = $request->validate([
            'semester' => 'required',
            'angkatan' => 'required',
            'dosen_pembimbing' => 'required',
            'surat_rekomendasi' => 'mimes:pdf|max:2048',
            'surat_pernyataan' => 'mimes:pdf|max:2048',
        ]);

        $pemberkasan = Pemberkasan::findOrFail($id);

        if ($request->hasFile('surat_rekomendasi')) {
            // Delete the old file if it exists
            if (basename($pemberkasan->file) && file_exists('files/pemberkasan/surat_rekomendasi/' . basename($pemberkasan->file))) {
                unlink('files/pemberkasan/surat_rekomendasi/' . basename($pemberkasan->file));
            }

            $pemberkasan->status_surat_rekomendasi = 'submited';
            $pemberkasan->save();
            $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'rekomendasi')->first();
            if ($reject != null) {
                $reject->status = 'completed';
                $reject->save();
            }

            $file = $request->file('surat_rekomendasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasan/surat_rekomendasi/', $filename);
            $url = url('/files/pemberkasan/surat_rekomendasi/' . $filename);
            $credential['surat_rekomendasi'] = $url;
        }

        if ($request->hasFile('surat_pernyataan')) {
            // Delete the old file if it exists
            if (basename($pemberkasan->file) && file_exists('files/pemberkasan/surat_pernyataan/' . basename($pemberkasan->file))) {
                unlink('files/pemberkasan/surat_pernyataan/' . basename($pemberkasan->file));
            }

            $pemberkasan->status_surat_pernyataan = 'submited';
            $pemberkasan->save();
            $reject = RejectionReasons::where('NIM_id', Auth::user()->NIM)->where('status', 'rejected')->where('file_type', 'pernyataan')->first();
            if ($reject != null) {
                $reject->status = 'completed';
                $reject->save();
            }

            $file = $request->file('surat_pernyataan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/pemberkasan/surat_pernyataan/', $filename);
            $url = url('/files/pemberkasan/surat_pernyataan/' . $filename);
            $credential['surat_pernyataan'] = $url;
        }

        $pemberkasan->update($credential);

        return redirect('/dashboard/pemberkasan')->with('success', 'Pemberkasan Berhasil Diupate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemberkasan = Pemberkasan::find($id);
        if (basename($pemberkasan->image) && file_exists('images/pemberkasan/' . basename($pemberkasan->image))) {
            unlink('images/pemberkasan/' . basename($pemberkasan->image));
        }
        $pemberkasan->delete();
        return redirect('/dashboard/pemberkasan')->with('success', 'Pemberkasan Berhasil Dihapus');
    }
}
