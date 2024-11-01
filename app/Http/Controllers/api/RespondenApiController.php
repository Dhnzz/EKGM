<?php

namespace App\Http\Controllers\Api;

use App\Models\Responden;
use App\Models\Kuesioner;
use App\Models\RespondenKuesioner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Log;

class RespondenApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $respondens = Responden::all();
        return response()->json([
            'success' => true,
            'data' => $respondens,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:respondens,phone',
            'birth_date' => 'required|date',
        ]);

        // Check if the phone number already exists
        $existingResponden = Responden::where('phone', $validatedData['phone'])->first();

        if ($existingResponden) {
            $existingResponden->fill($validatedData);
            $existingResponden->save();

            return response()->json([
                'success' => true,
                'already_registered' => true,
                'message' => 'Responden Sudah Terdaftar',
                'data' => $existingResponden,
            ], Response::HTTP_OK);
        }

        // Create a new Responden if not already registered
        try {
            $responden = Responden::create($validatedData);

            return response()->json([
                'success' => true,
                'already_registered' => false,
                'message' => 'Responden berhasil ditambahkan',
                'data' => $responden,
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            // Handle any exceptions during creation
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan responden',
                'error' => $e->getMessage(), // Log the actual error message for debugging
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $responden = Responden::find($id);

        if ($responden) {
            $kuesioner = Kuesioner::with('respondenKuesioners')
                ->whereHas('respondenKuesioners', function ($query) {
                    $query->where('answer', '!=', null);
                })
                ->get();

            return response()->json([
                'success' => true,
                'data' => $responden,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Responden tidak ditemukan',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:respondens,phone,' . $id,
            'birth_date' => 'date|required',
        ]);

        $responden = Responden::find($id);

        if ($responden) {
            $responden->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Responden berhasil diubah',
                'data' => $responden,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengubah responden',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $responden = Responden::find($id);

        if ($responden) {
            $responden->delete();

            return response()->json([
                'success' => true,
                'message' => 'Responden berhasil dihapus',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Responden tidak ditemukan',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Respond to a kuesioner.
     */
    public function respondKuesioner(Request $request, $id)
    {
        // $request->validate([
        //     'responden_id' => 'required|exists:respondens,id',
        //     'answers' => 'required|array',
        //     'answers.*' => 'required',
        // ]);

        Log::info($request->all());
        $responden = Responden::find($request->responden_id);
        if (!$responden) {
            Log::info('HERE', $responden);
            return response()->json([
                'success' => false,
                'message' => 'Responden tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }
        $data = [];
        foreach ($request->answer as $answerData) {
            $data[] = [
                'responden_id' => $request->responden_id,
                'kuesioner_id' => $request->kuesioner_id,
                'question_id' => $answerData['question_id'],
                'answer' => $answerData['answer'],
            ];
        }

        RespondenKuesioner::insert($data);

        return response()->json([
            'success' => true,
            'message' => 'Respon kuesioner berhasil ditambahkan',
            'data' => Kuesioner::with('questions')->find($request->kuesioner_id),
        ], Response::HTTP_CREATED);

    }

}
