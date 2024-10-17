<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Artikel';
        $active = 'artikel';
        $article_data = Article::all();
        return view('admin.master-data.article.index', compact('article_data', 'title', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Data Atikel';
        $active = 'artikel';
        $subtitle = 'Tambah Artikel';
        return view('admin.master-data.article.create', compact('subtitle', 'title', 'active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover' => 'required|mimes:png,jpg,jpeg',
            'content' => 'required'
        ],[
            'title.required' => 'Harap isi kolom judul',
            'cover.required' => 'Harap masukkan cover',
            'cover.required' => 'Harap masukkan format PNG, JPG, atau JPEG',
            'content.required' => 'Harap isi kolom konten',
        ]);
        $slug = Str::slug($request['title']);

        $image = $request->file('cover');
        $imageName = time() . '-' . rand(1,100) . '-' . $slug .'.'.$image->extension();
        $image->move(public_path('uploads/article/image'), $imageName);

        $article = Article::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'cover' => $imageName
        ]);

        if ($article) {
            return redirect()->route('article.index')->with('success', 'Berhasil menambahkan artikel');
        }else{
            return redirect()->route('article.index')->with('error', 'Gagal menambahkan artikel');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
