

const getMenu = async () => {
    const response = await fetch('https://dnbworks.github.io/orderPizzaRestuarant/data.json');
    const data = await response.json();
    return data;
};


function render(data, elementObject, type, pizza_name){
    data.forEach(item => {
        if(type == item.type){
            var item_data = item.data;
            

            for(let i = 0; i < item_data.length; i++){
               
                if(item_data[i].title == pizza_name){
                    // console.log(item_data[i].title);
                    elementObject.title.innerText = item_data[i].title;
                    elementObject.img.src = item_data[i].img;
                    
                }
      
            }
        }
    });   

   // add zoom feature
    var evt = new Event(),
    m = new Magnifier(evt);
    m.attach({
        thumb: '#thumb',
        largeWrapper: 'preview',
        zoom:2,
        zoomable: false,
        mode: "inside"
    });
    
    // var preloader = document.querySelector(".pre-loader");
    // preloader.style.display = "none"; 
    
}



const img = document.querySelector("figure #thumb");

if(img.src){
    console.log("hi");
}





window.onload = function(){
    const pizza_name = new URLSearchParams(window.location.search).get("pizza_name");
    const type = new URLSearchParams(window.location.search).get("type");
    const elementObject = {
        title: document.querySelector("h4"),
        img: document.querySelector("figure img#thumb")
    }

    getMenu()
    .then(data => render(data, elementObject, type, pizza_name))
    .catch(err => console.log("error", err));

    // console.log(pizza_name, type);

    const input_texts = document.querySelectorAll(".input-text");
    const drop_down = document.querySelector(".u-df-mb");
    const lis = drop_down.querySelectorAll("li");
    const cancel = document.querySelector(".cart img");
    const cart = document.querySelector(".cart");
    const cartBtn = document.querySelector(".cartBtn-div");
    const shadow = document.querySelector(".shadow");
    const add_to_cart = document.querySelector("#form_options button");
    const img = document.querySelector("figure #thumb");
    const loader = document.querySelector(".loader-div");
    
    setTimeout(function(){
        loader.style.display = "none";
    }, 1000);
    

    

    input_texts.forEach(input => {

        if(!input.value){
            add_to_cart.disabled = true;
            add_to_cart.style.opacity = '0.6';
        } else {
            add_to_cart.disabled = false;
            add_to_cart.style.opacity = '1';
        }

        // input.addEventListener("change", function(){
        //     console.log("hi");
        // });

        input.addEventListener("focus", function(){
            var input = this;
            this.nextElementSibling.style.visibility = "visible";
            this.nextElementSibling.style.opacity = "1";
            this.nextElementSibling.style.display = "block";
            currentList = this.nextElementSibling.querySelectorAll("li");
  
            this.nextElementSibling.querySelectorAll("li").forEach(li => {
                li.addEventListener("click", function(){
                    input.value = this.querySelector("h5").textContent;
                    this.parentElement.style.display = "none";
                });
            })
            
        });

        input.addEventListener("blur", function(){
            this.nextElementSibling.style.visibility = "invisible";
            this.nextElementSibling.style.opacity = "0"; 

            setTimeout(() => {
                this.nextElementSibling.style.display = "none"; 
            }, 1000);
            
        });
        
    });

    add_to_cart.addEventListener("click", function(e){
        e.preventDefault();
        if(!this.disabled){
            this.style.opacity = '0.6';
            this.firstElementChild.style.display = "block";

            setTimeout(() => {
                this.style.opacity = '1';
                this.textContent = "Added to Tray";
                this.firstElementChild.style.display = "none";
            
            }, 1000);
        }
        this.disabled = true;
    
    });



    cartBtn.addEventListener("click", function(){
        cart.style.display = "block"; 
        shadow.style.display = "block"; 
    });

    cancel.addEventListener("click", function(){
        cart.style.display = "none"; 
        shadow.style.display = "none"; 
    });


}


