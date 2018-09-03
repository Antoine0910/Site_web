<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
        <title> Acceuil </title>
    </head>

<body>

<div class = "logo">
        <a href = "isep.png"> <img src="isep2.png" alt="logo" title ="logo"/>
        </a>
</div>

<!-- Identifiant lorsque la personne se connecte -->
<div class = "Pseudo">
<?php 
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=tpforum;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query("SELECT prenom_Admin, nom_Admin FROM admin WHERE mail_Admin =  '". $_SESSION['mail_Admin'] ."'");

while ($donnees = $reponse->fetch())
{
    $_SESSION['prenom_Admin'] = $donnees['prenom_Admin']; 
    $_SESSION['nom_Admin'] = $donnees['nom_Admin']; 
}
$reponse->closeCursor(); // Termine le traitement de la requête

echo "Administrateur : ".$_SESSION['prenom_Admin'].' '.$_SESSION['nom_Admin'];
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


<div class = "Modifications">

<h2> Informations </h2>

<form method="post" action="acceuil_connect.php" enctype="multipart/form-data">
    
    <div class = "Livre">

    <h3> Livres </h3>

    <!-- Trié par auteur -->
    <?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=tpforum;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    $reponse = $bdd->query('SELECT * FROM Catégories');
    $ops = "";
        while ($row = $reponse->fetch(PDO::FETCH_ASSOC))
        {
           $ops .= "<option value='".$row['id_Livre']."'>".$row['auteur']."</option>";
        }?>

        <label for "auteur"> Par auteur de sujet :</label> <br />
        <select name = "auteur[]" id = "auteur">
           <option value="Tous">Tous</option>
            <?php echo $ops; ?> 
        </select> <br />







</body>

</html>















