<?php
session_name('pollexpress');
session_start();

include('../BDD.php');



$id = (int) $_GET['id'];
$token = (String) htmlentities($_GET['token']);

if(!empty($_POST)){
	extract($_POST);
	$ok = true;

	/*if(!isset($id)){
		$ok = false;
	    	echo 'Mauvais lien';

		}elseif(!isset($token)){
			$ok = false;
	    	echo 'Mauvais lien';

		}*/
	if (isset($_POST['newmdp'])){
		      $mdp = trim($mdp); 
      		  $confmdp = trim($confmdp); 

      		  if(empty($mdp)) {
        		$ok = false;
        		$er_mdp = "Le mot de passe est vide";

 	  			//verif que la confirmation du mdp est valide
      			}elseif($mdp != $confmdp){
       				$ok = false;
       				$er_mdp = "Les deux mots de passe ne correspondent pas";
      

     			}elseif(strlen($mdp)<6){
        		$ok = false;
        		$er_mdp = "Le mot de passe doit faire au minimum 6 caractères.";
      
      			}

	if($ok){
		$req = $pdo->prepare("SELECT id FROM User WHERE id = :id AND token = :token");
	    $req->execute(array('id' => $id, 'token' => $token));
	    $req = $req->fetch();

	    if(!isset($req['id'])){
	    	$ok = false;
	    	echo 'Mauvais lien';

		}else{
		    $mdp = crypt($mdp, '$6$rounds=5000$pollexpresslesangdelaveine$'); //cryptage du mdp


			$req = $pdo->prepare("UPDATE User SET motdepasse = :motdepasse WHERE id = :id");
			$req->execute(array('id' => $id, 'motdepasse' => $mdp));
	    	$req = $req->fetch();

	    	echo 'MDP changé';
			header('Location: login.php'); //on redirige l'utilisateur vers la page de login
	    	exit;

    }
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
                    <title>Nouveau mot de passe</title>
          </head>
          <body>
                    <div>Choisissez un nouveau mot de passe :</div>
                    <form method="post">
                              <?php
                                        if (isset($er_mdp)){
                              ?>
                                        <div><?= $er_mdp ?></div>
                              <?php         
                                        }
                              ?>
                              <label for="password"><b>Nouveau mot de passe</b></label>
							  <br>
						      <input type="password" placeholder="Mot de passe" name="mdp" id="mdp" required>
						      <br>
						      <label for="password"><b>Confirmer le mot de passe</b></label>
						      <br>
						      <input type="password" placeholder="Confirmer le mot de passe" name="confmdp" id="confmdp" required>
						      <hr>
                              <button type="submit" name="newmdp">Envoyer</button>
                    </form>
          </body>
</html>
