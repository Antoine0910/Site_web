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

<div class = "Pseudo">
<?php echo $_SESSION['prenom'].' '.$_SESSION['nom']; ?>
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



$req = $bdd->prepare('INSERT INTO Catégories(livre, auteur, categorie, parution, Nv_sujet) VALUES(:livre, :auteur, :categorie, :parution, :Nv_sujet)');
$req->execute(array(
    'livre' => $_POST['livre'],
    'auteur' => $_POST['auteur'],
    'categorie' => $_POST['categorie'],
    'parution' => $_SESSION['parution'],
    'Nv_sujet' => $_POST['Nv_sujet'],
    ));



$id_Personne = $_SESSION['id_Personne'];



$reponse = $bdd->query('SELECT id_Livre FROM Catégories ORDER BY id_Livre DESC');
$id = $reponse->fetch();

$id_categorie = $id['id_Livre'];

$req = "";
$req = $bdd->prepare('UPDATE Catégories SET id_Personne = :id_Personne WHERE id_Livre = :id_categorie');
$req->execute(array(
    'id_Personne' => $id_Personne,
    'id_categorie' => $id_categorie
    ));


// Si le nom de l'auteur existe déjà, on modifie son id pour lui donner le même qu'à celui qui existe déjà
//if()

//$aut = $bdd->prepare('UPDATE Catégories SET id_Livre = :id_Livre WHERE id_Livre = :id_categorie');
//$aut->execute(array(
//    'id_Livre' => $id_Personne,
//    'id_categorie' => $id_categorie
//    ));







?>

<p> Votre sujet a bien été enregistré dans la base de données </p>





</body>
</html>


