<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
    	<title> Traitement 3 </title>
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

<p>
	La requète a bien étée effectuée </br>
    <a href = "TP_INFORMATIQUE.php"> Changer mes informations </a>
</p>

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

if ($_POST['supprimer'] == "on")
                {
                    $supprimer = 1;
                }
                else
                {
                    $supprimer = 0;
                }

if ($supprimer==1)
    {
    	$supprimer = $bdd->exec('DELETE FROM Personne /*WHERE nom=\'Antoine Madrange\'*/');
    	echo "Les informations ont été supprimées";
  	}
    else
    {
        echo "Les informations n'ont pas été supprimées";
    }
?>





</body>

</html>