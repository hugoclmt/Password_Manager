<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>PasswordManager</title>
</head>

<body>
    <header>
        <?php
            if (file_exists('./Frontend/src/header/header.php')) {
                include('./Frontend/src/header/header.php');
            }
            else{
                include('./backend/view/notFound/404NotFound.php');
            }
        ?>
    </header>
    <main>
        <?php
        if (!isset($_SESSION['page'])){
            $_SESSION['page'] = 'accueil';
        }

        if (isset($_GET['page'])){
            $_SESSION['page'] = $_GET['page'];
        }

        $path = './backend/view/userRandom/'.$_SESSION['page'];

        if (file_exists($path.'.php')) {
            include($path.'.php');
        }
        else{
            include('./backend/view/notFound/404NotFound.php');
        }
        ?>
    </main>
    <footer>
        <?php
            if (file_exists('./Frontend/src/footer/footer.php')) {
                include('./Frontend/src/footer/footer.php');
            }
            else{
                include('./backend/view/notFound/404NotFound.php');
            }
        ?>
    </footer>
</body>
</html>