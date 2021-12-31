<div>
    <main class="page landing-page">
        <section class="clean-block clean-info dark" style="background: #dcdde1; padding-bottom: 10px;padding-top: 80px;">
            <div class="container" style="width:50%">
                <div class="block-heading" style="padding-top: 0px"><br><br>
                    <h2 class="text-info" style="color: #0c2461;"> <?php  echo 'Bienvenue, ' . $_SESSION['pseudo'] . ' ! </h2>'; ?>
                </div>
                <div class="row align-items-center" >
                    <div class="col-md-6" style="padding-bottom:  15px">
                        <br>
                        <div class="getting-started-info"></div>
                        <br>
                        <?php
                        echo '<h3 style="display:inline;">Argent :</h3> <h4 style="color:#cd7030; display:inline; padding-left:0.2em">' . $_SESSION['argent'] . '</h5>';
                        ?>
                        <br><?php
                        echo '<h3 style="display:inline;">XP :</h3> <h4 style="color:#cd3030; display:inline; padding-left:0.2em">' . $_SESSION['xp'] . '</h5>';
                        ?>
                    </div>

                </div>
            </div>
            <section></section>
        </section>
        <section class="clean-block clean-info dark" style="height: 133px;background: rgb(255,255,255);">
            <div class="container">
                <div class="block-heading" style="height: -26px;"><a href="./index.php?action=postersondage">
                    <button id="btnPosterSondage" class="btn btn-primary" type="button" style="transform: translate(0px) scale(1.63);border-radius: 11px;background: #2e86de;">Poster un sondage</button></a></div>
            </div>
        </section>
        <section class="clean-block clean-info dark" style="height: 133px;background: rgb(255,255,255);">
            <div class="row justify-content-center">
                <div class="containerl">
                    <div class="leaderboard">
                        <div class="headl">
                            <i class="fas fa-crown"></i>
                            <h1>Leaderboard</h1>
                        </div>
                            <div class="bodyl">
                                <ol>
                                    <?php
                                        $reponse = Model::getPDO()->query('SELECT * FROM PE__User ORDER BY xp DESC');
                                        $i = 0;
                                        while ($donnees = $reponse->fetch() and $i<5) {
                                            $i++;
                                        
                                        echo "<li>
                                             <span class='lpseudo'>" . $donnees['pseudo'] . "</span>
                                            <span class='lxp'>" . $donnees['xp']. "</span>
                                        </li>";
                                        }
                                        $reponse->closeCursor();
                                    ?>
                                </ol>
                            </div>
                    </div>
                </div>
            </div>
        </section><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="text-align: left;color: #0c2461;">Récents :</h2>
                </div>
                <div class="row justify-content-center">
                                <?php
                
                $i = 0;
                while ($donnees = $recent->fetch() and $i<5) {
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
                            
                        $i = 0;
                        while ($donnees = $nbVues->fetch() and $i<5) {
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

                    echo '<p class = "champSondage colle">Posté le : ' . $donnees['date_creation_sondage'] . '</p>'; 
                    ?>
                    <div class="icons"><a href="./index.php?action=testclics&id=<?php echo $donnees['id_sondage']?>&lien=<?php echo $donnees['lien']?>" target="_blank">
                        <button id="btnSondage" class="openmodal myBtn btn btn-primary" style="width: 138px;height: 43px;font-size: 10px;background: #2e86de;">Répondre au sondage</button></a>
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
                    echo '<p class = "champSondage"><br><small style="padding: -0;text-align: left;width: 0;height: 0;margin: 0;">Vues :&nbsp;' . $donnees['clics'] . '</small></p></div></div>';

            }
                $reponse->closeCursor();
                ?>
                </div>
            </div>
        </section>
    </main>
</div>
<style type="text/css">
  #btnPosterSondage {
    transition-duration: 0.25s !important;
  }

  #btnPosterSondage:hover {
    background-color: #3B99E0 !important;
    border-color: white !important; /* Green */
    color: white !important;
  }
  
</style>