          <body>
                    <section class="clean-block clean-form dark" style="height: 830.188px;">
                            <div class="container text-start" style="height: 459px;">
                                <div class="block-heading" style="height: -5px;">
                                    <h2 class="text-info" style="text-align: center;  margin-top: 80px;"><strong>Choississez un nouveau mot de passe :</strong></h2>
                                </div>
                    <form method="post">
                              <?php
                                        if (isset($er_mdp)){
                              ?>
                                        <div><?= $er_mdp ?></div>
                              <?php         
                                        }
                              ?>
                              <div class="mb-3">
                              <label class="form-label" for="password"><b>Nouveau mot de passe</b></label>
						      <input class="form-control item" type="password" placeholder="Mot de passe" name="mdp" id="mdp" minlength="6" required></div>
						      <div class="mb-3">
						      <label class="form-label" for="password"><b>Confirmer le mot de passe</b></label></div>
						      <input class="form-control item" type="password" placeholder="Confirmer le mot de passe" name="confmdp" id="confmdp" required>
						      <hr>
						      <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;">
                              <button class="btn btn-primary text-center" name="newmdp" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button>
                    </form>
                </div>
                </section>
          </body>





