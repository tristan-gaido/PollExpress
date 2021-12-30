                    <body>
                              <section class="clean-block clean-form dark" style="height: 830.188px;">
                                      <div class="container text-start" style="height: 459px;">
                                          <div class="block-heading" style="height: -5px;">
                                              <h2 class="text-info" style="text-align: center;"><strong>Mot de passe oublié :</strong></h2>
                                          </div>
                                          <p style="text-align: center;">Entrez l'email de votre compte pour réinitialiser votre mot de passe.<br></p>
                              <form method="post" action="./index.php?action=resetmdp">
                                   <?php
                                            if (isset($er_email)){
                                  ?>
                                            <div><?= $er_email ?></div>
                                  <?php         
                                            }
                                  ?>
                                        <div class="mb-3">
                                        <label class="form-label" for="email"><b>Adresse email</b></label>
                            <input class="form-control item" type="email" placeholder="Adresse email" name="email" value="<?php if(isset($email)){ echo $email; }?>" required></div>
                            <div class="mb-3">
                            
                            <div class="mb-3" style="width: 435px;height: -65px;margin: 20px;padding: 0px;">
                                        <button class="btn btn-primary text-center" name="resetmdp" type="submit" style="background: rgb(12,36,97);border-radius: 13px;border-color: rgb(12,36,97);margin: 5px;height: 39px;padding: 7px 12px;transform: scale(1.13);font-size: 14px;font-weight: bold;width: 130.344px;">Envoyer</button></div>
                                          <small>Revenir sur la <a href="./index.php?action=register">page d'inscription</a></small>
                              </form>
                            </div>
                              
                          </div>
                          </section>
                    </body>