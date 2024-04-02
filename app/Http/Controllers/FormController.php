<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['show', 'activeForm']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new GeneralResource(Form::with('template')->withCount('submissions')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'event_name' => ['required_if:certificate,true', 'nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'certificate' => ['required', 'boolean'],
            'template_id' => ['required_if:certificate,true', 'nullable', 'exists:templates,id'],
            'bg_image' => ['nullable', 'image', 'max:8192']
        ]);

        if ($request->hasFile('bg_image')) {
            $path = $request->file( 'bg_image' )->store('background_image');
        } else {
            $path = null;
        }

        $data = Form::create([
            'title' => $request->title,
            'event_name' => $request->event_name,
            'description' => $request->description,
            'certificate' => $request->certificate,
            'template_id' => $request->template_id,
            'bg_image' => $path
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
     * Display the specified resource.
     */
    public function activeForm(string $form)
    {
        return new GeneralResource(Form::with('template')->where('status', 'active')->findOrFail($form));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        if ($request->hasFile('bg_image')) {
            $path = $request->file( 'bg_image' )->store('background_image');
        } else {
            $path = $form->bg_image;
        }
        $form->update([
            'title' => $request->title ?? $form->title,
            'event_name' => $request->event_name ?? $form->event_name,
            'description' => $request->description ?? $form->description,
            'certificate' => $request->certificate ?? $form->certificate,
            'template_id' => $request->template_id ?? $form->template_id,
            'fields' => $request->fields ?? $form->fields,
            'status' => $request->status ?? $form->status,
            'bg_image' => $path
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
