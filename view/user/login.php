
<body>
    <section class="clean-block clean-form dark" style="height: 830.188px;">
        <div class="container text-start" style="height: 459px;">
            <div class="block-heading" style="height: -5px;">
                <h2 class="text-info" style="text-align: center; margin-top: 80px;"><strong>Se connecter</strong></h2>
            </div>
            <p style="text-align: center;">Connectez vous à votre compte PollExpress<br></p>
            <form method="post" action="./index.php?action=login">
              <?php
              if (isset($er_email)){ 
              ?>
                 <div><?= $er_email ?></div>
              <?php
                }
              ?>
                <div class="mb-3"><label class="form-label" for="email"><strong>Adresse Email</strong><br></label>
                  <input class="form-control item" type="email" id="email" placeholder="Adresse email" name="email" value="<?php if(isset($email)){ echo $email; }?>" required></div>
                  <?php
                  if (isset($er_mdp)){ 
                  ?>
                    <div><?= $er_mdp ?></div>
                  <?php
                    }
                  ?>
                <div class="mb-3"><label class="form-label" for="password"><strong>Mot de passe</strong> <a href="./index.php?action=resetmdp" style="color:#3B99E0;">Mot de passe oublié</a><br></label>
                  <input class="form-control" type="password" id="password" name="mdp"></div>
                <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;"></div>
                <button id="btnLogin" class="btn btn-primary text-center" name="connexion" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Se connecter</button>
                <div></div><small>Vous n'êtes pas encore inscrit ? <a href="./index.php?action=register" style="color:#3B99E0;">S'inscrire</a></small>
            </form>
        </div>
    </section>

</body>
<style type="text/css">
  #btnLogin {
    transition-duration: 0.25s !important;
  }

  #btnLogin:hover {
    background-color: #3B99E0 !important;
    border-color: white !important; /* Green */
    color: white !important;
  }
  
</style>