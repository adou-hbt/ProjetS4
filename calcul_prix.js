document.addEventListener('DOMContentLoaded', function () {
    const prix_billet = document.getElementById('prix-billet');
    const checkboxes = document.querySelectorAll('input[type="checkbox"][data-price]');
    const radios = document.querySelectorAll('input[name="hebergement"][data-price]');
    const nbPersonnesInput = document.getElementById('nombre-personnes');
    const dureeSelect = document.getElementById('duree-sejour');
    const prixTotal = document.getElementById('total-complet');

    function updatePrix() {
        let billetPrix = parseFloat(prix_billet?.dataset.price || "0");
        let nbJours = parseInt(dureeSelect.value, 10) || 1;
        let nbPersonnes = parseInt(nbPersonnesInput.value, 10) || 1;
        let totalActivites = 0;
        let hebergementPrix = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) totalActivites += parseFloat(cb.dataset.price);
        });

        radios.forEach(rb => {
            if (rb.checked) hebergementPrix = parseFloat(rb.dataset.price);
        });

        const total = nbPersonnes * (totalActivites + billetPrix + (hebergementPrix * nbJours));
        prixTotal.textContent = total.toFixed(2);
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updatePrix));
    radios.forEach(rb => rb.addEventListener('change', updatePrix));
    dureeSelect.addEventListener('change', updatePrix);
    nbPersonnesInput.addEventListener('input', updatePrix);
    updatePrix();
});