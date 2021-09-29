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
   
        getMenu()
        .then(data => render(data, menu, type))
        .catch(err => console.log("error", err));
      
            
    });
})



const getMenu = async () => {
    const response = await fetch('http://127.0.0.1:5500/data.json');
    const data = await response.json();
    return data;
};


function render(data, element, type){
    var items = Array.from(element.querySelectorAll(".item"));
    var available;
    data.forEach(item => {
        var item_data = item.data;
        if(type == item.type){
            if(item.data.length < 6){
                available = item.data.length;
            } else {
                available = 6;
            }

            items.forEach(item => {
                // item.querySelector(".views-field-price__number span").textContent = "",
                // item.querySelector(".product-list-title a").textContent = "",
                // item.querySelector(".product-list-title a").href = `meal.html?pizza_type=${type}&pizza_id=1&pizza_name=${item_data[i].title}`,
                // item.querySelector(".media img").src = "",
                // item.querySelector(".views-field-body p").textContent = "";

                item.style.display = "none";
            });

            var dispalyItems = items.slice(0, available);

            for(let i = 0; i < item_data.length; i++){

                dispalyItems.forEach((item, index ) => {
                    item.style.display = "block";
                    if(index == i){
                        item.querySelector(".field-content a").href = `meal.html?type=${type}&pizza_id=1&pizza_name=${item_data[i].title}`,
                        item.querySelector(".views-field-price__number span").textContent = item_data[i].price,
                        item.querySelector(".product-list-title a").textContent = item_data[i].title,
                        item.querySelector(".product-list-title a").href = `meal.html?type=${type}&pizza_id=1&pizza_name=${item_data[i].title}`,
                        item.querySelector(".media img").src = item_data[i].img,
                        item.querySelector(".views-field-body p").textContent = item_data[i].description;
                    }
                    
                   
                   
                });
            
            }

     
        }
    });   
    var preloader = document.querySelector(".pre-loader");
    preloader.style.display = "none"; 
    
}



