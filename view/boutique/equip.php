<?php
  session_name('pollexpress');
  session_start();

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

  $userID = $_GET['userID'];
  $itemID = $_GET['itemID'];


    $sql4 = $pdo->prepare("UPDATE PE__Inventaire SET isEquiped = 1 WHERE userID = :userID AND itemID = :itemID");
    $sql4->execute(array('userID' => $userID, 'itemID' => $itemID));

  header('Location: ./index.php?action=profil');
  exit;

?>

