<!DOCTYPE html>
<?php
	//Connexion à la BDD.
	try 
	{
		$bdd = new PDO('mysql:host=localhost;dbname=green_future;charset=utf8', 'root', '');
	}

	catch(Exception $e) 
	{
	        die('Erreur : '.$e->getMessage());
	}

	if(isset($_POST['formconnexion']))
	{
		//Création de variable sécurisé.
		$emailconnect = htmlspecialchars($_POST['emailconnect']);
		$passwordconnect = htmlspecialchars($_POST['passwordconnect']);

		//Si champs non remplit afficher erreur.
		if(!empty($emailconnect) AND !empty($passwordconnect)) 
		{
			//Récupération des info utilisateur dans la BDD.
			$req = $bdd->prepare('SELECT id, mail, password FROM membre WHERE mail = :emailconnect');
			$req->execute(array('emailconnect' => $emailconnect));
			$resultat = $req->fetch();

			//Vérifie si le mot de passe entré par l'utilisateur correspond à son hash dans la BDD.
			$ispasswordcorrect = password_verify($passwordconnect, $resultat['password']);
			
			//Si le résultat est différent de l'entrée dans la BDD afficher erreur.
			if(!$resultat) 
			{
				$erreur = "E-mail ou mot de passe invalide";
			}
			else
			{
				//Si le mot de passe est correct ouvre les variables de sessions.
				if ($ispasswordcorrect) 
				{
        			session_start();
        			$_SESSION['id'] = $resultat['id'];
        			$_SESSION['mail'] = $emailconnect;
        			echo 'Vous êtes connecté !';
        			header("location: profil.php?id=".$_SESSION['id']);
    			}
    			else 
    			{
        			$erreur = "E-mail ou mot de passe invalide";
            	}
            }
		}
	}
?>

<html>
<head>
	<title>GreenFuture</title>
	<link rel="stylesheet" href="css/styleconnexion.css?t=<? echo time(); ?>" type="text/css"/>
	<meta charset="utf-8">
</head>
<body>

	<header>
		<?php include("header.php"); ?>
	</header>

	<div id="decoration">
		<div id="bloc_contenu">
			<div id="titre">
				<h2>Se connecter</h2>
				<p>Nouvel Utilisateur ? <a href="form_inscription.php">S'inscrire</a></p>
			</div>
		<div id="bloc_form-co">
			<div id="form">
				<form method="post" action="#" name="formconnexion" id="bloc_formulaire">
					<table>
						<tr>
							<td>
								<label for="email">E-mail</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="email" name="emailconnect" id="email" placeholder="Votre e-mail" value="">
							</td>
						</tr>
						<tr id="mdp">
							<td>
								<label for="password">Mot de passe</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="password" name="passwordconnect" id="password" placeholder="Votre mot de passe">
							</td>
						</tr>
						<tr>
							<td>
								<br /><input type="submit" name="formconnexion" id="formconnexion" value="Se connecter">
							</td>
						</tr>
					</table>
				</form>
				<?php if(isset($erreur)) {
							echo '<p id="erreur">'.$erreur.'</p>';
						}?>
			</div>
			<div id="ligne"></div>
			<div id="fbgg">
				<a href="www.facebook.com"><img src="image/fb_button.png"></a><br />
				<a href="www.google.com"><img src="image/gg_button.png"></a>
			</div>
		</div>
	</div>
</div>
	<footer>
		<?php include("footer.php"); ?>
	</footer>
</body>
</html>