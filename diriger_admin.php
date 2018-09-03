<?php
session_start();

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

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id_Admin, password_Admin FROM admin WHERE mail_Admin = :mail_Admin');
$req->execute(array(
    'mail_Admin' => $mail));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['password_Admin'], $resultat['password_Admin']);

if (!$resultat)
{
    header ('Location: admin.php');
        exit();
}
else
{
    if ($isPasswordCorrect) {
        $_SESSION['id_Admin'] = $resultat['id_Admin'];
        $_SESSION['mail_Admin'] = $mail;
		header('Location: acceuil_admin.php');
			exit();
    }
    else { 
        header ('Location: admin.php'); 
        exit();
    }
}
?>







