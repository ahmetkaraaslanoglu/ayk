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


const sendButton = document.getElementById("send-button");
const inputEmail = document.getElementById("email");
const inputTitle = document.getElementById("title");
const inputMessage = document.getElementById("message");

// sendButton.addEventListener("click", function () {
//     if (inputEmail.value !== "" && inputTitle.value !== "" && inputMessage.value !== ""){
//
//         showAlert();
//     }else{
//         showFalseAlert();
//     }
// });

function showAlert() {
    const alertBox = document.getElementById("alertBox");
    alertBox.style.display = "block";
    setTimeout(() => {
        alertBox.style.display = "none";
    }, 3000);
}

function showFalseAlert() {
    const falseAlertBox = document.getElementById("falseAlertBox");
    falseAlertBox.style.display = "block";
    setTimeout(() => {
        falseAlertBox.style.display = "none";
    }, 3000);
}
