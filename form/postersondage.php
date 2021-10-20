<?php
	session_name('pollexpress');
	session_start();
	include('../BDD.php');

	if (!isset($_SESSION['id'])){ //si pas de ssession, on redirige vers la page de login
		header('Location: login.php');
		exit;
	}

	
	if(!empty($_POST)){ // Si la variable "$_Post" contient des informations alors on les traites
		extract($_POST); //extrait les valeurs du form en 2 variables $nomsondage $lien
		
		$ok = true;


	if (isset($_POST['postersondage'])){ //test pour le formulaire "inscription"

		//htmlentites = pour éviter les injections, trim = enleve les espaces au début et a la fin
		$nomsondage = htmlentities(strtolower(trim($nomsondage)));
		$lien = trim($lien);

		if(empty($nomsondage)){ //test si email est vide
			$ok = false;
			$er_nomsondage = "Remplissez un titre pour le sondage";
		}

		if(empty($lien)){ //test si le mdp est vide
			$ok = false;
			$er_mdp = "Remplissez un lien pour le sondage";
		}

		$stmt = $pdo->prepare("SELECT * FROM Sondage WHERE lien=?");
		$stmt->execute([$lien]); 
		$req_lien = $stmt->fetch();
		if ($req_lien) {
			$ok = false;
			$er_lien = "Ce sondage existe déjà";
        }

		if ($ok){ //si tout est valide, alors on enregistre le sondage dans la BDD

			$datecreation = date('Y-m-d H:i:s');

			$req = $pdo->prepare("INSERT INTO Sondage SET titre = :titre, lien = :lien, date_creation_sondage = :datecreation"); 
			$req->execute(array('titre' => $nomsondage, 'lien' => $lien, 'datecreation' => $datecreation));
	        
	 
	       	header('Location: ../index.php'); //redirection vers la page index.php
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
	<title>Poster un sondage</title>
</head>
	<body>
		<form method="post">
			<h1>Poster un sondage</h1>
    		<p>Remplissez le formulaire pour poster un sondage sur PollExpress</p>
    		<hr>
			<?php
			if (isset($er_nomsondage)){ 
			?>
			   <div><?= $er_nomsondage ?></div>
			<?php
				}
			?>
				<label for="email"><b>Nom du sondage</b></label>
		  		<br>
				<input type="text" placeholder="Nom du sondage" name="nomsondage" value="<?php if(isset($nomsondage)){ echo $nomsondage; }?>" required>
				<br>
			<?php
			if (isset($er_lien)){ 
			?>
				<div><?= $er_lien ?></div>
			<?php
				}
			?>
				<label for="lien"><b>Lien du sondage</b></label>
		  		<br>
				<input type="url" placeholder="Lien du sondage" name="lien" value="<?php if(isset($lien)){ echo $lien; }?>" required>
				<br>
				<button type="submit" name="postersondage" class="boutonform">Poster Sondage</button>
					<div class="container sondage">
    					<p><a href="../index.php">Retour a l'accueil</a></p>
  					</div>
		</form>
	</body>
</html>
