<?php

namespace App\Repositories;

use App\MedicalAssistance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Zend_Pdf;
use Zend_Pdf_Font;

class MedicalAssistanceRepository extends Repository
{
    /**
     * Create new instance of medical assistance repository.
     *
     * @param MedicalAssistance $medicalAssistance MedicalAssistance model
     */
    public function __construct(MedicalAssistance $medicalAssistance)
    {
        parent::__construct($medicalAssistance);
        $this->medicalAssistance = $medicalAssistance;
    }

    /**
     * Create pagination with filters for the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $orderBy
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @return array json object
     */
    public function paginateWithFilters(
        $request = null,
        $orderBy = 'desc',
        $length = 10,
        $removePage = true
    ) {
        if ($orderBy == null) {
            $orderBy = 'desc';
        }

        return $this->medicalAssistance->filter($request)
                            ->orderBy('created_at', $orderBy)
                            ->with('person')
                            ->paginate($length)
                            ->withPath(
                                $this->medicalAssistance->createPaginationUrl($request, $removePage)
                            );
    }

    /**
     * Find the resource using the specified id or else fail.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFail($id)
    {
        return $this->medicalAssistance->with('user', 'person')->findOrFail($id);
    }

    /**
     * Generate PDF file.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $pdf = Zend_Pdf::load(storage_path('app/template_files/medical-assistance.pdf'));

        $page = $pdf->pages[0];
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER_BOLD);

        $page->setFont($font, 12);
        $name = request()->first_name . ' ' . substr(request()->middle_name, 0, 1) . '. ' . request()->last_name;
        $page->drawText($name, 38, 375);


        $birthdate = new Carbon(request()->person['birthdate'], 'Asia/Manila');
        $age = $birthdate->diff(Carbon::today())->format('%y');
        $page->drawText($age, 287, 375);

        $page->setFont($font, 10);
        $page->drawText(request()->person['address'], 85, 345);
        $page->setFont($font, 11);
        $page->drawText(request()->person['mobile_number'], 36, 317);

        $page->setFont($font, 15);
        $page->drawText(request()->amount, 59, 287);

        $page->setFont($font, 10);
        $page->drawText(request()->amount_in_words, 193, 287);

        $page->setFont($font, 13);

        if (request()->hospital_bills) {
            $page->drawText('X', 75, 258);
        }

        if (request()->medicines) {
            $page->drawText('X', 75, 244);
        }

        if (request()->consultation) {
            $page->drawText('X', 75, 230);
        }

        if (request()->medical_supplies) {
            $page->drawText('X', 75, 216);
        }

        if (request()->minor_procedures) {
            $page->drawText('X', 75, 201);
        }

        if (request()->laboratory) {
            $page->drawText('X', 75, 187);

            if (request()->laboratory_test) {
                $page->drawText('X', 108, 172);
            }

            if (request()->blood_processing) {
                $page->drawText('X', 108, 158);
            }

            if (request()->biopsy) {
                $page->drawText('X', 108, 143);
            }

            if (request()->laboratory_others) {
                $page->drawText('X', 108, 129);
            }
        }

        if (request()->radiology) {
            $page->drawText('X', 247, 258);
        }

        if (request()->xray) {
            $page->drawText('X', 274, 244);
        }

        if (request()->ct_scan) {
            $page->drawText('X', 274, 230);
        }

        if (request()->utz) {
            $page->drawText('X', 274, 215);
        }

        if (request()->echo) {
            $page->drawText('X', 274, 201);
        }

        if (request()->mri) {
            $page->drawText('X', 274, 187);
        }

        if (request()->radiology_others) {
            $page->drawText('X', 274, 172);
        }

        $page->setFont($font, 10);
        if (request()->radiology_others_details) {
            $page->drawText(request()->radiology_others_details, 268, 150);
        }

        $fileName = substr(request()->first_name, 0, 1) . substr(request()->last_name, 0, 1) . rand(100, 999) . '.pdf';

        $year = Carbon::now()->year;
        $month = Carbon::now()->format('F');
        Storage::makeDirectory('public/medical_records/' . $year . '/' . $month, 0775, true);

        $path = storage_path('app/public/medical_records/' . $year . '/' . $month . '/' . $fileName);

        request()->merge([
            'file' => $year . '/' . $month . '/' . $fileName
        ]);

        $pdf->save($path);

        header('Content-Type:', 'application/pdf');
        header('Content-Disposition:', 'inline');
        
        return;
    }
}
