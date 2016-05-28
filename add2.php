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
if($_SESSION['logged']) {
	// jeśli zostanie naciśnięty przycisk "Zarejestruj"
	if(isset($_POST['tresc'])) {
		// filtrujemy dane...
		$_POST['tytul'] = clear($_POST['tytul']);
		$_POST['tresc'] = clear($_POST['tresc']);
		$_POST['id_autora'] = clear($_POST['id_autora']);
		$_POST['status_wpisu'] = clear($_POST['status_wpisu']);
		
		// sprawdzamy czy wszystkie pola zostały wypełnione
		if(empty($_POST['tresc']) || empty($_POST['tytul']) || empty($_POST['id_autora']) || empty($_POST['status_wpisu'])){ 
			echo '<p>Musisz wypełnić wszystkie pola.</p>';
		// sprawdzamy czy podane dwa hasła są takie same
		} else {
				// i wykonujemy zapytanie na dodanie usera
				mysql_query("INSERT INTO `wpisy` (`tytul`, `tresc`, `id_autora`, `status_wpisu`, `regdate`) VALUES ('$tytul', '$tresc', '$id_autora', '$status_wpisu', '".time()."')");
				//mysql_query("INSERT INTO wpisy SET tytul='$tytul', tresc='$tresc', id_autora='$id_autora', status_wpisu='$status_wpisu'");
				//Definiujemy zapytanie do tabeli newsletter wpisujace dane nowego
 //subskrybenta
      // $zapytanie = "INSERT INTO `wpisy` (`tytul`, `Imie`, `Nazwisko`, 
 
     //    			`Mail`) ";
    //   $zapytanie .= "VALUES ('', '$imie', '$nazwisko', '$mail')";
 //Wykonujemy zapytanie na bazie mysql
      // $wynik_zapytania = mysql_query($zapytanie);
				echo '<p>Poprawnie dodany post</a>.</p>';
			}
		}
	
	
	// wyświetlamy formularz
	echo '<form method="post" action="add2.php">
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