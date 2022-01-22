

const deleteBtn = document.querySelectorAll('.delete');
const preloader = document.querySelector('.pre-loader');
const cartBody = document.querySelector(".cart-body");
const subTotals = document.querySelectorAll('.subtotal');
const amount = document.querySelector('.amount');
const empty_cart = document.querySelector('.empty-cart-notification');

const layout = {
    pizza: function(size, condiments, pizza_cut, Instruction, quantity){
        let template = `
            <span><b>size</b>: ${size}</span>
            <span><b>condiments</b>: ${condiments}</span>
            <span><b>pizza cut</b>: ${pizza_cut}</span>
            <span><b>Instruction</b>: ${Instruction}</span>
            <span><b>Quantity</b>: ${quantity}</span>
        `;
        return template;
    },
    solo_meals: function(size, Instruction, quantity){
        let template = `
                <span><b>Plate size</b>: ${size}</span>
                <span><b>Instruction</b>: ${Instruction}</span>
                <span><b>Quantity</b>: ${quantity}</span>
            `;
        return template;
    },
    pasta: function(size, Instruction, quantity){
        let template = `
            <span><b>Plate size</b>: ${size}</span>
            <span><b>Instruction</b>: ${Instruction}</span>
            <span><b>Quantity</b>: ${quantity}</span>
        `;
         return template;
    },
    group_meals: function(size, Instruction, quantity){
        let template = `
                <span><b>Plate size</b>: ${size}</span>
                <span><b>Instruction</b>: ${Instruction}</span>
                <span><b>Quantity</b>: ${quantity}</span>
            `;
        return template;
    }
};

function generateAddons(category, options){
    let template;
    switch(category){
        case 'Pizza':
            template = layout.pizza(options.size, options.condiments, options.pizza_cut, options.Instruction, options.number);
        break;
        case 'Pasta':
            template = layout.pasta(options.size, options.Instruction, options.number);
        break;
        case 'Group Meals':
            template = layout.group_meals(options.size, options.Instruction, options.number);
        break;
        case 'Solo Meals':
            template = layout.solo_meals(options.size, options.Instruction, options.number);
        break;
    }
    return template;
}

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
        xhr.open("POST", "/api/delete", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(e.target.id));

        xhr.onload = function() {
            preloader.style.display = 'none';
            let cart = JSON.parse(this.responseText).cart;
            let subtotal = JSON.parse(this.responseText).subtotal;
            let cart_count = JSON.parse(this.responseText).cartNum;
            let template = '';
            console.log(cart_count);

            cart.forEach(item => {
                template += `
                <div class="cart-items d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center col-9 col-md-5" style="padding-left: 5px !important;">
                        <img src="/asset/img/${item.img}" alt="" width="100px" class="pic">
                        <div class="added-item-details">
                            <a href="/order">${item.title}</a>
                            <span>PHP ${format_money(item.price)} X (${item.options.number})</span>
                            <span>Total: PHP ${format_money(item.price * item.options.number)}</span>
                            <span>Addons</span>
                            <div class="addons">
                                ${generateAddons(item.category, item.options)}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center d-flex justify-content-between col-3">
                        <a href="/order?type=${item.category}&name=${item.title}" id="${item.id}">Edit</a>
                        <div class="total d-flex align-items-center">
                            <img src="/asset/img/cancel.png" alt="" srcset="" width="15px" id="${item.CartItemId}" class="delete">
                        </div>
                    </div>
                </div> 
                `
            });

            subTotals.forEach(span => {
                span.textContent = 'PHP ' + format_money(subtotal);
            });

            amount.textContent = cart_count;

            console.log(JSON.parse(this.responseText));
            cartBody.innerHTML = template;
            preloader.style.display = 'none';

            if(cart_count == 0){
                cartBody.innerHTML = `   
                    <div class="empty-cart" style="padding: 50px 0; text-align: center;">
                        <p>Your cart is currenly empty. It seems the right time to start ordering</p>
                        <a href="/order">Order here</a>
                    </div>
                `;
            }

            
            
            
        }

    }
});

console.log(document.querySelector('.empty-cart'));



