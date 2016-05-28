


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
include 'config.php';
db_connect();

check_login();

// filtrujemy id oraz rzutujemy je na int
$_GET['id'] = (int)clear($_GET['id']);

// pobieramy dane usera z podanego id
$user_data = get_wpis_data($_GET['id']);

// sprawdzamy czy znalazło użytkownika
// jeśli nie to wyświetlamy komunikat
// a jeśli tak to wyświetlamy wszystkie jego dane
// jeśli user nie ma podanej strony www lub skąd jest to wyświetlamy "brak"
if($user_data === false) {
	echo '<p>Niestety, wpisów tego użytkownika nie ma.</p>
		<p>[<a href="index.html">Powrót</a>]</p>';
} else {
	echo '<h2>Wpis użytkownika</h2>
			<p>Tytuł: <b>'.$user_data['tytul'].'</b></p>
		<p>Treśc: <b>'.$user_data['tresc'].'</b></p>
		<p>Autor: '.$user_data['id_autora'].'</p>
		<p>Data Wpisu: '.date("d.m.Y, H:i", $user_data['wpis_regdate']).'</p>';

}

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