<?php

namespace App\Http\Controllers\Api;

use App\Models\{Kuesioner, Question, Responden};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class KuesionerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kuesioners = Kuesioner::all();
        return response()->json([
            'success' => true,
            'data' => $kuesioners,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $kuesioner = Kuesioner::create([
            'name' => $request->name,
            'isActive' => 0,
        ]);

        if ($kuesioner) {
            foreach ($request->questions as $item) {
                Question::create([
                    'kuesioner_id' => $kuesioner->id,
                    'question' => $item,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Kuesioner created successfully',
                'data' => $kuesioner,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create kuesioner',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kuesioner = Kuesioner::with('questions')->find($id);

        if (!$kuesioner) {
            return response()->json([
                'success' => false,
                'message' => 'Kuesioner not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $kuesioner
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $kuesioner = Kuesioner::find($id);

        if (!$kuesioner) {
            return response()->json([
                'success' => false,
                'message' => 'Kuesioner not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $kuesioner->update([
            'name' => $request->name,
            'isActive' => 0,
        ]);

        // Updating questions
        $questionIds = collect($request->questions)->pluck('id')->filter();
        $kuesioner->questions()->whereNotIn('id', $questionIds)->delete();

        foreach ($request->questions as $item) {
            if (isset($item['id'])) {
                $question = Question::find($item['id']);
                if ($question) {
                    $question->update(['question' => $item['question']]);
                }
            } else {
                Question::create([
                    'kuesioner_id' => $kuesioner->id,
                    'question' => $item['question'],
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Kuesioner updated successfully',
            'data' => $kuesioner,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kuesioner = Kuesioner::find($id);

        if (!$kuesioner) {
            return response()->json([
                'success' => false,
                'message' => 'Kuesioner not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $kuesioner->questions()->delete();
        $kuesioner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kuesioner deleted successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Toggle the status of a kuesioner.
     */
    public function statusChange($id)
    {
        $kuesioner = Kuesioner::findOrFail($id);

        $kuesioner->update([
            'isActive' => !$kuesioner->isActive,
        ]);

        $status = $kuesioner->isActive ? 'activated' : 'deactivated';

        return response()->json([
            'success' => true,
            'message' => "Kuesioner successfully {$status}",
        ], Response::HTTP_OK);
    }

    /**
     * Show the respondents associated with a specific kuesioner.
     */
    public function showResponden($id)
    {
        $kuesioner = Kuesioner::find($id);

        if (!$kuesioner) {
            return response()->json([
                'success' => false,
                'message' => 'Kuesioner not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $respondens = Responden::with('kuesioner')
            ->whereHas('kuesioner', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'kuesioner' => $kuesioner,
                'respondens' => $respondens,
            ],
        ], Response::HTTP_OK);
    }
}
