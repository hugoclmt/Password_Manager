document.getElementById("generatePassword").addEventListener("click", function() {
    const lettreMinuscule = "abcdefghijklmnopqrstuvwxyz";
    const lettreMajuscule = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const chiffre = "0123456789";
    const caractereSpecial = "!@#$%^&*()_+~`|}{[]:;?><,./-=";

    const inputPassword = document.getElementById("password");
    let password = "";
    let length = 16; // Vous pouvez ajuster cette valeur ou la récupérer dynamiquement.
    let caractereSouhaite = "";

    // Utilisation des IDs corrects selon votre HTML
    if (document.getElementById("miniscule").checked) {
        caractereSouhaite += lettreMinuscule;
    }
    if (document.getElementById("majuscules").checked) {
        caractereSouhaite += lettreMajuscule;
    }
    if (document.getElementById("chiffres").checked) {
        caractereSouhaite += chiffre;
    }
    if (document.getElementById("caractèresSpeciaux").checked) {
        caractereSouhaite += caractereSpecial;
    }

    // Vérification si aucun type de caractère n'est sélectionné
    if (caractereSouhaite.length === 0) {
        alert("Veuillez sélectionner au moins un type de caractère pour générer le mot de passe.");
        return;
    }

    // Génération du mot de passe
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * caractereSouhaite.length);
        password += caractereSouhaite[randomIndex];
    }

    inputPassword.value = password;
});
