<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new GeneralResource(Form::with('template')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'certificate' => ['required', 'boolean'],
            'template_id' => ['required_if:certificate,true', 'exists:templates,id'],
        ]);

        $data = Form::create([
            'title' => $request->title,
            'description' => $request->description,
            'certificate' => $request->certificate,
            'template_id' => $request->template_id
        ]);

        return new GeneralResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $form)
    {
        return new GeneralResource(Form::with('template')->findOrFail($form));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        $form->update([
            'title' => $request->title ?? $form->title,
            'description' => $request->description ?? $form->description,
            'certificate' => $request->certificate ?? $form->certificate,
            'template_id' => $request->template_id ?? $form->template_id,
            'fields' => $request->fields ?? $form->fields,
            'status' => $request->status ?? $form->status
        ]);

        return new GeneralResource($form);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return response()->noContent();
    }
}
