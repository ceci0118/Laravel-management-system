<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Signature;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Need to define wether this is an applicant form or an guardian form before saving into database


    public function index()
    {
        return view('signForm');
    }


    public function submit(Request $request)
    {
        $request->validate([
            'signed' => 'required',
        ]);

        // save signature to local path: public/upload
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $file = $folderPath . uniqid() . '.' . $image_type;

        file_put_contents($file, $image_base64);

        // save signature to database
        Signature::create([
            'signature_path' => $file
        ]);

        // save form to pdf
        $this->createPDF();

        // create form in database
        // get applicant type or guardian type
        $path = storage_path('RowanForm');
        $pdf_path = $path . '/'. uniqid() .'.pdf';
        file_put_contents($pdf_path, $this->createPDF());

        return redirect()->route('success');
    }

    public function createPDF()
    {
        $pdf = PDF::loadView('signForm')->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled', false
        ]);
        return $pdf->download('form.pdf');
    }

}
