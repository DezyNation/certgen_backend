<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ResponseExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (is_null($this->id)) {
            $data = DB::table('submissions')
                ->join('forms', 'forms.id', '=', 'submissions.form_id')
                ->select('submissions.id', 'forms.title', 'submissions.name', 'submissions.student_id', 'submissions.certificate_id', 'submissions.data', 'submissions.created_at')
                ->get();
        } else {
            $data = DB::table('submissions')
            ->join('forms', 'forms.id', '=', 'submissions.form_id')
            ->where('submissions.form_id', $this->id)
            ->select('submissions.id', 'forms.title', 'submissions.name', 'submissions.student_id', 'submissions.certificate_id', 'submissions.data', 'submissions.created_at')
            ->get();
        }

        return $data;
    }

    public function headings(): array
    {
        return ["ID", "Form Title", "User Name", "Student ID", "Certificate ID", "Data", "Created At"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
