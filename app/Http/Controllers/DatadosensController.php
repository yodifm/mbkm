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
        $data = User::where('role', 'dosen')->get();
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
        $data = user::all();
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
            'NIM' => 'required|unique:users,NIM',
            'name' => 'required',
            'password' => 'required',
        ]);

        $credential['role'] = 'dosen';
        user::create($credential);
        return redirect('/dashboard/datadosens')->with('success', 'data dosen created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Data MBKM';
        $data = user::find($id);
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
            'NIM' => 'nullable|unique:users,NIM,' . $id,
            'name' => 'nullable',
            'password' => 'confirmed',
        ]);

        $dosen = user::find($id);
        $dosen->update($credential);

        return redirect('/dashboard/datadosens')->with('success', 'Data dosen updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = user::find($id);
        $dosen->delete();
        return redirect('/dashboard/datadosens')->with('success', 'Data dosen deleted successfully');
    }
}
