<?php
	session_name('pollexpress');
	session_start();
require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';


        $req = $pdo->prepare("UPDATE PE__User SET isVerified = true WHERE email = :email");
        $req->execute(array('email' => $_SESSION['email']));
        $req2 = $pdo->prepare("SELECT * FROM PE__User WHERE email = :email");
        $req2->execute(array('email' => $_SESSION['email']));
        $resultat = $req2->fetch();

        $_SESSION['isVerified'] = htmlentities($resultat['isVerified']);
		header('Location: ./index.php');
		exit;

?>