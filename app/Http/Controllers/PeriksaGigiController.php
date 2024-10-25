<?php

namespace App\Http\Controllers;

use App\Models\{PeriksaGigi, Responden};
use Illuminate\Http\Request;

class PeriksaGigiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $title = 'Periksa Gigi';
        $subtitle = 'Tambah Periksa Gigi';
        $active = 'periksaGigi';
        $responden = Responden::findOrFail($id);
        return view('admin.master-data.periksaGigi.create', compact('title', 'subtitle', 'responden', 'active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate(
            [
                'date' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg',
                'result' => 'required',
            ],
            [
                'date.required' => 'Harap isi kolom tanggal',
                'image.required' => 'Harap isi kolom gambar',
                'result' => 'Harap isi hasil klasifikasi',
            ],
        );
        $slug = $request['date'] . $id;

        $image = $request->file('image');
        $imageName = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
        $image->move(public_path('uploads/periksaGigi/image'), $imageName);
        PeriksaGigi::create([
            'date' => $request['date'],
            'image' => $imageName,
            'ohis' => null,
            'result' => $request['result'],
            'responden_id' => $id,
        ]);
        return redirect()->route('responden.index')->with('success', 'Berhasil menambahkan pemeriksaan gigi');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title = 'Periksa Gigi';
        $subtitle = 'Tambah Periksa Gigi';
        $active = 'periksaGigi';
        $periksaGigi = PeriksaGigi::findOrFail($id);
        return view('admin.master-data.periksaGigi.show', compact('title', 'subtitle', 'periksaGigi', 'active'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeriksaGigi $periksaGigi, $id)
    {
        $title = 'Periksa Gigi';
        $subtitle = 'Tambah Periksa Gigi';
        $active = 'periksaGigi';
        $periksaGigi = PeriksaGigi::findOrFail($id);
        return view('admin.master-data.periksaGigi.edit', compact('title', 'subtitle', 'periksaGigi', 'active'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'date' => 'required',
                'image' => 'mimes:png,jpg,jpeg',
                'result' => 'required',
            ],
            [
                'date.required' => 'Harap isi kolom tanggal',
                'result' => 'Harap isi hasil klasifikasi',
            ],
        );
        $periksaGigi = PeriksaGigi::findOrFail($id);

        if ($request->hasFile('image')) {
            $current_image = $request->input('current_image');
            $image = $request['image'];
            $slug = $request['date'] . $id;
            $imageName = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
            $image->move(public_path('uploads/periksaGigi/image'), $imageName);

            if ($current_image) {
                unlink(public_path('uploads/periksaGigi/image/' . $current_image));
            }
            $periksaGigiUpdate = $periksaGigi->update([
                'title' => $request['title'],
                'result' => $request['result'],
                'image' => $imageName,
            ]);
        } else {
            $periksaGigiUpdate = $periksaGigi->update([
                'title' => $request['title'],
                'result' => $request['result'],
            ]);
        }
        return redirect()->route('responden.index')->with('success', 'Berhasil mengubah pemeriksaan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeriksaGigi $periksaGigi, $id)
    {
        $periksaGigi = PeriksaGigi::findOrFail($id);

        $image = $periksaGigi->image;

        unlink(public_path('uploads/periksaGigi/image/' . $image));

        $periksaGigiDelete = $periksaGigi->delete();
        return redirect()->route('responden.index')->with('success', 'Berhasil menghapus pemeriksaan');
    }
}
