<?php
	session_name('pollexpress');
	session_start();
	//test commentaire
	include('./BDD.php');

	if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: ./form/login.php');
    exit;
  }

  if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
  		header('Location: ./form/login.php');
		exit;
  }
?>


<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	  <link rel="stylesheet" href="./css/styles.css">
	  <script src="script.js"></script>	
         <title>PollExpress</title>
    </head>
	<header>

	  <div class="header">
	    <div id="logo" class="header-item">
	      <h1>PollExpress </h1>
	      <img src="logo.png" alt="logo">
	    </div>
	    <div class="header-item">
	      	<?php
	if(isset($_SESSION['id'])){
		?>
			<a href="./script/deconnexion.php">Déconnexion</a>
		<?php
	}else{
		?>
		<a href="./form/inscription.php">Inscription</a>
		<a href="./form/login.php">Connexion</a>
		<?php
	}
	?>
	    </div>
	  </div>

	</header>
        <body>
	<div>
	       <h1>Profil</h1>
			<?php
					echo 'Pseudo : ' . $_SESSION['pseudo'] . '<br>' . 'Email : ' . $_SESSION['email'] . '<br>' . 'ID : ' . $_SESSION['id'] . '<br>' . 'Vérifié : ' . $_SESSION['isVerified'];
			?>
	</div>
	<div>
		<br><br>
		<?php
            if($_SESSION['isVerified']==1){
        ?>
            <a href="./form/postersondage.php">Poster un sondage</a>
            <br>
            <a href="./script/deverification.php">Se dévérifier</a>
        <?php
           }
           elseif($_SESSION['isVerified']==0){
           ?>
           <a href="./script/verifierprofil.php">Verifier son profil pour poster des sondages</a>
        <?php
           }
        ?>
	</div>
	<div class="p-3 mb-2 bg-primary text-white">.bg-primary</div>
	    <h1>Sondages :</h1>
			<div><strong>Récents :</strong></div><br>
			<div class = "listeSondage">
			<?php
				$reponse = $pdo->query('SELECT * FROM Sondage ORDER BY date_creation_sondage DESC');
				$i = 0;
				while ($donnees = $reponse->fetch() and $i<5) {
					$i++;
					?>
					<div class ="sondage">
					<?php
					echo '<h3 class = "titreSondage">' . $donnees['titre'] . ' :</h3>';

					echo '<a class = "lien" href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/script/testclics.php?id=' .$donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '"><p class="button"> Répondre au sondage </p></a>';

					echo '<p class = "champSondage">Posté le : ' . $donnees['date_creation_sondage'] . '</p>';

					echo '<p class = "champSondage">Vues : ' . $donnees['clics'] . '</p><br />';
					?>
				</div>
					<?php
			}
				$reponse->closeCursor();
				?>
			</div>
		</div>
			<br><br><br>
			<div><strong>Les plus vus :</strong></div><br>
			<div class = "listeSondage">

			<?php
				$reponse = $pdo->query('SELECT * FROM Sondage ORDER BY clics DESC');
				$i = 0;
				while ($donnees = $reponse->fetch() and $i<5) {
					$i++;
					?>
					<div class ="sondage">
					<?php
					echo '<h3 class = "titreSondage">' . $donnees['titre'] . ' :</h3>';

					echo '<a class = "lien" href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/script/testclics.php?id=' .$donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '"><p class="button"> Répondre au sondage </p></a>';

					echo '<p class = "champSondage">Posté le : ' . $donnees['date_creation_sondage'] . '</p>';

					echo '<p class = "champSondage">Vues : ' . $donnees['clics'] . '</p><br />';
					?>
				</div>
					<?php
				}
				$reponse->closeCursor();
				?>
			</div>
		</div>
	  </body>
</html>