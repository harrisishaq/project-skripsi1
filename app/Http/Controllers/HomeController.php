<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\DataEmployee;
use EllipticCurve\PrivateKey;
use Elliptic\EC;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $pdfFilePath = public_path('/pdf/TestFile.pdf');

        // Create an instance of the PDFParser
        $PDFParser = new Parser();

        // Create an instance of the PDF with the parseFile method of the parser
        // this method expects as first argument the path to the PDF file
        $pdf = $PDFParser->parseFile($pdfFilePath);
        
        // Extract ALL text with the getText method
        $old_text = $pdf->getText();
        $text = explode("Abstract", $old_text);
        $abstract = explode("Keyword", $text[1]);
        // dd($text);

        $privateKey = new EllipticCurve\PrivateKey;
        $publicKey = $privateKey->publicKey();
        

        # Generate Signature
        $signature = EllipticCurve\Ecdsa::sign($abstract[0], $privateKey);

        # Verify if signature is valid
        $result = EllipticCurve\Ecdsa::verify($abstract[0], $signature, $publicKey);

        // $employee = DataEmployee::all();
        
        return view('home', ['text'=> $result]);
    }
}
