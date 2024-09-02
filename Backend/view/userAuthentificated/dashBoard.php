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

if (isset($_POST['action']))
{
    if ($_POST['action'] === 'Modifier')
    {
        $idPassword = $_POST['idPassword'];
        $siteName = $_POST['siteNameTest'];
        $password = $_POST['passwordTest'];
        $siteURL = $_POST['siteURLTest'];
        $notes = $_POST['notesTest'];
        echo $controller->updatePassword($idPassword,$password, $siteName, $siteURL, $notes);
        $password_all = $controller->getAllPassword();
    }
    else if ($_POST['action'] === 'Supprimer')
    {
        $result = $controller->deletePassword($_POST['idPassword']);
        $password_all = $controller->getAllPassword();
    }
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
            <form method="post">
                <input type="hidden" name="idPassword" value="<?php echo $password->getId()?>">
                <input type="text" name="siteNameTest" value="<?php echo $password->getSiteName(); ?>">
                <input type="password" name="passwordTest" value="<?php echo $password->getPasswordEncrypted();?>">
                <input type="text" name="siteURLTest" value="<?php echo $password->getSiteURL(); ?>">
                <input type="text" name="notesTest" value="<?php echo $password->getNotes(); ?>">
                <button type="submit" name="action" value="Modifier">Modifier</button>
                <button type="submit" name="action" value="Supprimer">Supprimer</button>
            </form>
        </div>
        <?php
        }
        ?>
    </div>

</div>
