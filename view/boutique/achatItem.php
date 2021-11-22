<?php
  session_name('pollexpress');
  session_start();

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

  $userID = $_GET['userID'];
  $itemID = $_GET['itemID'];




  $sql = $pdo->prepare("SELECT argent FROM User WHERE id = :userID");
  $sql->execute(array('userID' => $userID));
  $sql = $sql->fetch();

  $sql2 = $pdo->prepare("SELECT prix FROM Objet WHERE itemID = :itemID");
  $sql2->execute(array('itemID' => $itemID));
  $sql2 = $sql2->fetch();

  $argentUser = $sql['argent'];
  $prixItem = $sql2['prix'];

  if($argentUser>=$prixItem){

    $newargent = $argentUser - $prixItem;
    echo 'NEWARGENT : ' . $newargent;
    $sql3 = $pdo->prepare("INSERT INTO Inventaire VALUES (:userID , :itemID, 0)");
    $sql3->execute(array('userID' => $userID, 'itemID' => $itemID));

    $sql4 = $pdo->prepare("UPDATE User SET argent = :newargent WHERE id = :userID");
    $sql4->execute(array('newargent' => $newargent, 'userID' => $userID));

    $_SESSION['argent'] = $newargent;

  }
  else {
    echo 'Pas assez d\'argent';
  }


  header('Location: https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/index.php?action=boutique');
  exit;

?>

