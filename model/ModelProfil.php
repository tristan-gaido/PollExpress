<?php
    
    session_name('pollexpress');
    if (!isset($_SESSION['id'])){ 
        session_start();
    }
    

require_once File::build_path(array("model","Model.php")); // chargement du modèle

class ModelProfil {

     public static function getEquipped($idUser) {
        try {
        $rep = Model::getPDO()->query('SELECT * FROM PE__Objet JOIN PE__Inventaire ON PE__Objet.itemID = PE__Inventaire.itemID WHERE userID =' . $idUser . ' AND isEquiped = 1 ORDER BY prix ASC');
        $sql = $rep->fetch();
        return $sql;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function equip($userID, $itemID) {
        try {

        $rep = Model::getPDO()->prepare("UPDATE PE__Inventaire SET isEquiped = 1 WHERE userID = :userID AND itemID = :itemID");
        $rep->execute(array('userID' => $userID, 'itemID' => $itemID));
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }




}