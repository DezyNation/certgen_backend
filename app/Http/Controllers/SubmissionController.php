<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ResponseExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\GeneralResource;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class SubmissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        new GeneralResource(Submission::paginate(30));
    }

    public function download($id = null)
    {
        return Excel::download(new ResponseExport($id), "responses.xlsx");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        $bool = Submission::where('form_id', $request->form_id)->where('email', $request->email)->exists();

        if ($bool) {
            abort(422, "Form already submitted.");
        }

        $data = Submission::create([
            'certificate_id' => "iTAS" . "-" . Str::random(8),
            'student_id' => $request->student_id,
            'form_id' => $request->form_id,
            'data' => json_encode($request->all()),
            'email' => $request->email,
            'name' => $request->name
        ]);

        return new GeneralResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Submission::where('certificate_id', $id)->with(['form' =>  function ($q) {
            $q->select('event_name', 'id');
        }])->get();
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
