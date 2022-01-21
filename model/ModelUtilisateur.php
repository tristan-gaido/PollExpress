<?php

require_once File::build_path(array("model","Model.php")); // chargement du modèle

class ModelUtilisateur {

     public static function getAllSondages() {
        try {
        $rep = Model::getPDO()->query('SELECT * FROM PE__Sondage WHERE titre = "daz"');
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

    public static function checkTokenEmail($email) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__User WHERE email=:email");
        $sql->execute(array('email' => $email));
        $testtoken = $sql->fetch();
        return $testtoken; 

        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function checkPseudo($pseudo) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__User WHERE pseudo=:pseudo");
        $sql->execute(array('pseudo' => $pseudo));
        $testtoken = $sql->fetch();
        return $testtoken; 

        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function checkLogin($email, $mdp) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__User WHERE email = :email AND motdepasse = :mdp");
        $sql->execute(array('email' => $email, 'mdp' => $mdp));
        $resultat = $sql->fetch();
        return $resultat; 

        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function createUser($pseudo, $mdp, $email, $datecreation, $token) {
        try {

        $sql = Model::getPDO()->prepare("INSERT INTO PE__User SET pseudo = :pseudo, motdepasse = :motdepasse, email = :email, date_creation = :datecreation, argent = 100, isVerified = false, token = :token");
        $sql->execute(array('pseudo' => $pseudo, 'motdepasse' => $mdp, 'email' => $email, 'datecreation' => $datecreation, 'token' => $token));
        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectUserNewMDP($id, $token) {
        try {

        $sql = Model::getPDO()->prepare("SELECT id FROM PE__User WHERE id = :id AND token = :token");
        $sql->execute(array('id' => $id, 'token' => $token));
        $resultat = $sql->fetch();
        return $resultat; 

        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function updateMDP($mdp, $id) {
        try {

        $sql = Model::getPDO()->prepare("UPDATE PE__User SET motdepasse = :motdepasse WHERE id = :id");
        $sql->execute(array('motdepasse' => $mdp, 'id' => $id));
        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function updateTokeMail($id) {
        try {

        $sql = Model::getPDO()->prepare("UPDATE PE__User SET confirmation_token = :conftoken WHERE id = :id");
        $sql->execute(array('id' => $id, 'conftoken' => true));
        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectSondageFromID($id) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__Sondage WHERE id_sondage = :id_sondage");
        $sql->execute(array('id_sondage' => $id));
        $testtoken = $sql->fetch();
        return $testtoken; 

        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function updateNbClics($nbclics, $id_sondage) {
        try {
        $sql = Model::getPDO()->prepare("UPDATE PE__Sondage SET clics = :clics WHERE id_sondage = :id_sondage");
        $sql->execute(array('clics' => $nbclics+1, 'id_sondage' => $id_sondage));
        }
        catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectRecents() {
        try {
        $sql = Model::getPDO()->query("SELECT * FROM PE__Sondage ORDER BY date_creation_sondage DESC");
        return $sql; 
        }
         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectNbVues() {
        try {
        $sql = Model::getPDO()->query("SELECT * FROM PE__Sondage ORDER BY clics DESC");
        return $sql; 
        }
         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectSondageFromLien($lien) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__Sondage WHERE lien=:lien");
        $sql->execute(array('lien' => $lien));
        $testtoken = $sql->fetch();
        return $testtoken; 
        }
         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function createSondage($titre, $lien, $tag1, $tag2, $datecreation, $code, $bonus, $userID) {
        try {

        $sql = Model::getPDO()->prepare("INSERT INTO PE__Sondage SET titre = :titre, lien = :lien, tag1 = :tag1, tag2 = :tag2, date_creation_sondage = :datecreation, code = :code, bonus = :bonus, userID = :userID ");
        $sql->execute(array('titre' => $titre, 'lien' => $lien, 'tag1' => $tag1, 'tag2' => $tag2, 'datecreation' => $datecreation, 'code' => $code, 'bonus' => $bonus, 'userID' => $userID));
        }

         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectSondageWithCode($idsondage, $code) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__Sondage WHERE id_sondage=:id_sondage AND code = :code");
        $sql->execute(array('id_sondage' => $idsondage, 'code' => $code));
        $testtoken = $sql->fetch();
        return $testtoken; 
        }
         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectSondageFaits($idsondage, $idUser) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__SondageFait WHERE userID=:idUser AND sondageID = :idsondage");
        $sql->execute(array('idUser' => $idUser, 'idsondage' => $idsondage));
        $testtoken = $sql->fetch();
        return $testtoken; 
        }
         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function updateXp($idUser, $idSondage, $bonus) {
        try {
        $sql = Model::getPDO()->prepare("UPDATE PE__User SET xp = xp + :bonus, argent = argent+100 WHERE id = :id");
        $sql->execute(array('id' => $idUser, 'bonus' => $bonus));
        $sql2 = Model::getPDO()->prepare("INSERT INTO PE__SondageFait (userID, sondageID) VALUES (:idUser , :idSondage)");
        $sql2->execute(array('idUser' => $idUser, 'idSondage' => $idSondage));
        }
        catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); 
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function addSignalement($idSondage, $idUser) {
        try {        
        $sql2 = Model::getPDO()->prepare("INSERT INTO PE__Signalements (idSondage, idUser) VALUES (:idSondage, :idUser)");
        $sql2->execute(array('idSondage' => $idSondage, 'idUser' => $idUser));
        }
        catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); 
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectSignalement($idsondage, $idUser) {
        try {

        $sql = Model::getPDO()->prepare("SELECT * FROM PE__Signalements WHERE idUser=:idUser AND idSondage = :idSondage");
        $sql->execute(array('idUser' => $idUser, 'idSondage' => $idsondage));
        $testtoken = $sql->fetch();
        return $testtoken; 
        }
         catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}
