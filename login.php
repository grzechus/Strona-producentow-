<!DOCTYPE html>

<html lang="pl_PL">

<head>
	<!-- Kodowanie -->
	<meta charset="utf-8">
	<!-- Tytuł -->
	<title>New Game</title> <!-- Trzeba coś wymyślić -->
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<!-- Kontener -->
	<div class="container">
		<!-- I rząd - Logowanie rejestracja-->
		<div class="row">
			<div class="col-lg-3 col-lg-offset-9
						col-md-3 col-md-offset-9
						col-sm-6 col-ss-ofset-6
						col-xs-12">
				<p><a href="register.php">Rejestracja</a> lub <a href="login.php">Logowanie</a></p>
			</div>
		</div>
		
		<!-- II rząd - Baner -->
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2
						col-md-8 col-lg-offset-2
						col-sm-10 col-sm-offset-1
						col-xs-12">
				<center><img src="images/baner.png" class="img-responsive"> <!-- Trzeba coś dodać --></center>
			</div>				
		</div>
		
		<!-- III rząd - Menu -->
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2
						col-md-8 col-lg-offset-2
						col-sm-10 col-sm-offset-1
						col-xs-12">
				<nav class="navbar navbar-default" role="navigation">
					
					
					<div class="container-fluid">
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
						<ul class="nav navbar-nav">
							<li><a href="index.html">HOME</a></li>
							<li><a href="gallery.html">Galeria</a></li>
							<li><a href="team.html">Zespół</a></li>
							<li><a href="contact.html">Kontakt</a></li>
						</ul>
					</div>
					</div>

				</nav>
			</div>
		</div>
		
		<!-- IV rząd - Zawartość -->
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2
						col-md-8 col-lg-offset-2
						col-sm-10 col-sm-offset-1
						col-xs-12">
				<!-- Formularz -->
				<?php
include 'config.php';
db_connect();

// sprawdzamy czy user nie jest przypadkiem zalogowany
if(!$_SESSION['logged']) {
	// jeśli zostanie naciśnięty przycisk "Zaloguj"
	if(isset($_POST['name'])) {
		// filtrujemy dane...
		$_POST['name'] = clear($_POST['name']);
		$_POST['password'] = clear($_POST['password']);
		// i kodujemy hasło
		$_POST['password'] = codepass($_POST['password']);
		
		// sprawdzamy prostym zapytaniem sql czy podane dane są prawidłowe
		$result = mysql_query("SELECT `user_id` FROM `users` WHERE `user_name` = '{$_POST['name']}' AND `user_password` = '{$_POST['password']}' LIMIT 1");
		if(mysql_num_rows($result) > 0) {
			// jeśli tak to ustawiamy sesje "logged" na true oraz do sesji "user_id" wstawiamy id usera
			$row = mysql_fetch_assoc($result);
			$_SESSION['logged'] = true;
			$_SESSION['user_id'] = $row['user_id'];
			echo '<p>Zostałeś poprawnie zalogowany! Możesz teraz przejść na <a href="index.html">stronę główną</a>.</p>';
		} else {
			echo '<p>Podany login i/lub hasło jest nieprawidłowe.</p>';
		}
	}
	
	// wyświetlamy komunikat na zalogowanie się
	echo '<form method="post" action="login.php">
		<p>
			Login:<br>
			<input type="text" value="'.$_POST['name'].'" name="name">
		</p>
		<p>
			Hasło:<br>
			<input type="password" value="'.$_POST['password'].'" name="password">
		</p>
		<p>
			<input type="submit" value="Zaloguj">
		</p>
	</form>';
} else {
echo '<p>Jesteś już zalogowany, więc nie możesz się zalogować ponownie.</p>
		<p>[<a href="index.html">Powrót</a>]</p>';
}

db_close();
?>

			</div>
			</div>
		</div>

		<! -- V rząd - Stopka -->
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2
						col-md-8 col-lg-offset-2
						col-sm-10 col-sm-offset-1
						col-xs-12">
				<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
					<div class="container-fluid">
						<p align="center">&reg; Copyright 2016. All rights reserved. Power by <b>GauS</b> &amp; <b>Grzegorz</b>.</p>
					</div>
				</nav>
			</div>
		</div>

	</div>
</body>

</html>