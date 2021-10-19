

const deleteBtn = document.querySelectorAll('.delete');
const preloader = document.querySelector('.pre-loader');
const cartBody = document.querySelector(".cart-body");

function format_money(price){
    let price_string = price.toString();
    if(price_string.indexOf('.') > -1){
        let price_array = price_string.split('.');
        let price_decimal = price_array[1];
        let price_decimal_length = price_decimal.length;
        return price_array[0] + '.' + addZero(price_decimal_length, price_decimal);
    }
    return price_string + '.00';
}

function addZero(length, price){
    if(length == 1){
        return price = '0' + price;
    }
    return price;
}

let price = 343;
// console.log(format_money(price));


cartBody.addEventListener('click', function(e){
    if(e.target.className == "delete"){
        console.log(e.target.id);
        preloader.style.display = 'block';

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost:8080/api/delete", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(e.target.id));

        xhr.onload = function() {
            preloader.style.display = 'none';
            let cart = JSON.parse(this.responseText).cart;
            let template = '';
            cart.forEach(item => {
                template = `
                <div class="cart-items d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center col-9 col-md-5" style="padding-left: 5px !important;">
                        <img src="/asset/img/${item.img}" alt="" width="100px" class="pic">
                        <div class="added-item-details">
                            <a href="/order">${item.title}</a>
                            <span>PHP ${format_money(item.price)} X (${item.quantity})</span>
                            <span>Total: PHP ${format_money(item.price * item.quantity)}</span>
                            <span>Addons</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center d-flex justify-content-between col-3">
                        <a href="/order?type=${item.category}&name=${item.title}" id="${item.id}">Edit</a>
                        <div class="total d-flex align-items-center">
                            <img src="/asset/img/cancel.png" alt="" srcset="" width="15px" id="${item.id}" class="delete">
                        </div>
                    </div>
                </div> 
                `
            });

            console.log(JSON.parse(this.responseText));
            cartBody.innerHTML = template;
            preloader.style.display = 'none';
            
        }

    }
});



