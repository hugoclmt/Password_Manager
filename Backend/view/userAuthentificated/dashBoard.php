<?php
$password_all = $controller->getAllPassword();

if (isset($_POST['password']) && isset($_POST['nameSite']) && isset($_POST['url']) && isset($_POST['note'])) {
    $password = $_POST['password'];
    $nameSite = $_POST['nameSite'];
    $url = $_POST['url'];
    $note = $_POST['note'];

    $result = $controller->addPassword($password, $nameSite, $url, $note);
    $password_all = $controller->getAllPassword();
    echo $result;
}

?>

<div>
    <div>
        <button id="openModalBtn">Ouvrir la Modale</button>
        <!-- Fenêtre Modale -->
        <div id="myModal" class="modal">
            <!-- Contenu de la Modale -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Votre nouveau mot de passe</h2>
                <form method="post">
                    <input id="password" type="password" name="password" placeholder="Votre mot de passe">
                    <input type="text" name="nameSite" placeholder="Nom du site web">
                    <input type="text" name="url" placeholder="URL du site web">
                    <input type="text" name="note" placeholder="Notes à ajouter">

                    <button id="savePassword">Enregistrer</button>
                </form>
                <button id="generatePassword">Générer un mot de passe</button>
            </div>
        </div>
    </div>
    <div>
        <?php
        foreach ($password_all as $password) {
        ?>
        <div>
            <fieldset>
                <input type="password" value="<?php echo htmlspecialchars($password->getPasswordEncrypted(), ENT_QUOTES, 'UTF-8'); ?>">
                <button>Modifier le mot de passe</button>
                <button>Supprimer le mot de passe</button>
            </fieldset>
        </div>
        <?php
        }
        ?>
    </div>

</div>
