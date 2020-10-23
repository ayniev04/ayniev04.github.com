<?php
	
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['pass']);
	$mysql = new mysqli('localhost', 'majik78', '78b83u04a06i14u', 'server');
	$result = $mysql->query('SELECT * FROM siteusers');

	while (($row = $result->fetch_assoc()) != false) {
		if($row['username'] == $username && $row['password'] == $password)  {
			echo "
				<!DOCTYPE html>
				<html>
				<head>
					<title>Profile - $username</title>
					<link href='style.css' rel='stylesheet'>
					<script src='jquery-3.2.0.min.js'></script>
					<script src='main.js'></script>
				</head>
				<body>
			";

			echo "<h2 id='welcome'>Добро пожаловать <b>$username</b></h2>";
			echo "Пользователи: <p/><div style='border:1px solid black;width:30%'>";
			$new =  $mysql->query('SELECT * FROM siteusers');
			while (($row = $new->fetch_assoc()) != false) {
				if($row['username'] == $username) {
					echo "<div class='user' style='background-color:#5CAFF7;color:#fff'>".$row['username']."</div>";
				}
				else echo "<div class='user active' data-name=".$row['username'].">".$row['username']."<span class='message'>написать</span>
					<form id='usMes'>
						<textarea class='mesForm' id='mes' name='message'></textarea>
						<input type='hidden' value='".$username."' name='from' />
						<input type='hidden' value='".$password."' name='password' />
						<input type='hidden' class='toUser' value='' name='toUser' />
						<p id='error' style='color:red;display:none'></p>
						<input type='submit' class='btns' value='Отправить' />
					</form>		
					<script>
						for(let i = 0; i < usMes.length; i++) {
							usMes[i].onsubmit = function(e) {
								let toUser = document.querySelectorAll('.toUser')
								console.log(toUser)
								if(mes[i].value == '') {
									error[i].style.display = 'block'
									error[i].innerHTML = 'Вы не ввели сообщение!'
									return false
								} else {
									e.preventDefault()
									error[i].style.display = 'none'
									let query = $.ajax({
										type: 'POST',
										url: 'message.php',
										data: `from=$username&toUser=`+toUser[i].value+`&message=` + mes[i].value + `&password=$password`,
										success: function(data) {
											error[i].style.color = '#000'
											error[i].innerHTML = data
											error[i].style.display = 'block'
											mes[i].value = ''
											setTimeout(function(){
												error[i].style.display = 'none'
											}, 2000)
										}
									})
								}
							}
						}
					</script>
				</div>";
			}
			echo "</div>";

			echo "<div id='basic_chat'>";
				echo "<div style='text-align:center; padding: 0.4rem 0;font-size:180%;border-bottom:1px solid #000;background-color:#F73048;color:#fff'>Chat</div>";
					$chat_query = $mysql->query('SELECT * FROM `chat`');
					while(($row = $chat_query->fetch_assoc()) != false) {

						echo "<div class='message_block'>";
						if($row['username'] == $username) {
							echo "<div class='username' style='font-weight:bold'>".$row['username']."</div>"; 
							echo "<div class='user_message self'>".$row['message']."</div>";
						} else {
							echo "<div class='username' style='font-weight:bold'>".$row['username']."</div>"; 
							echo "<div class='user_message'>".$row['message']."</div>"; 
						}

						echo "</div>";

					} 

				echo "
					<form>
						<textarea name='message'></textarea>
						<input type='submit' value='send' />
					</form>
				";

			echo "</div>";

			$mesQuery = $mysql->query('SELECT * FROM `messages`');
			while (($row = $mesQuery->fetch_assoc()) != false) {
				echo "
					<div id='userMessages'>
						<h3>Сообщения:</h3>
						<div id='chat'>
							";

					if($row['toUser'] == $username) {
						$userQuery = $mysql->query('SELECT * FROM `messages`');
						while (($row = $userQuery->fetch_assoc()) != false) {
							if($row['toUser'] == $username) {
								echo "
									<div class='userMes'>
										<div class='from'>
											<span class='header'><b>".$row['username']."</span>
											<span class='showMes'>показать</span>
										</div>
										<div class='mes'>
											".$row['message']
											."<div class='date'>".$row['date']."</div>
										</div>
									</div>
								";
							}
						}
					}

				echo		"
						</div>
					</div>	
				";
			}

			echo "<p/><a id='logout' href='index.html'>Выйти из аккаунта</a>";
			echo "</body></html>";
			return false;
		} else {
			continue;
		}
	}

	echo "Неправилный пароль или логин!";

	$mysql->close();

?>

