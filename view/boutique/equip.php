<?php
  session_name('pollexpress');
  session_start();

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

  $userID = $_GET['userID'];
  $itemID = $_GET['itemID'];


    $sql4 = $pdo->prepare("UPDATE Inventaire SET isEquiped = 1 WHERE userID = :userID AND itemID = :itemID");
    $sql4->execute(array('userID' => $userID, 'itemID' => $itemID));

  header('Location: https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/index.php?action=profil');
  exit;

?>
