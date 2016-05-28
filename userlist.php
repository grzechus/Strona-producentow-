







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
							<li><a href="#">Moje wpisy</a></li>
							<li><a href="#">Moje zgłoszone błędy</a></li>
						</ul>
					</div>
					</div>

				</nav>
	<?php
include 'config.php';
db_connect();

check_login();

// wyświetlamy początek prostej tabelki
echo '<h2>Lista użytkowników</h2>
	<table border="1" width="500px">
		<tr>
			<th>Nick</th>
			<th>Email</th>
			<th>Data rejestracji</th>
		</tr>';

// sprawdzamy ilu jest wszystkich userów
$result = mysql_query("SELECT Count(user_id) FROM `users`");
$row = mysql_fetch_row($result);
$count_users = $row[0];

// ustawiamy ile ma być wyników na 1 strone
$per_page = 10;

// obliczamy ilość stron
$pages = ceil($count_users / $per_page);

// aktualna strona - jeśli nie została podana to = 1
// jeśli została podana to filtrujemy ją i rzutujemy na int
$current_page = !isset($_GET['page']) ? 1 : (int)clear($_GET['page']);

// jeśli ktoś poda stronę mniejszą niż 1 lub większą niż ilość stron to zmieniamy ją na 1
if($current_page < 1 || $current_page > $pages) {
	$current_page = 1;
}

// jeśli jest chociaż 1 user to wyświetlamy
if($count_users > 0) {
	$result = mysql_query("SELECT * FROM `users` ORDER BY `user_id` ASC LIMIT ".($per_page*($current_page-1)).", ".$per_page);
	while($row = mysql_fetch_assoc($result)) {
		echo '<tr>
			<td><a href="profile.php?id='.$row['user_id'].'">'.$row['user_name'].'</a></td>
			<td>'.$row['user_email'].'</td>
			<td>'.date("d.m.Y, H:i", $row['user_regdate']).'</td>
		</tr>';
	}
} else {
	// jeśli nie ma w ogóle to wyświetlamy komunikat
	echo '<tr>
		<td colspan="3" style="text-align:center">Niestety nie znaleziono żadnych użytkowników.</td>
	</tr>';
}
echo '</table>';

// wyświetlamy stronicowanie
if($pages > 0) {	
	echo '<p>';
	if($pages < 11) {
		for($i = 1; $i <= $pages; $i++) {
			if($i == $current_page) {
				echo '<b>['.$current_page.']</b> ';
			} else {
				echo '<a href="userlist.php?page='.$i.'">['.$i.']</a> ';
			}
		}
	} elseif($current_page > 10) {
		echo '<a href="userlist.php?page=1">[1]</a> ';
		echo '<a href="userlist.php?page=2">[2]</a> ';
		echo '[...] ';
		for($i = ($current_page-3); $i <= $current_page; $i++) {
			if($i == $current_page) {
				echo '<b>['.$current_page.']</b> ';
			} else {
				echo '<a href="userlist.php?page='.$i.'">['.$i.']</a> ';
			}
		}
		for($i = ($current_page+1); $i <= ($current_page+3); $i++) {
			if($i > ($pages)) break;
			if($i == $current_page) {
				echo '<b>['.$current_page.']</b> ';
			} else {
				echo '<a href="userlist.php?page='.$i.'">['.$i.']</a> ';
			}
		}
		if($current_page < ($pages-4)) {
			echo '[...] ';
			echo '<a href="userlist.php?page='.($pages-1).'">['.($pages-1).']</a> ';
			echo '<a href="userlist.php?page='.$pages.'">['.$pages.']</a> ';
		} elseif($current_page == ($pages-4)) {
			echo '[...] ';
			echo '<a href="userlist.php?page='.$pages.'">['.$pages.']</a> ';
		}
	} else {
		for($i = 1; $i <= 11; $i++) {
			if($i == $current_page) {
				if($i > ($pages)) break;
				echo '<b>['.$current_page.']</b> ';
			} else {
				echo '<a href="userlist.php?page='.$i.'">['.$i.']</a> ';
			}
		}
		if($pages > 12) {
			echo '[...] ';
			echo '<a href="userlist.php?page='.($pages-1).'">['.($pages-1).']</a> ';
			echo '<a href="userlist.php?page='.$pages.'">['.$pages.']</a> ';
		} elseif($pages == 12) {
			echo '[...] ';
			echo '<a href="userlist.php?page=12">[12]</a> ';
		}
	}
	echo '</p>';
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