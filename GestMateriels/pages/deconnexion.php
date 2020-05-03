<?php
session_start();
$_SESSION['Auth'] = Array();
session_destroy();
header('location: ./pages/connexion.php');
    
?>