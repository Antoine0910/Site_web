<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Connection </title>
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

<h2> Connection </h2>

<form method="post" action="diriger.php" enctype="multipart/form-data">
            <label for = "mail"> Votre adresse mail : </label> </br>
            <input type = "text" name = "mail" id = "mail" placeholder = "Votre e-mail" size = "45" required /> </br>

            <label for = "password"> Votre mot de passe : </label> </br>
            <input type = "password" name = "password" id = "password" placeholder = "Votre mot de passe" size = "45" required /> 
            </br>
            <input type="submit" value="Envoyer" class = "envoye"/>
</form> 


<h2> Pas encore de compte : <a href = "inscription.php"> Inscription </a> </h2>








</body>
</html>