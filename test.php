<!DOCTYPE html>
<html>
<head>
	<title>GreenFuture</title>
	<link rel="stylesheet" href="css/test.css?t=<? echo time(); ?>" meta-charset="utf-8">
</head>


<div id="decoration">
	<div id="titre">
		<h2>Se connecter</h2>
		<p>Nouvel Utilisateur ? <a href="form_inscription.php">S'inscrire</a></p>
	</div>
	<div id="bloc_contenu">
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
						<tr>
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
			</div>
			<div id="ligne"></div>
			<div id="fbgg">
				<a href="www.facebook.com"><img src="image/fb_button.png"></a><br />
				<a href="www.google.com"><img src="image/gg_button.png"></a>
			</div>
		</div>
	</div>
</div>
</html>
