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
				<?php
include 'config.php';
db_connect();

// sprawdzamy czy user nie jest przypadkiem zalogowany
if(!$_SESSION['logged']) {
	// jeśli zostanie naciśnięty przycisk "Zarejestruj"
	if(isset($_POST['name'])) {
		// filtrujemy dane...
		$_POST['name'] = clear($_POST['name']);
		$_POST['password'] = clear($_POST['password']);
		$_POST['password2'] = clear($_POST['password2']);
		$_POST['email'] = clear($_POST['email']);
		
		// sprawdzamy czy wszystkie pola zostały wypełnione
		if(empty($_POST['name']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['email'])) {
			echo '<p>Musisz wypełnić wszystkie pola.</p>';
		// sprawdzamy czy podane dwa hasła są takie same
		} elseif($_POST['password'] != $_POST['password2']) {
			echo '<p>Podane hasła różnią się od siebie.</p>';
		// sprawdzamy poprawność emaila
		} elseif(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			echo '<p>Podany email jest nieprawidłowy.</p>';
		} else {
			// sprawdzamy czy są jacyś uzytkownicy z takim loginem lub adresem email
			$result = mysql_query("SELECT Count(user_id) FROM `users` WHERE `user_name` = '{$_POST['name']}' OR `user_email` = '{$_POST['email']}'");
			$row = mysql_fetch_row($result);
			if($row[0] > 0) {
				echo '<p>Już istnieje użytkownik z takim loginem lub adresem e-mail.</p>';
			} else {
				// jeśli nie istnieje to kodujemy haslo...
				$_POST['password'] = codepass($_POST['password']);
				// i wykonujemy zapytanie na dodanie usera
				mysql_query("INSERT INTO `users` (`user_name`, `user_password`, `user_email`, `user_regdate`) VALUES ('{$_POST['name']}', '{$_POST['password']}', '{$_POST['email']}', '".time()."')");
				echo '<p>Zostałeś poprawnie zarejestrowany! Możesz się teraz <a href="login.php">zalogować</a>.</p>';
			}
		}
	}
	
	// wyświetlamy formularz
	echo '<form method="post" action="register.php">
		<p>
			Login:<br>
			<input type="text" value="'.$_POST['name'].'" name="name">
		</p>
		<p>
			Hasło:<br>
			<input type="password" value="'.$_POST['password'].'" name="password">
		</p>
		<p>
			Powtórz hasło:<br>
			<input type="password" value="'.$_POST['password2'].'" name="password2">
		</p>
		<p>
			E-mail:<br>
			<input type="text" value="'.$_POST['email'].'" name="email">
		</p>
		<p>
			<input type="submit" value="Zarejestruj">
		</p>
	</form>';
} else {
	echo '<p>Jesteś już zalogowany, więc nie możesz stworzyć nowego konta.</p>
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