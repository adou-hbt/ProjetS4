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