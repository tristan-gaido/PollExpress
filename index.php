<?php
	session_name('pollexpress');
	session_start();

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
	  <link rel="stylesheet" href="./css/styles.css">
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
	  </body>
</html>