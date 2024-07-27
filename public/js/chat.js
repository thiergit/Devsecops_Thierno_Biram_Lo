document.addEventListener('DOMContentLoaded', function() {
    const submitbtn = document.getElementById('submitbtn');
    const otherConv = document.querySelectorAll('.other-conv');
    let currentMedecinId = null;

    otherConv.forEach(conv => {
        conv.addEventListener('click', function(event) {
            event.preventDefault(); 
            const nom = this.getAttribute('data-nom');
            const prenom = this.getAttribute('data-prenom');
            currentMedecinId = this.getAttribute('data-id');
            document.getElementById('nom').textContent = `${nom} ${prenom}`;
            getConversation(currentMedecinId);
        });
    });

    submitbtn.addEventListener('click', function(event) {
        event.preventDefault();
        const messageContent = document.getElementById('message').value;
        if (currentMedecinId && messageContent) {
            axios.post('/patient/chat/send', {
                medecin_id: currentMedecinId,
                message: messageContent
            })
            .then(response => {
                const message = response.data;
                appendMessageToUI(message);
                document.getElementById('message').value = ''; // Efface le champ de message
            })
            .catch(error => {
                console.log('Erreur lors de l\'envoi du message:', error);
            });
        } else {
            alert('Sélectionnez un Medecin et tapez un message.');
        }
    });

    // Interval pour récupérer les nouvelles conversations toutes les secondes
    setInterval(function() {
        if (currentMedecinId) {
            getConversation(currentMedecinId);
        }
    }, 2000); // Interval de 1 seconde

    function getConversation(medecinId) {
        axios.get(`/patient/chat/${medecinId}`)
            .then(response => {
                const messages = response.data;
                const chatMessagesContainer = document.getElementById('chat-messages');
                chatMessagesContainer.innerHTML = '';
                messages.forEach(message => {
                    appendMessageToUI(message);
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement des conversations:', error);
            });
    }

    function appendMessageToUI(message) {
        const chatMessagesContainer = document.getElementById('chat-messages');
        const messageElement = document.createElement('div');
        console.log(message);
        if (message.expediteur == patientId) {
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
