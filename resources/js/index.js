



document.addEventListener("DOMContentLoaded", function(event) {
    const formPopup = document.getElementById('formPopup');
    const openFormBtn = document.getElementById('openFormBtn');
    const closeBtn = document.querySelector('.close');

    openFormBtn.onclick = function() {
        formPopup.style.display = "block";
    }

    closeBtn.onclick = function() {
        formPopup.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == formPopup) {
            formPopup.style.display = "none";
        }
    }
});
