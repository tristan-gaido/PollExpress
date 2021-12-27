<?php
  session_name('pollexpress');
  session_start();

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

  $id_sondage = $_GET['id'];
  $lien_sondage = $_GET['lien'];

  echo $id_sondage;
  echo $lien_sondage;

  setcookie("CodeSondage", $id_sondage, time()+3600);

  $sql = $pdo->prepare("SELECT * FROM PE__Sondage WHERE id_sondage = :id_sondage");
  $sql->execute(array('id_sondage' => $id_sondage));
  $sql = $sql->fetch();


  $nbclics = $sql['clics'];

  $sqlt = $pdo->prepare("UPDATE PE__Sondage SET clics = :clics WHERE id_sondage = :id_sondage");
  $sqlt->execute(array('clics' => $nbclics+1, 'id_sondage' => $id_sondage));

  header('Location: ' . $lien_sondage); //redirection vers la page 
  exit;

?>

