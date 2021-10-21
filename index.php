<?php
	session_name('pollexpress');
	session_start();

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
	  <link rel="stylesheet" type="text/css" href="./css/styles.css">
	  <script src="script.js"></script>	
         <title>PollExpress</title>
    </head>
	<header>
	  <div class="header">
	    <div id="logo" class="header-item">
	      <img src="assets/PollExpressLogo.png" alt="PollExpress Logo">
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
	</header>
        <body>
   	<div id="content">
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
	<div>
	    <h1>Sondages :</h1>
			<div><strong>Récents :</strong></div>
			<?php
				$reponse = $pdo->query('SELECT * FROM Sondage ORDER BY date_creation_sondage DESC');

				while ($donnees = $reponse->fetch())
				{
					echo $donnees['titre'] . ' : ' . '<a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/script/testclics.php?id=' .$donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '">' . $donnees['lien'] . '</a>' . ' Posté le : ' . $donnees['date_creation_sondage'] . ' Image : ' . $donnees['image'] . ' Vues : ' . $donnees['clics'] . '<br />';
				}
				$reponse->closeCursor();
				?>
		</div>
			<br><br><br>
			<div><strong>Les plus vus :</strong></div>

			<?php
				$reponse = $pdo->query('SELECT * FROM Sondage ORDER BY clics DESC');
				while ($donnees = $reponse->fetch())
				{
					echo $donnees['titre'] . ' : ' . '<a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/script/testclics.php?id=' .$donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '">' . $donnees['lien'] . '</a>' . ' Posté le : ' . $donnees['date_creation_sondage'] . ' Vues : ' . $donnees['clics'] . '<br />';
				}
				$reponse->closeCursor();
				?>
		</div>
	  </body>
</html>