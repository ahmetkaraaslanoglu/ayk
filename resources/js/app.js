import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()


const modal = document.getElementById("modal");
const modalButton = document.getElementById("modal-button");
const modalCloseButton = document.getElementById("modal-close-button");

modalButton.addEventListener("click", function () {
    modal.classList.remove("hidden");
});

modalCloseButton.addEventListener("click", function () {
    modal.classList.add("hidden");
});





