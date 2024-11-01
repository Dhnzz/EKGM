<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ArticleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return response()->json([
            'success' => true,
            'data' => $articles,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover' => 'required|mimes:png,jpg,jpeg',
            'content' => 'required',
        ]);

        // Generate slug for the article title
        $slug = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imageName = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
            $image->move(public_path('uploads/article/image'), $imageName);
        }

        // Create the article
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'cover' => $imageName ?? null,
        ]);

        if ($article) {
            return response()->json([
                'success' => true,
                'message' => 'Article created successfully',
                'data' => $article,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create article',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::find($id);

        if ($article) {
            return response()->json([
                'success' => true,
                'data' => $article,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Article not found',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'title' => 'required',
            'cover' => 'mimes:png,jpg,jpeg',
            'content' => 'required',
        ]);

        // Update cover image if provided
        if ($request->hasFile('cover')) {
            $currentCover = $article->cover;
            $image = $request->file('cover');
            $slug = Str::slug($request->title);
            $imageName = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
            $image->move(public_path('uploads/article/image'), $imageName);

            // Remove old cover if exists
            if ($currentCover) {
                unlink(public_path('uploads/article/image/' . $currentCover));
            }

            // Update the article with the new cover
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'cover' => $imageName,
            ]);
        } else {
            // Update without changing the cover
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => $article,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
            ], Response::HTTP_NOT_FOUND);
        }

        // Remove the cover image if it exists
        if ($article->cover) {
            unlink(public_path('uploads/article/image/' . $article->cover));
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully',
        ], Response::HTTP_OK);
    }
}
