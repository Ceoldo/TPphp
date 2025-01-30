document.querySelector('form').addEventListener('submit', function(event) {
    let password = document.getElementById('password').value;
    let confirm_password = document.getElementById('confirm_password').value;

    if (password !== confirm_password) {
        alert("Les mots de passe ne correspondent pas.");
        event.preventDefault();
    }

    let activites = document.getElementById('activites');
    let selectedActivites = Array.from(activites.selectedOptions).map(option => option.value);

    if (selectedActivites.length < 2 || selectedActivites.length > 4) {
        alert("Veuillez sélectionner entre 2 et 4 activités.");
        event.preventDefault();
    }
});