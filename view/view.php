<?php
    session_name('pollexpress');
    session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $pagetitle ?></title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="./assets/css/vanilla-zoom.min.css">
    <link rel="stylesheet" href="./assets/css/accueil.css">
    <link rel="stylesheet" href="./assets/css/boutique.css" >
</head>

<body>
    <script src="./assets/js/accueil.js"></script>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container">
            <div class="collapse navbar-collapse" id="navcol-1"><img src="./assets/img/logo.png" style="width: 385px;margin: -13px;padding: 7px;">
                <ul class="navbar-nav ms-auto">
                                <?php
                        if(isset($_SESSION['id'])){
                            ?>
                                <li class="nav-item"><a class="nav-link active" href="./index.php">Accueil</a></li>
                                <li class="nav-item"><a class="nav-link" href="./index.php?action=sondages">Sondages</a></li>
                                <li class="nav-item"><a class="nav-link" href="./index.php?action=boutique">Boutique</a></li>
                                <li class="nav-item"><a class="nav-link" href="./index.php?action=profil">Profil</a></li>
                                <li class="nav-item"><a class="nav-link active" href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/view/user/deconnexion.php">Déconnexion</a></li>

                            <?php
                        }else{
                            ?>
                            <a href="./form/inscription.php">Debug Register</a>
                            <a href="https://webinfo.iutmontp.univ-montp2.fr/~gaidot/PollExpress/index.php?action=login">Debug login</a>

                            <?php
                        }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
        <div class="content">
                <?php
                $filepath = File::build_path(array("view", $controller, "$view.php"));
                require $filepath;
                ?>
            
        </div>    
            <footer class="page-footer dark">
        <div class="footer-copyright">
            <p>© 2021 PollExpress</p>
        </div>
    </footer>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="./assets/js/vanilla-zoom.js"></script>
    <script src="./assets/js/theme.js"></script>
</body>

</html>
