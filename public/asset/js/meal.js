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


const tabs = document.querySelectorAll('.tabs a');
const decrease = document.querySelector("#decrease");
const increase = document.querySelector("#increase");

const input_texts = document.querySelectorAll(".input-text");
const input_values = document.querySelectorAll('.input');
const drop_down = document.querySelector(".u-df-mb");
const lis = drop_down.querySelectorAll("li");

const add_to_cart = document.querySelector("#form_options button");
const img = document.querySelector("figure #thumb");
const loader = document.querySelector(".loader-div");
const amount = document.querySelector('.amount');
const form_container = document.getElementById('form_container');

class Product {
    constructor(option, value, id){
        this.option = option;
        this.value = value;
        this.id = id;
    }
}

function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}

function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById('number').value = value;
}

function handleFocus(){
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
    });
}

function handleBlur(){
    this.nextElementSibling.style.visibility = "invisible";
    this.nextElementSibling.style.opacity = "0"; 

    setTimeout(() => {
        this.nextElementSibling.style.display = "none"; 
    }, 1000);
}

function handleAddCart(e){
    e.preventDefault();

    console.log(e.target.id)
   let validate = checkValidation(input_texts);
   const input_values = document.querySelectorAll('.input');

   if(validate.status && (validate.empty_fields.length == 0)){
        let data_array = [] ;

        if(e.target.id == 'add' || e.target.id == 'addDiff'){
            input_values.forEach(input => {
                data_array.push(new Product(input.id, input.value, parseInt(document.querySelector("h4").id)));
            });
        } else if(e.target.id == 'update'){
            input_values.forEach(input => {
                data_array.push(new Product(input.id, input.value, document.querySelector(".text").id));
            });
        }
       
        let url = '';
        if(e.target.id == 'add'){
            url = 'http://localhost:8080/api/create';
        } else if(e.target.id == 'update'){
            url = 'http://localhost:8080/api/update';
        } else {
            url = 'http://localhost:8080/api/addDiff';
        }

      

        console.log(url);
        console.log(data_array);
        // console.log(document.querySelector(".text"));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(data_array));

        this.style.opacity = '0.6';
        this.firstElementChild.style.display = "block";

        let button = this;

        xhr.onload = function() {
            console.log(JSON.parse(this.responseText));
            
            let cart_count = JSON.parse(this.responseText).cartNum;
            // console.log(this.responseText);
            button.style.opacity = '1';

            if(e.target.id == 'update'){
                button.textContent = "Updated your order";
            } else {
                button.textContent = "Added to Tray";
            }
            
            button.disabled = true;
            var amount = document.querySelector('.amount');
            amount.textContent = cart_count;

            // if(JSON.parse(this.responseText).counter == 1){
            //     window.location.href = "/cart";
            // }

            
            
        }

    } else {
        validate.empty_fields.forEach(field => {
            field.classList.add('error');
        });
        console.log(validate.status);
        console.log(validate.empty_fields);
     }
}

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

function handleFormContainer(e){
    if(e.target.classList.contains('tab-btn')){
        e.preventDefault();

        let url = `/api/render?id=${e.target.dataset.id}&status=${e.target.id}&category=${e.target.dataset.category}&cartItemId=${e.target.dataset.cartitemid}`;

        console.log(url);
        console.log(e.target.dataset.cartitemid);
        var xhr3 = new XMLHttpRequest();
        xhr3.open("GET", url, true);
        xhr3.send(null);

        xhr3.onreadystatechange = function(){
            if(xhr3.readyState == 4 && xhr3.status == 200 ){
                console.log(JSON.parse(this.responseText));
                let template = `
                    <div class="tabs d-flex justify-content-between">
                        <a href="#" id="update" data-category="${e.target.dataset.category}" data-id="${e.target.dataset.id}" data-cartitemid="${e.target.dataset.cartitemid}" class="tab-btn active">Update Order</a>
                        <a href="#" id="addDiff" data-category="${e.target.dataset.category}" data-id="${e.target.dataset.id}" data-cartitemid="${e.target.dataset.cartitemid}" class="tab-btn">Add product differently</a>
                    </div>
                    <span class="title">Select your options</span>
                    ${JSON.parse(this.responseText).form}
                `;
                form_container.innerHTML = template;

                const input_texts = form_container.querySelectorAll(".input-text");
                const decrease = document.querySelector("#decrease");
                const increase = document.querySelector("#increase");
                const add_to_cart = document.querySelector("#form_options button");

                add_to_cart.addEventListener("click", handleAddCart);
                decrease.addEventListener('click', decreaseValue);
                increase.addEventListener('click', increaseValue);
                input_texts.forEach(input => {
                    input.addEventListener('focus', handleFocus);
                    input.addEventListener('blur', handleBlur);
                });
                // console.log(form_container.querySelectorAll(".input-text")[0]);
            } // end if
        } // end XMLHttpRequest
    } // end if
}


window.onload = function(){

    setTimeout(function(){
        loader.style.display = "none";
    }, 1000);
    
    decrease.addEventListener('click', decreaseValue);
    increase.addEventListener('click', increaseValue);

    input_texts.forEach(input => {
        input.addEventListener("focus", handleFocus);
        input.addEventListener("blur", handleBlur);
    });

    add_to_cart.addEventListener("click", handleAddCart);
    form_container.addEventListener('click', handleFormContainer); 
} // end of window listener

