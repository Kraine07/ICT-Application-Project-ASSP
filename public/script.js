const loginFormButton = document.getElementById('login');
const loginForm = document.getElementById('login-form');
const loginCancel = document.getElementById('login-cancel');

const searchMovieButton = document.getElementById('search-movie-btn');
const searchMovieForm = document.getElementById('search-movie-form');

const movieDetails = document.getElementById('movie-details');
const closeMovieDetailsButton = document.getElementById('close-movie-details');


var slideIndex = 1;
var timer;

/**
 * Below is the code that handles the login modal window
 */

if(loginFormButton != null){

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