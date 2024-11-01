<?php

namespace App\Http\Controllers;

use App\Models\{Kuesioner, Question, Responden};
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kuesioner';
        $active = 'kuesioner';
        $kuesioner_data = Kuesioner::all();
        return view('admin.master-data.kuesioner.index', compact('kuesioner_data', 'title', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Kuesioner';
        $active = 'kuesioner';
        $subtitle = 'Tambah Kuesioner';
        return view('admin.master-data.kuesioner.create', compact('subtitle', 'title', 'active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kuesioner = Kuesioner::create([
            'name' => $request['name'],
            'isActive' => 0,
        ]);
        if ($kuesioner) {
            // dump($request['questions']);
            foreach ($request['questions'] as $item) {
                // dump($item);
                $question = Question::create([
                    'kuesioner_id' => $kuesioner->id,
                    'question' => $item,
                ]);
            }
            return redirect()->route('kuesioner.index')->with('success', 'Berhasil menambah kuesioner!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambah kuesioner');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title = 'Kuesioner';
        $active = 'kuesioner';
        $subtitle = 'Detail Kuesioner';
        $data = Kuesioner::find($id);
        return view('admin.master-data.kuesioner.show', compact('subtitle', 'title', 'data', 'active'));
    }

    public function status_change($id)
    {
        $kuesioner = Kuesioner::findOrFail($id);
        if ($kuesioner->isActive == 0) {
            $kuesioner->update([
                'isActive' => 1,
            ]);
            return redirect()
                ->route('kuesioner.index')
                ->with('success', 'Berhasil mengaktifkan kuesioner ' . $kuesioner->name);
        } elseif ($kuesioner->isActive == 1) {
            $kuesioner->update([
                'isActive' => 0,
            ]);
            return redirect()
                ->route('kuesioner.index')
                ->with('success', 'Berhasil menonaktifkan kuesioner ' . $kuesioner->name);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Kuesioner::findOrFail($id);
        $active = 'kuesioner';
        $title = 'Kuesioner';
        $subtitle = 'Edit Kuesioner';
        return view('admin.master-data.kuesioner.edit', compact('subtitle', 'title', 'data', 'active'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kuesioner = Kuesioner::findOrFail($id);
        $kuesioner->update([
            'name' => $request['name'],
            'isActive' => 0,
        ]);

        if ($kuesioner) {
            $questionIds = collect($request['questions'])
                ->pluck('id')
                ->filter();
            $kuesioner->questions()->whereNotIn('id', $questionIds)->delete();
            foreach ($request['questions'] as $item) {
                if (isset($item['id'])) {
                    $question = $kuesioner->questions->where('id', $item['id'])->first();

                    $question->update([
                        'question' => $item['question'],
                    ]);
                } else {
                    Question::create([
                        'kuesioner_id' => $kuesioner['id'],
                        'question' => $item['question'],
                    ]);
                }
            }
        }
        return redirect()->route('kuesioner.index')->with('success', 'Berhasil mengubah kuesioner!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kuesioner::find($id)->delete();
        return redirect()->route('kuesioner.index')->with('success', 'Berhasil menghapus kuesioner!');
    }

    public function show_responden($id)
    {
        $title = 'Kuesioner';
        $active = 'kuesioner';
        $subtitle = 'Detail Respons';
        $data = Kuesioner::find($id);
        $responden = Responden::with('kuesioner')->whereHas('kuesioner')->get();
        return view('admin.master-data.kuesioner.show_responden', compact('subtitle', 'title', 'data', 'active', 'responden'));
    }
}
