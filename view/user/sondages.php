<?php
session_name('pollexpress');
session_start();
require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: ./form/login.php');
    exit;
}

if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
    header('Location: ./form/login.php');
    exit;
}


if(!empty($_POST)){
    extract($_POST);

    $ok = true;


    if (isset($_POST['search'])){


        $search = htmlentities(strtolower(trim($search)));

      /*$reponse = $pdo->query('SELECT * FROM Sondage ORDER BY date_creation_sondage DESC');
        $i = 0;
        while ($donnees = $reponse->fetch() and $i<5) { */

        $sql = $pdo->prepare("SELECT * FROM Sondage WHERE titre = :recherche");
        $sql->execute(array('recherche' => $search));
        $recherche = $sql->fetch();

        echo $recherche['titre'];

        $_SESSION['titre'] = $recherche['titre'];


            //header('Location: ../script/recherche.php'); //on redirige l'utilisateur vers la page d'accueil
            exit;
        }
    
}
?>


<form method="post">
    <h1>Rechercher un sondage</h1>
    <hr>
    <label for="text"><b>Recherche</b></label>
    <br>
    <input type="text" placeholder="Nom du sondage" name="recherche">
    <br>
    <button type="submit" name="search" class="boutonsearch">Rechercher</button>
</form>

<div>
    <?php

    echo $_SESSION['titre'];


    ?>

</div>
 <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="text-align: left;color: #0c2461;">Récents :</h2>
                </div>
                <div class="row justify-content-center">
                    <?php
                $reponse = $pdo->query('SELECT * FROM Sondage ORDER BY date_creation_sondage DESC');
                $i = 0;
                while ($donnees = $reponse->fetch() and $i<5) {
                    $i++;
                    ?>
                    <div class="col-sm-6 col-lg-4" style="width: 228px;">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/sondage-826x459.jpg" style="height: 120.234px;">
                    <?php
                    echo '<h4 class="card-title" style="height: 14px;">' . $donnees['titre'] . '</h4>';

                    echo '<p class="card-text">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle">Posté le :' . $donnees['date_creation_sondage'] . '</p>'; 

                    echo '<div class="icons"><a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/view/user/testclics.php?id=' . $donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '"><button class="btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a></div>';

                    echo '<p class = "champSondage"><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues :&nbsp;' . $donnees['clics'] . '</small></p></div></div>';

            }
                $reponse->closeCursor();
                ?>
        </div>
        </section>
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="text-align: left;color: #0c2461;">Les plus vus :</h2>
                </div>
                      <div class="row justify-content-center">
            <?php
                $reponse = $pdo->query('SELECT * FROM Sondage ORDER BY clics DESC');
                $i = 0;
                while ($donnees = $reponse->fetch() and $i<5) {
                    $i++;
                    ?>
                    <div class="col-sm-6 col-lg-4" style="width: 228px;">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/sondage-826x459.jpg" style="height: 120.234px;">
                    <?php
                    echo '<h4 class="card-title" style="height: 14px;">' . $donnees['titre'] . '</h4>';

                    echo '<p class="card-text">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle">Posté le :' . $donnees['date_creation_sondage'] . '</p>'; 

                    echo '<div class="icons"><a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/view/user/testclics.php?id=' . $donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '"><button class="btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a></div>';

                    echo '<p class = "champSondage"><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues :&nbsp;' . $donnees['clics'] . '</small></p></div></div>';

            }
                $reponse->closeCursor();
                ?>
               </div>
               </section>
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="text-align: left;color: #0c2461;">Tous les sondages :</h2>
                </div>
                      <div class="row justify-content-center">
            <?php
            
                $reponse = $pdo->query('SELECT * FROM Sondage ORDER BY titre ASC');
                $i = 0;
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-sm-6 col-lg-4" style="width: 228px;">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/sondage-826x459.jpg" style="height: 120.234px;">
                    <?php
                    echo '<h4 class="card-title" style="height: 14px;">' . $donnees['titre'] . '</h4>';

                    echo '<p class="card-text">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle">Posté le :' . $donnees['date_creation_sondage'] . '</p>'; 

                    echo '<div class="icons"><a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/view/user/testclics.php?id=' . $donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '"><button class="btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a></div>';

                    echo '<p class = "champSondage"><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues :&nbsp;' . $donnees['clics'] . '</small></p></div></div>';

            }
                $reponse->closeCursor();
                ?>
               </div>
            </div>
        </section>
</body>
</html>