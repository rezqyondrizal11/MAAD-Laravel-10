<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPriceController extends Controller
{
    public function show()
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'Admin') {
            $page = 'price';
            $price = Price::get();
            return view('admin.price.price_show', compact('price', 'page'));
        } else {
            return redirect()->route('admin_login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
    public function create()
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'Admin') {
            $page = 'price';
            return view('admin.price.price_create', compact('page'));
        } else {
            return redirect()->route('admin_login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'priceName' => 'required',
        ]);

        $store = new Price();
        $store->name = $request->priceName;
        $store->price = $request->price;
        $store->save();

        return redirect()->route('admin_price_show')->with('success', 'Berhasil Tambah Price');
    }
    public function edit($name)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'Admin') {
            $page = 'price';
            $edit = Price::where('name', $name)->first();
            return view('admin.price.price_edit', compact('edit', 'page'));
        } else {
            return redirect()->route('admin_login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
    public function update(Request $request, $name)
    {
        $request->validate([
            'priceName' => 'required',
        ]);

        $update = Price::where('name', $name)->first();
        $update->name = $request->priceName;
        $update->price = $request->price;
        $update->update();

        return redirect()->route('admin_price_show')->with('success', 'Berhasil Update Price');
    }
    public function delete($name)
    {
        Price::where('name', $name)->delete();
        return redirect()->route('admin_price_show')->with('success', 'Berhasil Hapus Price');
    }
}
