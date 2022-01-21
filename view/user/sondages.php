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


    if (isset($_POST['search'])){


        if (isset($tag1) || isset($tag2) || isset($tag3) || isset($tag4)){
             $tag = '';

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
                $reponse = $pdo->query('SELECT * FROM PE__Sondage WHERE titre LIKE "%' . $recherche . '%" ORDER BY date_creation_sondage DESC' );
                }
    
                else{
                $reponse = $pdo->query('SELECT * FROM PE__Sondage WHERE tag1 ="' . $tag . '" OR tag2="' . $tag . '"');
                }

        		echo '<br><br><br><br><br><br><br><div class="row justify-content-center">';
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

                    
                    if(strlen($donnees['titre'])>20){
                            echo '<h4 class="card-title" style="height: 14px; margin-top: 5px; font-size: 15px; margin-bottom: 45px;margin-left: 5px;margin-right: 5px;">' . $donnees['titre'] . '</h4>';
                    }else{
                        echo '<h4 class="card-title" style="height: 14px; margin-top: 5px;">' . $donnees['titre'] . '</h4>';
                    }
          

                    echo '<p class="card-text" style="margin-bottom: 3px;">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle" style="margin-bottom: 3px;">Posté le : ' . $donnees['date_creation_sondage'] . '</p>'; 
                    ?>
                    <div class="icons"><a style="height: 55px;" href="./index.php?action=testclics&id=<?php echo $donnees['id_sondage']?>&lien=<?php echo $donnees['lien']?>" target="_blank">
                        <button id="btnSondage" class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 11px;background: #2e86de; padding: 3px 3px;">Répondre au sondage</button></a>
                    <div class="modal myModal">
                    <div class="modal-content">
                    <form method="post" action="./index.php?action=testcode&idsondage=<?php echo $donnees['id_sondage']?>">                          
                            <div class="mb-3"><label class="form-label" for="code"><strong>Entrez le code du sondage</strong><br></label>
                              <input class="form-control item" type="text" id="code" placeholder="Code du sondage" name="codeSondage"></div>                       
                            <div class="mb-3">                                
                            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="code" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
                        </form>
                    </div>
                    </div></div></div>
                    <?php
                    if($_SESSION['id']==$donnees['userID']){
                    ?>
                     <p style="margin: 0px; padding: 0px;"> <a href="./index.php?action=deletesondage&idsondage=<?php echo $donnees['id_sondage']?>"> Supprimer </a></p>
                     <?php 
                     }
                     ?>
                    <p class = "champSondage"><br><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues : <?php echo $donnees['clics'] ?></small><a href="./index.php?action=signaler&idsondage=<?php echo $donnees['id_sondage'] ?>"><button class="btn btn-primary btn-xs" style="font-size: 12px; margin-left: 30px; padding: 5px;">Signaler</button></a></p></div></div>
                    <?php

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

                    
                    if(strlen($donnees['titre'])>20){
                            echo '<h4 class="card-title" style="height: 14px; margin-top: 5px; font-size: 15px; margin-bottom: 45px;margin-left: 5px;margin-right: 5px;">' . $donnees['titre'] . '</h4>';
                    }else{
                        echo '<h4 class="card-title" style="height: 14px; margin-top: 5px;">' . $donnees['titre'] . '</h4>';
                    }
          

                    echo '<p class="card-text" style="margin-bottom: 3px;">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle" style="margin-bottom: 3px;">Posté le : ' . $donnees['date_creation_sondage'] . '</p>'; 
                    ?>
                    <div class="icons"><a style="height: 55px;" href="./index.php?action=testclics&id=<?php echo $donnees['id_sondage']?>&lien=<?php echo $donnees['lien']?>" target="_blank">
                        <button id="btnSondage" class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 11px;background: #2e86de; padding: 3px 3px;">Répondre au sondage</button></a>
                    <div class="modal myModal">
                    <div class="modal-content">
                    <form method="post" action="./index.php?action=testcode&idsondage=<?php echo $donnees['id_sondage']?>">                          
                            <div class="mb-3"><label class="form-label" for="code"><strong>Entrez le code du sondage</strong><br></label>
                              <input class="form-control item" type="text" id="code" placeholder="Code du sondage" name="codeSondage"></div>                       
                            <div class="mb-3">                                
                            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="code" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
                        </form>
                    </div>
                    </div></div></div>
                    <?php
                    if($_SESSION['id']==$donnees['userID']){
                    ?>
                     <p style="margin: 0px; padding: 0px;"> <a href="./index.php?action=deletesondage&idsondage=<?php echo $donnees['id_sondage']?>"> Supprimer </a></p>
                     <?php 
                     }
                     ?>
                    <p class = "champSondage"><br><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues : <?php echo $donnees['clics'] ?></small><a href="./index.php?action=signaler&idsondage=<?php echo $donnees['id_sondage'] ?>"><button class="btn btn-primary btn-xs" style="font-size: 12px; margin-left: 30px; padding: 5px;">Signaler</button></a></p></div></div>
                    <?php

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
                    if(strlen($donnees['titre'])>20){
                            echo '<h4 class="card-title" style="height: 14px; margin-top: 5px; font-size: 15px; margin-bottom: 45px;margin-left: 5px;margin-right: 5px;">' . $donnees['titre'] . '</h4>';
                    }else{
                        echo '<h4 class="card-title" style="height: 14px; margin-top: 5px;">' . $donnees['titre'] . '</h4>';
                    }

                    echo '<p class="card-text">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle">Posté le : ' . $donnees['date_creation_sondage'] . '</p>'; 
                    ?>
                    <div class="icons"><a href="./index.php?action=testclics&id=<?php echo $donnees['id_sondage']?>&lien=<?php echo $donnees['lien']?>" target="_blank">
                        <button id="btnSondage" class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 11px;background: #2e86de; padding: 3px 3px;">Répondre au sondage</button></a>
                    <div class="modal myModal">
                    <div class="modal-content">
                    <form method="post" action="./index.php?action=testcode&idsondage=<?php echo $donnees['id_sondage']?>">                          
                            <div class="mb-3"><label class="form-label" for="code"><strong>Entrez le code du sondage</strong><br></label>
                              <input class="form-control item" type="text" id="code" placeholder="Code du sondage" name="codeSondage"></div>                       
                            <div class="mb-3">                                
                            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="code" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
                        </form>
                    </div>
                    </div></div></div>
                    <?php
                    if($_SESSION['id']==$donnees['userID']){
                    ?>
                     <p style="margin: 0px; padding: 0px;"> <a href="./index.php?action=deletesondage&idsondage=<?php echo $donnees['id_sondage']?>"> Supprimer </a></p>
                     <?php 
                     }
                     ?>
                    <p class = "champSondage"><br><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues : <?php echo $donnees['clics'] ?></small><a href="./index.php?action=signaler&idsondage=<?php echo $donnees['id_sondage'] ?>"><button class="btn btn-primary btn-xs" style="font-size: 12px; margin-left: 30px; padding: 5px;">Signaler</button></a></p></div></div>
                    <?php

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
                        <div class="card text-center clean-card" style="margin-bottom: 30px;"><img class="card-img-top w-100 d-block" src="assets/img/sondage-826x459.jpg" style="height: 120.234px;">

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

                    
                    if(strlen($donnees['titre'])>20){
                            echo '<h4 class="card-title" style="height: 14px; margin-top: 5px; font-size: 15px; margin-bottom: 45px;margin-left: 5px;margin-right: 5px;">' . $donnees['titre'] . '</h4>';
                    }else{
                        echo '<h4 class="card-title" style="height: 14px; margin-top: 5px;">' . $donnees['titre'] . '</h4>';
                    }
          

                    echo '<p class="card-text" style="margin-bottom: 3px;">' . $donnees['tag1'] . '⠀⠀' . $donnees['tag2'] . '</p>';

                    echo '<p class = "champSondage colle" style="margin-bottom: 3px;">Posté le : ' . $donnees['date_creation_sondage'] . '</p>'; 
                    ?>
                    <div class="icons"><a style="height: 55px;" href="./index.php?action=testclics&id=<?php echo $donnees['id_sondage']?>&lien=<?php echo $donnees['lien']?>" target="_blank">
                        <button id="btnSondage" class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 11px;background: #2e86de; padding: 3px 3px;">Répondre au sondage</button></a>
                    <div class="modal myModal">
                    <div class="modal-content">
                    <form method="post" action="./index.php?action=testcode&idsondage=<?php echo $donnees['id_sondage']?>">                          
                            <div class="mb-3"><label class="form-label" for="code"><strong>Entrez le code du sondage</strong><br></label>
                              <input class="form-control item" type="text" id="code" placeholder="Code du sondage" name="codeSondage"></div>                       
                            <div class="mb-3">                                
                            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="code" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
                        </form>
                    </div>
                    </div></div></div>
                    
                    <p class = "champSondage"><br><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues : <?php echo $donnees['clics'] ?></small><a href="./index.php?action=signaler&idsondage=<?php echo $donnees['id_sondage'] ?>"><button class="btn btn-primary btn-xs" style="font-size: 12px; margin-left: 30px; padding: 5px;">Signaler</button></a></p></div></div>
                    <?php

            }
                $reponse->closeCursor();

                ?>
               </div>
            </div>
        </section>
</body>
