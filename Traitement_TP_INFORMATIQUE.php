<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Traitement </title>
    </head>

<body>

<div class = "logo">
		<a href = "isep.png"> <img src="isep2.png" alt="logo" title ="logo"/>
   	 	</a>
</div>

<div class = "Pseudo">
<?php 
$_SESSION['nom'] = $_POST['nom'];
$_SESSION['prenom'] = $_POST['prenom'];
$_SESSION['mail'] = $_POST['mail'];
echo $_SESSION['prenom'].' '.$_SESSION['nom'];
?>
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


<!--  Renvoie le nom et l'adresse mail du formulaire précédent  -->
<p>
Je m'appelle <?php echo htmlspecialchars($_POST['prenom']).' '. htmlspecialchars($_POST['nom']);?> mon adresse mail est <?php echo htmlspecialchars($_POST['mail']); ?> 
</p>


<p>
<!--  Permet d'enregistrer une donnée dans la base de donnée  -->
<?php 
$sexe = $_POST['sexe'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$mail = $_POST['mail'];
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
$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
$req = $bdd->prepare('INSERT INTO Personne(sexe, prenom, nom, mail, password) VALUES(:sexe, :prenom, :nom, :mail, :password)');
$req->execute(array(
    'sexe' => $sexe,
    'prenom' => $prenom,
    'nom' => $nom,
    'mail' => $mail,
    'password' => $pass_hache));


echo 'Vos données ont bien étée enregistrée'; ?> 
</p>

<form method="post" action="acceuil_connect.php" enctype="multipart/form-data">
	<input type="submit" value="Acceuil" class = "envoye"/>
</form>



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

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id_Personne FROM Personne WHERE mail = :mail');
$req->execute(array(
    'mail' => $mail));
$resultat = $req->fetch();
$_SESSION['id_Personne'] = $resultat['id_Personne']; ?>





</body>

</html>













