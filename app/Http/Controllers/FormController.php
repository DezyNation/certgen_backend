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
        return new GeneralResource(Form::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cerificate' => ['required', 'boolean'],
            'template_id' => ['required', 'exists:templates,id']
        ]);

        $data = Form::create([
            'title' => $request->title,
            'description' => $request->description,
            'cerificate' => $request->cerificate,
            'template_id' => $request->template_id
        ]);

        return new GeneralResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        return new GeneralResource($form);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        //
    }
}
