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

<div class = "lien">
    <div class = "0"> <a href="actualite.php" title = "actualite"> Actualités </a> </div>
    <div class = "1"> <a href="connection.php" title = "Acceuil" > Connection </a> </div>
    <div class = "2"> <a href="inscription.php" title = "Inscription" > Inscription </a> </div>
    <div class = "5"> <a href="admin.php" title = "Administrateur" > Administrateur </a> </div>
</div>

<h1> ISEP </h1>


<div id = "bloc">


<div class = "filtrer">

<h2> Filtrer </h2>

<form method="post" action="actualite.php" enctype="multipart/form-data">
    

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

</div> <!-- div filtrer -->



<div class = "actualité">

<h2> Actualités </h2>

<div class = "livre">

<!-- Renvoie les informations contenue dans la base de donnée -->
<?php

if(isset($_POST['auteur']) == "Tous" OR isset($_POST['auteur']) == "")
{
// Prend les informations sur les livres
$reponse = $bdd->query('SELECT * FROM Personne, Catégories WHERE Catégories.id_Personne = Personne.id_Personne ORDER BY parution DESC');


// Prend les inforations sur les messages
$message = $bdd->query('SELECT * FROM Personne, Messages WHERE Messages.id_Personne = Personne.id_Personne ORDER BY date_message DESC LIMIT 0, 3');


// On affiche chaque livre, auteur un par un
while ($donnees = $reponse->fetch())
{
?>
    <p> 
    Livre : <?php echo $donnees['livre']; ?> </br>
    L'auteur du livre est <?php echo $donnees['auteur']; ?> </br>
    Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> le <?php echo $donnees['parution']; ?> </br>
    Catégorie : <?php echo $donnees['categorie']; ?>
   </p>
</div> <!-- div livre -->

        <div class = "message"> 
        <?php  
        // Renvoie tous les messages un par un 
        while ($donnees = $message->fetch())
        {
        ?>
            <p>
            >> Message : <?php echo $donnees['message']; ?> </br>
            Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> le <?php echo $donnees['date_message']; ?> </br>
           </p>
        <?php } ?>
        <form method="post" action="connection.php" enctype="multipart/form-data">
            <input type="submit" value="Se connecter pour ajouter une réponse" class = "envoye"/>
        </form>


        </div> <!-- div message -->
<?php     
} 
}
else
{
    echo "Filtrage par catégories"; //Ajouter le filtrage par auteur et par catégorie
}
?>


<?php 
// Importation des messages dans la base de donnée
$_SESSION['date_message'] = date('d/m/Y H:i:s');


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


if(isset($_POST['message']) AND $_POST['message'] != NULL)
{
$req = $bdd->prepare('INSERT INTO Messages(id_Personne, message, date_message) VALUES(:id_Personne, :message, :date_message)');
$req->execute(array(
    'id_Personne' => $_SESSION['id_Personne'],
    'message' => $_POST['message'],
    'date_message' => $_SESSION['date_message']
    ));
}
else
{
    echo "Pas de message ajouté";
}

$reponse->closeCursor(); // Termine le traitement de la requête
?>

</div> <!-- div actualité -->


</div> <!-- div bloc -->










</body>

</html>















