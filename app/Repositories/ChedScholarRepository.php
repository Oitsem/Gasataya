<?php

namespace App\Repositories;

use App\ChedScholar;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Zend_Pdf;
use Zend_Pdf_Font;

class ChedScholarRepository extends Repository
{
    /**
     * List of highest grade attained.
     *
     * @var array
     */
    protected $highestAttainedGrade = [
        1 => 'Grade 1',
        2 => 'Grade 2',
        3 => 'Grade 3',
        4 => 'Grade 4',
        5 => 'Grade 5',
        6 => 'Grade 6',
        7 => 'Grade 7',
        8 => 'First Year High School',
        9 => 'Second Year High School',
        10 => 'Third Year High School',
        11 => 'Fourth Year High School',
        12 => 'Junior High',
        13 => 'Senior High',
        14 => 'First Year College',
        15 => 'Second Year College',
        16 => 'Third Year College',
        17 => 'Fourth Year College',
        18 => 'Fifth Year College'
    ];

    /**
     * Create new instance of ched scholar repository.
     *
     * @param ChedScholar $chedScholar ChedScholar model
     */
    public function __construct(ChedScholar $chedScholar)
    {
        parent::__construct($chedScholar);
        $this->chedScholar = $chedScholar;
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

        return $this->chedScholar->filter($request)
                            ->orderBy('created_at', $orderBy)
                            ->with('person')
                            ->paginate($length)
                            ->withPath(
                                $this->chedScholar->createPaginationUrl($request, $removePage)
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
        return $this->chedScholar->with('user', 'person')->findOrFail($id);
    }

    /**
     * Generate PDF file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function generatePDF(& $request)
    {
        $data = $this->chedScholar->where('id', $request->id)->first();

        if ($data) {
            if (Storage::disk('local')->exists('public/ched_scholars/' . $data->file)) {
                Storage::disk('local')->delete('public/ched_scholars/' . $data->file);
            }
        }

        $pdf = Zend_Pdf::load(storage_path('app/template_files/ched-application.pdf'));

        $page = $pdf->pages[0];
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER_BOLD);

        $page->setFont($font, 9);
        $page->drawText($request->last_name, 75, 807);
        $page->setFont($font, 9);
        $page->drawText($request->first_name, 232, 807);
        $page->setFont($font, 9);
        $page->drawText($request->middle_name, 366, 807);
        $page->setFont($font, 9);
        $page->drawText($request->extension_name, 500, 807);

        $birthdate = new Carbon($request->birthdate, 'Asia/Manila');
        $birthdate = $birthdate->format('m/d/Y');
        $page->setFont($font, 9);
        $page->drawText($birthdate, 140, 778);
        $page->setFont($font, 9);
        $page->drawText($request->place_of_birth, 138, 763);

        if ($request->sex) {
            $page->setFont($font, 7);
            $page->drawText('X', 129, 751);
        } else {
            $page->setFont($font, 7);
            $page->drawText('X', 182, 751);
        }

        if ($request->civil_status == 1) {
            $page->setFont($font, 7);
            $page->drawText('X', 129, 738);
        } elseif ($request->civil_status == 2) {
            $page->setFont($font, 7);
            $page->drawText('X', 129, 727);
        } elseif ($request->civil_status == 3) {
            $page->setFont($font, 7);
            $page->drawText('X', 129, 715);
        } elseif ($request->civil_status == 4) {
            $page->setFont($font, 7);
            $page->drawText('X', 182, 738);
        } elseif ($request->civil_status == 5) {
            $page->setFont($font, 7);
            $page->drawText('X', 182, 727);
        } else {
            $page->setFont($font, 7);
            $page->drawText('X', 182, 715);
        }

        $page->setFont($font, 9);
        $page->drawText($request->citizenship, 145, 700);
        $page->setFont($font, 9);
        $page->drawText($request->mobile_number, 140, 685);
        $page->setFont($font, 6);
        $page->drawText($request->email, 123, 672);

        if ($request->school_last_attended_sector) {
            $page->setFont($font, 8);
            $page->drawText('X', 156, 658);
        } else {
            $page->setFont($font, 8);
            $page->drawText('X', 122, 658);
        }

        $page->setFont($font, 10);
        $page->drawText($this->highestAttainedGrade[$request->highest_attained_grade], 50, 632);
        $page->setFont($font, 6);
        $page->drawText($request->address, 330, 778);
        $page->setFont($font, 9);
        $page->drawText($request->zip_code, 357, 749);
        $page->drawText($request->district, 490, 749);
        $page->setFont($font, 8);
        $page->drawText($request->school_last_attended, 330, 700);
        $page->drawText($request->school_last_attended_address, 330, 685);

        $page->setFont($font, 5);
        $fullName = $request->fathers_first_name . ' ' . $request->fathers_middle_name . ' ' . $request->fathers_last_name . ' ' . $request->fathers_extension_name;
        $page->drawText($fullName, 148, 594);
        $page->drawText($request->fathers_address, 148, 577);
        $page->setFont($font, 8);
        $page->drawText($request->fathers_contact_number, 148, 560);
        $page->drawText($request->fathers_occupation, 148, 543);
        $page->setFont($font, 6);
        $page->drawText($request->fathers_name_of_employer, 148, 526);
        $page->drawText($request->fathers_employer_address, 148, 509);
        $page->setFont($font, 10);
        $page->drawText($request->fathers_annual_gross_income, 148, 494);

        $page->setFont($font, 5);
        $fullName = $request->mothers_first_name . ' ' . $request->mothers_middle_name . ' ' . $request->mothers_last_name;
        $page->drawText($fullName, 262, 594);
        $page->drawText($request->mothers_address, 262, 577);
        $page->setFont($font, 8);
        $page->drawText($request->mothers_contact_number, 262, 560);
        $page->drawText($request->mothers_occupation, 262, 543);
        $page->setFont($font, 6);
        $page->drawText($request->mothers_name_of_employer, 262, 526);
        $page->drawText($request->mothers_employer_address, 262, 509);
        $page->setFont($font, 10);
        $page->drawText($request->mothers_annual_gross_income, 262, 494);

        $page->setFont($font, 5);
        $fullName = $request->legal_guardian_first_name . ' ' . $request->legal_guardian_middle_name . ' ' . $request->legal_guardian_last_name . ' ' . $request->legal_guardian_extension_name;
        $page->drawText($fullName, 420, 594);
        $page->drawText($request->legal_guardian_address, 420, 577);
        $page->setFont($font, 8);
        $page->drawText($request->legal_guardian_contact_number, 420, 560);
        $page->drawText($request->legal_guardian_occupation, 420, 543);
        $page->setFont($font, 6);
        $page->drawText($request->legal_guardian_name_of_employer, 420, 526);
        $page->drawText($request->legal_guardian_employer_address, 420, 509);
        $page->setFont($font, 10);
        $page->drawText($request->legal_guardian_annual_gross_income, 420, 494);

        $page->setFont($font, 11);
        $page->drawText($request->number_of_siblings, 155, 479);

        $page->setFont($font, 10);
        $page->drawText($request->school_intended_to_enroll, 185, 468);
        $page->setFont($font, 9);
        $page->drawText($request->school_intended_to_enroll_address, 185, 458);

        if ($request->school_intended_to_enroll_sector) {
            $page->setFont($font, 10);
            $page->drawText('X', 183, 448);
        } else {
            $page->setFont($font, 10);
            $page->drawText('X', 229, 447);
        }

        $fileName = substr(request()->first_name, 0, 1) . substr(request()->last_name, 0, 1) . rand(100, 999) . '.pdf';

        $year = Carbon::now()->year;
        $month = Carbon::now()->format('F');

        Storage::makeDirectory('public/ched_scholars/' . $year . '/' . $month, 0775, true);

        $path = storage_path('app/public/ched_scholars/' . $year . '/' . $month . '/' . $fileName);

        request()->merge([
            'file' => $year . '/' . $month . '/' . $fileName
        ]);

        $pdf->save($path);
        
        return;
    }
}
