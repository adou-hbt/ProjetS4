function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function switchTheme() {
    const currentTheme = getCookie('theme') || 'clair';
    const newTheme = currentTheme === 'clair' ? 'nuit' : 'clair';
    setCookie('theme', newTheme, 30);
    applyTheme(newTheme);
}

function applyTheme(theme) {
    const path = window.location.pathname;
    const page = path.substring(path.lastIndexOf('/') + 1).replace('.php', '');
    let cssFile = "";

    switch (page) {
        case "accueil":
            cssFile = theme === 'nuit' ? "style.css" : "style_nuit.css";
            break;
        case "formulaire":
            cssFile = theme === 'nuit' ? "style.css" : "style_nuit.css";
            break;
        case "connexion":
            cssFile = theme === 'nuit' ? "style.css" : "style_nuit.css";
            break;
        case "presentation":
            cssFile = theme === 'nuit' ? "style.css" : "style_nuit.css";
            break;
        case "Jevoyage":
            cssFile = theme === 'nuit' ? "Voyage.css" : "Voyage_nuit.css";
            break;
        case "JevoyageEnFinlande":
            cssFile = theme === 'nuit' ? "Voyage.css" : "Voyage_nuit.css";
            break;
        case "JevoyageEnNorvege":
            cssFile = theme === 'nuit' ? "Voyage.css" : "Voyage_nuit.css";
            break;
        case "JevoyageEnSuede":
            cssFile = theme === 'nuit' ? "Voyage.css" : "Voyage_nuit.css";
            break;
        case "JevoyageEnIslande":
            cssFile = theme === 'nuit' ? "Voyage.css" : "Voyage_nuit.css";
            break;
        case "Abisko":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Akureiry":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Bergen":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "geiranger":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Hanko":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Helsinki":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Husavik":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Inari":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Malmo":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Reykjavik":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Rovaniemi":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Stockholm":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Tromso":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Upssala":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Vik":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "Oslo":
            cssFile = theme === 'nuit' ? "Choixvoyage.css" : "Choixvoyage_nuit.css";
            break;
        case "profil":
            cssFile = theme === 'nuit' ? "style_nuit.css" : "style.css";
            break;
        default:
            cssFile = theme === 'nuit' ? "style_nuit.css" : "style.css";
    }

    const link = document.getElementById('theme-style');
    if (link) {
        link.setAttribute('href', cssFile);
    }
}

window.onload = function() {
    const savedTheme = getCookie('theme') || 'clair';
    applyTheme(savedTheme);
};
