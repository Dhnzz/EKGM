<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\{Responden, Category, CategoryTodo};

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

        $todo = Todo::create([
            'date' => $request['date'],
            'responden_id' => $id,
        ]);

        $data = [];
        foreach ($request['category_id'] as $item => $value) {
            $data[] = [
                'todo_id' => $todo->id,
                'category_id' => $value,
            ];
        }

        $categoryTodo = CategoryTodo::insert($data);
        if ($categoryTodo) {
            return redirect()->route('responden.index')->with('success', 'Berhasil menambahkan Todo');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo, $id)
    {
        $title = 'Todo';
        $active = 'todo';
        $subtitle = 'Detail Todo';
        $todo = Todo::findOrFail($id);
        $category = Category::all();
        $todoCategory = CategoryTodo::where('todo_id', '=', $todo->id)->get();
        return view('admin.master-data.todo.edit', compact('title', 'active', 'subtitle', 'category', 'todo', 'todoCategory'));
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
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        // $todo->update([
        //     'date' => $request['date'],
        // ]);
        if ($todo) {
            $categoryIds = collect($request['category_id']);
            $kuesioner->question()->whereNotIn('id', $questionIds)->delete();
            foreach ($request['category_id'] as $item) {
                if (isset($item)) {
                    // $categoryTodo = $todo->question->where('id', $item['id'])->first();
                    $categoryTodo = $todo->category->first();
                    dump($categoryTodo);

                    // $question->update([
                    //     'question' => $item['question'],
                    // ]);
                } else {
                    // Question::create([
                    //     'kuesioner_id' => $kuesioner['id'],
                    //     'question' => $item,
                    // ]);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
