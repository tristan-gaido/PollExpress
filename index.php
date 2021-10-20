<?php
	session_name('pollexpress');
	session_start();
	//test commentaire
	include('./BDD.php');

	if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: login.php');
    exit;
  }

  if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
  		header('Location: login.php');
		exit;
  }
?>

<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	  <link rel="stylesheet" href="styles.css">
	  <script src="script.js"></script>	
         <title>PollExpress</title>
    </head>
	<header>
	  <div class="header">
	    <div id="logo" class="header-item">
	      <h1>PollExpress </h1>
	      <img src="logo.png" alt="PollExpress Logo">
	    </div>
	    <div class="header-item">
	      	<?php
	if(isset($_SESSION['id'])){
		?>
			<a href="deconnexion.php">Déconnexion</a>
		<?php
	}else{
		?>
		<a href="inscription.php">Inscription</a>
		<a href="login.php">Connexion</a>
		<?php
	}
	?>
	    </div>
	  </div>
	</header>
	<script>
    function compteur() {
        let count = localStorage.getItem('counter');
        if(count === null){
            count = 0;
            localStorage.setItem('counter', count);
        }
        count = parseInt(count);
        updateCompteur(count);
    }
    function augmenterCompteur() {
        let count = parseInt(localStorage.getItem('counter'));
        count = count + 1;
        localStorage.setItem('counter', count);
        updateCompteur(count);
        return true;
    }
    function updateCompteur(count) {
        document.getElementById("count").innerHTML = +count;
    }
</script>
        <body>
   			<p id="count">-</p>
    		<script type="text/javascript">
        		compteur();
    		</script>
	<div>
	       <h1>Profil</h1>

			<?php
					echo 'Pseudo : ' . $_SESSION['pseudo'] . '<br>' . 'Email : ' . $_SESSION['email'] . '<br>' . 'ID : ' . $_SESSION['id'] . '<br>' . 'Vérifié : ' . $_SESSION['isVerified'];

			?>
	</div>
	<div>
		<br>
		<br>
		<?php
            if($_SESSION['isVerified']==1){
        ?>
            <a href="postersondage.php">Poster un sondage</a>
            <br>
            <a href="deverification.php">Se dévérifier</a>
        <?php
           }
           elseif($_SESSION['isVerified']==0){
           ?>
           <a href="verifierprofil.php">Verifier son profil pour poster des sondages</a>
        <?php
           }
        ?>
	</div>
	<div>
	    <h1>Sondages :</h1>

			<div><strong>Récents :</strong></div>

			<?php

				$reponse = $pdo->query('SELECT titre, lien, date_creation_sondage FROM Sondage ORDER BY date_creation_sondage DESC');

				while ($donnees = $reponse->fetch())
				{
					echo $donnees['titre'] . ' : ' . '<a href="' . $donnees['lien'] . '" onclick="augmenterCompteur()">' . $donnees['lien'] . '</a>' . ' Posté le : ' . $donnees['date_creation_sondage'] . '<br />';
				}

				$reponse->closeCursor();

				?>


				


		</div>

	  </body>
</html>