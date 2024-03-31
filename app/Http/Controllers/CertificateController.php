<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Models\Form;
use App\Models\Submission;
use App\Models\Template;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Capsule\Manager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $submission = Submission::findOrFail($id);
        if (!$submission->approved) {
            return response()->json(['message' => 'Certificate not found.'], 404);
        }
        $manager = new ImageManager(
            new Driver()
        );
        $form = Form::find($submission->form_id);
        $template = $submission->template();

        switch ($template->qr_color) {
            case 'white':
                $path = storage_path('app/qr/white.png');
                break;

            default:
                $path = storage_path('app/qr/black.png');
                break;
        }

        $img = $manager->read(storage_path("app/{$template->path}"));
        $img->text($submission->name, $template->name_x_coordinate, $template->name_y_coordinate, function (FontFactory $font) use ($template) {
            $font->file(storage_path('app/public/OpenSans-VariableFont_wdth,wght.ttf'));
            $font->size($template->font_size);
            $font->align('center');
            $font->valign('center');
        })->text(
            $form->event_name,
            $template->workshop_x_coordinate,
            $template->workshop_y_coordinate,
            function (FontFactory $font) use ($template) {
                $font->file(storage_path('app/public/OpenSans-VariableFont_wdth,wght.ttf'));
                $font->size($template->event_font_size);
            }
        )->text(
            $submission->certificate_id,
            $template->qr_x_coordinate,
            $template->qr_y_coordinate + 60,
            function (FontFactory $font) use ($template) {
                $font->file(storage_path('app/public/OpenSans-VariableFont_wdth,wght.ttf'));
                $font->size(12);
                $font->color($template->qr_color);
            }
        )->place($manager->read($path)->resize($template->qr_dimension, $template->qr_dimension), 'top-left', $template->qr_x_coordinate, $template->qr_y_coordinate, 100);

        $image = $img->toPng(90);
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename=' . 'test.png',
        ];
        $submission->update([
            'downloaded' => 1
        ]);
        return response()->stream(function () use ($image) {
            echo $image;
        }, 200, $headers);
    }

    public function pdf(string $id)
    {
        $submission = Submission::findOrFail($id);
        if (!$submission->approved) {
            return response()->json(['message' => 'Certificate not found.'], 404);
        }

        $form = Form::find($submission->form_id);
        $template = $submission->template();
        $data = [
            'image' => $template->path,
            'qr_size' => $template->qr_dimension,
            'cerificate_id' => 2,
            'user_name' => $submission->name,
            'event_name' => $form->event_name,
            'qr_y' => $template->qr_y_coordinate,
            'qr_x' => $template->qr_x_coordinate,
            'name_y' => $template->name_y_coordinate,
            'name_x' => $template->name_x_coordinate,
            'name_size' => $template->font_size,
            'event_y' => $template->workshop_y_coordinate,
            'event_x' => $template->workshop_x_coordinate,
            'event_size' => 12,
        ];
        $pdf = Pdf::setPaper('letter')->loadView('certificate', $data);
        return $pdf->stream();
        return view('certificate', $data);
    }

    public function sample(Request $request, string $id)
    {
        // $submission = Submission::findOrFail($id);
        $manager = new ImageManager(
            new Driver()
        );
        // $template = $submission->template();
        $template = Template::findOrFail($id);
        $form = Form::where('template_id', $id)->first();

        switch ($template->qr_color) {
            case 'white':
                $path = storage_path('app/qr/white.png');
                break;

            default:
                $path = storage_path('app/qr/black.png');
                break;
        }

        $img = $manager->read(storage_path("app/{$template->path}"));
        $img->text("John Doe", $template->name_x_coordinate, $template->name_y_coordinate, function (FontFactory $font) use ($template) {
            $font->file(storage_path('app/public/OpenSans-VariableFont_wdth,wght.ttf'));
            $font->size($template->font_size);
            $font->align('center');
            $font->valign('center');
        })->text(
            "Test Event",
            $template->workshop_x_coordinate,
            $template->workshop_y_coordinate,
            function (FontFactory $font) use ($template) {
                $font->file(storage_path('app/public/OpenSans-VariableFont_wdth,wght.ttf'));
                $font->size($template->event_font_size);
            }
        )->text(
            "#####",
            $template->qr_x_coordinate,
            $template->qr_y_coordinate + 60,
            function (FontFactory $font) use ($template) {
                $font->file(storage_path('app/public/OpenSans-VariableFont_wdth,wght.ttf'));
                $font->size(12);
                $font->color($template->qr_color);
            }
        )->place($manager->read($path)->resize($template->qr_dimension, $template->qr_dimension), 'top-left', $template->qr_x_coordinate, $template->qr_y_coordinate, 100);

        $image = $img->toPng(90);
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename=' . 'test.png',
        ];

        return response()->stream(function () use ($image) {
            echo $image;
        }, 200, $headers);
    }

    public function myCertificates($id)
    {
        $submission = Submission::where(['approved' => 1])->where(function ($q) use ($id) {
            $q->where('student_id', $id)
                ->orWhere('email', $id);
        })->with('form.template')->paginate(30);
        return new GeneralResource($submission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
