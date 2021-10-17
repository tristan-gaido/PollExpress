<?php
	session_start();

	include('./BDD.php');

	if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté, il est redirigé automatiquement vers la page de login
    header('Location: login.php');
    exit;
  }
?>

<!DOCTYPE html>
<html>
  ﻿<head>
    ﻿<meta charset="utf-8"/>
    ﻿<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	  <link rel="stylesheet" href="styles.css">
	  <script src="script.js"></script>	
  ﻿  <title>PollExpress</title>
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
			<a href="deconnexion.php">Deconnexion</a>
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
  ﻿<body>
	<div>
	    ﻿<h1>Profil</h1>

			<?php
					echo 'Pseudo : ' . $_SESSION['pseudo'] . '<br>' . 'Email : ' . $_SESSION['email'] . '<br>' . 'ID : ' . $_SESSION['id'];
				
			?>
	</div>
	<div>
		<br>
		<br>
		<a href="postersondage.php">Poster un sondage</a>
	</div>
	<div>
	    ﻿<h1>Sondages :</h1>

			<div><strong>Récents :</strong></div>

			<?php

				$reponse = $pdo->query('SELECT titre, lien, date_creation_sondage FROM Sondage ORDER BY date_creation_sondage DESC');

				while ($donnees = $reponse->fetch())
				{
					echo $donnees['titre'] . ' : ' . '<a href="' . $donnees['lien'] . '">' . $donnees['lien'] . '</a>' . ' Posté le : ' . $donnees['date_creation_sondage'] . '<br />';
				}

				$reponse->closeCursor();

				?>


		</div>

	  </body>
</html>