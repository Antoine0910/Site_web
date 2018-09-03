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

$reponse = $bdd->query("SELECT prenom, nom FROM Personne WHERE mail =  '". $_SESSION['mail'] ."'");

while ($donnees = $reponse->fetch())
{
    $_SESSION['prenom'] = $donnees['prenom']; 
    $_SESSION['nom'] = $donnees['nom']; 
}
$reponse->closeCursor(); // Termine le traitement de la requête

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

<div class = "bloc">

<div class = "acualité">

<h2> Actualités </h2>


<!-- Renvoie les informations contenue dans la base de donnée -->

<?php



$reponse = $bdd->query('SELECT * FROM Personne, Catégories WHERE Catégories.auteur = Personne.id_Personne');


// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    >> L'auteur du livre est <?php echo $donnees['auteur']; ?> et c'est un <?php echo $donnees['categorie']; ?> </br>
        >> Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> le <?php echo $donnees['parution']; ?>
   </p>
<?php

$reponse->closeCursor(); // Termine le traitement de la requête

?>







<form method="post" action="Nv_sujet_download.php" enctype="multipart/form-data">
<p>
    <label for="Sujet"> Votre réponse : </label> <br />
    <textarea name="Nv_sujet" value "" id="Nv_sujet" placeholder = "Votre sujet" rows="10" cols="50">
        Votre réponse
    </textarea> 
</p>
    <input type="submit" value="Envoyer" class = "envoye"/>
</form>

</div>

<div class = "filtrer">

<h2> Filtrer </h2>

<form method="post" action="trie_par_auteur.php" enctype="multipart/form-data">
    

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
        <select name = "auteur" id = "auteur">
            <option value="Tous">Tous</option>
            <?php echo $ops; ?>
        </select> <br />


    <!-- Trié par catégorie -->
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
    $cat = "";
        while ($row = $reponse->fetch(PDO::FETCH_ASSOC))
        {
           $cat .= "<option value='".$row['id_Livre']."'>".$row['categorie']."</option>";
        }?>

        <label for "categorie"> Par catégorie :</label> <br />
        <select name = "categorie" id = "categorie">
            <option value="Toutes">Toutes</option>
            <?php echo $cat; ?>
        </select> <br />



    <label for="Sujet"> Article postérieur à la date : </label> <br />
        <input type="date" /> <br />
           
    <input type="submit" value="Filter" class = "envoye"/>

</form>

</div>

</div>






<?php exit(); ?>



</body>

</html>



