<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicalAssistanceResource;
use App\Repositories\MedicalAssistanceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Zend_Pdf;
use Zend_Pdf_Font;

class MedicalAssistanceController extends Controller
{
    /**
     * MedicalAssistance repository.
     *
     * @var App\Repositories\MedicalAssistanceRepository
     */
    protected $medicalAssistance;
    
    /**
     * Create new instance of medical assistance controller.
     *
     * @param MedicalAssistanceRepository medicalAssistance MedicalAssistance repository
     */
    public function __construct(MedicalAssistanceRepository $medicalAssistance)
    {
        $this->medicalAssistance = $medicalAssistance;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MedicalAssistanceResource::collection(
            $this->medicalAssistance->paginateWithFilters(request(), request()->order_by, request()->per_page)
        );
    
        if (! $data) {
            return response()->json([
                'message' => 'Failed to retrieve resource'
            ], 400);
        }
    
        return $data;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 400);
        }

        $this->generatePDF();
    
        if (! $this->medicalAssistance->store($request)) {
            return response()->json([
                'message' => 'Failed to store resource'
            ], 500);
        }
    
        return response()->json([
            'message' => 'Resource successfully stored'
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $medicalAssistance = $this->medicalAssistance->findOrFail($id)) {
            return response()->json([
                'message' => 'Resource does not exist'
            ], 400);
        }
    
        return response()->json([
            'message' => 'Resource successfully retrieve',
            'medicalAssistance' => $medicalAssistance
        ], 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 400);
        }
    
        if (! $this->medicalAssistance->update($request, $id)) {
            return response()->json([
                'message' => 'Failed to update resource'
            ], 500);
        }
    
        return response()->json([
            'message' => 'Resource successfully updated'
        ], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $this->medicalAssistance->findOrFail($id)->delete()) {
            return response()->json([
                'message' => 'Failed to delete resource'
            ], 400);
        }
    
        return response()->json([
            'message' => 'Resource successfully deleted'
        ], 200);
    }
    
    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! $this->medicalAssistance->restore($id)) {
            return response()->json([
                'message' => 'Failed to restore resource'
            ], 400);
        }
    
        return response()->json([
            'message' => 'Resource successfully restored'
        ], 200);
    }
    
    /**
     * Forcefully remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        if (! $this->medicalAssistance->forceDestroy($id)) {
            return response()->json([
                'message' => 'Failed to permanently delete resource'
            ], 400);
        }
    
        return response()->json([
            'message' => 'Resource successfully deleted permanently'
        ], 200);
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
        $page->drawText(request()->person['phone_number'], 36, 317);

        $page->setFont($font, 15);
        $page->drawText(request()->amount, 59, 287);

        $page->setFont($font, 10);
        $page->drawText(request()->amount_in_words, 190, 287);

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
