function togglePassword() {
    const input = document.getElementById("mdp");
    input.type = input.type === "password" ? "text" : "password";
}

function validerFormulaire() {
    const email = document.getElementById("mail").value;
    const mdp = document.getElementById("mdp").value;
    let erreurs = [];

    if (!email.includes("@") || email.length < 5) {
        erreurs.push("Adresse e-mail invalide.");
    }
    if (mdp.length < 6) {
        erreurs.push("Le mot de passe doit contenir au moins 6 caractères.");
    }

    if (erreurs.length > 0) {
        alert(erreurs.join("\n"));
        return false;
    }
    return true;
}

document.addEventListener("DOMContentLoaded", () => {
    const emailInput = document.getElementById("mail");
    const mdpInput = document.getElementById("mdp");

    emailInput.addEventListener("input", () => {
        document.getElementById("email-counter").textContent = emailInput.value.length + " / 100";
    });

    mdpInput.addEventListener("input", () => {
        document.getElementById("mdp-counter").textContent = mdpInput.value.length + " / 50";
    });
});