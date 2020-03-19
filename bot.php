<?php
$confirmation_token = '4cb985ad';
$data = json_decode(file_get_contents('php://input'));
switch ($data->type) {  
	case 'confirmation': 
		echo $confirmation_token; 
	break;  
		
	case 'message_new': 
		$message_text = $data -> object -> text;
		$chat_id = $data -> object -> peer_id;
		$host = '217.182.203.129:28794';
		$port = 28804;
		$password = 'Urban999\!\!'
		$timeout = 3;

		require_once('Rcon.php');

		$rcon = new Rcon($host, $port, $password, $timeout);
		
		if($rcon->connect) {
			$rcon->sendCommand($message_text);
			vk_msg_send($chat_id, "Успешно получено соединение с консолью. Идёт исполнение команд.");
		}
		echo 'ok';
	break;
}
function vk_msg_send($peer_id, $text) {
	$request_params = array(
		'message' => $text,
		'peer_id' => $peer_id,
		'access_token' => "046cf2cb421aaa9abc21eb17e6a127201398e5aa341c52e194013d53696db120a8780ca7db343cf6759d4",
		'v' => '5.8'
	);
	$get_params = http_build_query($request_params);
	file_get_contents('https://api.vk.com/method/messages.send?', $get_params);
}
?>
