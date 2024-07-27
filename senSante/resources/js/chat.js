document.addEventListener('DOMContentLoaded', function() {
   const nom = document.getElementById('nom');
   const message = document.getElementById('message');
   const submitbtn = document.getElementById('submitbtn');
   const chatDest = document.getElementById('chat-destinataire');

   if (submitbtn) {
       submitbtn.addEventListener('click', () => {
           axios.post('/chat', {
               nom: nom.value,
               message: message.value
           }).then(response => {
               console.log(response.data);
           }).catch(error => {
               console.error(error);
           });
       });
   }

   if (window.Echo) {
       window.Echo.channel('chat')
           .listen('chat-message', (event) => {
               chatDest.innerHTML += `<div>${event.message} par ${event.nom}</div>`;
           });
   } else {
       console.error('Echo is not defined');
   }
});
