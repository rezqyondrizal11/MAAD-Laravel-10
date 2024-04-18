<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCategoryController extends Controller
{
    public function show()
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'Admin') {
            $page = 'category';
            $categories = Category::get();
            return view('admin.category.category_show', compact('categories', 'page'));
        } else {
            return redirect()->route('admin_login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }

    public function create()
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'Admin') {
            $page = 'category';
            return view('admin.category.category_create', compact('page'));
        } else {
            return redirect()->route('admin_login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category_name = $request->category_name;

        $category_id = null;
        switch ($category_name) {
            case 'Photo':
                $category_id = 3;
                break;
            case 'Video':
                $category_id = 4;
                break;
            case 'Audio':
                $category_id = 5;
                break;
            case 'Awok':
                $category_id = 15;
                break;
        }

        $category_store = new Category();
        $category_store->id = $category_id;
        $category_store->name = $category_name;
        $category_store->show_on_menu = 'Show';
        $category_store->save();
        return redirect()->route('admin_category_show');
    }

    public function edit($name)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'Admin') {
            $page = 'category';
            $edit = Category::where('name', $name)->first();
            return view('admin.category.category_edit', compact('edit', 'page'));
        } else {
            return redirect()->route('admin_login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }

    public function update(Request $request, $name)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category_update = Category::where('name', $name)->first();
        $category_update->name = $request->category_name;
        $category_update->show_on_menu = $request->show_on_menu;
        $category_update->update();
        return redirect()->route('admin_category_show');
    }

    public function delete($name)
    {
        Category::where('name', $name)->delete();
        return redirect()->route('admin_category_show');
    }
}
