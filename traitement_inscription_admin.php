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
$_SESSION['nom_Admin'] = $_POST['nom_Admin'];
$_SESSION['prenom_Admin'] = $_POST['prenom_Admin'];
$_SESSION['mail_Admin'] = $_POST['mail_Admin'];
echo "Administrateur : ".$_SESSION['prenom_Admin'].' '.$_SESSION['nom_Admin'];
?>
</div>

<div class = "deco">
<a href = "deconnexion.php"> Déconnexion </a>
</div>

<div class = "lien">
    <div class = "0"> <a href="acceuil_admin.php" title = "actualite"> Actualités </a> </div>
	<div class = "3"> <a href="Ajouter_sujet.php" title = "Sujet" > Ajouter un sujet </a> </div>
	<div class = "4"> <a href="contact.php" title = "Contact" > Contact </a> </div>
</div>

<h1> ISEP </h1>


<!--  Renvoie le nom et l'adresse mail du formulaire précédent  -->
<p>
Je m'appelle <?php echo htmlspecialchars($_POST['prenom_Admin']).' '. htmlspecialchars($_POST['nom_Admin']);?> mon adresse mail est <?php echo htmlspecialchars($_POST['mail_Admin']); ?> 
</p>


<p>
<!--  Permet d'enregistrer une donnée dans la base de donnée  -->
<?php 
$sexe = $_POST['sexe'];
$prenom = $_POST['prenom_Admin'];
$nom = $_POST['nom_Admin'];
$mail = $_POST['mail_Admin'];
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
$pass_hache = password_hash($_POST['password_Admin'], PASSWORD_DEFAULT);
$req = $bdd->prepare('INSERT INTO admin(sexe, prenom_Admin, nom_Admin, mail_Admin, password_Admin) VALUES(:sexe, :prenom_Admin, :nom_Admin, :mail_Admin, :password_Admin)');
$req->execute(array(
    'sexe' => $sexe,
    'prenom_Admin' => $prenom,
    'nom_Admin' => $nom,
    'mail_Admin' => $mail,
    'password_Admin' => $pass_hache));


echo 'Vos données ont bien étée enregistrée dans la base de donnée administrateur'; ?> 
</p>

<form method="post" action="acceuil_admin.php" enctype="multipart/form-data">
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
$req = $bdd->prepare('SELECT id_Admin FROM admin WHERE mail_Admin = :mail_Admin');
$req->execute(array(
    'mail_Admin' => $mail));
$resultat = $req->fetch();
$_SESSION['id_Admin'] = $resultat['id_Admin']; ?>





</body>

</html>













