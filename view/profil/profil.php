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

$req2 = $pdo->prepare("SELECT COUNT(*) as Stats FROM PE__SondageFait WHERE userID = :userID"); 
$req2->execute(array('userID' => $_SESSION['id']));
$resultat2 = $req2->fetch();
$req2->closeCursor();


?>

    <main class="page landing-page">
        <section class="clean-block clean-info dark" style="background: #dcdde1; padding-top: 80px;">
            <div class="container">
                <div class="block-heading">
                    <div class="tab">
                      <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'Equipement')">Équipement</button>  
                    <button class="tablinks"  onclick="openCity(event, 'Profil')">Profil</button>
                    
                    </div>
                    <div id="Profil" class="tabcontent">

                      <h2 class="text-info" style="color: #0c2461; margin-top: 20px;">Profil</h2>
                  
                  <div class="row align-items-center">
                      <div class="col-md-6" style="width: 1000px; text-align: left; margin-left: 50px
                      ;">
                          <h3 >Pseudo : <?php echo $_SESSION['pseudo'];?></h3> 
                          <div class="getting-started-info"></div>
                          <h3>Argent : <?php echo $_SESSION['argent'];?></h3>
                          <h3>Email : <?php echo $_SESSION['email'];?> </h3>
                          <h3>Date de création du compte : <?php echo $_SESSION['date']; ?> </h3>
                          <h3>Nombre de sondages répondus : <?php echo $resultat2['Stats']; ?></h3>

                          <br><br><br></div></div>
</div></div>
                        <div id="Equipement" class="tabcontent">
                        <h2 class="text-info" style="color: #0c2461; margin-top: 20px; text-align: center;">Équipement</h2> 
                        <div class="row justify-content-center">
                        <?php 

                        $reponse = $pdo->query('SELECT * FROM PE__Objet JOIN PE__Inventaire ON PE__Objet.itemID = PE__Inventaire.itemID WHERE userID =' . $_SESSION['id'] . ' AND isEquiped = 1 ORDER BY prix ASC');
                        while ($donnees = $reponse->fetch()) {
 
                                            ?>
                                            <div class="col-sm-6 col-lg-4" style="width: 228px; padding-top: 20px;">
                                                <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/<?php echo $donnees['file'] ?>" style="height: 140.234px; padding: 10px">
                                                    <div class="card-body info" style="height: 160.234px;">
                                            
                                            <h4 class="card-title" style="height: 25px;"><?php echo $donnees['nom']; ?></h4>

                                            <div class="icons"><a href="./index.php?controller=profil&action=unequip&itemID=<?php echo $donnees['itemID'] . '&userID=' . $_SESSION['id'] ?>"><button class="btn btn-primary" data-bss-hover-animate="pulse" type="button" style="width: 138px;height: 39px;font-size: 14px;background: #2e86de;">Désequiper</button></a></div></div></div></div>
                                            <?php

                                    }
                                        $reponse->closeCursor();
                                        ?>
                                        </div>
                        <br><br><br>

                    </div>
                </div>
            </div></div>
            <main class="page pricing-table-page">
        <section class="clean-block clean-pricing dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Inventaire</h2><br>
                    <div class="row justify-content-center">
                                            <?php

                                        $reponse = $pdo->query('SELECT * FROM PE__Objet JOIN PE__Inventaire ON PE__Objet.itemID = PE__Inventaire.itemID WHERE PE__Inventaire.isEquiped = 0 AND userID =' . $_SESSION['id'] . ' ORDER BY prix ASC');

                                        $i = 0;
                                        while ($donnees = $reponse->fetch() and $i<50) {
                                            $i++;
                                            ?>
                                            <div class="col-sm-6 col-lg-4" style="width: 228px; padding-top: 20px;">
                                                <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="./assets/img/<?php echo $donnees['file'] ?>" style="height: 140.234px; padding: 10px">
                                                    <div class="card-body info" style="height: 160.234px;">
                                            
                                            <h4 class="card-title" style="height: 25px;"><?php echo $donnees['nom']; ?></h4>

                                            <div class="icons"><a href="./index.php?controller=profil&action=equip&itemID=<?php echo $donnees['itemID'] . '&userID=' . $_SESSION['id'] ?>"><button class="btn btn-primary" data-bss-hover-animate="pulse" type="button" style="width: 138px;height: 39px;font-size: 14px;background: #2e86de;">Équiper</button></a></div></div></div></div>
                                            <?php

                                    }
                                        $reponse->closeCursor();
                                        ?>
                                
                    </div>
                </div></div></div></div></div></section></main></div></section></main>


<style type="text/css">
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    .tab button {
      background-color: inherit;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
    }

    .tab button:hover {
      background-color: #ddd;
    }

    .tab button.active {
      background-color: #ccc;
    }

    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
</style>
<script type="text/javascript">
    document.getElementById("defaultOpen").click();

    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;

      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>


