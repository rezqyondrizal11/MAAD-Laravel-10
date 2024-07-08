<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDosenController extends Controller
{
    public function show()
    {
        $page = 'dosen';
        $dosens = Admin::get();
        return view('admin.dosen.dosen_show', compact('dosens', 'page'));
    }
    public function create()
    {
        $page = 'dosen';
        return view('admin.dosen.dosen_create', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:admins,nama',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $dosen_store = new Admin();
        $dosen_store->nama = $request->name;
        $dosen_store->email = $request->email;
        $dosen_store->nidn = $request->nidn;
        $dosen_store->password = Hash::make($request->password);
        $dosen_store->role = 'Dosen';
        $dosen_store->save();
        return redirect()->route('admin_dosen_show');
    }

    public function edit($nama)
    {
        $page = 'dosen';
        $edit = Admin::where('nama', $nama)->first();
        return view('admin.dosen.dosen_edit', compact('edit', 'page'));
    }

    public function update(Request $request, $nama)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $dosen_update = Admin::where('nama', $nama)->first();
        $dosen_update->nama = $request->name;
        $dosen_update->email = $request->email;
        $dosen_update->nidn = $request->nidn;
        $dosen_update->role = $request->role;

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $dosen_update->password = Hash::make($request->password);
        }
        $dosen_update->update();
        return redirect()->route('admin_dosen_show');
    }

    public function delete($nama)
    {
        Admin::where('nama', $nama)->delete();
        return redirect()->route('admin_dosen_show');
    }
}
