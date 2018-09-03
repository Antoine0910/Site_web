<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Traitement 2 </title>
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
  <div class = "0"> <a href="actualite.php" title = "actualite"> Actualités </a> </div>
	<div class = "1"> <a href="Acceuil_TP_INFORMATIQUE.php" title = "Acceuil" > Acceuil </a> </div>
	<div class = "2"> <a href="inscription.php" title = "Inscription" > Inscription </a> </div>
	<div class = "3"> <a href="Ajouter_sujet.php" title = "Sujet" > Ajouter un sujet </a> </div>
	<div class = "4"> <a href="contact.php" title = "Contact" > Contact </a> </div>
</div>

<h1> ISEP </h1>


<?php
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=tpforum;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM Personne LIMIT 0,1');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    Je m'appelle <?php echo $donnees['nom']; ?><br />
    Mon mail est <?php echo $donnees['mail']; ?>
   </p>
<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>


<form method="post" action="Fin_TP_INFORMATIQUE.php" enctype="multipart/form-data">
    <input name="supprimer" value="0" type="hidden">
    <input type="checkbox" name="supprimer" id="supprimer"/> <label for="supprimer">Supprimer les informations contenues dans la base de donnée </label> <br/> </br>

    <input type="submit" value="Envoyer" class = "envoye"/>
</form>



<!--  Ouvre une fenêtre avec un message  
<script>
        alert('Hello world!');
    </script>
-->

</body>

</html>













