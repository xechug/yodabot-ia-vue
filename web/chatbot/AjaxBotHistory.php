<?php 


	require 'SocketAPI.php';
	
	$r = $_GET['history'];

	if(isset($r)) {
		$api = new ConnectAPI();
		$history = $api->chatHistory();
		echo json_encode($history);
	}
?>