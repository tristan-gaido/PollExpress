<?php
if(!isset($_SESSION)){
session_name('pollexpress');
session_start();
}
?>
<body>
    <section class="clean-block clean-form dark" style="height: 830.188px;">
        <div class="container text-start" style="height: 459px;">
            <div class="block-heading" style="height: -5px;">
                <h2 class="text-info" style="text-align: center;"><strong>S'inscrire</strong></h2>
            </div>
            <p style="text-align: center;">Remplissez ce formulaire pour créer votre compte PollExpress :<br></p>
            <form method="post" action="./index.php?action=register">
                <?php
                if (isset($er_pseudo)){
                ?>
                  <div><?= $er_pseudo ?></div>
                <?php 
                }
              ?>
                <div class="mb-3"><label class="form-label" for="pseudo"><strong>Pseudo</strong><br></label>
                  <input class="form-control item" type="text" id="pseudo" minlength="3" maxlength="20" type="text" placeholder="Votre pseudo" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>" id="pseudo">

                  <?php
                    if (isset($er_email)){
                    ?>
                      <div><?= $er_email ?></div>
                    <?php 
                    }
                  ?>
                  <label class="form-label" for="email"><strong>Adresse Email</strong><br></label>
                  <input class="form-control item" type="email" placeholder="Adresse email" name="email" value="<?php if(isset($email)){ echo $email; }?>" id="email"></div>
                              <?php
                              if (isset($er_mdp)){
                              ?>
                                <div><?= $er_mdp ?></div>
                              <?php 
                              }
                            ?>
                <div class="mb-3"><label class="form-label" for="password"><strong>Mot de passe</strong><br></label>

                  <input class="form-control" type="password" placeholder="Mot de passe" name="mdp" id="mdp" minlength="6" maxlength="50" required>

                  <label class="form-label" for="password"><strong>Confirmer le mot de passe</strong><br></label>

                  <input class="form-control" type="password" placeholder="Confirmer le mot de passe" name="confmdp" id="confmdp" required></div>

                <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div>
                <button id="btnRegister" class="btn btn-primary text-center" type="submit" name="inscription" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">S'inscrire</button>
                <div></div><small>Vous avez déjà un compte ?&nbsp;<a href="index.php?action=login">Se connecter</a></small>
            </form>
        </div>
    </section>
    <style type="text/css">
      #btnRegister {
        transition-duration: 0.3s !important;
      }

      #btnRegister:hover {
        background-color: #3B99E0 !important;
        border-color: white !important; /* Green */
        color: white !important;
      }
      
    </style>

</body>
