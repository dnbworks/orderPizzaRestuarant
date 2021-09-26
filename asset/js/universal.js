var menubtn = document.querySelector(".menu");
var sidenav = document.querySelector(".sidenav");
var closebtn = document.querySelector(".closebtn");

var nav = document.querySelector("nav");

closebtn.addEventListener("click", function(){
    sidenav.classList.remove("shownav");
});

menubtn.addEventListener("click", function(){
    sidenav.classList.add("shownav");
});


const search = document.querySelector('.search-container')
const btn = document.querySelector('.search-container span')
const input = document.querySelector('.search-container input')

btn.addEventListener('click', () => {
    input.classList.toggle('active');
    // input.focus();
})

