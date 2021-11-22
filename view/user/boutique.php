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
                    <h2 class="text-info">Boutique</h2><br>
                    <div class="row justify-content-center">
                                            <?php
                                        $reponse = $pdo->query('SELECT * FROM Objet ORDER BY itemID DESC');
                                        $i = 0;
                                        while ($donnees = $reponse->fetch() and $i<50) {
                                            $i++;
                                            ?>
                                            <div class="col-sm-6 col-lg-4" style="width: 228px;">
                                                <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/<?php echo $donnees['file'] ?>" style="height: 140.234px;">
                                                    <div class="card-body info" style="height: 160.234px;">
                                            <?php
                                            echo '<h4 class="card-title" style="height: 25px;">' . $donnees['nom'] . '</h4>';

                                            echo '<div class="icons"><a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/view/boutique/achatItem.php?userID=' . $_SESSION['id'] . '&itemID=' . $donnees['itemID'] . '"><button class="btn btn-primary" data-bss-hover-animate="pulse" type="button" style="width: 138px;height: 39px;font-size: 14px;background: #2e86de;">Acheter</button></a></div>';

                                            echo '<p style="margin: 19px;">Prix : ' . $donnees['prix'] . '</p></div></div></div>';

                                    }
                                        $reponse->closeCursor();
                                        ?>
                                
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
	