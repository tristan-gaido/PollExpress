<?php
session_name('pollexpress');
session_start();
session_destroy();

header('Location: https://webinfo.iutmontp.univ-montp2.fr/~gaidot/ExpressPoll/index.php');
exit;


?>