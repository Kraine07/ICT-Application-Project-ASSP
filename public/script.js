


const loginFormButton = document.getElementById('login');
const loginForm = document.getElementById('login-form');
const loginCancel = document.getElementById('login-cancel');

const searchMovieButton = document.getElementById('search-movie-btn');
const searchMovieForm = document.getElementById('search-movie-form');


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


}
else if(searchMovieButton != null){

// search movie modal window
    searchMovieButton.addEventListener('click',()=>{
    searchMovieForm.classList.remove('hidden')
})
//click outside the window to close the modal window
window.onclick = function(event) {
    if (event.target == searchMovieForm) {
        searchMovieForm.classList.add("hidden");
    }
}

}




/**
 * Below is the code that handles the slides on the main page
 */

autoSlideshow();

function autoSlideshow() {
    var i;
    var slides = document.getElementsByClassName("slides");
    var dots = document.getElementsByClassName('dot');

    for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
    dots[i].style.backgroundColor = 'rgba(255,255,255,0.2)';
    }

    if (slideIndex > slides.length) {
        slideIndex = 1
    }else if(slideIndex < 1){
        slideIndex = slides.length
    }

    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].style.backgroundColor = 'rgba(255,255,255,0.7)';
    slideIndex++;
    timer = setTimeout(autoSlideshow, 5000);
}


function currentSlide(n){
    slideIndex = n;
    clearTimeout(timer)
    autoSlideshow();

}

function nextSlide(n){
    slideIndex += n-1;
    clearTimeout(timer)
    autoSlideshow();
}

//click outside the window to close the modal window
window.onclick = function(event) {
    if (event.target == loginForm || event.target == titleSearch) {
        loginForm.classList.add("hidden");
    }
}






