document.addEventListener('DOMContentLoaded', function() {
    const submitbtn = document.getElementById('submitbtn');
    const otherConv = document.querySelectorAll('.other-conv');
    let currentPatientId = null;

    otherConv.forEach(conv => {
        conv.addEventListener('click', function(event) {
            event.preventDefault(); 
            const nom = this.getAttribute('data-nom');
            const prenom = this.getAttribute('data-prenom');
            currentPatientId = this.getAttribute('data-id');
            document.getElementById('nom').textContent = `${nom} ${prenom}`;
            getConversation(currentPatientId);
        });
    });

    submitbtn.addEventListener('click', function(event) {
        event.preventDefault();
        const messageContent = document.getElementById('message').value;
        if (currentPatientId && messageContent) {
            axios.post('/medecin/chat/send', {
                patient_id: currentPatientId,
                message: messageContent
            })
            .then(response => {
                const message = response.data;
                appendMessageToUI(message);
                document.getElementById('message').value = ''; // Efface le champ de message
            })
            .catch(error => {
                console.error('Erreur lors de l\'envoi du message:', error);
            });
        } else {
            alert('Sélectionnez un patient et tapez un message.');
        }
    });

    // Interval pour récupérer les nouvelles conversations toutes les secondes
    setInterval(function() {
        if (currentPatientId) {
            getConversation(currentPatientId);
        }
    }, 2000); // Interval de 1 seconde

    function getConversation(patientId) {
        axios.get(`/medecin/chat/${patientId}`)
            .then(response => {
                const messages = response.data;
                const chatMessagesContainer = document.getElementById('chat-messages');
                chatMessagesContainer.innerHTML = '';
                messages.forEach(message => {
                    appendMessageToUI(message);
                });
            })
            .catch(error => {
                console.log('Erreur lors du chargement des conversations:', error);
            });
    }

    function appendMessageToUI(message) {
        const chatMessagesContainer = document.getElementById('chat-messages');
        const messageElement = document.createElement('div');
        if (message.expediteur == MedecinId) {
            messageElement.classList.add('chat-message-right', 'pb-4');
        } else {
            messageElement.classList.add('chat-message-left', 'pb-4');
        }
        messageElement.innerHTML = MessageFormat(message);
        chatMessagesContainer.appendChild(messageElement);
    }

    function MessageFormat(message) {
        return `<div>
                    <div class="text-muted small text-nowrap mt-2">${message.heure}</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                    <div class="font-weight-bold mb-1"></div>
                    <span>${message.message}</span>
                </div>`;
    }
});
