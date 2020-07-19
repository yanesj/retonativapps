<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait getDocumentStatusTrait{
	public function getDocumentStatus($ruta,$token){
		$curl = curl_init();
		$data = array(
			"sendmail"=> false
		);
		$payload = json_encode($data);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $ruta,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>$payload,
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".$token,
				"Accept: application/json",
				"Content-Type: application/json"
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$info= (array) json_decode(stripslashes($response));


		if(property_exists((object)$info,'success')){

			$response = 'ok';
		}

		return $info;
	}
}
?>