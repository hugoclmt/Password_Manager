<?php
session_start();
require_once '../../Backend/controller/Controller.class.php';
if (!isset($_SESSION['connected']) || !$_SESSION['connected']){
    header('Location: ../../index.php');
    exit();
}
else{
    $_SESSION['page'] = 'dashBoard';
    $controller = new Controller();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>MyPasswordManager</title>
    <link rel="stylesheet" href="">

</head>
<body>
    <header>
        <?php
        if (file_exists('../src/header/headerConnected.php')) {
            include('../src/header/headerConnected.php');
        }
        else{
            include('../../Backend/view/notFound/404NotFound.php');
        }
        ?>
    </header>
    <main>
        <?php
        if (!isset($_SESSION['page'])){
            $_SESSION['page'] = 'dashBoard';
        }

        if (isset($_GET['page'])){
            $_SESSION['page'] = $_GET['page'];
        }

        $path = '../../Backend/view/userAuthentificated/'.$_SESSION['page'];

        if (file_exists($path.'.php')) {
            include($path.'.php');
        }
        else{
            include('../../Backend/view/notFound/404NotFound.php');
        }
        ?>
    </main>
    <script src="../lib/js/generateurMotDePasse.js"></script>

</body>
</html>