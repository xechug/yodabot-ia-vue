<?php 
//	ini_set('display_errors', 1);
//	ini_set('display_startup_errors', 1);
//	error_reporting(E_ALL);

	require 'SocketAPI.php';


	$input_message = $_POST['message'];


	
	if(isset($input_message)) {
	
		$api = new ConnectAPI();
		$message = $api->sendMessage($input_message);
		
	
		

		$response = $message->answers[0]->messageList;
		if ($message->answers[0]->flags != NULL ) {

			array_push($response, 'notfound');

		}		
		
		echo json_encode($response);
	
		
		
	} 
	
	if(isset($_GET['characters'])) {
		$api = new ConnectAPI();
		$response = array();
		
		$charList = $api->getCharacters();
		$charListToString = "I'll show you a list of characters:  ";
		for ($i = 1; $i < count($charList); $i++) {
			$charListToString .= $i.'. '.$charList[$i].'  ';
		}
		array_push($response, $charListToString);
		
		echo json_encode($response);
		$msghistorybot = $api->sendMessage($charListToString);
	}
	
	if(isset($_GET['films'])) {
		$api = new ConnectAPI();
		$response = array();
		
		$charList = $api->getFilms();
		$charListToString = "I'll show you a list of films:  ";
		for ($i = 1; $i < count($charList); $i++) {
			$charListToString .= $i.'. '.$charList[$i].'  ';
		}
		array_push($response, $charListToString);
		echo json_encode($response);
		$msghistorybot = $api->sendMessage($charListToString);
	}
?>