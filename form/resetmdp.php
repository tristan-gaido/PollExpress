<?php
session_name('pollexpress');
session_start();

include('../BDD.php');


if(!empty($_POST)){
	extract($_POST);
	$ok = true;

	if (isset($_POST['resetmdp'])){
		$email = htmlentities(strtolower(trim($email)));


		if(empty($email)){
			$ok = false;
			$er_email = "Email vide";
		}

		$stmt = $pdo->prepare("SELECT * FROM User WHERE email=?");
		$stmt->execute([$email]); 
		$req_email = $stmt->fetch();
		
		if (!$req_email) {
			$ok = false;
			$er_email = "Aucun compte avec cet email";
        } 

		if($ok){
			$verif_mail = $pdo->prepare("SELECT * FROM User WHERE email = :email");
			$verif_mail->execute(array('email' => $email));
    		$verif_mail = $verif_mail->fetch();

    		if(isset($verif_mail['email'])){
  				
    				$objet = 'Nouveau mot de passe';
    				$to = $verif_mail['email'];

    				$header = "From: NOM_DE_LA_PERSONNE <no-reply@test.com> \n";
    				$header .= "Reply-To: ".$to."\n";
    				$header .= "MIME-version: 1.0\n";
    				$header .= "Content-type: text/html; charset=utf-8\n";
    				$header .= "Content-Transfer-Encoding: 8bit";

    				
			        $contenu = '<p>Bonjour ' . $verif_mail['pseudo'] . ',</p><br>
			                    <p>Cliquez ici pour réinitialiser votre mot de passe : <a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/form/newmdp.php?id=' . $verif_mail['id'] . '&token=' . $verif_mail['token'] . '">Reinitialiser votre mot de passe</a><p>';
			        mail($to, $objet, $contenu, $header);

			    }

			

			        header('Location: ../redirections/redirectionmdp.php'); //redirection vers la page index.php
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
                    <title>Mot de passe oublié</title>
          </head>
          <body>
                    <div>Mot de passe oublié</div>
                    <form method="post">
                              <?php
                                        if (isset($er_email)){
                              ?>
                                        <div><?= $er_email ?></div>
                              <?php         
                                        }
                              ?>
                              <input type="email" placeholder="Adresse email" name="email" value="<?php if(isset($email)){ echo $email; }?>" required>
                              <button type="submit" name="resetmdp">Envoyer</button>
                    </form>
          </body>
</html>
