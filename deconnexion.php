<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Acceuil </title>
    </head>

<body>

<div class = "logo">
		<a href = "isep.png"> <img src="isep2.png" alt="logo" title ="logo"/>
   	 	</a>
</div>

<div class = "lien">
    <div class = "0"> <a href="actualite.php" title = "actualite"> Actualités </a> </div>
	<div class = "1"> <a href="connection.php" title = "Acceuil" > Connection </a> </div>
	<div class = "2"> <a href="inscription.php" title = "Inscription" > Inscription </a> </div>
</div>

<h1> ISEP </h1>

<p> Merci pour votre visite et à bientôt </p>

<?php session_destroy();?>