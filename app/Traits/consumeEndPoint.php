<?php
namespace App\Traits;
use Illuminate\Http\Request;
use File;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Traits\getDocumentStatusTrait;
use App\Traits\generatePDFTrait;
use App\Invoice;

trait consumeEndPointTrait{
	use getDocumentStatusTrait;
	use generatePDFTrait;

	public function consumeEndpoint($header,$detail,$cliente){

		
		$message=array();$user=Auth::user();
		$messageResponse ='';
		$filename =$header;
		$fp = fopen($filename, "r");
		while(!feof($fp)){
			$l1 = utf8_decode(fgets($fp));$v1=explode(";",$l1);
			$l2 = utf8_decode(fgets($fp));$v2=explode(";",$l2);
			$l3 = utf8_decode(fgets($fp));$v3=explode(";",$l3);
			$l4 = utf8_decode(fgets($fp));$v4=explode(";",$l4);
			$l5 = utf8_decode(fgets($fp));$v5=explode(";",$l5);
			$l6 = utf8_decode(fgets($fp));$v6=explode(";",$l6);
			$l7 = utf8_decode(fgets($fp));$v7=explode(";",$l7);
     //se empiezan a formar los componentes del json a enviar
			$customer=array("identification_number"=>$v2[0],"dv"=>$v1[1],"name"=> $v2[1],"phone"=>$v2[2],"address"=>$v2[3],"email"=>$v2[4],
				"merchant_registration"=>$v2[5],"type_document_identification_id"=>$v2[6],"type_organization_id"=>$v2[7],
				"municipality_id"=>$v2[8],"type_regime_id"=>$v2[9]
			);
			$payment_form=array("payment_form_id"=> $v3[0],"payment_method_id"=> $v3[1],"payment_due_date"=> $v3[2],
				"duration_measure"=> $v3[3]
			);
			$prepaid_payment=array("idpayment"=> $v4[0],"paidamount"=> $v4[1],"receiveddate"=> $v4[2],"paiddate"=> $v4[3],
				"instructionid"=> $v4[4]
			);
			$allowance_charges[]=array("discount_id"=> $v5[0],"charge_indicator"=> false,"allowance_charge_reason"=> $v5[2],"amount"=> $v5[3],
				"base_amount"=> $v5[4]);
			$legal_monetary_totals=array("line_extension_amount"=>$v6[0],"tax_exclusive_amount"=>$v6[1],"tax_inclusive_amount"=>$v6[2],
				"allowance_total_amount"=>$v6[3],"charge_total_amount"=>$v6[4],"pre_paid_amount"=>$v6[5],"payable_amount"=>$v6[6]);
			$tax_totals[]=array("tax_id"=>$v7[0],"tax_amount"=>$v7[1],"percent"=>$v7[2],"taxable_amount"=>$v7[3]);
          //Detalle de la factura
			$invoice_lines=[]; 
           $filename = $detail;//abrir archivo de solo lectura
           $fp2 = fopen($filename, "r");
           $lE = utf8_decode(fgets($fp2));
           while(!feof($fp2)) {
           	$lE = utf8_decode(fgets($fp2));
           	$vdet=explode(";",$lE);
           	$allowance_charges_det[]=array("charge_indicator"=>false,"allowance_charge_reason"=>$vdet[6],"amount"=>$vdet[7],"base_amount"=>$vdet[8]);
           	$tax_totals_det[]=array("tax_id"=> $vdet[9],"tax_amount"=> $vdet[10],"taxable_amount"=> $vdet[11],"percent"=> $vdet[12]);
           	array_push($invoice_lines,array("unit_measure_id"=> $vdet[1],"invoiced_quantity"=> $vdet[2],"line_extension_amount"=> $vdet[3],
           		"free_of_charge_indicator"=> false,"allowance_charges"=>$allowance_charges_det,"tax_totals"=>$tax_totals_det,"description"=> $vdet[13],
           		"code"=> $vdet[14],"type_item_identification_id"=>$vdet[15],"price_amount"=>$vdet[16],"base_quantity"=>$vdet[17]));
           	$allowance_charges_det=array();$tax_totals_det=array();
           }
           fclose($fp2);

           

           

           $message=array("number"=>intval($v1[0]),"dv"=>$v1[1],"type_document_id"=>$v1[2],"date"=>$v1[3],"time"=>$v1[4],"customer"=>$customer,"payment_form"=>$payment_form,"prepaid_payment"=>$prepaid_payment,"allowance_charges"=>$allowance_charges,"legal_monetary_totals"=>$legal_monetary_totals,"tax_totals"=>$tax_totals,"invoice_lines"=>$invoice_lines);

           //fact: NumFac,fecha_fact+hora_fact:FecFac,nit_fac = nit de la organizacion, $v2[0]=DocAdq, "line_extension_amount"=>$v6[0],iva:"tax_amount"=>$v7[1]
           //"tax_inclusive_amount"=>$v6[2]:ValTotal, otros ipuestos, colocarlo e 0
           /*
           NumFac: 1
FecFac: 2020-07-09
NitFac: 802004947
DocAdq: 800161687
ValFac: 1636300.00
ValIva: 310897.00
ValOtroIm: 0.00
ValTotal: 1947197.00
CUFE: c4c693b68422f7ba85dbb3f123014fb24f6ff75c345e45576ab1d9f11d9b1c95509004c2bc15c66813cd90f274f7b8ab
           */
$heading=array('fact'=>$v1[0],'nit'=>$v2[0].'-'.$v1[1],'customer'=>$v2[1],'phone'=>$v2[2],'dir'=>$v2[3],'fecha_fact'=>$v1[3],'hora_fact'=>$v1[4],'fecha_vto'=>$v3[2]);



           //por ahora lo ponemos acá, luego lo ubicamos.
$this->exportToPDF('factuEstrateg.png',$heading,$invoice_lines);
exit();


           //se envía la petición
$curl = curl_init();
$payload = json_encode($message);
           //printf($payload); exit();
$s=env('APP_URL_API').'/invoice'.$user->proof_test_id;
curl_setopt_array($curl, array(
	CURLOPT_URL => env('APP_URL_API').'/invoice'.$user->proof_test_id,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS =>$payload,
	CURLOPT_HTTPHEADER => array(
		"Content-Type: application/json",
		"Accept: application/json",
		"Authorization: Bearer ".$user->api_token
	),                       
));

$response = curl_exec($curl);




curl_close($curl);
$info= (array) json_decode(stripslashes($response));
           //dd($info);  


if(property_exists((object)$info,'cufe')){
	$response = $this->getDocumentStatus(env('APP_URL_API')."/status/document/".$info['cufe']."/C:_FRS",$user->api_token);
	$responseCode=$response['ResponseDian']->Envelope->Body->GetStatusResponse->GetStatusResult->StatusCode;

	
	if($responseCode=='00'){
		$user->invoices()->create(['client_id'=>$cliente,
			'cufe'=>$info['cufe'],
			'invoice_type'=>'factura',
			'invoice_number'=>$v1[0]
		]);
		
	}
	$messageResponse = $messageResponse.' Factura '.$v1[0].' '.$response['ResponseDian']->Envelope->Body->GetStatusResponse->GetStatusResult->StatusDescription.' -- ';
}   
else{
	$messageResponse = $messageResponse.' Factura '.$v1[0].' debe ser revisada antes de ser montada en el lote.';
}

}
fclose($fp);
return $messageResponse;
}
}
?> 