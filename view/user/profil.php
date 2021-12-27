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

$req2 = $pdo->prepare("SELECT COUNT(*) as Stats FROM PE__SondageFait WHERE userID = :userID"); 
$req2->execute(array('userID' => $_SESSION['id']));
$resultat2 = $req2->fetch();
$req2->closeCursor();


?>

    <main class="page landing-page">
        <section class="clean-block clean-info dark" style="background: #dcdde1;">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="color: #0c2461;">Profil</h2>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>Pseudo :</h3> <?php echo $_SESSION['pseudo'];?>
                        <div class="getting-started-info"></div>
                        <h3>Argent :&nbsp;</h3>
                        <?php
                        echo $_SESSION['argent'];
                        ?>
                        <h3>Email :</h3> <?php echo $_SESSION['email'];?>
                        <h3>Date de création du compte :</h3> <?php echo $_SESSION['date'];?>
                        <h3>Nombre de sondages répondus :</h3> <?php echo $resultat2['Stats'];;?>

                        <br><br><br>

                        <h3>Équipement</h3> 
                        <?php 

                        $reponse = $pdo->query('SELECT * FROM PE__Objet JOIN PE__Inventaire ON PE__Objet.itemID = PE__Inventaire.itemID WHERE userID =' . $_SESSION['id'] . ' AND isEquiped = 1 ORDER BY prix ASC');
                        while ($donnees = $reponse->fetch()){
                            ?>
                                            <div class="col-sm-6 col-lg-4" style="width: 228px;">
                                                <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/<?php echo $donnees['file'] ?>" style="height: 120.234px;">
                                                    <div class="card-body info" style="height: 160.234px;">
                                            <?php
                                            echo '<h4 class="card-title" style="height: 25px;">' . $donnees['nom'] . '</h4>';

                                            echo '<div class="icons"><a href="./index.php?controller=boutique&action=unequip&itemID=' . $donnees['itemID'] . '&userID=' . $_SESSION['id'] . '"><button class="btn btn-primary" data-bss-hover-animate="pulse" type="button" style="width: 138px;height: 39px;font-size: 14px;background: #2e86de;">Déséquiper</button></a></div></div></div></div>';

                                    }
                                        $reponse->closeCursor();
                                        


                        ?>
                        <br><br><br>


                    </div>
                </div>
            </div>
            <main class="page pricing-table-page">
        <section class="clean-block clean-pricing dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Inventaire</h2><br>
                    <div class="row justify-content-center">
                                            <?php

                                        $reponse = $pdo->query('SELECT * FROM PE__Objet JOIN PE__Inventaire ON PE__Objet.itemID = PE__Inventaire.itemID WHERE PE__Inventaire.isEquiped = 0 AND userID =' . $_SESSION['id'] . ' ORDER BY prix ASC');

                                        $reponse = $pdo->query('SELECT * FROM PE__Objet JOIN PE__Inventaire ON PE__Objet.itemID = PE__Inventaire.itemID WHERE PE__Inventaire.isEquiped = 0 AND userID =' . $_SESSION['id'] . ' ORDER BY prix ASC');

                                        $i = 0;
                                        while ($donnees = $reponse->fetch() and $i<50) {
                                            $i++;
                                            ?>
                                            <div class="col-sm-6 col-lg-4" style="width: 228px;">
                                                <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/<?php echo $donnees['file'] ?>" style="height: 120.234px;">
                                                    <div class="card-body info" style="height: 160.234px;">
                                            <?php
                                            echo '<h4 class="card-title" style="height: 25px;">' . $donnees['nom'] . '</h4>';

                                            echo '<div class="icons"><a href="./index.php?controller=boutique&action=equip&itemID=' . $donnees['itemID'] . '&userID=' . $_SESSION['id'] . '"><button class="btn btn-primary" data-bss-hover-animate="pulse" type="button" style="width: 138px;height: 39px;font-size: 14px;background: #2e86de;">Équiper</button></a></div></div></div></div>';

                                    }
                                        $reponse->closeCursor();
                                        ?>
                                
                    </div>
                </div></div></div>

