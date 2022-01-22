var ul = document.querySelector('.order-here ul');
var menu = document.querySelector(".menu-content");
var nav = document.querySelector("nav");
var imgs = document.querySelectorAll('.media img.media__image');
var lis = ul.querySelectorAll("li");
var preloader = document.querySelector(".pre-loader");
var pagination = document.querySelector('.pagination');


// asynchronus function
const getMenu = async (url) => {
    const response = await fetch(url);

    const data = await response.json();
    console.log(data);
    return data;
};


lis.forEach(li => {
    li.addEventListener('click', function(e){
        e.preventDefault();

        // display loader
        imgs.forEach(img => {
            img.previousElementSibling.style.visibility = 'visible';
        });
        
        // Start highlighting tabs
        lis.forEach(li => {
            li.classList.remove('active');
        });
        this.classList.add('active');
        // End highlighting tabs

        // setting query params
        let type = this.id;
        const url = `/api?type=${type}`;
        console.log(url);
        
        // fetch data for clicked tab
        getMenu(url)
        .then(data => render(data, menu, type))
        .catch(err => console.log("error", err));
        
           
    });
});




function render(data, element, type){
    console.log('hi');

    var items = Array.from(element.querySelectorAll(".item"));
    var available;
    // console.log(data);
    // console.log(data.data.length);

    // pagination
    if(data.data.length > 6){

    }

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
                item.querySelector(".field-content a").href = `/order?type=${product.category}&name=${product.title}`,
                item.querySelector(".views-field-price__number span").textContent = 'PHP ' + product.price,
                item.querySelector(".product-list-title a").textContent = product.title,
                item.querySelector(".product-list-title a").href = `meal.html?type=${type}&pizza_id=1&pizza_name=${product.title}`,
                item.querySelector(".media img.media__image").src = `/asset/img/${product.img}`,
                item.querySelector(".views-field-body p").textContent = product.description.slice(0, 50);
            } 
        });
      
    });   

    
    imgs.forEach(img => {
        img.onload = function(){
            this.previousElementSibling.style.visibility = 'hidden';
        }
        
    });
   
    pagination.innerHTML = data.pagination_links;
    if(pagination.querySelectorAll('a')){
        let pagination_links = pagination.querySelectorAll('a');
        pagination_links.forEach(link => {
            link.addEventListener('click', function(e){
                e.preventDefault();
                let url = e.target.href;

                getMenu(url)
                .then(data => render(data, menu, type))
                .catch(err => console.log("error", err));
                // console.log(url);
            });
        });
        
    }

}


window.onload = function(){

    imgs.forEach(img => {
        // console.log(img.src);
        img.previousElementSibling.style.visibility = 'hidden';
    });
    console.log('hello world');
}









