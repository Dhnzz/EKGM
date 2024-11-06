<?php

namespace App\Http\Controllers;

use App\Models\{Ohis, Responden};
use Illuminate\Http\Request;

class OhisController extends Controller
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
        $title = 'Responden';
        $active = 'ohis';
        $subtitle = 'Tambah OHIS';
        $responden = Responden::findOrFail($id);
        return view('admin.master-data.ohis.create', compact('title', 'active', 'subtitle', 'responden'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate(
            [
                'date' => 'required',
                'di_1' => 'required',
                'di_2' => 'required',
                'di_3' => 'required',
                'di_4' => 'required',
                'di_5' => 'required',
                'di_6' => 'required',
                'ci_1' => 'required',
                'ci_2' => 'required',
                'ci_3' => 'required',
                'ci_4' => 'required',
                'ci_5' => 'required',
                'ci_6' => 'required',
            ],
            [
                'date.required' => 'Harap isi kolom tanggal',
                'di_1.required' => 'Harap pilih nilai untuk DI 1',
                'di_2.required' => 'Harap pilih nilai untuk DI 2',
                'di_3.required' => 'Harap pilih nilai untuk DI 3',
                'di_4.required' => 'Harap pilih nilai untuk DI 4',
                'di_5.required' => 'Harap pilih nilai untuk DI 5',
                'di_6.required' => 'Harap pilih nilai untuk DI 6',
                'ci_1.required' => 'Harap pilih nilai untuk CI 1',
                'ci_2.required' => 'Harap pilih nilai untuk CI 2',
                'ci_3.required' => 'Harap pilih nilai untuk CI 3',
                'ci_4.required' => 'Harap pilih nilai untuk CI 4',
                'ci_5.required' => 'Harap pilih nilai untuk CI 5',
                'ci_6.required' => 'Harap pilih nilai untuk CI 6',
            ],
        );

        $total_DI = $request->input('di_1') + $request->input('di_2') + $request->input('di_3') + $request->input('di_4') + $request->input('di_5') + $request->input('di_6');
        $total_CI = $request->input('ci_1') + $request->input('ci_2') + $request->input('ci_3') + $request->input('ci_4') + $request->input('ci_5') + $request->input('ci_6');
        $ohi = $total_DI / 6 + $total_CI / 6;
        if ($ohi >= 0 && $ohi <= 1.2) {
            $kesimpulan = 'Buruk';
        } elseif ($ohi >= 1.3 && $ohi <= 3.0) {
            $kesimpulan = 'Sedang';
        } elseif ($ohi >= 3.1 && $ohi <= 6.0) {
            $kesimpulan = 'Baik';
        } else {
            $kesimpulan = 'Tidak Valid';
        }

        $ohis = Ohis::create([
            'responden_id' => $id,
            'date' => $request->input('date'),
            'di_1' => $request->input('di_1'),
            'di_2' => $request->input('di_2'),
            'di_3' => $request->input('di_3'),
            'di_4' => $request->input('di_4'),
            'di_5' => $request->input('di_5'),
            'di_6' => $request->input('di_6'),
            'ci_1' => $request->input('ci_1'),
            'ci_2' => $request->input('ci_2'),
            'ci_3' => $request->input('ci_3'),
            'ci_4' => $request->input('ci_4'),
            'ci_5' => $request->input('ci_5'),
            'ci_6' => $request->input('ci_6'),
            'total_di' => $total_DI,
            'total_ci' => $total_CI,
            'ohi' => $ohi,
            'kesimpulan' => $kesimpulan,
        ]);

        return redirect()->route('responden.show', $id)->with('success', 'Berhasil menambahkan OHIS');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ohis $ohis)
    {
        $title = 'Responden';
        $active = 'ohis';
        $subtitle = 'Detail OHIS';
        return view('admin.master-data.ohis.show', compact('title', 'active', 'subtitle', 'ohis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ohis $ohis)
    {
        $title = 'Responden';
        $active = 'ohis';
        $subtitle = 'Edit OHIS';
        return view('admin.master-data.ohis.edit', compact('title', 'active', 'subtitle', 'ohis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ohis $ohis)
    {
        $request->validate(
            [
                'date' => 'required',
                'di_1' => 'required',
                'di_2' => 'required',
                'di_3' => 'required',
                'di_4' => 'required',
                'di_5' => 'required',
                'di_6' => 'required',
                'ci_1' => 'required',
                'ci_2' => 'required',
                'ci_3' => 'required',
                'ci_4' => 'required',
                'ci_5' => 'required',
                'ci_6' => 'required',
            ],
            [
                'date.required' => 'Harap isi kolom tanggal',
                'di_1.required' => 'Harap pilih nilai untuk DI 1',
                'di_2.required' => 'Harap pilih nilai untuk DI 2',
                'di_3.required' => 'Harap pilih nilai untuk DI 3',
                'di_4.required' => 'Harap pilih nilai untuk DI 4',
                'di_5.required' => 'Harap pilih nilai untuk DI 5',
                'di_6.required' => 'Harap pilih nilai untuk DI 6',
                'ci_1.required' => 'Harap pilih nilai untuk CI 1',
                'ci_2.required' => 'Harap pilih nilai untuk CI 2',
                'ci_3.required' => 'Harap pilih nilai untuk CI 3',
                'ci_4.required' => 'Harap pilih nilai untuk CI 4',
                'ci_5.required' => 'Harap pilih nilai untuk CI 5',
                'ci_6.required' => 'Harap pilih nilai untuk CI 6',
            ],
        );

        $total_DI = $request->input('di_1') + $request->input('di_2') + $request->input('di_3') + $request->input('di_4') + $request->input('di_5') + $request->input('di_6');
        $total_CI = $request->input('ci_1') + $request->input('ci_2') + $request->input('ci_3') + $request->input('ci_4') + $request->input('ci_5') + $request->input('ci_6');
        $ohi = $total_DI / 6 + $total_CI / 6;
        if ($ohi >= 0 && $ohi <= 1.2) {
            $kesimpulan = 'Buruk';
        } elseif ($ohi >= 1.3 && $ohi <= 3.0) {
            $kesimpulan = 'Sedang';
        } elseif ($ohi >= 3.1 && $ohi <= 6.0) {
            $kesimpulan = 'Baik';
        } else {
            $kesimpulan = 'Tidak Valid';
        }

        $ohis->update([
            'date' => $request->input('date'),
            'di_1' => $request->input('di_1'),
            'di_2' => $request->input('di_2'),
            'di_3' => $request->input('di_3'),
            'di_4' => $request->input('di_4'),
            'di_5' => $request->input('di_5'),
            'di_6' => $request->input('di_6'),
            'ci_1' => $request->input('ci_1'),
            'ci_2' => $request->input('ci_2'),
            'ci_3' => $request->input('ci_3'),
            'ci_4' => $request->input('ci_4'),
            'ci_5' => $request->input('ci_5'),
            'ci_6' => $request->input('ci_6'),
            'total_di' => $total_DI,
            'total_ci' => $total_CI,
            'ohi' => $ohi,
            'kesimpulan' => $kesimpulan,
        ]);

        return redirect()->route('responden.show', $ohis->responden->id)->with('success', 'Berhasil mengubah OHIS');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ohis $ohis)
    {
        $id = $ohis->responden->id;
        $ohis->delete();
        return redirect()->route('responden.show', $id)->with('success', 'Berhasil menghapus OHIS');
    }
}
