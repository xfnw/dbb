<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//print_r($_POST);

include 'config.php';

$postid = substr(md5(implode($_POST))0,5);
if( strpos(file_get_contents("./data/received.txt"),$postid) == false) {
	// do stuff

	file_put_contents('./data/received.txt', $postid."\n", FILE_APPEND | LOCK_EX);


	// federate here
	//
	//
	//
	foreach ($peers as $peer) {
		$options = array(
			'http' => array(
				'timeout' => 1,
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($_POST)
			)
		);
		$context = stream_context_create($options);

		file_get_contents($peer, false, $context);
	}



	if (isset($_POST['thread']) && isset($_POST['nickname']) && isset($_POST['content'])) {
		$thread = str_replace('/', '.', $_POST['thread']);
		$nickname = escapeshellarg($_POST['nickname']);
		$content = str_replace("\r",'',str_replace("==========","\\==========",$_POST['content']));

		file_put_contents('./data/threads/'.$thread.'.txt',"==========\nId: ".$postid."\nDate: ".date('c', time())."\nFrom: ".$nickname."\n\n".$content."\n\n", FILE_APPEND | LOCK_EX);

		echo "200 OK";
	}else{
		echo 'ERROR 102: malformed request';
	}



}else{
	echo 'ERROR 101: already received';

}

