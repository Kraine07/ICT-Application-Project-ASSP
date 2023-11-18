const loginFormButton = document.getElementById('login');
const loginForm = document.getElementById('login-form');
const loginCancel = document.getElementById('login-cancel');

// open modal window when admin panel button is clicked
loginFormButton.addEventListener('click',()=>{
    loginForm.classList.remove('hidden');
});

// close modal window when cancel button is clicked
loginCancel.addEventListener('click',()=>{
    loginForm.classList.add("hidden");
});

//click outside the window to close the modal window
window.onclick = function(event) {
    if (event.target == loginForm) {
        loginForm.classList.add("hidden");
    }
}