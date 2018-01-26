<!DOCTYPE html>
<html lang="fr">

	<head>
		
		<meta charset="utf-8" />
		<title>Connexion — Espace de notes IUT Laval</title>
		<link rel="stylesheet" href="./src/css/app.css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="/favicon.png" type="image/png">
	
	</head>
	
	<body class="login-page">
		
		<div class="wrapper">
			<form class="login">
				
				<div class="title">
					<img src="./src/images/logo-iutlaval.png" alt="Logo de l'IUT Laval" title="Logo de l'IUT Laval" />
					<span class="pink">Connexion à l'Espace de notes</span>
				</div>
				
				<input type="text" placeholder="Identifiant" autofocus="autofocus" />
				<i class="fa fa-user"></i>
				
				<input type="password" placeholder="Mot de passe" />
				<i class="fa fa-key"></i>
				
				<div class="forgotten">
					<a href="http://entframe.univ-lemans.fr/reinitialisation/accueil.php" target="_blank">Mot de passe perdu ?</a>
				</div>
				
				<button><span class="state">Se connecter</span></button>
			</form>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
		<script src="./src/js/app.js" type="text/javascript"></script>
	</body>

</html>