<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Formulaire d'inscription </title>
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


<h2> Inscription au forum </h2>

	<form method="post" action="traitement_inscription_admin.php" enctype="multipart/form-data">

        <label for = "sexe"> Civilité : </label> </br>
        <input type="radio" name="sexe" value="M" id="sexe" required /> <label for="M">M</label><br />
        <input type="radio" name="sexe" value="F" id="sexe" required /> <label for="F">F</label><br />

        <label for = "pseudo"> Votre prénom : </label> </br>
	    <input type = "text" name = "prenom_Admin" id = "prenom_Admin" placeholder = "Prénom" size = "45" required /> </br>

	    <label for = "pseudo"> Votre nom : </label> </br>
	    <input type = "text" name = "nom_Admin" id = "nom_Admin" placeholder = "Nom" size = "45" required /> </br>

	    <label for = "mail"> Votre e-mail : </label> </br>
	    <input type = "email" name = "mail_Admin" id = "mail_Admin" placeholder = "E-mail" size = "45" required /> </br> 

		<label for = "password"> Votre mot de passe : </label> </br>
	    <input type = "password" name = "password_Admin" id = "password_Admin" placeholder = "Mot de passe" size = "45" required /></br>

		<label for = "password"> Confirmer votre mot de passe : </label> </br>
	    <input type = "password" name = "password_Admin" id = "password_Admin" placeholder = "Mot de passe" size = "45" required /></br>
	    

		<input type="submit" value="Envoyer" class = "envoye"/>
	</form>	
	
		









</body>

</html>
