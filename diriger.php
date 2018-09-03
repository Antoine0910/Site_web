<?php
session_start();

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

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id_Personne, password FROM Personne WHERE mail = :mail');
$req->execute(array(
    'mail' => $mail));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

if (!$resultat)
{
    header ('Location: connection.php');
        exit();
}
else
{
    if ($isPasswordCorrect) {
        $_SESSION['id_Personne'] = $resultat['id_Personne'];
        $_SESSION['mail'] = $mail;
		header('Location: acceuil_connect.php');
			exit();
    }
    else { 
        header ('Location: connection.php'); 
        exit();
    }
}
?>







