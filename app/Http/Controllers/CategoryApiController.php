<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'data' => $categories,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
        ], [
            'name.required' => 'Harap isi kolom nama kategori',
            'name.unique' => 'Kategori sudah terdaftar',
        ]);

        // Return error response if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create category
        $category = Category::create([
            'name' => $request->name,
        ]);

        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $category,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan kategori',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $category,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $id,
        ], [
            'name.required' => 'Harap isi kolom nama kategori',
            'name.unique' => 'Kategori sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Update the category
        $categoryUpdate = $category->update([
            'name' => $request->name,
        ]);

        if ($categoryUpdate) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diubah',
                'data' => $category,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengubah kategori',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }

        $categoryDelete = $category->delete();

        if ($categoryDelete) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus kategori',
        ], Response::HTTP_BAD_REQUEST);
    }
}
