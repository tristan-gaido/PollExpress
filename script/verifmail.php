<?php
session_name('pollexpress');
session_start();

include('../BDD.php');

$ok = true;

$id = (int) $_GET['id'];
$token = (String) htmlentities($_GET['token']);

if(!isset($id)){
	$ok = false;
    	echo 'Mauvais lien';

	}elseif(!isset($token)){
		$ok = false;
    	echo 'Mauvais lien';

	}

if($ok){
	$req = $pdo->prepare("SELECT id FROM User WHERE id = :id AND token = :token");
    $req->execute(array('id' => $id, 'token' => $token));
    $req = $req->fetch();

    if(!isset($req['id'])){
    	$ok = false;
    	echo 'Mauvais lien';

	}else{
		$req = $pdo->prepare("UPDATE User SET confirmation_token = :conftoken WHERE id = :id");
		$req->execute(array('id' => $id, 'conftoken' => true));
    	$req = $req->fetch();

    	echo 'Compte validé';
		header('Location: ../form/login.php'); //on redirige l'utilisateur vers la page d'accueil
    	exit;

    }
}
?>
