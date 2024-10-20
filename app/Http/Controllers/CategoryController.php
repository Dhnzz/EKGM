<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kategori';
        $active = 'category';
        $category_data = Category::all();
        return view('admin.master-data.category.index', compact('title', 'active', 'category_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Kategori';
        $active = 'category';
        $subtitle = 'Tambah Kategori';
        return view('admin.master-data.category.create', compact('title', 'active', 'subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories,name',
            ],
            [
                'name.required' => 'Harap isi kolom nama kategori',
                'name.unique' => 'Kategori sudah terdaftar',
            ],
        );

        $category = Category::create([
            'name' => $request['name'],
        ]);
        if ($category) {
            return redirect()->route('category.index')->with('success', 'Berhasil menambahkan kategori');
        } else {
            return redirect()->route('category.index')->with('error', 'Gagal menambahkan kategori');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Kategori';
        $active = 'category';
        $subtitle = 'Edit Kategori';
        $category = Category::findOrFail($id);
        return view('admin.master-data.category.edit', compact('title','active','subtitle','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(
            [
                'name' => 'required|unique:categories,name',
            ],
            [
                'name.required' => 'Harap isi kolom nama kategori',
                'name.required' => 'Kategori sudah terdaftar',
            ],
        );

        $categoryUpdate = $category->update([
            'name' => $request['name'],
        ]);
        if ($categoryUpdate) {
            return redirect()->route('category.index')->with('success', 'Berhasil mengubah kategori');
        } else {
            return redirect()->route('category.index')->with('error', 'Gagal mengubah kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $categoryDelete = $category->delete();
        if ($categoryDelete) {
            return redirect()->route('category.index')->with('success','Berhasil menghapus kategori');
        } else {
            return redirect()->route('category.index')->with('error','Gagal menghapus kategori');
        }

    }
}
