
<?php
    session_name('pollexpress');
    session_start();

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';


    if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: ./index.php?action=login');
    exit;
  }

  if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
        header('Location: ./index.php?action=login');
        exit;
  }
?>