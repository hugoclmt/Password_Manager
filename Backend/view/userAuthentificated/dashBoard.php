<?php
$password_all = $controllerPassword->getAllPassword();
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $nameSite = $_POST['nameSite'];
    $url = $_POST['url'];
    $note = $_POST['note'];
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
                    <input id="password" type="password" value="password" placeholder="Votre mot de passe">
                    <input type="text" value="nameSite" placeholder="Nom du site web">
                    <input type="text" value="url" placeholder="URL du site web">
                    <input type="text" value="note" placeholder="Notes à ajouter">
                    <button id="generatePassword">Générer un mot de passe</button>
                    <button id="savePassword">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <?php
        foreach ($password_all as $password) {
        ?>
        <div>
            <fieldset>
                <p>Premier mdp</p>
                <button>Modifier le mot de passe</button>
                <button>Supprimer le mot de passe</button>
            </fieldset>
        </div>
        <?php
        }
        ?>
    </div>

</div>
