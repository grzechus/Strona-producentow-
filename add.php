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
										<li><a href="profil.php">Mój profil</a></li>
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
							<li class="active"><a href="index.html">HOME</a></li>
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
				<!-- Menu dostępne po zalogowaniu -->
				<div class="row">
					<nav class="navbar navbar-default" role="navigation">
						<div class="conteiner-fluid">
							<a href="add.php"><button type="button" class="btn btn-default navbar-btn">Dodaj wpis</button></a>
							<a href="wpis.php"><button type="button" class="btn btn-default navbar-btn">Moje wpisy</button></a>
						</div>
					</nav>
				</div>

								<?php
include 'config.php';
db_connect();

// sprawdzamy czy user nie jest przypadkiem zalogowany
//if(!$_SESSION['logged']) {
	if($_SESSION['logged']) {
	// jeśli zostanie naciśnięty przycisk "Zarejestruj"
	if(isset($_POST['tresc'])) {
		// filtrujemy dane...
		/*$tytul = $_POST['tytul'];
		$tresc = $_POST['tresc'];
		$id_autora = $_POST['id_autora'];
		$status_wpisu = $_POST['status_wpisu'];
		$czas ;
		*/
		$_POST['tytul'] = clear($_POST['tytul']);
		$_POST['tresc'] = clear($_POST['tresc']);
		$_POST['id_autora'] = clear($_POST['id_autora']);
		$_POST['status_wpisu'] = clear($_POST['status_wpisu']);
		
		
		// sprawdzamy czy wszystkie pola zostały wypełnione
		if(empty($_POST['tresc']) || empty($_POST['tytul']) || empty($_POST['id_autora']) || empty($_POST['status_wpisu'])){ 
			echo '<p>Musisz wypełnić wszystkie pola.</p>';
		
		} else {
			
			
				// i wykonujemy zapytanie na dodanie usera
				\mysql_query("INSERT INTO `wpisy` (`tytul`, `tresc`, `id_autora`, `status_wpisu`, `wpis_regdate`) VALUES ('{$_POST['tytul']}', '{$_POST['tresc']}', '{$_POST['id_autora']}', '{$_POST['status_wpisu']}', '".time()."')");
			// dodajemy rekord do bazy 
			//mysql_query("INSERT INTO wpisy SET tytul='$tytul', tresc='$tresc', id_autora='$id_autora', status_wpisu='$status_wpisu', czas='".time()."'");
			echo '<p>Poprawnie dodany post</a>.</p>';
			}
		}
	
	
	// wyświetlamy formularz
	echo '<form method="post" action="add.php">
		<p>
			Tytul:<br>
			<input type="text" value="'.$_POST['tytul'].'" name="tytul">
		</p>
		<p>
			Tresc:<br>
			<input type="text" value="'.$_POST['tresc'].'" name="tresc">
		</p>
		<p>
			Autor:<br>
			<input type="int" value="'.$_POST['id_autora'].'" name="id_autora">
		</p>
		<p>
			Status:<br>
			<input type="text" value="'.$_POST['status_wpisu'].'" name="status_wpisu">
		</p>
		
		<p>
			<input type="submit" value="Dodaj">
		</p>
	</form>';
//} else {
	//echo '<p>Jesteś już zalogowany, więc nie możesz stworzyć nowego konta.</p>
		//<p>[<a href="index.html">Powrót</a>]</p>';
//}
}
db_close();
?>

				<!-- Więcej -->
				<div class="row">
					<div class="col-lg-12
								col-md-12
								col-sm-12
								col-xs-12">
						<p align="right"><a href="#">Więcej...</a></p>
					</div>
				</div>

				<!-- Paginacja -->
				<div class="row">
					<div class="col-lg-12
								col-md-12
								col-sm-12
								col-xs-12">
						<ul class="pager">
  							<li class="previous"><a href="#">&larr; Poprzednie</a></li>
  							<li class="next"><a href="#">Następne &rarr;</a></li>
						</ul>
					</div>
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