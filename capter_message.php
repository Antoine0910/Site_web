<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="TP_CSS.css" />
        <title> Messages </title>
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

<h2> Messages affichés </h2>


<!-- Renvoie les informations contenue dans la base de donnée -->

<?php
$reponse = $bdd->query('SELECT * FROM Personne, Messages WHERE Messages.id_Personne = Personne.id_Personne ORDER BY date_message DESC');


// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    Message : <?php echo $donnees['message']; ?> </br>
    Posté par <?php echo $donnees['prenom'] .' '. $donnees['nom']; ?> le <?php echo $donnees['date_message']; ?> </br>
   </p>
<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>

<form method="post" action="capter_message.php" enctype="multipart/form-data">
<p>
    <label for="Sujet"> Votre réponse : </label> <br />
    <textarea name="message" value "" id = "message" placeholder = "Votre réponse" rows="10" cols="50">
        
    </textarea> 
</p>
    <input type="submit" value="Envoyer" class = "envoye"/>
</form>

<?php $_SESSION['date_message'] = date('d/m/Y h:i:s');
$id_Personne = $_SESSION['id_Personne'];

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


if(isset($_POST['message']))
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
?>







</body>

</html>















