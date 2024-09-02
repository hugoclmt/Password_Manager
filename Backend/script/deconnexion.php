<?php

// Détruire toutes les variables de session
$_SESSION = array();

// Finalement, détruire la session.
session_destroy();

// Redirection vers l'index à partir du script de déconnexion
header("Location: ../../index.php?page=accueil");
exit();

