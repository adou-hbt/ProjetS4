
// Enregistre un cookie
function setCookie(name, value, days) {
  let expires = "";
  if (days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Lit un cookie
function getCookie(name) {
  const nameEQ = name + "=";
  const ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) === ' ') c = c.substring(1);
    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length);
  }
  return null;
}

// Applique le thème correspondant à la page et au cookie
function applyTheme(theme) {
  const path = window.location.pathname;
  const page = path.substring(path.lastIndexOf('/') + 1).replace('.php', '');
  let cssFile = "";

  switch (page) {
    case "JevoyageEnNorvege":
      cssFile = theme === 'nuit' ? "style_norvege_nuit.css" : "style_norvege.css";
      break;
    case "JevoyageEnSuede":
      cssFile = theme === 'nuit' ? "style_suede_nuit.css" : "style_suede.css";
      break;
    case "accueil":
    case "":
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

// Change le thème au clic
function switchTheme() {
  const currentTheme = getCookie('theme') || 'clair';
  const newTheme = currentTheme === 'clair' ? 'nuit' : 'clair';
  setCookie('theme', newTheme, 30);
  applyTheme(newTheme);
}

// Applique le thème au chargement
window.onload = function () {
  const savedTheme = getCookie('theme') || 'clair';
  applyTheme(savedTheme);
};
