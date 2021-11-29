<?php
    session_name('pollexpress');
    session_start();

require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';


    if (!isset($_SESSION['id'])){   //Si l'utilisateur n'est pas connecté ou pas validé, il est redirigé automatiquement vers la page de login
    header('Location: ../form/login.php');
    exit;
  }

  if((isset($_SESSION['id'])) && ($_SESSION['confirmation_token']==0)){
        header('Location: ../form/login.php');
        exit;
  }
?>
    <main class="page pricing-table-page">
        <section class="clean-block clean-pricing dark">
            <div class="container">
                <div class="block-heading">
                        <div class="partie_boutique">
                    <h2 class = "categorie_boutique"> <button>Personnalisation</button>
                                            <button>Objets Réels</button></h2><br>
                    <div class="row justify-content-center">
                                            <?php
                                        $reponse = $pdo->query('SELECT * FROM Objet ORDER BY itemID DESC');
                                        $i = 0;

                                        while ($donnees = $reponse->fetch() and $i<50) {


                                            $i++;


                                            if($donnees['type'] == 'background') {
                                                $couleurH = '#8728F5';
                                                $couleurM = '#A82FFF';
                                                $couleurB = '#CE52FE';
                                            }
                                            else {
                                                $couleurH = '#fcba03';
                                                $couleurB = '#E2E2E2';
                                                $couleurM = '#ffffff';
                                            }

                                            ?>
                                            <div class="col-sm-6 col-lg-4" style="width: 228px; padding-top: 20px;">

                                                <div class="card text-center clean-card" style="border: solid; border-color:#ababab;">
                                                      <?php
                                                echo '<h4 class="card-title" style="height:25px; color:white; padding-top:5px; padding-bottom:25px; background-color:' . $couleurH .';   ">' . $donnees['type'] . '</h4>'; //Categorie
                                                ?>  
                                                    <img class="card-img-top w-100 d-block" style="background-color:<?php echo $couleurM;?>"src="./assets/img/<?php echo $donnees['file'] ?>" style="height: 140.234px;">
                                                    <div class="card-body info"  style="height: 120.234px; background-color:<?php echo $couleurM;?>">
                                            <?php


                                            echo '<h4 class="card-title" style="height: 25px; color:white;">' . $donnees['nom'] . '</h4>'; //NOM

                                            echo '<div>
                                                        <a class="text_bouton_acheter" href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/view/boutique/achatItem.php?userID=' . $_SESSION['id'] . '&itemID=' . $donnees['itemID'] . '"> 
                                                                <button class="btn btn-primary " data-bss-hover-animate="pulse" style="width: 138px; height: 39px;border-width:2px;font-size: 14px;background-color:' . $couleurB .';border-color:' . $couleurH .'; ">'
                                                                        . $donnees['prix'] . ' ' . '<img "src="https://www.pngall.com/wp-content/uploads/4/Dollar-Gold-Coin-PNG.png" alt="Pièces""'.' 
                                                                </button>
                                                        </a>
                                                </div>';
                                            //ID + BOUTON

                                            echo '</div></div></div>'; //PRIX


                                    }
                                        $reponse->closeCursor();
                                        ?>
                                
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4" style="width: 228px;">
                <div class="card text-center clean-card"></div>
            </div>
        </section>
    </main>
   

       <?php /* <h1>Boutique</h1>
            <div><strong>Récents :</strong></div><br>
            <div class = "listeItem">
            <?php
                $reponse = $pdo->query('SELECT * FROM Objet ORDER BY itemID DESC');
                $i = 0;
                while ($donnees = $reponse->fetch() and $i<5) {
                    $i++;
                    ?>
                    <div class ="objet">
                    <?php
                    echo '<p class = "nomObjet">' . $donnees['nom'] . ' :</p>';
                    echo '<img class="image" src="https://i.imgur.com/FnSfVG1.png">';
                    echo '<a class = "lien colle " href="https://google.com/fr"><p class="button"> Acheter </p></a>';
                    echo '<p class = "prix">' . $donnees['prix'] . '</p>';
                    ?>
                </div>
                    <?php
            }
                $reponse->closeCursor();
                ?>
            </div> */ ?>