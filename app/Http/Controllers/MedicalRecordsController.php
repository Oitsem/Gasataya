<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Zend_Pdf;
use Zend_Pdf_Font;

class MedicalRecordsController extends Controller
{
    public function generateMedicalRecordPDF()
    {
        $pdf = Zend_Pdf::load(storage_path('app/template_files/medical.pdf'));

        $page = $pdf->pages[0];
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER_BOLD);

        $page->setFont($font, 12);
        $page->drawText('GETHER KESTREL B. MEDEL', 40, 363);
        $page->drawText('24', 250, 363);

        $page->setFont($font, 7);
        $page->drawText('Villa Homes Villa Angle Subdivision. Bacolod City.', 35, 335);
        $page->setFont($font, 12);
        $page->drawText('09258742269', 228, 335);

        $page->setFont($font, 15);
        $page->drawText('10,000', 293, 305);

        $fileName = 'testing.pdf';

        $year = Carbon::now()->year;
        $month = Carbon::now()->format('F');
        Storage::makeDirectory('public/medical_records/' . $year . '/' . $month, 0775, true);
        $pdf->save(storage_path('app/public/medical_records/' . $year . '/' . $month . '/' . $fileName));

        header('Content-Type:', 'application/pdf');
        header('Content-Disposition:', 'inline');

        return true;
    }
}
