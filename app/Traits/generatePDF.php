<?php
namespace App\Traits;
use Illuminate\Http\Request;
use File;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Invoice;
use Fpdf;
use QrCode;

trait generatePDFTrait{

    public function generateQRCode($string){
      QrCode::size(1200)->format('png')->generate($string, public_path('qrcodes/qrcode.png'));
    }
	
	 public function exportToPDF($nombreArchivo,$header,$detail) {
    //'factuEstrateg.png'

    dd($detail);

    $publicPath=public_path();
    $pdf = new Fpdf();
    $pdf::AddPage();
    $pdf::Image(env('APP_INVOICES_PICTURES').$nombreArchivo, -5,-5, 220,300);
    $pdf::SetFont("Arial","",9);
    $pdf::Text(35,52,$header['customer']);
    $pdf::Text(35,57,$header['nit']);
    $pdf::Text(166,57,$header['fact']);
    $pdf::Text(35,62,$header['dir']);
    $pdf::Text(35,68,$header['phone']);
    $pdf::Text(166,62,$header['fecha_fact']);
    $pdf::Text(166,68,$header['fecha_vto']);

    //detail
   //dd($detail);
    $i=1;$col=84;
   foreach ($detail as $value){
       $pdf::Text(20,$col,$i);//dibuja los items
       //Los otros valores que se tienen que dibujar son 
       //$value['invoiced_quantity'],//$value['line_extension_amount'], cada uno va en una columna diferente, o sea que son $col1, $col2, ... $col n
       $i++;$col=$col+3;
   }
  
    /*$pdf::SetFont("Arial","B",18);
    $pdf::Cell(0,10,"Title",0,"","C");
    $pdf::Ln();
    $pdf::Ln();
    $pdf::SetFont("Arial","B",12);
    $pdf::cell(25,8,"ID",1,"","C");
    $pdf::cell(45,8,"Name",1,"","L");
    $pdf::cell(35,8,"Address",1,"","L");
    $pdf::Ln();
    $pdf::SetFont("Arial","",10);
    $pdf::cell(25,8,"1",1,"","C");
    $pdf::cell(45,8,"John",1,"","L");
    $pdf::cell(35,8,"New York",1,"","L");
    $pdf::Ln();*/
   // $pdf::Output();
    $pdf::Output('F',$publicPath.'\facturaEjemplo.pdf');
    
  }
}
?> 