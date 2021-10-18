
class Product {
    constructor(option, value, id){
        this.option = option;
        this.value = value;
        this.id = id;
    }
}


 // add zoom feature
    // var evt = new Event(),
    // m = new Magnifier(evt);
    // m.attach({
    //     thumb: '#thumb',
    //     // largeWrapper: 'preview',
    //     zoom:2,
    //     zoomable: false,
    //     mode: "inside"
    // });

window.onload = function(){
  

    const input_texts = document.querySelectorAll(".input-text");
    const drop_down = document.querySelector(".u-df-mb");
    const lis = drop_down.querySelectorAll("li");
  
    const add_to_cart = document.querySelector("#form_options button");
    const img = document.querySelector("figure #thumb");
    const loader = document.querySelector(".loader-div");
    
    setTimeout(function(){
        loader.style.display = "none";
    }, 1000);
    

    input_texts.forEach(input => {

        // if(!input.value){
        //     add_to_cart.disabled = true;
        //     add_to_cart.style.opacity = '0.6';
        // } else {
        //     add_to_cart.disabled = false;
        //     add_to_cart.style.opacity = '1';
        // }

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

       let validate = checkValidation(input_texts);

       if(validate.status && (validate.empty_fields.length == 0)){
            // console.log('yes');
            let data_array = [] ;
            input_texts.forEach(input => {

                data_array.push(new Product(input.id, input.value, parseInt(document.querySelector("h4").id)));
            });

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost:8080/api/create", true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data_array));

            this.style.opacity = '0.6';
            this.firstElementChild.style.display = "block";


            xhr.onload = function() {
                // console.log("HELLO")
                console.log(JSON.parse(this.responseText));
                // console.log(JSON.parse(this.responseText).data);
                add_to_cart.style.opacity = '1';
                add_to_cart.textContent = "Added to Tray";
                add_to_cart.disabled = true;
                var amount = document.querySelector('.amount').textContent = JSON.parse(this.responseText).num_of_cart_items;

                window.location.href = "/cart";
                
                // console.log(document.querySelector("h4").id)
                // console.log(add_to_cart.firstElementChild);
                // add_to_cart.firstElementChild.style.display = "none";
                // var data = JSON.parse(this.responseText);
                // console.log(data);
            }

            // console.log(data_array);

        } else {
            validate.empty_fields.forEach(field => {
                field.classList.add('error');
            });
            console.log(validate.status);
            console.log(validate.empty_fields);
         }

      
        // if(!this.disabled){
        //     this.style.opacity = '0.6';
        //     this.firstElementChild.style.display = "block";

        //     setTimeout(() => {
        //         this.style.opacity = '1';
        //         this.textContent = "Added to Tray";
        //         this.firstElementChild.style.display = "none";
            
        //     }, 1000);
        // }
        // this.disabled = true;
    
    });


    function checkValidation(inputs){
        let validate;
        let empty_fields = [];
        

        input_texts.forEach(input => {
            if(input.value !== ""){
                validate = true;
                
            } else {
                validate = false;
                empty_fields.push(input);
            }
            
        });

        return {
            status: validate,
            empty_fields: empty_fields
        };
    }


}

