<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\DataEmployee;
//use EllipticCurve\PrivateKey;
use Elliptic\EC;
use kornrunner\Keccak;

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
        //var_dump($old_text);
        $text = explode("Abstract", $old_text);
        $abstract = explode("Keyword", $text[1]);        
        //initial ECDSA
        $ec = new EC('secp256k1');
        // Hashing abstract use sha1
        $hashAbstract = sha1($abstract[0]);
        // Hashing abstract use keccak
        $hashAbstractKeccak = Keccak::hash($abstract[0], 224);
        var_dump($hashAbstractKeccak);
        // Generate key from hash we created
        $privateKey = $ec->keyFromPrivate($hashAbstract);
        // Sign message (can be hex sequence or array)
        $msg = $abstract;
        $signature = $privateKey->sign($msg);
        // Export DER encoded signature to hex string
        $derSign = $signature->toDER('hex');
        // Verify signature
        $isValid = $privateKey->verify($msg, $derSign);
        // Generate pub key
        $pubKey = $privateKey->getPublic(true, "hex");
        var_dump($pubKey);
        if ($isValid) {
            echo "Your key is valid";
        } else {
            echo "not valid";
        }
        // $employee = DataEmployee::all();
        
        return view('home', ['text'=> $abstract]);
    }
}
