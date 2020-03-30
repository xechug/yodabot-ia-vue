<?php 
require 'ConnectAPI.php';


class ConnectAPI {
	private $_instance = null;

	private $api_key = 'nyUl7wzXoKtgoHnd2fB0uRrAv0dDyLC+b4Y6xngpJDY=';
	private $api_token = '';
	private $session_token = '';
	private $chatbot_api_url = '';
	
// se ejecuta cuando se llama a una nueva instancia de una clase
	public function __construct() {
		if($this->_instance == null) {
			$this->getToken();
			$this->chatbot_api_url = $this->getApis()->apis->chatbot.'/v1/';
			$this->getSessionToken();
			$this->_instance = $this;
		}
			
		return $this->_instance;
	}
	
	private function doApi($api_url, $request_method = 'GET', $post_data = '', $isinbenta = true) {
	    $call = new CallAPI;
	    $curl = curl_init();
	
		$headers = array();
		
		if ($isinbenta) {
			$headers = [
			    	//'content-type: multipart/form-data',
			        "x-inbenta-key: ".$this->api_key
			    ];
			
			    if(!empty($this->api_token)) {
			        array_push($headers, 'Authorization: Bearer '.$this->getToken());
			    }
			    
			    if (!empty($this->session_token)) {
			    	array_push($headers, 'x-inbenta-session: Bearer '.$this->getSessionToken());
			    }
			    	
		}
	  
	    //var_dump($headers);
	    		
	    curl_setopt_array($curl, array(
	        CURLOPT_URL => $api_url,
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_CUSTOMREQUEST => $request_method,
	        CURLOPT_HTTPHEADER => $headers,
//	        CURLOPT_POSTFIELDS => $post_data
	    ));
	    
	    if (!empty($post_data)) {
	    	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);	
	    }
	    
	    $response = curl_exec($curl);
	    
	    $err = curl_error($curl);
	    $jsonResponse = json_decode($response);
	    curl_close($curl);
	
	    return $jsonResponse;
	}
	
	
	
	private function getSessionToken() {
		$cookieSession = $_COOKIE['session_token'];
		//echo 'cookieSession = '.$cookieSession.'<br/>';
		if(isset($cookieSession) || !empty($cookieSession)) {
			$this->session_token = $cookieSession;
		} else if(!isset($this->session_token) || empty($this->session_token)){
			$url = $this->chatbot_api_url.'conversation';
			//echo 'url = '.$url.'<br/>';
		    $session_token = $this->doApi($url, 'POST');
		    //var_dump($session_token);
		    $this->session_token = $session_token->sessionToken;
		    setcookie('session_token', $this->session_token, time()+60*5);
		}
		
		//echo '$this->session_token = '.$this->session_token.'<br/>';
	    return $this->session_token;
	}
	
	
	public function chatHistory() {
		$url = $this->chatbot_api_url.'conversation/history';
		$sendhistory = $this->doApi($url, 'GET');
		//print_r($sendhistory);
		return $sendhistory;
	}
	
	public function getCharacters() {
		$url = 'https://swapi.co/api/people/';
		$getChar = $this->doApi($url, 'GET', '', false);

		$charList = array();
		for($i = 0; $i < 5; $i++) {
			array_push($charList, $getChar->results[$i]->name);
		}
		return $charList;		
	}
	
	public function getFilms() {
			$url = 'https://swapi.co/api/films/';
			$getChar = $this->doApi($url, 'GET', '', false);
	
			$charList = array();
			for($i = 0; $i < 7; $i++) {
				array_push($charList, $getChar->results[$i]->title);
			}
			return $charList;		
		}
	
	public function sendMessage($UserMsg) {
		if (!empty($UserMsg)) {
			//echo $this->chatbot_api_url.'<br/>';
			$this->refreshToken();
			$url = $this->chatbot_api_url.'conversation/message';
			//var_dump($url);
			$sendmsg = $this->doApi($url, 'POST', 'message='.$UserMsg.'');
			
			return $sendmsg;
		} 
		return 'empty string';
	}
	
	
	
	private function refreshToken() {
		$api_url = 'https://api.inbenta.io/v1/refreshToken';
		$api_token = $this->doApi($api_url, 'POST');
		$this->api_token = $api_token->accessToken;
		
		return $this->api_token;
	}
	
	private function getToken() {
		if(!isset($this->api_token) || empty($this->api_token)) {
			$api_url = 'https://api.inbenta.io/v1/auth';
		    $api_token = $this->doApi($api_url, 'POST', 'secret=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJwcm9qZWN0IjoieW9kYV9jaGF0Ym90X2VuIn0.anf_eerFhoNq6J8b36_qbD4VqngX79-yyBKWih_eA1-HyaMe2skiJXkRNpyWxpjmpySYWzPGncwvlwz5ZRE7eg');
		    //print_r($api_token);
		    $this->api_token = $api_token->accessToken;
		}
		
	    return $this->api_token;
	}
	
	private function getApis() {
	    return $this->doApi('https://api.inbenta.io/v1/apis');
	}}


 ?>