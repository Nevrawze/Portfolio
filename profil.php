<!DOCTYPE html>
<?php
session_start();
	//Connexion à la BDD.
	try 
	{
		$bdd = new PDO('mysql:host=localhost;dbname=green_future;charset=utf8', 'root', '');
	}

	catch(Exception $e) 
	{
	        die('Erreur : '.$e->getMessage());
	}

	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
		$requser->execute(array($getid));
		$userinfo = $requser->fetch();
	}

?>
<html>
<head>
	<title>GreenFuture</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<meta charset="utf-8">
</head>
<body>

	<header>
		<?php include("header.php"); ?>
	</header>

	<div id="inscription">
		<h2>Profil de <?php echo $userinfo['prenom'] . ' ' . $userinfo['nom']; ?></h2>
		</br></br>
		pseudo = ...
		<br />
		mail = ...
	
	</div>
	<footer>
		<?php include("footer.php"); ?>
	</footer>
</body>
</html>