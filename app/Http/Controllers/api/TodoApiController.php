<?php

namespace App\Http\Controllers\Api;

use App\Models\CategoryTodo;
use App\Models\Todo;
use App\Models\Responden;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class TodoApiController extends Controller
{
    /**
     * Display a listing of todos.
     */
    public function index()
    {
        $todos = Todo::with('category', 'responden')->get();
        return response()->json([
            'success' => true,
            'data' => $todos,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created todo in storage.
     */
    public function store(Request $request, $responden_id)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'category_id' => 'required|array',
        ], [
            'date.required' => 'Harap mengisi kolom tanggal',
            'category_id.required' => 'Harap mengisi kolom kategori',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Prepare data for multiple categories
        $data = [];
        foreach ($request->category_id as $categoryId) {
            $data[] = [
                'date' => $request->date,
                'responden_id' => $responden_id,
                'category_id' => $categoryId,
            ];
        }

        // Insert todos
        $created = Todo::insert($data);

        if ($created) {
            return response()->json([
                'success' => true,
                'message' => 'Todo berhasil ditambahkan',
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan Todo',
        ], Response::HTTP_BAD_REQUEST);
    }

    public function getByDate($date)
    {
        $todos = Todo::whereDate('date', $date)->first();

        if ($todos->isEmpty()) {

        }

        return response()->json([
            'success' => true,
            'data' => $todos->category(),
        ], Response::HTTP_OK);
    }

    public function getByUser($id)
    {
        // Retrieve todos for the given user ID
        $todos = Todo::where('responden_id', $id)->get();

        // Check if there are no todos
        if ($todos->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada Todo pada tanggal ini',
                'data' => []
            ], Response::HTTP_NOT_FOUND);
        }

        // Structure the todos with their categoryTodos
        $todosWithCategories = $todos->map(function ($todo) {
            // Retrieve CategoryTodos associated with this todo
            $categories = CategoryTodo::where('todo_id', $todo->id)->get();

            return [
                'todo_id' => $todo->id,
                'date' => $todo->date,
                'categories' => $categories, // Manually fetched CategoryTodo records
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $todosWithCategories,
        ], Response::HTTP_OK);
    }

    public function postByUser($id, Request $request)
    {
        // Validate the incoming request to ensure 'date' and 'categories' are provided
        $request->validate([
            'date' => 'required|date',
            'categories' => 'required|array',
            'categories.*.category_id' => 'required|integer',
        ]);

        $date = $request->input('date');
        $categories = $request->input('categories');

        // Check if a Todo already exists for this user and date
        $existingTodo = Todo::where('responden_id', $id)
            ->where('date', $date)
            ->first();

        if ($existingTodo) {
            // Retrieve existing CategoryTodo records for this Todo
            $existingCategoryTodos = CategoryTodo::where('todo_id', $existingTodo->id)->get();

            // Extract category IDs from the request
            $newCategoryIds = collect($categories)->pluck('category_id')->toArray();

            // Remove CategoryTodos that are not in the new categories list
            foreach ($existingCategoryTodos as $existingCategoryTodo) {
                if (!in_array($existingCategoryTodo->category_id, $newCategoryIds)) {
                    $existingCategoryTodo->delete();
                }
            }

            // Add new CategoryTodos that don’t already exist
            foreach ($newCategoryIds as $categoryId) {
                $existingCategory = $existingCategoryTodos->firstWhere('category_id', $categoryId);
                if (!$existingCategory) {
                    CategoryTodo::create([
                        'todo_id' => $existingTodo->id,
                        'category_id' => $categoryId,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Todo already exists for this date and has been updated.',
                'data' => $existingTodo,
            ], Response::HTTP_OK);

        } else {
            // If no Todo exists, create a new one
            $newTodo = Todo::create([
                'date' => $date,
                'responden_id' => $id,
            ]);

            // Create CategoryTodo records for the new Todo
            foreach ($categories as $category) {
                CategoryTodo::create([
                    'todo_id' => $newTodo->id,
                    'category_id' => $category['category_id'],
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'New Todo created successfully.',
                'data' => $newTodo,
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified todo.
     */
    public function show($id)
    {
        $todo = Todo::with('category', 'responden')->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $todo,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified todo in storage.
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'category_id' => 'required|integer|exists:categories,id',
        ], [
            'date.required' => 'Harap mengisi kolom tanggal',
            'category_id.required' => 'Harap mengisi kolom kategori',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $todo->update([
            'date' => $request->date,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Todo berhasil diubah',
            'data' => $todo,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified todo from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }

        $deleted = $todo->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Todo berhasil dihapus',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus Todo',
        ], Response::HTTP_BAD_REQUEST);
    }
}
