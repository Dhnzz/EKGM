<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\{Responden, Category};

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $title = 'Todo';
        $active = 'todo';
        $subtitle = 'Tambah Todo';
        $category = Category::all();
        $todo = Todo::all();
        $responden = Responden::findOrFail($id);
        return view('admin.master-data.todo.create', compact('title', 'subtitle', 'active', 'todo', 'category', 'responden'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate(
            [
                'date' => 'required',
                'category_id' => 'required',
            ],
            [
                'date.required' => 'Harap mengisi kolom tanggal',
                'category_id.required' => 'Harap mengisi kolom kategori',
            ],
        );

        $data = [];
        foreach ($request['category_id'] as $item) {
            $data[] = [
                'date' => $request['date'],
                'responden_id' => $id,
                'category_id' => $item
            ];
        }

        $todo = Todo::insert($data);
        if ($todo) {
            return redirect()->route('responden.index')->with('success','Berhasil menambahkan Todo');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
