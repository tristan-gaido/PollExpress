    <?php
    if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/index.php?action=login');
    exit;
  }

  if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
        header('Location: https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/index.php?action=login');
        exit;
  }
?>
            <div>
    <main class="page landing-page">
        <section class="clean-block clean-info dark" style="background: #dcdde1;">
            <div class="container">
                <div class="block-heading"><br><br>
                    <h2 class="text-info" style="color: #0c2461;"> <?php  echo 'Bienvenue, ' . $_SESSION['pseudo'] . '</h2>'; ?>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>Pseudo :</h3> 
                        <?php
                        echo $_SESSION['pseudo'];
                        ?>
                        <br>
                        <div class="getting-started-info"></div>
                        <br><h3>Argent :&nbsp;</h3>
                        <?php
                        echo $_SESSION['argent'];
                        ?>
                    </div>
                </div>
            </div>
            <section></section>
        </section>
        <section class="clean-block clean-info dark" style="height: 133px;background: rgb(255,255,255);">
            <div class="container">
                <div class="block-heading" style="height: -26px;"><a href="./index.php?action=postersondage"><button class="btn btn-primary" type="button" style="transform: translate(0px) scale(1.63);border-radius: 11px;background: #2e86de;">Poster un sondage</button></a></div>
            </div>
        </section>
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="text-align: left;color: #0c2461;">Récents :</h2>
                </div>
                <div class="row justify-content-center">
                                <?php
                $reponse = Model::getPDO()->query('SELECT * FROM Sondage ORDER BY date_creation_sondage DESC');
                $i = 0;
                while ($donnees = $reponse->fetch() and $i<5) {
                    $i++;
                    ?>
                    <div class="col-sm-6 col-lg-4" style="width: 228px;">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="assets/img/sondage-826x459.jpg" style="height: 120.234px;">
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
                                $reponse = Model::getPDO()->query('SELECT * FROM Sondage ORDER BY clics DESC');
                                $i = 0;
                while ($donnees = $reponse->fetch() and $i<5) {
                    $i++;
                    ?>
                    <div class="col-sm-6 col-lg-4" style="width: 228px;">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="assets/img/sondage-826x459.jpg" style="height: 120.234px;">
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
    </main>
</div>
