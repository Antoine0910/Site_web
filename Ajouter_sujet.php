<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Ajouter un sujet </title>
    </head>

<body>

<div class = "logo">
		<a href = "isep.png"> <img src="isep2.png" alt="logo" title ="logo"/>
   	 	</a>
</div>

<div class = "Pseudo">
<?php echo $_SESSION['prenom'].' '.$_SESSION['nom']; ?>
</div> 

<div class = "deco">
<a href = "deconnexion.php"> Déconnexion </a>
</div>

<div class = "lien">
	<div class = "0"> <a href="acceuil_connect.php" title = "actualite"> Actualités </a> </div>
	<div class = "3"> <a href="Ajouter_sujet.php" title = "Sujet" > Ajouter un sujet </a> </div>
	<div class = "4"> <a href="contact.php" title = "Contact" > Contact </a> </div>
</div>

<h1> ISEP </h1>


<form method="post" action="Nv_sujet_download.php" enctype="multipart/form-data">
	
	<p>
	<label for = "livre"> Nom du livre </label>
	<input type = "text" name = "livre" id = "livre" placeholder = "Nom du livre" required size = "30"/> </br>
	</p>

	<p>
	<label for = "auteur"> Auteur </label>
	<input type = "text" name = "auteur" id = "auteur" placeholder = "Nom de l'auteur" required size = "36"/> </br>
	</p>

	<p>
	<label for = "categorie"> Thème ou genre de livre </label> 
	<input type = "text" name = "categorie" id = "categorie" placeholder = "Catégorie" required /> </br>
	</p>

	<p>
	<label for="Sujet"> Ajouter un sujet : </label> <br />
	<textarea name="Nv_sujet" value = "" id="Nv_sujet" placeholder = "Votre sujet" rows="10" cols="50">
	
	</textarea> </br>
	</p>

    <input type="submit" value = "Envoyer" class = "envoye"/>
</form>

<?php $_SESSION['parution'] = date('d/m/Y H:i:s');
?>















</body>
</html>




