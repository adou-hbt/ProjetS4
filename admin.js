document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll("form[method='POST']");

    forms.forEach(form => {
        const button = form.querySelector("button");

        form.addEventListener("submit", function (e) {
            e.preventDefault(); // empêche l'envoi immédiat
            button.disabled = true;
            button.textContent = "Traitement...";
            button.style.opacity = "0.6";
            button.style.cursor = "not-allowed";

            setTimeout(() => {
                form.submit(); // soumet le formulaire après 3 secondes
            }, 3000);
        });
    });
});