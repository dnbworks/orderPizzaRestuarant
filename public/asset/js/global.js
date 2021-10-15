var menubtn = document.querySelector(".menu");
var sidenav = document.querySelector(".sidenav");
var closebtn = document.querySelector(".closebtn");

const cancel = document.querySelector(".cart img");
const cart = document.querySelector(".cart");
const cartBtn = document.querySelector(".cartBtn-div");
const shadow = document.querySelector(".shadow");

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


cartBtn.addEventListener("click", function(){
    cart.style.display = "block"; 
    shadow.style.display = "block"; 
});

cancel.addEventListener("click", function(){
    cart.style.display = "none"; 
    shadow.style.display = "none"; 
});

