





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

				<!-- Menu dostępne po zalogowaniu -->
				<div class="row">
					<nav class="navbar navbar-default" role="navigation">
							<div class="conteiner-fluid">
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
									<ul class="nav navbar-nav">
										<li class="active"><a href="profil.php">Mój profil</a></li>
										<li><a href="admin.html">Panel administracyjny</a></li>
										<li><a href="logout.php">Wyloguj</a></li>
									</ul>
								</div>
							</div>
						</nav>
				</div>
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

		<div class="row">
			<div class="col-lg-8 col-lg-offset-2
						col-md-8 col-lg-offset-2
						col-sm-10 col-sm-offset-1
						col-xs-12">
				<nav class="navbar navbar-default" role="navigation">
					
					
					<div class="container-fluid">
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
						<ul class="nav navbar-nav">
							<li><a href="profile.php">Moje dane</a></li>
							<li><a href="wpis.php">Moje wpisy</a></li>
							
						</ul>
					</div>
					</div>

				</nav>
					<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'config.php';
db_connect();

check_login();

$user_data = get_user_data();

// jeśli zostanie naciśnięty przycisk "Edytuj profil"
if(isset($_POST['email'])) {
	// filtrujemy dane
	$_POST['website'] = clear($_POST['website']);
	$_POST['from'] = clear($_POST['from']);
	$_POST['new_password'] = clear($_POST['new_password']);
	$_POST['new_password2'] = clear($_POST['new_password2']);
	$_POST['password'] = clear($_POST['password']);
	$_POST['email'] = clear($_POST['email']);
	
	// zmienne tymczasowe na treść błędu
	$err = '';
	// i zapytanie sql
	$up2 = '';
	
	// jeśli zostanie podane nowe hasło lub inny email
	if(!empty($_POST['new_password']) || $_POST['email'] != $user_data['user_email']) {
		// sprawdzamy czy zostało podane aktualne hasło
		if(empty($_POST['password'])) {
			$err = '<p>Jeśli chcesz zmienić hasło lub adres email musisz podać aktualne hasło.</p>';
		// jeśli zostało podane to sprawdzamy czy jest poprawne
		} elseif(codepass($_POST['password']) != $user_data['user_password']) {
			$err = '<p>Podane aktualne hasło jest nieprawidłowe.</p>';
		} else {
			// jeśli wszystko jest ok...
			
			// sprawdzamy czy user chce zmienić hasło
			if(!empty($_POST['new_password'])) {
				// jeśli podane dwa hasła są różne to wyświetlamy błąd
				if($_POST['new_password'] != $_POST['new_password2']) {
					$err = '<p>Podane hasła nie są takie same.</p>';
				// jeśli wszystko jest ok, dopisujemy do zmiennej tymczasowej zapytanie do zaktualizowania hasła
				} else {
					$up2.= ", `user_password` = '".codepass($_POST['new_password'])."'";
				}
			}
			// sprawdzamy czy user chce zmienić email (czy ten podany jest różny od aktualnego)
			if($_POST['email'] != $user_data['user_email']) {
				// sprawdzamy czy podany email jest prawidłowy
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
					$err = '<p>Podany email jest nieprawidłowy.</p>';
				} else {
					// sprawdzamy czy istnieje taki email w bazie przy czym omijamy usera który jest zalogowany
					$result = mysql_query("SELECT Count(user_id) FROM `users` WHERE `user_id` != '{$user_data['user_id']}' AND `user_email` = '{$_POST['email']}'");
					$row = mysql_fetch_row($result);
					if($row[0] > 0) {
						$err = '<p>Już istnieje użytkownik z takim loginem lub adresem e-mail.</p>';
					} else {
						// jeśli wszystko jest ok to dopisujemy zapytanie do zaktualizowania emaila
						$up2.= ", `user_email` = '{$_POST['email']}'";
					}
				}
			}
		}
	}
	
	// jeśli są jakieś błędy z powyższych działań to je wyświetlamy
	if(!empty($err)) {
		echo $err;
	} else {
		// jeśli nie ma błędów to wykonujemy zapytanie dopisując te na aktualizacje hasła oraz emaila - $up2
		$result = mysql_query("UPDATE `users` SET `user_website` = '{$_POST['website']}', `user_from` = '{$_POST['from']}'{$up2} WHERE `user_id` = '{$user_data['user_id']}'");
		if($result) {
			// jeśli zapytanie się wykonało to wyświetlamy komunikat...
			echo '<p>Twój profil został poprawnie zaktualizowany.</p>';
			// i pobieramy od nowa dane usera aby w poniższym formularze się one zaktualizowały
			$user_data = get_user_data();
		} else {
			// jeśli zapytanie będzie błędne to wyświetlamy treść errora
			echo '<p>Niestety wystąpił błąd:<br>'.mysql_error().'</p>';
		}
	}
}

// wyświetlamy prosty formularz
echo '<form method="post" action="editprofile.php">
	<p>
		Login:<br>
		<input type="text" value="'.$user_data['user_name'].'" disabled="true">
	</p>
	<p>
		Strona WWW:<br>
		<input type="text" value="'.$user_data['user_website'].'" name="website">
	</p>
	<p>
		Skąd:<br>
		<input type="text" value="'.$user_data['user_from'].'" name="from">
	</p>
	<p>
		Nowe hasło (pozostaw puste jeśli nie chcesz zmieniać):<br>
		<input type="password" value="" name="new_password" autocomplete="off">
	</p>
	<p>
		Powtórz nowe hasło:<br>
		<input type="password" value="" name="new_password2" autocomplete="off">
	</p>
	<p>
		E-mail:<br>
		<input type="text" value="'.$user_data['user_email'].'" name="email">
	</p>
	<p>
		Aktualne hasło (wymagane przy zmianie emaila lub hasła):<br>
		<input type="password" value="" name="password" autocomplete="off">
	</p>
	<p>
		<input type="submit" value="Edytuj profil">
	</p>
</form>';

db_close();
?>	
<br><br>
			</div>
		</div>
		
		<!-- IV rząd - Zawartość -->
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2
						col-md-8 col-lg-offset-2
						col-sm-10 col-sm-offset-1
						col-xs-12">
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