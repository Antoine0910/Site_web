<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Page administrateur </title>
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

<form method="post" action="diriger_admin.php" enctype="multipart/form-data">
            <label for = "mail_Admin"> Votre adresse mail administrateur : </label> </br>
            <input type = "text" name = "mail_Admin" id = "mail_Admin" placeholder = "Votre e-mail" size = "45" required /> </br>

            <label for = "password"> Votre mot de passe administrateur : </label> </br>
            <input type = "password" name = "password_Admin" id = "password_Admin" placeholder = "Votre mot de passe" size = "45" required /> 
            </br>
            <input type="submit" value="Envoyer" class = "envoye"/>
</form> 


<h2> Pas encore de compte : <a href = "inscription_admin.php"> Inscription pour être administrateur </a> </h2>






</body>
</html>