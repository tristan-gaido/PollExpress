<?php

require_once File::build_path(array("controller","ControllerUser.php"));
require_once File::build_path(array("controller","ControllerBoutique.php"));
require_once File::build_path(array("controller","ControllerProfil.php"));

$methodes = get_class_methods(get_class(new ControllerUser()));

if(isset($_GET['controller'])){
	if($_GET['controller']=='user'){
		$methodes = get_class_methods(get_class(new ControllerUser()));
	}
	if($_GET['controller']=='profil'){
		$methodes = get_class_methods(get_class(new ControllerProfil()));
	}
	else{
		$methodes = get_class_methods(get_class(new ControllerBoutique()));
	}
}

if ((isset($_GET['controller']))){

	$controller = $_GET['controller'];
	$controller_class = 'Controller' . ucfirst($controller);
	}else{
		$controller_class = 'ControllerUser';
	}



if ((isset($_GET['action']))){

	$action = $_GET['action'];

	if (in_array($_GET['action'], $methodes)) {
		
		 $controller_class::$action(); 
	}		
	}else{
		$controller_class::accueil();
	}

?>
