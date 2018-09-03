<?php session_start();?>
<!--Antoine Madrange-->

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

<div class = "Pseudo">
<?php 
echo $_SESSION['prenom'].' '.$_SESSION['nom'];
?> 
</div>

<div class = "deco">
<a href = "deconnexion.php"> Déconnexion </a>
</div>

<div class = "lien">
	<div class = "0"> <a href="actualite.php" title = "actualite"> Actualités </a> </div>
	<div class = "1"> <a href="connection.php" title = "Acceuil" > Connection </a> </div>
	<div class = "2"> <a href="inscription.php" title = "Inscription" > Inscription </a> </div>
	<div class = "3"> <a href="Ajouter_sujet.php" title = "Sujet" > Ajouter un sujet </a> </div>
	<div class = "4"> <a href="contact.php" title = "Contact" > Contact </a> </div>
</div>

<h1> ISEP </h1>

<div class = "blocs">

	<div class = "Partie_1">

	<h2> Ecole d'ingénieurs du numérique </h2>

	<p>
		<em>Lorem ipsum dolor sit amet</em>, consecteur adipiscing elit. </br>Vestibulum aliquet justo sit amet mauris condimentum 
	</p>

	<ul>
		<li> Ut auctor sem non eros blandit molestie, </li>
		<li> Pellentesque odio ipsum, </li>
		<li> mollis sit amet augue ae, </li>
		<li> bibendum condimentum nibh, </li>
	</ul>

	<p>
		Nullam <b> vel nibh pellentesque </b>, aliquet urna nec, faucibus nisi.
	</p>
	</div>

	<div class = "Parte_2">

	<h2> Inscription au forum </h2>

		<form method="post" action="Traitement_TP_INFORMATIQUE.php" enctype="multipart/form-data">
		    <label for = "pseudo"> Votre nom : </label> </br>
		    <input type = "text" name = "nom" id = "nom" placeholder = "Votre nom" size = "45" required /> </br>

		    <label for = "mail"> Votre e-mail : </label> </br>
		    <input type = "email" name = "mail" id = "mail" placeholder = "Votre e-mail" size = "45" required /> 
		    </br>
			<input type="submit" value="Envoyer" class = "envoye"/>
		</form>	
	</div>
		
	<div class = "Partie_3">

		<h2> Poster un nouveau sujet </h2>

		<form method="post" action="Ajouter_sujet.php" enctype="multipart/form-data">
			<label for="Sujet"> Votre sujet : </label> <br />
			<textarea name="Nv_sujet" value "" id="Nv_sujet" placeholder = "Votre sujet" rows="10" cols="50">Votre sujet
			</textarea> 
		</br>
		<input type="submit" value="Envoyer" class = "envoye"/>
		</form>	
	</div>



	<div class = "Partie_4">

	<h2> Sujet en cours </h2>

	<p> Lorem ipsum </p>
	<p> Proin convallis </p>
	<p> Sed vestibulum </p>
	</div>

</div>




</body>

</html>















