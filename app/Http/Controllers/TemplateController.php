<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new GeneralResource(Template::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'image', 'max:4096'],
            'name_x_coordinate' => ['required', 'numeric'],
            'name_y_coordinate' => ['required', 'numeric'],
            'qr_x_coordinate' => ['required', 'numeric'],
            'qr_y_coordinate' => ['required', 'numeric'],
            'workshop_x_coordinate' => ['required', 'numeric'],
            'workshop_y_coordinate' => ['required', 'numeric'],
            'unique_x_coordinate' => ['nullable', 'numeric'],
            'unique_y_coordinate' => ['nullable', 'numeric'],
            'font_size' => ['required', 'numeric'],
            'font_name' => ['required', 'string'],
            'qr_color' => ['required', 'hex_color'],
        ]);

        $data = Template::create([
            'path' => $request->file('file')->store('template'),
            'name_x_coordinate' => $request->name_x_coordinate,
            'name_y_coordinate' => $request->name_y_coordinate,
            'qr_x_coordinate' => $request->qr_x_coordinate,
            'qr_y_coordinate' => $request->qr_y_coordinate,
            'workshop_x_coordinate' => $request->workshop_x_coordinate,
            'workshop_y_coordinate' => $request->workshop_y_coordinate,
            'unique_x_coordinate' => $request->unique_x_coordinate,
            'unique_y_coordinate' => $request->unique_y_coordinate,
            'font_size' => $request->font_size,
            'font_name' => $request->font_name,
            'qr_color' => $request->qr_color,
        ]);

        return new GeneralResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        return new GeneralResource($template);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        $template->update([
            'name_x_coordinate' => $request->name_x_coordinate ?? $template->name_x_coordinate,
            'name_y_coordinate' => $request->name_y_coordinate ?? $template->name_y_coordinate,
            'qr_x_coordinate' => $request->qr_x_coordinate ?? $template->qr_x_coordinate,
            'qr_y_coordinate' => $request->qr_y_coordinate ?? $template->qr_y_coordinate,
            'workshop_x_coordinate' => $request->workshop_x_coordinate ?? $template->workshop_x_coordinate,
            'workshop_y_coordinate' => $request->workshop_y_coordinate ?? $template->workshop_y_coordinate,
            'unique_x_coordinate' => $request->unique_x_coordinate ?? $template->unique_x_coordinate,
            'unique_y_coordinate' => $request->unique_y_coordinate ?? $template->unique_y_coordinate,
            'font_size' => $request->font_size ?? $template->font_size,
            'font_name' => $request->font_name ?? $template->font_name,
            'qr_color' => $request->qr_color ?? $template->qr_color,
        ]);

        return new GeneralResource($template);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        //
    }
}
