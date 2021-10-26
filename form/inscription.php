<?php
session_name('pollexpress');
session_start();

include('../BDD.php');



  if ((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==1)){ //si une session existe déja (= utilisateur connecté) on redirige vers la page d'accueil
    header('Location: ../index.php');
    exit;
  }

if(!empty($_POST)){ //si le formulaire est vide ne rien faire
    extract($_POST); //extrait les valeurs du form en 4 variables $pseudo $email $mdp $confmdp


    $ok = true;
 
    if (isset($_POST['inscription'])){ //test pour le formulaire "inscription"

      //htmlentites = pour éviter les injections, trim = enleve les espaces au début et a la fin
      $pseudo = htmlentities(trim($pseudo)); 
      $email = htmlentities(strtolower(trim($email))); 
      $mdp = trim($mdp); 
      $confmdp = trim($confmdp); 
 
      // Verif pseudo
      if(empty($pseudo)){
        $ok = false;
        $er_pseudo = ("Le pseudo est vide");
      }
      else{

        //Verif que le pseudo existe pas déjà
		$stmt = $pdo->prepare("SELECT * FROM User WHERE pseudo=?");
		$stmt->execute([$pseudo]); 
		$req_pseudo = $stmt->fetch();
		if ($req_pseudo) {
			$ok = false;
			$er_pseudo = "Ce pseudo existe déjà";
        } 
    }

      // Verif email
      if(empty($email)){
        $ok = false;
        $er_mail = "L'email est vide";
 
       //on verif que le mail est dans un format mail
      }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)){
        $ok = false;
        $er_email = "L'email est invalide";

      }else{
      		
        //On check dans la base de donnée si le mail existe déjà
		$stmt = $pdo->prepare("SELECT * FROM User WHERE email=?");
		$stmt->execute([$email]); 
		$req_email = $stmt->fetch();
		if ($req_email) {
			$ok = false;
			$er_email = "Ce mail existe déjà";
        } 
    }

      // Verif du mot de passe
      if(empty($mdp)) {
        $ok = false;
        $er_mdp = "Le mot de passe est vide";

 	  //verif que la confirmation du mp est valide
      }elseif($mdp != $confmdp){
        $ok = false;
        $er_mdp = "Les deux mots de passe ne correspondent pas";
      

      }elseif(strlen($mdp)<6){
        $ok = false;
        $er_mdp = "Le mot de passe doit faire au minimum 6 caractères.";
      
      }
 
      //on execute la requete sql si toutes les conditions sont valides
      if($ok){

        $mdp = crypt($mdp, '$6$rounds=5000$pollexpresslesangdelaveine$'); //cryptage du mdp
        $datecreation = date('Y-m-d H:i:s');
        $token = bin2hex(random_bytes(12));

        $req = $pdo->prepare("INSERT INTO User
        SET pseudo = :pseudo, motdepasse = :motdepasse, email = :email, date_creation = :datecreation, argent = 100, isVerified = false, token = :token");
        $req->execute(array('pseudo' => $pseudo, 'motdepasse' => $mdp, 'email' => $email, 'datecreation' => $datecreation, 'token' => $token));


        $reqtoken = $pdo->prepare("SELECT * FROM User WHERE email = :email");
        $reqtoken->execute(array('email' => $email));
        $reqtoken = $reqtoken->fetch();

        $mailconf = $reqtoken['email'];


        $header = "From: PollExpress <tristan.gaido.pro@gmail.com>\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-type: text/html; charset=utf-8\n";
        $header .= "Content-Transfer-ncoding: 8bit";

        $contenu = '<p>Bonjour ' . $reqtoken['pseudo'] . ',</p><br>
                    <p>CLiquez ici pour confirmer votre compte <a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/script/verifmail.php?id=' . $reqtoken['id'] . '&token=' . $token . '">Valider</a><p>';
        mail($mailconf, 'Confirmation de votre compte', $contenu, $header);


        $_SESSION['confirmation_token'] = htmlentities($reqtoken['confirmation_token']);
        

        

        header('Location: ../redirections/redirectionemail.php'); //redirection vers la page
        exit;
      }
    }
  }
?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/registerlogin.css" media="screen" type="text/css" />
    <title>Inscription</title>
  </head>
  <body>
    <form method="post">
    	<div class="container">
    		<h1>S'inscrire</h1>
    		<p>Remplissez ce formulaire pour créer votre compte PollExpress.</p>
    		<hr>
		      	<?php
		        if (isset($er_pseudo)){
		        ?>
		          <div><?= $er_pseudo ?></div>
		        <?php 
		        }
		      ?>
		  <label for="pseudo"><b>Pseudo</b></label>
		  <br>
	      <input type="text" placeholder="Votre pseudo" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>" id="pseudo"> 
	      <br>

		      <?php
		        if (isset($er_email)){
		        ?>
		          <div><?= $er_email ?></div>
		        <?php 
		        }
		      ?>
		  <label for="email"><b>Email</b></label>
		  <br>
	      <input type="email" placeholder="Adresse email" name="email" value="<?php if(isset($email)){ echo $email; }?>" id="email">
	      <br>
		      <?php
		        if (isset($er_mdp)){
		        ?>
		          <div><?= $er_mdp ?></div>
		        <?php 
		        }
		      ?>
		  <label for="password"><b>Mot de passe</b></label>
		  <br>
	      <input type="password" placeholder="Mot de passe" name="mdp" id="mdp" required>
	      <br>
	      <label for="password"><b>Confirmer le mot de passe</b></label>
	      <br>
	      <input type="password" placeholder="Confirmer le mot de passe" name="confmdp" id="confmdp" required>
	      <hr>
	      <button type="submit" name="inscription" class="boutonform">Envoyer</button>
      </div>
      	<div class="container login">
    		<p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a>.</p>
  		</div>
    </form>
  </body>
</html>