<?php
  session_name('pollexpress');
  session_start();

  include('./BDD.php');

  $id_sondage = $_GET['id'];
  $lien_sondage = $_GET['lien'];

  echo $id_sondage;
  echo $lien_sondage;

  $sql = $pdo->prepare("SELECT * FROM Sondage WHERE id_sondage = :id_sondage");
  $sql->execute(array('id_sondage' => $id_sondage));
  $sql = $sql->fetch();


  $nbclics = $sql['clics'];

  $sqlt = $pdo->prepare("UPDATE Sondage SET clics = :clics WHERE id_sondage = :id_sondage");
  $sqlt->execute(array('clics' => $nbclics+1, 'id_sondage' => $id_sondage));

  header('Location: ' . $lien_sondage); //redirection vers la page index.php
  exit;

?>

