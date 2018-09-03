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
    <div class = "6"> <a href="gestion.php" title = "gestion" > Gestion des données </a> </div>
</div>

<h1> ISEP </h1>


<div id = "bloc">


<div class = "filtrer">

<h2> Filtrer </h2>

<form method="post" action="acceuil_connect.php" enctype="multipart/form-data">
    

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
        <select name = "categorie[]" id = "categorie">
            <option value="Toutes">Toutes</option>
            <?php echo $cat; ?>
        </select> <br />



    <label for="Sujet"> Article postérieur à la date : </label> <br />
        <input type="date" /> <br />
           
    <input type="submit" value="Filter" class = "envoye"/>

</form>

</div> <!-- div filtrer -->




<?php 
// Renvoie les information pour le triage

$id_Livre_filtrage = "Tous";
$categorie_filtrage = "Toutes";

if (isset($_POST['auteur']))
{
foreach($_POST['auteur'] as $id_Livre_filtrage);
}

if (isset($_POST['categorie'])) 
{    
foreach($_POST['categorie'] as $categorie_filtrage);
}
?>



<div class = "actualité">

<h2> Actualités </h2>

<div class = "livre">

<!-- Renvoie les informations contenue dans la base de donnée -->
<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=tpforum;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

if($id_Livre_filtrage == "Tous" AND $categorie_filtrage == "Toutes")
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
    Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> 
    le <?php echo $donnees['parution']; ?> </br>
    Catégorie : <?php echo $donnees['categorie']; ?>

   </p>

</div> <!-- div livre -->


        <div class = "message"> 

        <?php  
        $id_Livre_query = $bdd->query('SELECT id_Livre FROM Personne, Catégories WHERE Catégories.id_Personne = Personne.id_Personne ORDER BY parution DESC');


        $message_pers = $bdd->query('SELECT * FROM Personne, Catégories, Messages WHERE Messages.id_Livre = Catégories.id_Livre ORDER BY date_message DESC LIMIT 0, 3');



        // Renvoie tous les messages un par un 

    
        while ($donnees = $message->fetch())
        { 
            ?>
        
        <p>

            >> Message : <?php echo $donnees['message']; ?> </br>
            Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> 
            le <?php echo $donnees['date_message']; ?> </br>

        </p>
        
        <?php
        }   ?>


        <form method="post" action="afficher_message.php" enctype="multipart/form-data">
            <input type="submit" value="Afficher tout" class = "envoye"/>
        </form>



        <form method="post" action="acceuil_connect.php" enctype="multipart/form-data">
            <p>
                <label for="Sujet"> Votre réponse : </label> <br />
                <textarea name="message" value "" id="message" placeholder = "Votre réponse" rows="6" cols="50"></textarea> 
            </p>
                <input type="submit" value="Envoyer" class = "envoye"/>
        </form>


        </div> <!-- div Message-->


    <?php     
    } // Ferme le while

    } // Ferme le if


// Trie les informations par Auteur

