<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Models\Submission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        new GeneralResource(Submission::paginate(30));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Submission::create([
            'certificate_id' => uniqid(),
            'student_id' => $request->student_id,
            'form_id' => $request->form_id,
            'data' => json_encode($request->all()),
            'name' => $request->name
        ]);

        return new GeneralResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Submission::where('certificate_id', $id)->get();
        return new GeneralResource($data);
    }

    public function responses(string $id)
    {
        $data = Submission::where('form_id', $id)->get();
        return new GeneralResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update([
            'approved' => $request->approved ?? $submission->approved
        ]);

        return new GeneralResource($submission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();
        return response()->noContent();
    }
}
