<?php
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if ($password == $passwordConfirm) {
        $result = $controllerUser->inscription($email, $password);
        if ($result) {
            echo 'Vous êtes connecté';
        } else {
            echo 'Erreur de connexion';
        }

    }else{
        echo 'Les mots de passe ne correspondent pas';
    }
}
else{
    echo 'Veuillez remplir les champs';
}
?>

<div>
    <form method="post">
        <input type="email" name="email" placeholder="votre email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="passwordConfirm" placeholder="Confirm Password">
        <button type="submit">Sign In</button>
    </form>
</div>