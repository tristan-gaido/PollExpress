<?php

require_once File::build_path(array("model","ModelProfil.php")); // chargement du modèle


class ControllerProfil {

    public static function readAll() {
        $liste_Equipement = ModelProfil::getEquipped($_SESSION['id']);
        $controller='profil';
        $view='profil';
        $pagetitle='PollExpress - Profil';
        require_once File::build_path(array("view","view.php")); ;  //"redirige" vers la vue
    }

    public static function equip() {

        $userID = $_GET['userID'];
        $itemID = $_GET['itemID'];

        ModelProfil::equip($userID, $itemID);

        $controller='profil';
        $view='profil';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view","view.php")); //"redirige" vers la vue
    }

    public static function unequip() {

        $userID = $_GET['userID'];
        $itemID = $_GET['itemID'];
      
        $sql4 = Model::getPDO()->prepare("UPDATE PE__Inventaire SET isEquiped = 0 WHERE userID = :userID AND itemID = :itemID");
        $sql4->execute(array('userID' => $userID, 'itemID' => $itemID));

        $controller='profil';
        $view='profil';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view","view.php")); //"redirige" vers la vue
        
        
    }

}

?>