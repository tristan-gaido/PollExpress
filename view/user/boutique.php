
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
                                        $reponse = $pdo->query('SELECT * FROM Objet ORDER BY type ASC');
                                        $i = 0;

                                        while ($donnees = $reponse->fetch() and $i<50) {


                                            $i++;

                                            if($donnees['type'] == 'Chapeau') {
                                                $nomcat = 'Chapeau';
                                                $couleurH = '#c5a030';
                                                $couleurM = '#ddb74a';
                                                $couleurB = '#ffc550';
                                            }
                                            else if($donnees['type'] == 'tshirt') {
                                                $nomcat = 'T-shirt';
                                                $couleurH = '#3a80b0';
                                                $couleurM = '#30a0f0';
                                                $couleurB = '#70d0e5';
                                            }
                                            else if($donnees['type'] == 'vest') {
                                                $nomcat = 'Veste';
                                                $couleurH = '#3a904a';
                                                $couleurM = '#3aba40';
                                                $couleurB = '#80e070';
                                            }
                                            else if($donnees['type'] == 'vest') {
                                                $nomcat = 'Veste';
                                                $couleurH = '#3a904a';
                                                $couleurM = '#3aba40';
                                                $couleurB = '#80e070';
                                            }
                                            else if($donnees['type'] == 'pant') {
                                                $nomcat = 'Pantalon';
                                                $couleurH = '#002a80';
                                                $couleurM = '#2a4090';
                                                $couleurB = '#4070ea';
                                            }
                                            else if($donnees['type'] == 'shoes') {
                                                $nomcat = 'Chaussure';
                                                $couleurH = '#4a3525';
                                                $couleurM = '#6a503a';
                                                $couleurB = '#a07a55';
                                            }
                                            else if($donnees['type'] == 'tool') {
                                                $nomcat = 'Outil';
                                                $couleurH = '#750a0a';
                                                $couleurM = '#a01a1a';
                                                $couleurB = '#da3535';
                                            }
                                            else if($donnees['type'] == 'haircut') {
                                                $nomcat = 'Coupe de cheveux';
                                                $couleurH = '';
                                                $couleurM = '';
                                                $couleurB = '';
                                            }
                                            else if($donnees['type'] == 'hair_color') {
                                                $nomcat = 'Couleur de cheveux';
                                                $couleurH = '#ba9a00';
                                                $couleurM = '#d0ba50';
                                                $couleurB = '#faf065';
                                            }
                                            else if($donnees['type'] == 'pin') {
                                                $nomcat = 'Badge';
                                                $couleurH = '#304555';
                                                $couleurM = '#507080';
                                                $couleurB = '#8095b0';
                                            }
                                            else if($donnees['type'] == 'necklace') {
                                                $nomcat = 'Collier';
                                                $couleurH = '#306a60';
                                                $couleurM = '#4ab08a';
                                                $couleurB = '#5ad0a0';
                                            }
                                            else if($donnees['type'] == 'background') {
                                                $nomcat = 'Fond d\'ecran';
                                                $couleurH = '#500560';
                                                $couleurM = '#801595';
                                                $couleurB = '#a045ba';
                                            }
                                            else if($donnees['type'] == 'banner') {
                                                $nomcat = 'Bannière';
                                                $couleurH = '#888888';
                                                $couleurM = '#aaaaaa';
                                                $couleurB = '#dddddd';
                                            }
                                            else if($donnees['type'] == 'graphics') {
                                                $nomcat = 'Charte graphique';
                                                $couleurH = '#8a4080';
                                                $couleurM = '#a06aa0';
                                                $couleurB = '#f0a0e0';
                                            }
                                            else if($donnees['type'] == 'font') {
                                                $nomcat = 'Police';
                                                $couleurH = '#351065';
                                                $couleurM = '#5a209a';
                                                $couleurB = '#8a4ae5';
                                            }
                                            else if($donnees['type'] == 'title') {
                                                $nomcat = 'Titre';
                                                $couleurH = '#111111';
                                                $couleurM = '#333333';
                                                $couleurB = '#555555';
                                            }
                                            else if($donnees['type'] == 'skin') {
                                                $nomcat = 'Couleur de peau';
                                                $couleurH = '#7a350a';
                                                $couleurM = '#aa5035';
                                                $couleurB = '#d0553a';
                                            }
                                            else {
                                                $couleurH = '#e2e2e2';
                                                $couleurM = '#e2e2e2';
                                                $couleurB = '#e2e2e2';
                                            }








                                            ?>
                                            <div class="col-sm-6 col-lg-4" style="width: 228px; padding-top: 20px;">

                                                <div class="card text-center clean-card" style="border: solid; border-color:#ababab;">
                                                      <?php
                                                echo '<h4 class="card-title" style="height:25px; margin:0px;border-bottom:3px solid; color:white; padding-top:5px; padding-bottom:25px; background-color:' . $couleurH .'; border-bottom-color:#ababab;">' . $nomcat . '</h4>'; //Categorie
                                                ?>  
                                                    <img class="card-img-top w-100 d-block" style="border-radius: 0px; background-color:<?php echo $couleurM;?>"src="./assets/img/custom/<?php echo $donnees['type'] ?>/<?php echo $donnees['file'] ?>" style="height: 140.234px;">
                                                    <div class="card-body info"  style="height: 120.234px; background-color:<?php echo $couleurM;?>">
                                            <?php


                                            echo '<h4 class="card-title" style="height: 25px; color:white;">' . $donnees['nom'] . '</h4>'; //NOM

                                            echo '<div>
                                                        <a class="text_bouton_acheter" style="color:white;" href="./index.php?action=achatItem&userID=' . $_SESSION['id'] . '&itemID=' . $donnees['itemID'] . '"> 
                                                                <button class="btn btn-primary " data-bss-hover-animate="pulse" style="width: 138px; height: 39px;border-width:3px;font-size: 14px;background-color:' . $couleurB .';border-color:' . $couleurH .'; ">'
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
   
