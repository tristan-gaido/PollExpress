    <?php

    require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

    if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/index.php?action=login');
    exit;
  }

  if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
        header('Location: https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/index.php?action=login');
        exit;
  }


  if(!empty($_POST)){ // Si la variable "$_Post" contient des informations alors on les traites
    extract($_POST); //extrait les valeurs du form en 2 variables $email $mdp
    
    $ok = true;


  if (isset($_POST['code'])){ //test pour le formulaire "inscription"

    //htmlentites = pour éviter les injections, trim = enleve les espaces au début et a la fin
    $code = htmlentities(trim($email));

    $id_sondage = $_COOKIE['CodeSondage'];

    $req = $pdo->prepare("SELECT * FROM Sondage WHERE code = :code"); 
    $req->execute(array('code' => $code));
    $resultat = $req->fetch();
    //on test si les valeurs du formulaire correspondent a la bdd

    if (!$resultat) { //si la requete échoue
      $ok = false;
    }

    if ($ok){
      $_SESSION['argent'] = $_SESSION['argent'] + 50;
      $_SESSION['xp'] = $_SESSION['xp'] + 500;


      header('Location: ./index.php'); //on redirige l'utilisateur vers la page d'accueil
      exit;
    }
  }
}
?>
?>
            <div>
    <main class="page landing-page">
        <section class="clean-block clean-info dark" style="background: #dcdde1; padding-bottom: 10px;">
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
                        <br><h3>XP :&nbsp;</h3>
                        <?php
                        echo $_SESSION['xp'];
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

                        <script type="text/javascript">
                     
                        var modals = document.getElementsByClassName('modal');
                        var btns = document.getElementsByClassName("openmodal");
                        var spans=document.getElementsByClassName("close");
                        for(let i=0;i<btns.length;i++){
                           btns[i].onclick = function() {
                              modals[i].style.display = "block";
                           }
                        }
                        for(let i=0;i<spans.length;i++){
                            spans[i].onclick = function() {
                               modals[i].style.display = "none";
                            }
                         }      
                    </script>
                    <?php
                    
                    echo '<h4 class="card-title" style="height: 14px;">' . $donnees['titre'] . '</h4>';

                    echo '<p class="card-text">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle">Posté le :' . $donnees['date_creation_sondage'] . '</p>'; 

                    echo '<div class="icons"><a href="./index.php?action=testclics&id=' . $donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '" target="_blank"><button class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a>
                    <div class="modal myModal">
                    <div class="modal-content">
                    <span class="close">&times;</span>
                    <form method="post">                          
                            <div class="mb-3"><label class="form-label" for="email"><strong>Entrez le code du sondage</strong><br></label>
                              <input class="form-control item" type="text" id="code" placeholder="Code du sondage" name="code"></div>                       
                            <div class="mb-3">                                
                            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="code" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
                        </form>
                    </div>
                    </div></div></div>';

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

                        <script type="text/javascript">
                     
                        var modals = document.getElementsByClassName('modal');
                        var btns = document.getElementsByClassName("openmodal");
                        var spans=document.getElementsByClassName("close");
                        for(let i=0;i<btns.length;i++){
                           btns[i].onclick = function() {
                              modals[i].style.display = "block";
                           }
                        }
                        for(let i=0;i<spans.length;i++){
                            spans[i].onclick = function() {
                               modals[i].style.display = "none";
                            }
                         }      
                    </script>
                    <?php
                    
                    echo '<h4 class="card-title" style="height: 14px;">' . $donnees['titre'] . '</h4>';

                    echo '<p class="card-text">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle">Posté le :' . $donnees['date_creation_sondage'] . '</p>'; 

                    echo '<div class="icons"><a href="./index.php.action=testclics&id=' . $donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '" target="_blank"><button class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a>
                    <div class="modal myModal">
                    <div class="modal-content">
                    <span class="close">&times;</span>
                    <form method="post">                          
                            <div class="mb-3"><label class="form-label" for="email"><strong>Entrez le code du sondage</strong><br></label>
                              <input class="form-control item" type="text" id="code" placeholder="Code du sondage" name="code"></div>                       
                            <div class="mb-3">                                
                            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="code" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
                        </form>
                    </div>
                    </div></div></div>';

                    echo '<p class = "champSondage"><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues :&nbsp;' . $donnees['clics'] . '</small></p></div></div>';

            }
                $reponse->closeCursor();
                ?>
               </div>
            </div>
        </section>
    </main>
</div>
