<?php
	session_name('pollexpress');
	session_start();
	include('./BDD.php');


        $req = $pdo->prepare("UPDATE User SET isVerified = false WHERE email = :email");
        $req->execute(array('email' => $_SESSION['email']));
        $req2 = $pdo->prepare("SELECT * FROM User WHERE email = :email");
        $req2->execute(array('email' => $_SESSION['email']));
        $resultat = $req2->fetch();

        $_SESSION['isVerified'] = htmlentities($resultat['isVerified']);
		header('Location: index.php');
		exit;

?>