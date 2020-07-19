<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait configureResolutionTrait{
	public function configure($ruta,$type_document,$prefix,$token){
		$curl = curl_init();
		$data = array(
			"type_document_id"=> $type_document,
			"from"=> 1,
			"to"=> 99999999,
			"prefix"=> "9"
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
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS =>$payload,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
					"cache-control: no-cache",
					"Connection: keep-alive",
					"Accept-Encoding: gzip, deflate",
					"Host: localhost",
					"accept: application/json",
					"X-CSRF-TOKEN: ",
					"Authorization: Bearer ".$token,
					"Content-Type: text/plain"
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$info= (array) json_decode(stripslashes($response));
		if(property_exists((object)$info,'success')){

				$response = 'ok';
			}

		return $response;
	}
}
?>