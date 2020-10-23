<?php

	$mysql = new mysqli('localhost', 'majik78', '78b83u04a06i14u', 'server');

	$username = htmlspecialchars($_POST['username']);
	$pass = htmlspecialchars($_POST['pass']);
	$result = $mysql->query("SELECT * FROM `siteusers`");

	while (($row = $result->fetch_assoc()) != false) {
		if($row['username'] == $username) {
			echo "Такой пользователь уже существует в базе!";
			return false;
		} 
	}

	echo "<span style='text-align:center;font-weight:normal'>Спасибо за регистрацию, <b>$username</b></span>";
	$mysql->query("INSERT INTO siteusers (`username`, `password`) VALUES ('$username', '$pass')");

	$mysql->close();

?>