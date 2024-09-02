<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $result = $controllerAuth->connexion($email, $password,$ip);
    if (!$result) {
        echo "Erreur de connexion";
    }
}
else{
    echo "Veuillez remplir les champs";
}

?>

<div>
    <form method="post">
        <input type="email" name="email" placeholder="votre email">
        <div>
            <input type="password" name="password" placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>
</div>