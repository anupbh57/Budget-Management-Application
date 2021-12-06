var shippingCounter = 0;
var st = 0;
var sh = 0;
function productReader(productName, productPrice) {
    if (shippingCounter !== 0){
        pName = document.getElementById(productName).textContent;
        pPrice = document.getElementById(productPrice).textContent;
        cartNameWriter(pName, pPrice);

        var subTotal = document.getElementById('subtotal');
        var newSub = subTotal.textContent;

        var newPrice = pPrice.split(' ');
        console.log(newPrice[1]);
        var total = parseInt(newSub) + parseInt(newPrice[1]) ;
        subTotal.textContent = total;
        st = total;
        totalCalculator();
    }
        else {
        pName = document.getElementById(productName).textContent;
        pPrice = document.getElementById(productPrice).textContent;
        cartNameWriter(pName, pPrice);
        shippingCalculator();
        shippingCounter++;

        var subTotal = document.getElementById('subtotal');
        var newSub = subTotal.textContent;

        var newPrice = pPrice.split(' ');
        console.log(newPrice[1]);
        var total = parseInt(newSub) + parseInt(newPrice[1]) ;
        subTotal.textContent = total.toFixed(2);

        st = total;
        totalCalculator();
        }
}


function cartNameWriter(Name, Price) {
    var createName = document.createElement('li');
    createName.className = 'cart-prod';
    createName.appendChild(document.createTextNode(Name));
    var createPrice = document.createElement('span')
    createPrice.className = 'cart-quantity';
    createPrice.innerHTML = Price;
    createName.appendChild(createPrice);
    document.getElementById('cart-list').appendChild(createName);
}

function subTotalWriter() {
    var subTotal = document.getElementById('subtotal');
    var newSub = subTotal.textContent;
    var total = parseInt(newSub) + 99 ;
    subTotal.textContent = total;
}

function shippingCalculator() {
    var shipping = document.getElementById('shipping');
    var newShipping = shipping.textContent;
    totalShipping = parseInt(newShipping) + 15;
    shipping.textContent = totalShipping;
    sh = totalShipping;
}

function totalCalculator() {
    var subTotal = document.getElementById('total');
   var total =  parseInt(st) + parseInt(sh);
   subTotal.innerHTML = total;
    console.log(total);
}
totalCalculator();
