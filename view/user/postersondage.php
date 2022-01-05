<body>
    <section class="clean-block clean-form dark" style="height: 830.188px; margin-bottom: 100px;">
        <div class="container text-start" style="height: 459px;">
            <div class="block-heading" style="height: -5px;">
                <h2 class="text-info" style="text-align: center; margin-top: 80px;"><strong>Poster un sondage</strong></h2>
            </div>
            <p style="text-align: center;">Remplissez le formulaire pour poster un sondage sur PollExpress<br></p>
            <form method="post" action="./index.php?action=postersondage">
              <?php
      if (isset($er_nomsondage)){ 
      ?>
         <div><?= $er_nomsondage ?></div>
      <?php
        }
      ?>
                <div class="mb-3">
                  <label class="form-label" for="email"><strong>Nom du sondage</strong><br></label>
                  <input class="form-control item" type="text" id="email" name="nomsondage" minlength="5" maxlength="60" placeholder="Nom du sondage" name="email" value="<?php if(isset($nomsondage)){ echo $nomsondage; }?>" required></div>

                  <?php
            if (isset($er_lien)){ 
            ?>
              <div><?= $er_lien ?></div>
            <?php
              }
            ?>
                <div class="mb-3">
                  <label class="form-label" for="lien"><strong>Lien du sondage</strong><br></label>
                  <input class="form-control" type="url" id="password" name="lien" placeholder="Lien du sondage" value="<?php if(isset($lien)){ echo $lien; }?>" required></div>

                <div class="mb-3">
                  <label class="form-label" for="code"><strong>Code du sondage</strong><br></label>
                  <input class="form-control" type="text" id="code" name="code" placeholder="Code du sondage" minlength="3" maxlength="20" value="<?php if(isset($code)){ echo $code; }?>" required></div>

                
                  <label class="form-label" for="duree"><strong>Durée approximative du sondage</strong><br></label><br>
                  <input style="margin-bottom: 25px;" type="range" value="5" min="5" max="60" step="5" oninput="this.nextElementSibling.value = this.value + ' minutes'" id="duree" name="duree" placeholder="Durée du sondage" value="<?php if(isset($duree)){ echo $duree; }?>" required>
					<output>5 minute</output>
              
        <br>

                <select name="tag1" >
                    <option value="">Choisir un tag</option>
                    <option value="Informatique">Informatique</option>
                    <option value="Science">Science</option>
                    <option value="Jeux-video">Jeux-video</option>
                    <option value="Gestion">Gestion</option>
                    <option value="Mesure Physique">Mesure Physique</option>
                    <option value="GEII">GEII</option>
                    <option value="GEA">GEA</option>
                    <option value="TC">TC</option>
                    <option value="Médecine">Médecine</option>
                </select>
            <select name="tag2">
                <option value="">Choisir un tag</option>
                <option value="Informatique">Informatique</option>
                <option value="Science">Science</option>
                <option value="Jeux-video">Jeux-video</option>
                <option value="Gestion">Gestion</option>
                <option value="Mesure Physique">Mesure Physique</option>
                <option value="GEII">GEII</option>
                <option value="GEA">GEA</option>
                <option value="TC">TC</option>
                <option value="Médecine">Médecine</option>
            </select>
            <br>

            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div>
            <button id="btnSondage" class="btn btn-primary text-center" name="postersondage" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
              <p><a href="./index.php">Retour a l'accueil</a></p>
            </div>
    </form></section>
  </body>


  <style type="text/css">
    #btnSondage {
      transition-duration: 0.25s !important;
    }

    #btnSondage:hover {
      background-color: #3B99E0 !important;
      border-color: white !important; /* Green */
      color: white !important;
    }
    
  </style>
