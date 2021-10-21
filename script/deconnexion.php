<?php
session_name('pollexpress');
session_start();
session_destroy();

header('Location: ../index.php');
exit;


?>