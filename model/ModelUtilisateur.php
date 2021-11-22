<?php

require_once File::build_path(array("model","Model.php")); // chargement du modèle

class ModelUtilisateur {

     public static function getAllSondages() {
        try {
        $rep = Model::getPDO()->query('SELECT * FROM Sondage WHERE titre = "daz"');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
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