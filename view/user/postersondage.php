<?php
  session_name('pollexpress');
  session_start();
require_once '/home/ann2/gaidot/public_html/PollExpress/config/BDD.php';

  if (!isset($_SESSION['id'])){ //si pas de ssession, on redirige vers la page de login
    header('Location: ./login.php');
    exit;
  }

  
  if(!empty($_POST)){ // Si la variable "$_Post" contient des informations alors on les traites
    extract($_POST); //extrait les valeurs du form en 2 variables $nomsondage $lien
    
    $ok = true;


  if (isset($_POST['postersondage'])){ //test pour le formulaire "inscription"

    //htmlentites = pour éviter les injections, trim = enleve les espaces au début et a la fin
    $nomsondage = htmlentities(trim($nomsondage));
        $lien = trim($lien);
        $tag1 = htmlentities(trim($tag1));
        $tag2 = htmlentities(trim($tag2));


        if(empty($nomsondage)){ //test si email est vide
      $ok = false;
      $er_nomsondage = "Remplissez un titre pour le sondage";
    }

    if(empty($lien)){ //test si le mdp est vide
      $ok = false;
      $er_mdp = "Remplissez un lien pour le sondage";
    }

    $stmt = $pdo->prepare("SELECT * FROM Sondage WHERE lien=?");
    $stmt->execute([$lien]); 
    $req_lien = $stmt->fetch();
    if ($req_lien) {
      $ok = false;
      $er_lien = "Ce sondage existe déjà";
        }

        
        $lien = trim($lien);
        $name = $_FILES['image']['name'];
    $pic_path = ROOT . "upload/$name";
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $pic_path)) {
        echo "La copie a échoué";
    }



    if ($ok){ //si tout est valide, alors on enregistre le sondage dans la BDD

      $datecreation = date('Y-m-d H:i:s');

      $req = $pdo->prepare("INSERT INTO Sondage SET titre = :titre, lien = :lien, tag1 = :tag1, tag2 = :tag2, image = '0x89504E470D0A1A0A0000000D494844520000001000000010080200000090916836000000017352474200AECE1CE90000000467414D410000B18F0BFC6105000000097048597300000EC300000EC301C76FA8640000001E49444154384F6350DAE843126220493550F1A80662426C349406472801006AC91F1040F796BD0000000049454E44AE426082', date_creation_sondage = :datecreation");
      $req->execute(array('titre' => $nomsondage, 'lien' => $lien, 'datecreation' => $datecreation, 'tag1' => $tag1, 'tag2' => $tag2));
          
   
          header('Location: ../index.php'); //redirection vers la page index.php
          exit;
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Poster un sondage</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="../assets/css/vanilla-zoom.min.css">
</head>

<body>
    <section class="clean-block clean-form dark" style="height: 830.188px;">
        <div class="container text-start" style="height: 459px;">
            <div class="block-heading" style="height: -5px;">
                <h2 class="text-info" style="text-align: center;"><strong>Poster un sondage</strong></h2>
            </div>
            <p style="text-align: center;">Remplissez le formulaire pour poster un sondage sur PollExpress<br></p>
            <form method="post" action="postersondage.php">
              <?php
      if (isset($er_nomsondage)){ 
      ?>
         <div><?= $er_nomsondage ?></div>
      <?php
        }
      ?>
                <div class="mb-3"><label class="form-label" for="email"><strong>Nom du sondage</strong><br></label>
                  <input class="form-control item" type="text" id="email" name="nomsondage" minlength="5" placeholder="Nom du sondage" name="email" value="<?php if(isset($nomsondage)){ echo $nomsondage; }?>" required></div>
                  <?php
            if (isset($er_lien)){ 
            ?>
              <div><?= $er_lien ?></div>
            <?php
              }
            ?>
                <div class="mb-3"><label class="form-label" for="lien"><strong>Lien du sondage</strong><br></label>
                  <input class="form-control" type="url" id="password" name="lien" placeholder="Lien du sondage" value="<?php if(isset($lien)){ echo $lien; }?>" required></div>


        <br>

                <select name="tag1" >
                    <option value="">Choisir un tag</option>
                    <option value="Informatique">Informatique</option>
                    <option value="Science">Science</option>
                    <option value="Jeux-video">Jeux-video</option>
                    <option value="Gestion">Gestion</option>
                </select>
            <select name="tag2">
                <option value="">Choisir un tag</option>
                <option value="Informatique">Informatique</option>
                <option value="Science">Science</option>
                <option value="Jeux-video">Jeux-video</option>
                <option value="Gestion">Gestion</option>
            </select>
            <br>
            <br>
        <label for="image"><b>Image</b></label>
          <br>
        <input type="file" placeholder="Lien du sondage" name="image">
        <br>
                <br>

            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div><button class="btn btn-primary text-center" name="postersondage" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
              <p><a href="./index.php">Retour a l'accueil</a></p>
            </div>
    </form>
  </body>
</html>
