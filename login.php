<?php
	session_name('pollexpress');
	session_start();
	include('./BDD.php');

	if ((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==1)){ //si une session existe déja (= utilisateur connecté) on redirige vers la page d'accueil
		header('Location: index.php');
		exit;
	}

	
	if(!empty($_POST)){ // Si la variable "$_Post" contient des informations alors on les traites
		extract($_POST); //extrait les valeurs du form en 2 variables $email $mdp
		
		$ok = true;


	if (isset($_POST['connexion'])){ //test pour le formulaire "inscription"

		//htmlentites = pour éviter les injections, trim = enleve les espaces au début et a la fin
		$email = htmlentities(strtolower(trim($email)));
		$mdp = trim($mdp);

		if(empty($email)){ //test si email est vide
			$ok = false;
			$er_email = "L'email est vide";
		}

		if(empty($mdp)){ //test si le mdp est vide
			$ok = false;
			$er_mdp = "Le mot de passe est vide";
		}
		else{
        $sql = $pdo->prepare("SELECT * FROM User WHERE email=?");
        $sql->execute([$email]); 
        $testtoken = $sql->fetch();
        if($testtoken['confirmation_token']==0){
          $ok = false;
          $er_mdp = "Votre compte n'est pas validé. Veuillez cliquer sur le lien dans votre boite mail.";
        }
      }

		$mdp= crypt($mdp, '$6$rounds=5000$pollexpresslesangdelaveine$'); //on crypte le mdp avec la meme clé que pour l'inscription

		$req = $pdo->prepare("SELECT * FROM User WHERE email = :email AND motdepasse = :mdp"); 
		$req->execute(array('email' => $email, 'mdp' => $mdp));
		$resultat = $req->fetch();
		//on test si les valeurs du formulaire correspondent a la bdd

		if (!$resultat) { //si la requete échoue
			$ok = false;
			$er_email = "Le mail ou le mot de passe est incorrect";
		}

		if ($ok){ //si tout est valide, alors on charge une session avec les attributs de la requete
			$_SESSION['id'] = $resultat['id']; 
			$_SESSION['pseudo'] = htmlentities($resultat['pseudo']); //htmlentities pour éviter les injections html/php
			$_SESSION['email'] = htmlentities($resultat['email']);
			$_SESSION['isVerified'] = htmlentities($resultat['isVerified']);
			$_SESSION['confirmation_token'] = $resultat['confirmation_token'];

			header('Location: index.php'); //on redirige l'utilisateur vers la page d'accueil
			exit;
		}
	}
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="registerlogin.css" media="screen" type="text/css" />
	<title>Connexion</title>
</head>
	<body>
		<form method="post">
			<h1>Se connecter</h1>
    		<p>Connectez vous à votre compte PollExpress</p>
    		<hr>
			<?php
			if (isset($er_email)){ //si $er_mail n'est pas vide, alors on l'affiche
			?>
			   <div><?= $er_email ?></div>
			<?php
				}
			?>
				<label for="email"><b>Adresse Email</b></label>
		  		<br>
				<input type="email" placeholder="Adresse email" name="email" value="<?php if(isset($email)){ echo $email; }?>" required>
				<!--Le "value" c'est pour réafficher les données du champ email meme si il y a eu une erreur -->
				<br>
			<?php
			if (isset($er_mdp)){ //si $er_mdp n'est pas vide, alors on l'affiche
			?>
				<div><?= $er_mdp ?></div>
			<?php
				}
			?>
				<label for="password"><b>Mot de passe</b></label>
		  		<br>
				<input type="password" placeholder="Mot de passe" name="mdp">
				<br>
				<button type="submit" name="connexion" class="boutonform">Se connecter</button>
					<div class="container login">
    					<p>Vous n'êtes pas encore inscrit ? <a href="inscription.php">S'inscrire</a>.</p>
  					</div>
		</form>
	</body>
</html>
