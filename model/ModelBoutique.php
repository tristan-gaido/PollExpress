<?php

require_once File::build_path(array("model","Model.php")); // chargement du modèle

class ModelBoutique {

     public static function getAllItems() {
        try {
        $rep = Model::getPDO()->query('SELECT * FROM PE__Objets');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBoutique');
        return $rep->fetchAll();
            return $rep->fetchAll();
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