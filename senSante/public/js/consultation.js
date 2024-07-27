document.addEventListener('DOMContentLoaded', function() {
    // Sélection des boutons et des divs de consultation
    const btnConsultation1 = document.getElementById('btnConsultation1');
    const btnConsultation2 = document.getElementById('btnConsultation2');
    const btnConsultation3 = document.getElementById('btnConsultation3');
    const consultation1 = document.getElementById('consultation1');
    const consultation2 = document.getElementById('consultation2');
    const consultation3 = document.getElementById('consultation3');

    // Fonction pour masquer toutes les consultations sauf celle sélectionnée
    function afficherConsultation(id) {
        consultation1.style.display = 'none';
        consultation2.style.display = 'none';
        consultation3.style.display = 'none';
        document.getElementById(id).style.display = 'block';
    }
    function btnConsultation(id) {
        btnConsultation1.style.backgroundColor = "#4723D9";
        btnConsultation2.style.backgroundColor = "#4723D9";
        btnConsultation3.style.backgroundColor = "#4723D9";
        document.getElementById(id).style.backgroundColor = "#636fa4";
    }

    // Événements de clic sur les boutons de consultation
    btnConsultation1.addEventListener('click', function() {
        afficherConsultation('consultation1');
        btnConsultation('btnConsultation1');
    });

    btnConsultation2.addEventListener('click', function() {
        afficherConsultation('consultation2');
        btnConsultation('btnConsultation2');
    });

    btnConsultation3.addEventListener('click', function() {
        afficherConsultation('consultation3');
        btnConsultation('btnConsultation3');
    });
});
