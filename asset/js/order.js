var ul = document.querySelector('.order-here ul');
var menu = document.querySelector(".menu-content");

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

window.onload = function(){

}

ul.addEventListener("click", function(e){
    if(e.target.className == "type"){

        setTimeout(function(){
            var url = new URLSearchParams(window.location.search);
            url.append('type', e.target.textContent)
            getMenu()
            .then(data => render(data, menu, e.target.textContent))
            .catch(err => console.log("error", err));
        }, 500);
        
        
    }
  
});



const getMenu = async () => {
    const response = await fetch('http://127.0.0.1:5500/data.json');
    const data = await response.json();
    return data;
};


function render(data, element, type){
    
    data.forEach(item => {
        if(type == item.type){
            item.data.forEach((meal, index) => {
                if(index < Array.from(element.querySelectorAll(".item")).length){
                    Array.from(element.querySelectorAll(".item")).forEach((element, count) => {
                        if(index == count){
                            //  console.log(index);
                             var price, title, img;
                            price = element.querySelector(".views-field-price__number span").textContent = meal.price ,
                            title = element.querySelector(".product-list-title a").textContent = meal.title,
                            img = element.querySelector(".media img").src = meal.img;
                        }
                        
                    });
                   
                }
               
            });
        }
    });
    
  
}

