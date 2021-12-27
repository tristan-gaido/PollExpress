<?php
require_once File::build_path(array("model","ModelBoutique.php")); // chargement du modèle

class ControllerBoutique {

    public static function equip() {
        $controller='boutique';
        $view='equip';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
    }

    public static function unequip() {
        $liste_sondage = ModelUtilisateur::getAllSondages();
        $controller='boutique';
        $view='unequip';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
        
        
    }

        public static function achatItem() {
        $liste_sondage = ModelUtilisateur::getAllSondages();
        $controller='boutique';
        $view='achatItem';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
        
        
    }

}
?>
