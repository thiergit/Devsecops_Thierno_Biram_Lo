document.addEventListener('DOMContentLoaded', function () {
    var healthIcons = document.querySelectorAll('.rdv-link');

    healthIcons.forEach(function (healthIcon) {
        healthIcon.addEventListener('click', function (e) {
            e.preventDefault();

            var medecinId = this.getAttribute('data-id');
            var alertContainer = document.getElementById('alertContainer');
            var alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-warning alert-dismissible fade show w-100';
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                Voulez-vous confirmer la demande de consultation ?
                <div class="mt-4">
                    <a href="/demande-consultation/${medecinId}" id="confirmButton" class="btn btn-warning btn-sm">Confirmer</a>
                    <button id="cancelButton" class="btn btn-link btn-sm" data-dismiss="alert">Annuler</button>
                </div>
            `;

            alertContainer.appendChild(alertDiv);
            document.getElementById('cancelButton').addEventListener('click', function () {
                alertDiv.remove(); // Remove the alert if canceled
            });
        });
    });
});
