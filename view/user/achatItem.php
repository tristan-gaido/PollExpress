<?php
  session_name('pollexpress');
  session_start();

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

  $userID = $_GET['userID'];
  $itemID = $_GET['itemID'];

  echo '<br><br><br><br><br> fuihfeuihfei';


  $sql = $pdo->prepare("SELECT PE__argent FROM User WHERE id = :userID");
  $sql->execute(array('userID' => $userID));
  $sql = $sql->fetch();

  $sql2 = $pdo->prepare("SELECT PE__prix FROM Objet WHERE itemID = :itemID");
  $sql2->execute(array('itemID' => $itemID));
  $sql2 = $sql2->fetch();

  $argentUser = $sql['argent'];
  $prixItem = $sql2['prix'];

  if($argentUser>=$prixItem){

    $newargent = $argentUser - $prixItem;
    echo 'NEWARGENT : ' . $newargent;
    $sql3 = $pdo->prepare("INSERT INTO PE__Inventaire VALUES (:userID , :itemID, 0)");
    $sql3->execute(array('userID' => $userID, 'itemID' => $itemID));

    $sql4 = $pdo->prepare("UPDATE PE__User SET argent = :newargent WHERE id = :userID");
    $sql4->execute(array('newargent' => $newargent, 'userID' => $userID));

    $_SESSION['argent'] = $newargent;

  }
  else {
    echo 'Pas assez d\'argent';
  }


  header('Location: ./index.php?action=boutique');
  exit;

?>

