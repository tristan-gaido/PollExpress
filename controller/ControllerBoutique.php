<?php
require_once File::build_path(array("model","ModelBoutique.php")); // chargement du modèle

class ControllerBoutique {


    public static function readAll() {
            $liste_objet = ModelBoutique::getAllItems();
            $pagetitle = 'PollExpress - Boutique';
            $controller='boutique';
            $view='boutique';    
            require File::build_path(array("view","view.php")); //"redirige" vers la vue
    }

    public static function achatItem() {

        $userID = $_GET['userID'];
        $itemID = $_GET['itemID'];

        $sql = Model::getPDO()->prepare("SELECT argent FROM PE__User WHERE id = :userID");
        $sql->execute(array('userID' => $userID));
        $sql = $sql->fetch();

        $sql2 = Model::getPDO()->prepare("SELECT prix FROM PE__Objet WHERE itemID = :itemID");
        $sql2->execute(array('itemID' => $itemID));
        $sql2 = $sql2->fetch();

        $argentUser = $sql['argent'];
        $prixItem = $sql2['prix'];

        if($argentUser>=$prixItem){

            $newargent = $argentUser - $prixItem;
            
            $sql3 = Model::getPDO()->prepare("INSERT INTO PE__Inventaire VALUES (:userID , :itemID, 0)");
            $sql3->execute(array('userID' => $userID, 'itemID' => $itemID));

            $sql4 = Model::getPDO()->prepare("UPDATE PE__User SET argent = :newargent WHERE id = :userID");
            $sql4->execute(array('newargent' => $newargent, 'userID' => $userID));

            $_SESSION['argent'] = $newargent;

        }
        else {
            echo 'Pas assez d\'argent';
        }

        $controller='boutique';
        $view='achatItem';
        $pagetitle='PollExpress';
        require_once File::build_path(array("view","view.php")); //"redirige" vers la vue
        
    }

    public static function couleurObjet($type) {
        switch($type) {
            case "Chapeau":
            $nomcat = 'Chapeau';
            $couleurH = '#c5a030';
            $couleurM = '#ddb74a';
            $couleurB = '#ffc550';
            break;

        case 'tshirt' :
            $nomcat = 'T-shirt';
            $couleurH = '#3a80b0';
            $couleurM = '#30a0f0';
            $couleurB = '#70d0e5';
            break;

        case 'vest' :
            $nomcat = 'Veste';
            $couleurH = '#3a904a';
            $couleurM = '#3aba40';
            $couleurB = '#80e070';
            break;

        case 'vest' :
            $nomcat = 'Veste';
            $couleurH = '#3a904a';
            $couleurM = '#3aba40';
            $couleurB = '#80e070';
            break;
        
        case 'pant' :
            $nomcat = 'Pantalon';
            $couleurH = '#002a80';
            $couleurM = '#2a4090';
            $couleurB = '#4070ea';
            break;
        
        case 'shoes':
            $nomcat = 'Chaussure';
            $couleurH = '#4a3525';
            $couleurM = '#6a503a';
            $couleurB = '#a07a55';
            break;
        
        case 'tool':
            $nomcat = 'Outil';
            $couleurH = '#750a0a';
            $couleurM = '#a01a1a';
            $couleurB = '#da3535';
            break;
        
        case 'haircut':
            $nomcat = 'Coupe de cheveux';
            $couleurH = '';
            $couleurM = '';
            $couleurB = '';
            break;
        
        case 'hair_color':
            $nomcat = 'Couleur de cheveux';
            $couleurH = '#ba9a00';
            $couleurM = '#d0ba50';
            $couleurB = '#faf065';
            break;
        
        case 'pin':
            $nomcat = 'Badge';
            $couleurH = '#304555';
            $couleurM = '#507080';
            $couleurB = '#8095b0';
            break;
        
        case 'necklace':
            $nomcat = 'Collier';
            $couleurH = '#306a60';
            $couleurM = '#4ab08a';
            $couleurB = '#5ad0a0';
            break;
        
        case 'background':
            $nomcat = 'Fond d\'ecran';
            $couleurH = '#500560';
            $couleurM = '#801595';
            $couleurB = '#a045ba';
            break;
        
        case 'banner':
            $nomcat = 'Bannière';
            $couleurH = '#888888';
            $couleurM = '#aaaaaa';
            $couleurB = '#dddddd';
            break;
        
        case 'graphics':
            $nomcat = 'Charte graphique';
            $couleurH = '#8a4080';
            $couleurM = '#a06aa0';
            $couleurB = '#f0a0e0';
            break;
        
        case 'font':
            $nomcat = 'Police';
            $couleurH = '#351065';
            $couleurM = '#5a209a';
            $couleurB = '#8a4ae5';
            break;
        
        case 'title':
            $nomcat = 'Titre';
            $couleurH = '#111111';
            $couleurM = '#333333';
            $couleurB = '#555555';
            break;
        
        case 'skin':
            $nomcat = 'Couleur de peau';
            $couleurH = '#7a350a';
            $couleurM = '#aa5035';
            $couleurB = '#d0553a';
            break;
        default :
            $couleurH = '#e2e2e2';
            $couleurM = '#e2e2e2';
            $couleurB = '#e2e2e2';    
        }
    }
}   
?>
