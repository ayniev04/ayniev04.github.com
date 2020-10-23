<?php
	
	$from = $_POST['from'];
	$toUser = $_POST['toUser'];
	$message = $_POST['message'];
	$pass = $_POST['password'];

	$mysql = new mysqli('localhost', 'majik78', '78b83u04a06i14u', 'server');
	$mysql->query("INSERT INTO `messages` (`username`, `toUser`, `message`, `date`) VALUES ('$from', '$toUser', '$message', CURRENT_TIME());");

	echo "Сообщение отправлено";

	$mysql->close();

?>