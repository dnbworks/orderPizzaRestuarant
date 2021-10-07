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
    var items = document.querySelectorAll(".item");
    if(window.innerWidth < 576){

        console.log(window.innerWidth);
        items.forEach(item => {
            item.querySelector(".views-field-body p").textContent = item.querySelector(".views-field-body p").textContent.slice(0, 50) + "...";
            // item.style.display = "none";
        });
    }
    
}

var lis = ul.querySelectorAll("li");

lis.forEach(li => {
    li.addEventListener('click', function(e){
        var preloader = document.querySelector(".pre-loader");
        preloader.style.display = "block";
        e.preventDefault();
        // Start highlighting tabs
        lis.forEach(li => {
            li.classList.remove('active');
        });
        this.classList.add('active');
        // End highlighting tabs

        // fetch data for clicked tab
        let type = this.id;
        const url = `http://localhost:8080/api?type=${type}`;
        // console.log(url);
   
        getMenu(url)
        .then(data => render(data, menu, type))
        .catch(err => console.log("error", err));
      
            
    });
})


const getMenu = async (url) => {
    const response = await fetch(url);
    const data = await response.json();
    // console.log(data.data);
    return data;
};


function render(data, element, type){
    var items = Array.from(element.querySelectorAll(".item"));
    var available;

    if(data.data.length < 6){
        available = data.data.length;
    } else {
        available = 6;
    }

    items.forEach(item => {
        item.style.display = "none";
    });

    data.data.forEach((product, i) => {
    
        var dispalyItems = items.slice(0, available);

        dispalyItems.forEach((item, index ) => {
            item.style.display = "block";
            if(index == i){
                item.querySelector(".field-content a").href = `/order?type=${type}&name=${product.title}`,
                item.querySelector(".views-field-price__number span").textContent = product.price,
                item.querySelector(".product-list-title a").textContent = product.title,
                item.querySelector(".product-list-title a").href = `meal.html?type=${type}&pizza_id=1&pizza_name=${product.title}`,
                item.querySelector(".media img").src = `/asset/img/${product.img}`,
                item.querySelector(".views-field-body p").textContent = product.description.slice(0, 80);
            }

            
        });
      
    });   
    var preloader = document.querySelector(".pre-loader");
    preloader.style.display = "none"; 
    
}