elseif ($id_Livre_filtrage != "Tous" AND $categorie_filtrage == "Toutes")
{

echo "Le filtrage de l'auteur a marché";

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=tpforum;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

    // Prend les informations sur les livres
$reponse = $bdd->query('SELECT * FROM Personne, Catégories WHERE Catégories.id_Personne = Personne.id_Personne AND "' .$id_Livre_filtrage. '" = id_Livre');


// Prend les inforations sur les messages
$message = $bdd->query('SELECT * FROM Personne, Messages WHERE Messages.id_Personne = Personne.id_Personne ORDER BY date_message DESC LIMIT 0, 3');


// On affiche chaque livre, auteur un par un
while ($donnees = $reponse->fetch())
{
?>
    <p> 

    Livre : <?php echo $donnees['livre']; ?> </br>
    L'auteur du livre est <?php echo $donnees['auteur']; ?> </br>
    Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> 
    le <?php echo $donnees['parution']; ?> </br>
    Catégorie : <?php echo $donnees['categorie']; ?>

   </p>

</div> <!-- div livre -->


        <div class = "message"> 

        <?php  
        $id_Livre_query = $bdd->query('SELECT id_Livre FROM Personne, Catégories WHERE Catégories.id_Personne = Personne.id_Personne ORDER BY parution DESC');


        $message_pers = $bdd->query('SELECT * FROM Personne, Catégories, Messages WHERE Messages.id_Livre = Catégories.id_Livre ORDER BY date_message DESC LIMIT 0, 3');



        // Renvoie tous les messages un par un 

    
        while ($donnees = $message->fetch())
        { 
            ?>
        
        <p>

            >> Message : <?php echo $donnees['message']; ?> </br>
            Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> 
            le <?php echo $donnees['date_message']; ?> </br>

        </p>
        
        <?php
        }   ?>


        <form method="post" action="afficher_message.php" enctype="multipart/form-data">
            <input type="submit" value="Afficher tout" class = "envoye"/>
        </form>



        <form method="post" action="acceuil_connect.php" enctype="multipart/form-data">
            <p>
                <label for="Sujet"> Votre réponse : </label> <br />
                <textarea name="message" value "" id="message" placeholder = "Votre réponse" rows="6" cols="50"></textarea> 
            </p>
                <input type="submit" value="Envoyer" class = "envoye"/>
        </form>


        </div> <!-- div Message-->


<?php     
} // Ferme le while

} // Ferme le if



// Trie les informations par catégorie

elseif ($id_Livre_filtrage == "Tous" AND $categorie_filtrage != "Toutes")
{

echo "Le filtrage des catégories a marché";

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=tpforum;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

    // Prend les informations sur les livres
$reponse = $bdd->query('SELECT * FROM Personne, Catégories WHERE Catégories.id_Personne = Personne.id_Personne AND "' .$categorie_filtrage. '" = categorie');


// Prend les inforations sur les messages
$message = $bdd->query('SELECT * FROM Personne, Messages WHERE Messages.id_Personne = Personne.id_Personne ORDER BY date_message DESC LIMIT 0, 3');


// On affiche chaque livre, auteur un par un
while ($donnees = $reponse->fetch())
{
?>
    <p> 

    Livre : <?php echo $donnees['livre']; ?> </br>
    L'auteur du livre est <?php echo $donnees['auteur']; ?> </br>
    Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> 
    le <?php echo $donnees['parution']; ?> </br>
    Catégorie : <?php echo $donnees['categorie']; ?>

   </p>

</div> <!-- div livre -->


        <div class = "message"> 

        <?php  
        $id_Livre_query = $bdd->query('SELECT id_Livre FROM Personne, Catégories WHERE Catégories.id_Personne = Personne.id_Personne ORDER BY parution DESC');


        $message_pers = $bdd->query('SELECT * FROM Personne, Catégories, Messages WHERE Messages.id_Livre = Catégories.id_Livre ORDER BY date_message DESC LIMIT 0, 3');



        // Renvoie tous les messages un par un 

    
        while ($donnees = $message->fetch())
        { 
            ?>
        
        <p>

            >> Message : <?php echo $donnees['message']; ?> </br>
            Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> 
            le <?php echo $donnees['date_message']; ?> </br>

        </p>
        
        <?php
        }   ?>


        <form method="post" action="afficher_message.php" enctype="multipart/form-data">
            <input type="submit" value="Afficher tout" class = "envoye"/>
        </form>



        <form method="post" action="acceuil_connect.php" enctype="multipart/form-data">
            <p>
                <label for="Sujet"> Votre réponse : </label> <br />
                <textarea name="message" value "" id="message" placeholder = "Votre réponse" rows="6" cols="50"></textarea> 
            </p>
                <input type="submit" value="Envoyer" class = "envoye"/>
        </form>


        </div> <!-- div Message-->


<?php     
} // Ferme le while

} // Ferme le if









else
    {
        echo "Filtrage par catégories"; //Ajouter le filtrage par auteur et par catégorie
    }
    ?>



</div> <!-- div actualité -->


</div> <!-- div bloc -->










</body>

</html>















