console.log("Début AJAX");
fetch('update_profil.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: JSON.stringify({ test: 'oui' })
})
    .then(res => res.json())
    .then(data => console.log("Réponse AJAX :", data))
    .catch(err => console.error("Erreur AJAX :", err));
const valeursInitiales = {};

function modifier(id) {
    const champ = document.getElementById(id);
    if (!(id in valeursInitiales)) {
        valeursInitiales[id] = champ.value;
    }
    champ.disabled = false;
}

function annuler(id) {
    const champ = document.getElementById(id);
    if (id in valeursInitiales) {
        champ.value = valeursInitiales[id];
    }
    champ.disabled = true;
}

function modifierGenre() {
    const radioChecked = document.querySelector('input[name="genre"]:checked');
    if (radioChecked) {
        valeursInitiales['genre'] = radioChecked.value;
    }
    document.getElementById('homme').disabled = false;
    document.getElementById('femme').disabled = false;
}

function annulerGenre() {
    const ancien = valeursInitiales['genre'];
    if (ancien === "homme") document.getElementById('homme').checked = true;
    if (ancien === "femme") document.getElementById('femme').checked = true;
    document.getElementById('homme').disabled = true;
    document.getElementById('femme').disabled = true;
}

function sauvegarderProfil() {
    const donnees = {
        nom: document.getElementById('nom').value,
        prenom: document.getElementById('prenom').value,
        email: document.getElementById('email').value,
        genre: document.querySelector('input[name="genre"]:checked')?.value,
    };

    fetch('update_profil.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify(donnees)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Profil mis à jour !");
                for (let id in donnees) {
                    const element = document.getElementById(id);
                    if (element) {
                        element.disabled = true;
                    }
                }
                document.getElementById('homme').disabled = true;
                document.getElementById('femme').disabled = true;
            } else {
                alert("Erreur : " + data.message);
            }
        })
        .catch(error => {
            console.error("Erreur AJAX :", error);
            alert("Une erreur est survenue.");
        });
}