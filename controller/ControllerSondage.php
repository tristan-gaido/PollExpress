<?php
require_once File::build_path(array("model","ModelUtilisateur.php")); // chargement du modèle

class ControllerSondage {

    public static function testimg() {
        $controller='sondage';
        $view='testimg';
        $pagetitle='PollExpress - testimg';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
    }





}
?>
