<?php

namespace App\Http\Controllers;

use App\Models\{Responden, Kuesioner, RespondenKuesioner, Todo, PeriksaGigi};
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Responden';
        $active = 'responden';
        $responden = Responden::all();
        return view('admin.master-data.responden.index', compact('active', 'responden', 'title'));
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
                'phone' => 'required|unique:respondens,phone',
                'birth_date' => 'date|required',
            ],
            [
                'name.required' => 'Harap isi kolom nama',
                'phone.required' => 'Harap isi kolom nomor telepon',
                'phone.unique' => 'Nomor telepon sudah terdaftar',
                'birth_date.required' => 'Harap isi kolom tanggal lahir',
                'birth_date.date' => 'Harap menggunakan format tanggal yang benar',
            ],
        );

        $responden = Responden::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
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
        $title = 'Responden';
        $active = 'responden';
        $subtitle = 'Detail Responden';
        $responden = Responden::findOrFail($id);
        $kuesioner = Kuesioner::with('respondenKuesioners')
            ->whereHas('respondenKuesioners', function ($query) {
                $query->where('answer', '!=', null);
            })
            ->get();
        $todo = Todo::where('responden_id', '=', $id)->get();
        $periksaGigi = PeriksaGigi::where('responden_id', '=', $id)->get();
        return view('admin.master-data.responden.show', compact('responden', 'title', 'active', 'subtitle', 'responden', 'kuesioner', 'todo', 'periksaGigi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Responden';
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
                'phone' => 'required',
                'birth_date' => 'date|required',
            ],
            [
                'name.required' => 'Harap isi kolom nama',
                'email.required' => 'Harap isi kolom nomor telepon',
                'birth_date.required' => 'Harap isi kolom tanggal lahir',
                'birth_date.date' => 'Harap menggunakan format tanggal yang benar',
            ],
        );
        $responden = Responden::findOrFail($id);

        $respondenUpdate = $responden->update([
            'name' => $request['name'],
            'phone' => $request['phone'],
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
        $title = 'Responden';
        $subtitle = 'Respon Kuesioner';
        $responden = Responden::findOrFail($id);
        $kuesioner = Kuesioner::where('isActive', 1)->get();
        return view('admin.master-data.responden.respond_kuesioner', compact('responden', 'kuesioner', 'title', 'subtitle'));
    }

    public function respond(Request $request)
    {
        $responden = Responden::findOrFail($request['responden_id']);
        $data = [];
        foreach ($request['answers'] as $questionId => $answer) {
            $data[] = [
                'responden_id' => $request['responden_id'],
                'kuesioner_id' => $request['kuesioner_id'],
                'question_id' => $questionId,
                'answer' => $answer,
            ];
        }

        RespondenKuesioner::insert($data);

        return redirect()->route('responden.index')->with('success', 'Berhasil menambahkan data');
    }

    public function show_detail_kuesioner($id)
    {
        $title = 'Responden';
        $subtitle = 'Detail Kuesioner';
        $kuesioner = RespondenKuesioner::where('responden_id', '=', $id)->where('answer', '!=', null)->get();
        return view('admin.master-data.responden.show_detail_kuesioner', compact('kuesioner', 'title', 'subtitle'));
    }

    public function edit_respond($id)
    {
        $title = 'Responden';
        $subtitle = 'Edit Respons';
        $kuesioner = RespondenKuesioner::where('responden_id', '=', $id)->where('answer', '!=', null)->get();
        return view('admin.master-data.responden.edit_respond', compact('kuesioner', 'title', 'subtitle'));
    }

    public function update_respond(Request $request, $id)
    {
        // $responden = Responden::findOrFail($request)
        foreach ($request['answers'] as $item => $value) {
            $respond = RespondenKuesioner::findOrFail($item);
            $respond->update([
                'answer' => $value,
            ]);
        }

        return redirect()
            ->route('responden.show_detail_kuesioner', $respond->responden_id)
            ->with('success', 'Berhasil mengubah jawaban');
    }

    public function destroy_respond($id)
    {
        $responden = RespondenKuesioner::where('responden_id', '=', $id)->get();
        foreach ($responden as $item => $value) {
            $respond = RespondenKuesioner::findOrFail($value->id);
            $respond->delete();
        }
        return redirect()
            ->route('responden.index', $respond->responden_id)
            ->with('success', 'Berhasil mengubah jawaban');
    }
}
