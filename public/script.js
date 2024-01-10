


const loginFormButton = document.getElementById('login');
const loginForm = document.getElementById('login-form');
const loginCancel = document.getElementById('login-cancel');

const searchMovieButton = document.getElementById('search-movie-btn');
const searchMovieForm = document.getElementById('search-movie-form');
const searchMovieInput = document.getElementById('movie_search');

const movieDetails = document.getElementById('movie-details');
const closeMovieDetailsButton = document.getElementById('close-movie-details');

const newScheduleButton = document.getElementById('new-schedule-btn');
const scheduleForm = document.getElementById('schedule-form');
const closeScheduleFormButton = document.getElementById('close-schedule-form');


var slideIndex = 1;
var timer;




// LOGIN
if(loginFormButton != null){
    loginFormButton.addEventListener('click',()=>{
        loginForm.classList.remove('hidden');
    });

    // close modal window when cancel button is clicked
    loginCancel.addEventListener('click',()=>{
        loginForm.classList.add("hidden");
    });

    //click outside form to close the modal window
    window.onclick = function(event) {
        if (event.target == loginForm) {
            loginForm.classList.add("hidden");
        }
    }
}

// ADD MOVIE
else if(searchMovieButton != null){
    searchMovieButton.addEventListener('click',()=>{
        searchMovieForm.classList.remove('hidden');
        searchMovieInput.focus()
    })
//click outside the form to close the modal window
    window.onclick = function(event) {
        if (event.target == searchMovieForm) {
            searchMovieForm.classList.add("hidden");
        }
    }
}

// MOVIE DETAILS
else if(movieDetails != null){
    closeMovieDetailsButton.addEventListener('click',()=>{
        movieDetails.classList.add('hidden')
    })

    window.onclick = function(event) {
        if (event.target == movieDetails) {
            movieDetails.classList.add("hidden");
        }
    }
}

// NEW SCHEDULE
else if(newScheduleButton != null){
    newScheduleButton.addEventListener('click',()=>{
        scheduleForm.classList.remove('hidden')
    })
    window.onclick = function(event) {
        if (event.target == scheduleForm) {
            scheduleForm.classList.add("hidden");
            location.reload();
        }
    }
    closeScheduleFormButton.addEventListener('click',()=>{
        scheduleForm.classList.add('hidden');
        location.reload();
    })
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
    timer = setTimeout(autoSlideshow, 8000);
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







