<?php
require_once File::build_path(array("model","ModelUtilisateur.php")); // chargement du modèle

class ControllerUser {

    public static function accueil() {

    	if (!isset($_SESSION['id'])){ 
    	  header('Location: ./index.php?action=login');
    	  exit;
    	}
    	if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
    	      header('Location: ./index.php?action=login');
    	      exit;
    	}

    	$recent = ModelUtilisateur::selectRecents();
    	$nbVues = ModelUtilisateur::selectNbVues();

        $controller='user';
        $view='accueil';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
    }

    public static function sondages() {
        $liste_sondage = ModelUtilisateur::getAllSondages();
        $controller='user';
        $view='sondages';
        $pagetitle='PollExpress - Sondages';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
        
        
    }

    public static function postersondage() {

    	  if(!empty($_POST)){
    	    extract($_POST); 
    	    
    	    $ok = true;

    	    $nomsondage = htmlentities(trim($nomsondage));
    	        $lien = trim($lien);
    	        $tag1 = htmlentities(trim($tag1));
    	        $tag2 = htmlentities(trim($tag2));
    	        $code = htmlentities(trim($code));
              $bonus = 100*$duree; 

          if($tag1==$tag2){
            $tag2 = "";
          }


    	    $req_lien = ModelUtilisateur::selectSondageFromLien($lien);
    	    if ($req_lien) {
    	      $ok = false;
    	      $er_lien = "Ce sondage existe déjà";
    	        }

    	    if ($ok){ 

    	      $datecreation = date('Y-m-d H');

              $userID = $_SESSION['id'];

    	      ModelUtilisateur::createSondage($nomsondage, $lien, $tag1, $tag2, $datecreation, $code, $bonus, $userID);
    	          
    	   
    	          header('Location: ./index.php'); 
    	          exit;
    	    }
    	  
    	}

        $controller='user';
        $view='postersondage';
        $pagetitle='PollExpress - Poster un sondage';
        require_once File::build_path(array("view","view.php"));
    }

    public static function register() {

    	if ((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==1)){ 
    	  header('Location: ./index.php');
    	  exit;
    	}

    	if(!empty($_POST)){ 
    	    extract($_POST);
    	    $ok = true;
    	    $pseudo = htmlentities(trim($pseudo)); 
    	    $email = htmlentities(strtolower(trim($email))); 
    	    $mdp = trim($mdp); 
    	    $confmdp = trim($confmdp);

    	            //Verif que le pseudo existe pas déjà
    	    		$req_pseudo = ModelUtilisateur::checkPseudo($pseudo);
    	    		if ($req_pseudo) {
    	    			$ok = false;
    	    			$er_pseudo = "Ce pseudo existe déjà";
    	            } 
    	        
    	          $req_email = ModelUtilisateur::checkTokenEmail($email);
    	    	  if ($req_email) {
    	    		$ok = false;
    	    		$er_email = "Ce mail existe déjà";
    	            } 
    	        
				  if($mdp != $confmdp){
    	            $ok = false;
    	            $er_mdp = "Les deux mots de passe ne correspondent pas";
    	          
    	          }
    	     
    	          if($ok){

    	            $mdp = crypt($mdp, '$6$rounds=5000$pollexpresslesangdelaveine$'); //cryptage du mdp
    	            $datecreation = date('Y-m-d H:i:s');
    	            $token = bin2hex(random_bytes(12));

    	            ModelUtilisateur::createUser($pseudo, $mdp, $email, $datecreation, $token);

    	            $reqtoken = ModelUtilisateur::checkTokenEmail($email);
    	            $mailconf = $reqtoken['email'];

    	            $header = "From: PollExpress <tristan.gaido.pro@gmail.com>\n";
    	            $header .= "MIME-version: 1.0\n";
    	            $header .= "Content-type: text/html; charset=utf-8\n";
    	            $header .= "Content-Transfer-ncoding: 8bit";

    	            $contenu = '<p>Bonjour ' . $reqtoken['pseudo'] . ',</p><br>
    	                        <p>Cliquez ici pour confirmer votre compte : <a style="color: red;" href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/index.php?action=verifmail&id=' . $reqtoken['id'] . '&token=' . $token . '">Valider</a><p>';
    	            mail($mailconf, 'Confirmation de votre compte', $contenu, $header);


    	            $_SESSION['confirmation_token'] = htmlentities($reqtoken['confirmation_token']);
    	            	            
    	            header('Location: ./index.php?action=redirectionemail'); //redirection vers la page
    	            exit;
    	          }
    	  }


        $pagetitle = 'PollExpress - Inscription';
        $controller='user';
        $view='register';
        require File::build_path(array("view","view.php"));
    }

    public static function login() {

    	if ((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==1)){ 
    	  header('Location: ./index.php?action=accueil');
    	  exit;
    	}

    	if(!empty($_POST)){ 
    	  extract($_POST);     	  
    	  $ok = true;
	  
    	  $email = htmlentities(strtolower(trim($email)));
    	  $mdp = trim($mdp);

   	  	  $testtoken = ModelUtilisateur::checkTokenEmail($email);
    	      if($testtoken['confirmation_token']==0){
    	        $ok = false;
    	        $er_mdp = "Votre compte n'est pas validé. Veuillez cliquer sur le lien dans votre boite mail.";
    	      }
    	    

    	  $mdp = crypt($mdp, '$6$rounds=5000$pollexpresslesangdelaveine$');

    	  $resultat = ModelUtilisateur::checkLogin($email, $mdp);
    	  if (!$resultat) { 
    	    $ok = false;
    	    $er_email = "Le mail ou le mot de passe est incorrect";
    	  }

    	  if ($ok){
    	    $_SESSION['id'] = $resultat['id']; 
    	    $_SESSION['pseudo'] = htmlentities($resultat['pseudo']); 
    	    $_SESSION['email'] = htmlentities($resultat['email']);
    	    $_SESSION['isVerified'] = $resultat['isVerified'];
    	    $_SESSION['argent'] = $resultat['argent'];
    	    $_SESSION['confirmation_token'] = $resultat['confirmation_token'];
    	    $_SESSION['date'] = $resultat['date_creation'];
    	    $_SESSION['xp'] = $resultat['xp'];

    	    header('Location: ./index.php');
    	}
    }

        $pagetitle = 'PollExpress - Connexion';
        $controller='user';
        $view='login';
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
        
  }



    public static function deconnexion() {
    	
    	session_name('pollexpress');
    	session_start();
    	session_destroy();

        $pagetitle = 'Déconnexion';
        $controller='user';
        $view='login';
        require File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
        
  }


    public static function profil() {
        $controller='user';
        $view='profil';
        $pagetitle='PollExpress - Profil';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
    }

    public static function boutique() {
      $pagetitle = 'PollExpress - Boutique';
      $controller='user';
      $view='boutique';    
      require File::build_path(array("view","view.php")); ;  //"redirige" vers la vue

   }

   public static function resetmdp() {

   		if(!empty($_POST)){
   			extract($_POST);
   			$ok = true;

   			$email = htmlentities(strtolower(trim($email)));


   				if(empty($email)){
   					$ok = false;
   					$er_email = "Email vide";
   				}

   				$req_email = ModelUtilisateur::checkTokenEmail($email);
   				
   				if (!$req_email) {
   					$ok = false;
   					$er_email = "Aucun compte avec cet email";
   		        } 

   				if($ok){
   					$verif_mail = ModelUtilisateur::checkTokenEmail($email);

   		    		if(isset($verif_mail['email'])){
   		  				
   		    				$objet = 'Nouveau mot de passe';
   		    				$to = $verif_mail['email'];

   		    				$header = "From: PollExpress - Reinitilisation du MDP <no-reply@test.com> \n";
   		    				$header .= "Reply-To: ".$to."\n";
   		    				$header .= "MIME-version: 1.0\n";
   		    				$header .= "Content-type: text/html; charset=utf-8\n";
   		    				$header .= "Content-Transfer-Encoding: 8bit";

   		    				
   					        $contenu = '<p>Bonjour ' . $verif_mail['pseudo'] . ',</p><br>
   					                    <p>Cliquez ici pour réinitialiser votre mot de passe : <a style="color: red;" href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/index.php?action=newmdp&id=' . $verif_mail['id'] . '&token=' . $verif_mail['token'] . '">Reinitialiser votre mot de passe</a><p>';
   					        mail($to, $objet, $contenu, $header);

   					    }

   					
   					        header('Location: ./index.php?action=redirectionmdp'); 
   					        exit;
   					    }

   			}

       $controller='user';
       $view='resetmdp';
       $pagetitle='PollExpress - Réinitialiser son mot de passe';
       require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
   }

   public static function testclics() {

       $lien_sondage = $_GET['lien'];

       header('Location: ' . $lien_sondage); 
       exit;
   }

   public static function newmdp() {

   	   $id = htmlentities($_GET['id']);
   	   $token = htmlentities($_GET['token']);

   	   if(!empty($_POST)){
   	   	extract($_POST);
   	   	$ok = true;

   	   	$mdp = htmlentities(trim($mdp)); 
   	    $confmdp = htmlentities(trim($confmdp)); 
		if(empty($mdp)) {
			$ok = false;
			$er_mdp = "Le mot de passe est vide";
		}elseif($mdp != $confmdp){
			$ok = false;
			$er_mdp = "Les deux mots de passe ne correspondent pas";
   	    }

   	   	if($ok){
   	   		$req = ModelUtilisateur::selectUserNewMDP($id, $token);

   	   	    if(!isset($req['id'])){
   	   	    	$ok = false;
   	   	    	echo 'Mauvais lien';

   	   		}else{
   	   		    $mdp = crypt($mdp, '$6$rounds=5000$pollexpresslesangdelaveine$'); //cryptage du mdp


   	   			ModelUtilisateur::updateMDP($mdp, $id);
   	   			header('Location: ./index.php?action=login'); //on redirige l'utilisateur vers la page de login
   	   	    	exit;
   	       }
   	   	}

   	   }

   			
       $controller='user';
       $view='newmdp';
       $pagetitle='PollExpress - Nouveau mot de passe';
       require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
   }


   public static function verifmail() {

   		$ok = true;

   		$id = htmlentities($_GET['id']);
   		$token = htmlentities($_GET['token']);

   		if(!isset($id)){
   			$ok = false;
   		    	echo 'Mauvais lien';

   			}elseif(!isset($token)){
   				$ok = false;
   		    	echo 'Mauvais lien';
   			}

   		if($ok){
   			$req = ModelUtilisateur::selectUserNewMDP($id, $token);

   		    if(!isset($req['id'])){
   		    	$ok = false;
   		    	echo 'Mauvais lien';

   			}else{
   				ModelUtilisateur::updateTokeMail($id);

   				header('Location: ./index.php?action=login'); 
   		    	exit;

   		    }
   		}
   } 

   public static function redirectionemail() {
       $controller='user';
       $view='redirectionemail';
       $pagetitle='PollExpress';
       require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
   }

   public static function redirectionmdp() {
       $controller='user';
       $view='redirectionmdp';
       $pagetitle='PollExpress';
       require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
   }
       public static function achatItem() {
       $liste_sondage = ModelUtilisateur::getAllSondages();
       $controller='user';
       $view='achatItem';
       $pagetitle='PollExpress';
       require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
       
       
   }

   public static function testcode() {

   	$idsondage = $_GET['idsondage'];
   	
   	$codeSondage = htmlentities($_POST['codeSondage']);
   	$idUser = $_SESSION['id'];


   	$req_test_sondageFait = ModelUtilisateur::selectSondageFaits($idsondage, $idUser);
   	if(!$req_test_sondageFait){
   	
   	$req_code = ModelUtilisateur::selectSondageWithCode($idsondage, $codeSondage);
   	

   	if($req_code){
      $bonus = $req_code ['bonus'];
   		ModelUtilisateur::updateXp($idUser, $idsondage, $bonus);

   		$sql = ModelUtilisateur::selectSondageFromID($idsondage);

   		$nbclics = $sql['clics'];

   		ModelUtilisateur::updateNbClics($nbclics, $idsondage);

   		$_SESSION['argent'] = $_SESSION['argent']+100;
   		$_SESSION['xp'] = $_SESSION['xp']+$bonus;
   	}

  }
  header('Location: ./index.php');
      
 }

   public static function signaler() {

    $idsondage = $_GET['idsondage'];
    $iduser = $_SESSION['id'];

    $req_signalement = ModelUtilisateur::selectSignalement($idsondage, $iduser);

    if(!$req_signalement){
    
    ModelUtilisateur::addSignalement($idsondage, $iduser);
    }
  
    header('Location: ./index.php');
      
 }

  public static function deletedaccount() {
        $controller='user';
        $view='login';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view", "view.php")); //"redirige" vers la vue

        $sql = "DELETE FROM PE__User WHERE id = :id";
        $values = array("id" => $_SESSION['id']);
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->execute($values);
        session_destroy();
   }

 public static function downloaded() {
       
        $controller='user';
        $view='redirectiondownload';
        $pagetitle='PollExpress - Réception données';
        require_once File::build_path(array("view", "view.php")); //"redirige" vers la vue

        $reqtoken = Model::getPDO()->prepare("SELECT * FROM PE__User WHERE email = :email");
        $reqtoken->execute(array('email' => $_SESSION['email']));
        $reqtoken = $reqtoken->fetch();

        $mailconf = $reqtoken['email'];


        $header = "From: PollExpress <tristan.gaido.pro@gmail.com>\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-type: text/html; charset=utf-8\n";
        $header .= "Content-Transfer-ncoding: 8bit";

        $contenu = '<p>Bonjour ' . $reqtoken['pseudo'] . ',</p><br>
                    <p>Voici les données de votre compte qui sont enregistrées dans notre base de données :<p>' 
                    . 'Pseudo : ' . $reqtoken['pseudo'] . '<br />'
                    . 'Email : ' . $reqtoken['email'] . '<br />'
                    . 'Date de création : ' . $reqtoken['date_creation'] . '<br />';
        mail($mailconf, 'Vos donnees personnelles', $contenu, $header);
   }

   public static function deletesondage() {

        $sondageID = $_GET['idsondage'];


        $sql = Model::getPDO()->prepare("DELETE FROM PE__Sondage WHERE id_sondage = :idSondage");
        $sql->execute(array('idSondage' => $sondageID));
        header('Location: ./index.php');


    }

  
}
?>
