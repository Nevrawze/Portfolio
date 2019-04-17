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

	if (isset($_POST['forminscription'])) 
	{
		//Création de variables sécurisé.
			$prenom = htmlspecialchars($_POST['prenom']);
			$nom = htmlspecialchars($_POST['nom']);
			$anniversaire = htmlspecialchars($_POST['anniversaire']);
			$mailinscription = htmlspecialchars($_POST['mailinscription']);
			$mailinscription2 = htmlspecialchars($_POST['mailinscription2']);
			$password = htmlspecialchars($_POST['password']);
			$password2 = htmlspecialchars($_POST['password2']);

		//Vérifie que les cases sont remplies.
		if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['anniversaire']) AND !empty($_POST['mailinscription']) AND !empty($_POST['mailinscription2']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
		{
			//Hashage du mot de passe.
			$passwordhash = password_hash($password, PASSWORD_DEFAULT);
			$passwordhash2 = password_hash($password2, PASSWORD_DEFAULT);

			//Comptabilise le nombres de lettres dans prénom et nom et renvoie une erreur si ça dépasse 50 caractères.
			$prenomlength = strlen($prenom); 
			$nomlenght = strlen($nom);
			if ($prenomlength <= 50 AND $nomlenght <= 50) 
			{

				//Vérifie que les mails soient identiques
				if ($mailinscription == $mailinscription2) 
				{
					//Filtre une des deux variables e-mail.
					if (filter_var($mailinscription, FILTER_VALIDATE_EMAIL)) 
					{
						$reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
						$reqmail->execute(array($mailinscription));
						$mailexist = $reqmail->rowCount();
						if ($mailexist == 0) 
						{
					
							//Vérifie que les mots de passes soient identiques.
							if ($password == $password2) 
							{
									$insertmbr = $bdd->prepare("INSERT INTO membre(prenom, nom, mail, password, anniversaire) VALUES(?, ?, ?, ?, ?)");
									$insertmbr->execute(array($prenom, $nom, $mailinscription, $passwordhash, $anniversaire));
									$erreur = "Votre compte à bien été créer.";

							}
							else
							{
								$erreur ="Les mots de passes ne correspondent pas.";
							}
						}
						else 
						{
							$erreur = "Adresse e-mail déjà utilisée.";
						}

					}
					else 
					{
						$erreur ="Votre adresse e-mail n'est pas valide.";
					}
				}
				else
				{
					$erreur ="Les adresses e-mail ne correspondent pas.";
				}	
			}
			else
			{
				$erreur = "Votre prénom et/ou votre nom ne doit pas dépasser 50 caractères si c'est le cas veuillez vous en réferez au webmaster.";
			}
		}
		else
		{
			$erreur = "Tous les champs doivent être complétés.";
		}
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
		<h2>Inscription</h2>
		</br></br>

	<!-- Formulaire d'inscription -->
		<form method="post" action="#" name="forminscription">
			<table>
				<tr>
					<td>
						<label for="prenom">Prénom :</label>
					</td>
					<td>
						<input type="text" name="prenom" id="prenom" placeholder="Votre prénom" value="<?php if(isset($prenom)) { echo $prenom;}?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="nom">Nom :</label>
					</td>
					<td>
						<input type="text" name="nom" id="nom" placeholder="Votre nom" value="<?php if(isset($nom)) { echo $nom;}?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="anniversaire">Date de naissance : </label>
					</td>
					<td>
						<input type="date" name="anniversaire" id="anniversaire" placeholder="Répéter votre mot de passe" value="<?php if(isset($anniversaire)) { echo $anniversaire;}?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="mailinscription">E-mail :</label>
					</td>
					<td>
						<input type="email" name="mailinscription" id="mail_inscription" placeholder="Votre E-mail" value="<?php if(isset($mailinscription)) { echo $mailinscription;}?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="mailinscription2">Confirmez votre e-mail :</label>
					</td>
					<td>
						<input type="email" name="mailinscription2" id="mail_inscription2" placeholder="Confirmez votre e-mail" value="<?php if(isset($mailinscription2)) { echo $mailinscription2;}?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="password">Mot de passe : </label>
					</td>
					<td>
						<input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="password2">Répéter le mot de passe : </label>
					</td>
					<td>
						<input type="password" name="password2" id="password2" placeholder="Répéter votre mot de passe" >
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<br /><input type="submit" name="forminscription" id="forminscription" value="Je m'inscris">
					</td>
				</tr>
			</table>
		</form>
		<?php 
			if(isset($erreur))
			{
				echo $erreur;
			}
		?>
	</div>
	<footer>
		<?php include("footer.php"); ?>
	</footer>
</body>
</html>