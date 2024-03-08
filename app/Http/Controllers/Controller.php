<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function overview()
    {
        $forms = Form::count();
        $submissions = Submission::count();
        $downloads = Submission::where('dowloaded')->count();
        $students = Submission::distinct('student_id')->count();

        return new GeneralResource([
            'forms' => $forms,
            'submissions' => $submissions,
            'downloads' => $downloads,
            'students' => $students
        ]);
    }
}
