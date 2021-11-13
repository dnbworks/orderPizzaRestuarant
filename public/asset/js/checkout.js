

const coupon_btn = document.querySelector('.coupon span a');
const form = document.querySelector('.coupon form');
const radios = document.querySelectorAll('input[name="deliveryMethod"]');
// const pickup_input = document.querySelector(".input-text");
const delivery = document.querySelector('.store-branches');
const billing_info = document.querySelector('.billing-info');
const card = document.querySelector('.card');



// asynchronus function
const getMenu = async (url) => {
    const response = await fetch(url);
    const data = await response.json();
    // console.log(data);
    return data;
};

function render(data, element, type){
    element.innerHTML = data.form;

    if(type == 'pickup'){
        pickup_input = element.querySelector('.input-text');
        pickup_input.addEventListener('focus', handleFocus);
        pickup_input.addEventListener('blur', handleBlur);
    }


}

radios.forEach(radio => {
    if(radio.checked){
        console.log(radio.value);
    }
    radio.addEventListener('change', function(){
        if(radio.checked){
            // setting query params
            let type = radio.id;
            const url = `http://localhost:8080/api/delivery?method=${type}`;
            console.log(url);
            
            // fetch data for clicked tab
            getMenu(url)
            .then(data => render(data, card, type))
            .catch(err => console.log("error", err));
            console.log(radio.value);
        }
    });
});


function handleClick(e){
    e.preventDefault();
    form.classList.toggle('show');
}

function handleFocus(){
    var input = this;
    this.nextElementSibling.style.visibility = "visible";
    this.nextElementSibling.style.opacity = "1";
    this.nextElementSibling.style.display = "block";
    currentList = this.nextElementSibling.querySelectorAll("li");

    this.nextElementSibling.querySelectorAll("li").forEach(li => {
        li.addEventListener("click", function(){
            const hidden_input = document.querySelector('#pickup_id');
            console.log(hidden_input);
            hidden_input.value = this.dataset.branch;
            input.value = this.querySelector("h3").textContent;
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

// card.addEventListener('click', function(e){
//     if(e.target){

//     }
// });

coupon_btn.addEventListener('click', handleClick);

const place_order_form = document.querySelector('#place_order');


place_order_form.addEventListener('submit', function(e){

    let input_pickup = place_order_form.querySelector('#pickup_address');

    if(input_pickup && input_pickup.value == ""){
        e.preventDefault();
        input_pickup.classList.add('error');
    } 
});

