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
        $request->validate(
            [
                'title' => 'required',
                'cover' => 'required|mimes:png,jpg,jpeg',
                'content' => 'required',
            ],
            [
                'title.required' => 'Harap isi kolom judul',
                'cover.required' => 'Harap masukkan cover',
                'cover.required' => 'Harap masukkan format PNG, JPG, atau JPEG',
                'content.required' => 'Harap isi kolom konten',
            ],
        );
        $slug = Str::slug($request['title']);

        $image = $request->file('cover');
        $imageName = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
        $image->move(public_path('uploads/article/image'), $imageName);

        $article = Article::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'cover' => $imageName,
        ]);

        if ($article) {
            return redirect()->route('article.index')->with('success', 'Berhasil menambahkan artikel');
        } else {
            return redirect()->route('article.index')->with('error', 'Gagal menambahkan artikel');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title = 'Data Artikel';
        $active = 'artikel';
        $subtitle = 'Detail Artikel';
        $article = Article::findOrFail($id);
        return view('admin.master-data.article.show', compact('article', 'title', 'active', 'subtitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Data Artikel';
        $active = 'artikel';
        $subtitle = 'Detail Artikel';
        $article = Article::findOrFail($id);

        if ($article) {
            return view('admin.master-data.article.edit', compact('title', 'active', 'subtitle', 'article'));
        } else {
            return redirect()->route('article.index')->with('success', 'Artikel tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'cover' => 'mimes:png,jpg,jpeg',
                'content' => 'required',
            ],
            [
                'title.required' => 'Harap isi kolom judul',
                'cover.required' => 'Harap masukkan cover',
                'content.required' => 'Harap isi kolom konten',
            ],
        );
        $article = Article::findOrFail($id);

        if ($request->hasFile('cover')) {
            $current_cover = $request->input('current_cover');
            $image = $request['cover'];
            $slug = Str::slug($request['title']);
            $imageName = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
            $image->move(public_path('uploads/article/image'), $imageName);

            if ($current_cover) {
                unlink(public_path('uploads/article/image/' . $current_cover));
            }
            $articleUpdate = $article->update([
                'title' => $request['title'],
                'content' => $request['content'],
                'cover' => $imageName,
            ]);
        } else {
            $articleUpdate = $article->update([
                'title' => $request['title'],
                'content' => $request['content'],
            ]);
        }
        if ($article) {
            return redirect()->route('article.index')->with('success', 'Berhasil mengubah artikel');
        } else {
            return redirect()->route('article.index')->with('error', 'Gagal mengubah artikel');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $image = $article->cover;

        unlink(public_path('uploads/article/image/' . $image));

        $articleDelete = $article->delete();
        if ($articleDelete) {
            return redirect()->route('article.index')->with('success', 'Berhasil menghapus artikel');
        } else {
            return redirect()->route('article.index')->with('error', 'Gagal menghapus artikel');
        }
    }
}
