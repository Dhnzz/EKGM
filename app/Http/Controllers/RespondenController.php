<?php

namespace App\Http\Controllers;

use App\Models\{Responden, Kuesioner, AnswerResponden};
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active = 'Responden';
        $responden = Responden::all();
        return view('admin.master-data.responden.index', compact('active', 'responden'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Responden';
        $subtitle = 'Tambah Responden';
        return view('admin.master-data.responden.create', compact('title', 'subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:respondens,email',
                'birth_date' => 'date|required',
            ],
            [
                'name.required' => 'Harap isi kolom nama',
                'email.required' => 'Harap isi kolom email',
                'email.email' => 'Harap menggunakan format email seperti: pengguna@example.com',
                'email.unique' => 'Email sudah terdaftar',
                'birth_date.required' => 'Harap isi kolom tanggal lahir',
                'birth_date.date' => 'Harap menggunakan format tanggal yang benar',
            ],
        );

        $responden = Responden::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'birth_date' => $request['birth_date'],
        ]);
        if ($responden) {
            return redirect()->route('responden.index')->with('success', 'Berhasil menambahkan responden');
        } else {
            return redirect()->route('responden.index')->with('error', 'Gagal menambahkan responden');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title = 'Data Responden';
        $active = 'responden';
        $subtitle = 'Detail Responden';
        $responden = Responden::findOrFail($id);
        $question = $responden->question();
        $kuesioner = $question->kuesioner;

        dd($kuesioner);
        return view('admin.master-data.responden.show', compact('responden', 'title', 'active', 'subtitle', 'responden','kuesioner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Data Responden';
        $subtitle = 'Edit Responden';
        $responden = Responden::findOrFail($id);
        return view('admin.master-data.responden.edit', compact('title', 'subtitle', 'responden'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'birth_date' => 'date|required',
            ],
            [
                'name.required' => 'Harap isi kolom nama',
                'email.required' => 'Harap isi kolom email',
                'email.email' => 'Harap menggunakan format email seperti: pengguna@example.com',
                'birth_date.required' => 'Harap isi kolom tanggal lahir',
                'birth_date.date' => 'Harap menggunakan format tanggal yang benar',
            ],
        );
        $responden = Responden::findOrFail($id);

        $respondenUpdate = $responden->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'birth_date' => $request['birth_date'],
        ]);

        if ($respondenUpdate) {
            return redirect()->route('responden.index')->with('success', 'Berhasil mengubah responden');
        } else {
            return redirect()->route('responden.index')->with('success', 'Berhasil mengubah responden');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $responden = Responden::findOrFail($id);
        $respondenDelete = $responden->delete();
        if ($respondenDelete) {
            return redirect()->route('responden.index')->with('success', 'Berhasil menghapus responden');
        } else {
            return redirect()->route('responden.index')->with('error', 'Gagal menghapus responden');
        }
    }

    public function respond_kuesioner($id)
    {
        $title = 'Data Responden';
        $subtitle = 'Respon Kuesioner';
        $responden = Responden::findOrFail($id);
        $kuesioner = Kuesioner::all();
        return view('admin.master-data.responden.respond_kuesioner', compact('responden', 'kuesioner', 'title', 'subtitle'));
    }

    public function respond(Request $request)
    {
        $responden = Responden::findOrFail($request['responden_id']);
        $responden->kuesioner()->attach($request['kuesioner_id']);
        // dump($responden->answers());
        foreach ($request->input('answers') as $item => $value) {
            $checkAnswer = $responden->question->where('question_id', $item)->first();
            if ($checkAnswer) {
                $responden->question->updateExistingPivot($item, ['answer' => $value]);
            }else{
                $responden->question()->attach($item, ['answer' => $value]);
            }
        }
        return redirect()->route('responden.index')->with('success', 'Berhasil menyimpan jawaban');
    }
}
