<?php
$password_all = $controller->getAllPassword();

if (isset($_POST['password']) && isset($_POST['nameSite']) && isset($_POST['url']) && isset($_POST['note'])) {
    $password = $_POST['password'];
    $nameSite = $_POST['nameSite'];
    $url = $_POST['url'];
    $note = $_POST['note'];

    $result = $controller->addPassword($password, $nameSite, $url, $note);
    $password_all = $controller->getAllPassword();
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
        $result =  $controller->updatePassword($idPassword,$password, $siteName, $siteURL, $notes);
        if ($result === null)
        {
            echo "Erreur lors de la modification";
        }
        $password_all = $controller->getAllPassword();
    }
    else if ($_POST['action'] === 'Supprimer')
    {
        $password_all = $controller->getAllPassword();
        if (sizeof($password_all) === 0)
        {
            echo "Impossible de supprimer";
        }
        else{
            $result = $controller->deletePassword($_POST['idPassword']);
            $password_all = $controller->getAllPassword();
        }
    }
}
?>
<div>
    <div id="ajoutPsw">
        <div id="popup-overlay" >
            <div class="popup-content">
                <h2>Votre nouveau mot de passe</h2>
                <p>Sélectionner au moins un choix</p>
                <label
                >Minuscules
                    <input class="checkboxPassword" type="checkbox" name="miniscule" id="miniscule" checked/>
                </label>
                <label
                >Majuscules
                    <input class="checkboxPassword" type="checkbox" name="majuscule" id="majuscules" checked />
                </label>
                <label
                >Chiffres
                    <input class="checkboxPassword" type="checkbox" name="Chiffres" id="chiffres" checked />
                </label>
                <label
                >Caractères spéciaux
                    <input class="checkboxPassword" type="checkbox" name="caractères spéciaux" id="caractèresSpeciaux" checked />
                </label>
                <br>
                <button id="generatePassword">Générer un mot de passe</button>
                <br>
                <form id="formulaireAjoutPassword" method="post">
                    <input type="text" name="nameSite" placeholder="Nom d'utilisateur">
                    <input id="password" type="password" name="password" placeholder="Votre mot de passe">
                    <input type="text" name="url" placeholder="URL du site web">
                    <input type="text" name="note" placeholder="Notes à ajouter">

                    <button id="savePassword">Enregistrer</button>
                </form>
                <span id="close">&times;</span>
            </div>
        </div>
        <button id="openModalBtn">Ajouter un mot de passe</button>
        <!-- Fenêtre Modale -->

    </div>
    <div id="contentPasswords">
        <?php
        foreach ($password_all as $password) {
        ?>
        <div class="passwordContent">
            <form class="formPasswd" method="post">
                <input type="hidden" name="idPassword" value="<?php echo $password->getId()?>">
                <div class="champsSupperieur">
                    <input type="text" name="siteNameTest" value="<?php echo $password->getSiteName(); ?>">
                    <input type="text" name="passwordTest" value="<?php echo $password->getPasswordEncrypted();?>">
                </div>
                <div class="champInferieur">
                    <input type="text" name="siteURLTest" value="<?php echo $password->getSiteURL(); ?>">
                    <input type="text" name="notesTest" value="<?php echo $password->getNotes(); ?>">
                </div>
                <div class="btns">
                    <button type="submit" name="action" value="Modifier">Modifier</button>
                    <button type="submit" name="action" value="Supprimer">Supprimer</button>
                </div>
            </form>
        </div>
        <?php
        }
        ?>
    </div>
</div>


