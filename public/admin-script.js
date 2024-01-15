
const movieMenuButton = document.getElementById('movies-menu-button');
const scheduleMenuButton = document.getElementById('schedule-menu-button');
const moviePage = document.getElementById('manage-movies');
const schedulePage = document.getElementById('manage-schedule');

movieMenuButton.addEventListener('click',  ()=>{
    moviePage.classList.remove('hidden');
    schedulePage.classList.add('hidden');
    movieMenuButton.classList.add('selected');
    scheduleMenuButton.classList.remove('selected');
  });

  scheduleMenuButton.addEventListener('click',() => {
    moviePage.classList.add('hidden');
    schedulePage.classList.remove('hidden');
    movieMenuButton.classList.remove('selected');
    scheduleMenuButton.classList.add('selected');
  });