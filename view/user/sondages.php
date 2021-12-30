<?php

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: ./index.php?action=login');
    exit;
}

if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
    header('Location: ./index.php?action=login');
    exit;
}


if(!empty($_POST)){
    extract($_POST);

    $tag = '';

    if (isset($_POST['search'])){


        if (isset($tag1) || isset($tag2) || isset($tag3) || isset($tag4)){

        if (isset($tag1) && !isset($tag2) && !isset($tag3) && !isset($tag4)) {
                $tag = $tag1;
        }if (!isset($tag1) && isset($tag2) && !isset($tag3) && !isset($tag4)) {
                $tag = $tag2;
        }if (!isset($tag1) && !isset($tag2) && isset($tag3) && !isset($tag4)) {
                $tag = $tag3;
        }if (!isset($tag1) && !isset($tag2) && !isset($tag3) && isset($tag4)) {
                $tag = $tag4;
        }

    }


        $recherche = htmlentities(strtolower(trim($recherche)));

                if (!isset($tag1) && !isset($tag2) && !isset($tag3) && !isset($tag4)) {
                $reponse = $pdo->query('SELECT * FROM PE__Sondage WHERE titre LIKE "%' . $recherche . '%"' );
                }
                else{
                $reponse = $pdo->query('SELECT * FROM PE__Sondage WHERE tag1 ="' . $tag . '" OR tag2="' . $tag . '"');
                }

        		echo '<br><br><br><br><br><br><br><div class="row justify-content-center">';
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-sm-6 col-lg-4" style="width: 228px;">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/sondage-826x459.jpg" style="height: 120.234px;">
                    <?php
                    echo '<h4 class="card-title" style="height: 14px;">' . $donnees['titre'] . '</h4>';

                    echo '<p class="card-text">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle">Posté le :' . $donnees['date_creation_sondage'] . '</p>'; 

                    echo '<div class="icons"><a href="./index.php?action=testclics&id=' . $donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '"><button class="btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a></div>';

                    echo '<p class = "champSondage"><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues :&nbsp;' . $donnees['clics'] . '</small></p></div></div>';

            }
                $reponse->closeCursor();
                

            exit;
        }
    
}
?>
<br><br>
<body>
    <section class="clean-block clean-form dark" style="height: 330.188px; background-color: white;">
        <div class="container text-start" style="height: 459px;">
            <div class="block-heading" style="height: -5px;">
                <form method="post">
                <div class="mb-3"><label class="form-label" for="text"><strong>Rechercher un sondage</strong><br></label>
                  <input class="form-control item" type="text" id="text" placeholder="Nom du sondage" name="recherche"></div>

                  <input type="checkbox" id="tag1" name="tag1" value="Informatique">
                  <label for="tag1">Informatique</label><br>

                  <input type="checkbox" id="tag2" name="tag2" value="Science">
                  <label for="tag2">Science</label><br>

                  <input type="checkbox" id="tag3" name="tag3" value="Jeux-video">
                  <label for="tag3">Jeux-video</label><br>

                  <input type="checkbox" id="tag4" name="tag4" value="Gestion">
                  <label for="tag4">Gestion</label><br>
                <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="search" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Rechercher</button>
            </form>
        </div>
    </section>


</div>
 <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="text-align: left;color: #0c2461;">Récents :</h2>
                </div>
                <div class="row justify-content-center">
                    <?php
                $reponse = $pdo->query('SELECT * FROM PE__Sondage ORDER BY date_creation_sondage DESC');
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

                    echo '<div class="icons"><a hhref="./index.php?action=testclics&id=' . $donnees['id_sondage'] . '&lien=' . $donnees['lien'] . '" target="_blank"><button class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a>
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
                $reponse = $pdo->query('SELECT * FROM PE__Sondage ORDER BY clics DESC');
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
                    ?>

                    <div class="icons"><a href="./index.php?action=testclics&id= <?php $donnees['id_sondage'] ?>&lien= <?php $donnees['lien'] ?>" target="_blank"><button class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a>
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
                    </div></div></div>
                    <?php

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
            
                $reponse = $pdo->query('SELECT * FROM PE__Sondage ORDER BY titre ASC');
                $i = 0;
                while ($donnees = $reponse->fetch()) {
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
            </div>
        </section>
</body>
