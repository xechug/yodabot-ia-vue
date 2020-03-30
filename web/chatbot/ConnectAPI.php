<?php  



class CallAPI {
	
	function getToken() {
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.inbenta.io/v1/auth",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "secret=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJwcm9qZWN0IjoieW9kYV9jaGF0Ym90X2VuIn0.anf_eerFhoNq6J8b36_qbD4VqngX79-yyBKWih_eA1-HyaMe2skiJXkRNpyWxpjmpySYWzPGncwvlwz5ZRE7eg",
		  CURLOPT_HTTPHEADER => array(
		    "x-inbenta-key: nyUl7wzXoKtgoHnd2fB0uRrAv0dDyLC+b4Y6xngpJDY="
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		$response = json_decode($response);
		$response = $response->accessToken;
		
		curl_close($curl);
		
		return $response;
	}
	
	
}

?>
	

