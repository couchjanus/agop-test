function el(selector) {
    return document.querySelector(selector);
}

function openCart() {
  showCart();
  el("#cart").classList.toggle("active");
  el(".overlay").classList.toggle("active");
}

function closeCart() {
  el("#cart").classList.remove("active");
  el(".overlay").classList.remove("active");
}

function initStorage() {
  window.localStorage.getItem("basket") ?
    window.localStorage.getItem("basket") :
    window.localStorage.setItem("basket", JSON.stringify([]));
}

function getProducts() {
  return JSON.parse(window.localStorage.getItem("basket"));
}

class Product {
  constructor(id, name, price, picture, amount=1) {
    this.id = id;
    this.name = name;
    this.price = price;
    this.picture = picture;
    this.amount = amount;
  }
}

function makeProductItem($template, product) {
    $template.querySelector('.card').setAttribute('productId', product.id);
    $template.querySelector('.product-name').textContent = product.name;
    $template.querySelector('.product-price').textContent = product.price;
    $template.querySelector('.product-description').textContent = product.description;
    $template.querySelector('.card-img-top').setAttribute('src', '/storage/'+product.images[0].filepath);
    return $template;
}

function getProductItem(prod) {
  return new Product(
    prod.id,
    prod.name,
    prod.price,
    "/storage/" +prod.images[0].filepath,
  );
}

function addProduct(prod) {
  let tmpProducts = getProducts();

  if (tmpProducts.length > 0) {
    let exist = tmpProducts.some(elem => {
      return elem.id === prod.id;
    });
    if (exist) {
      tmpProducts.forEach(elem => {
        if (elem.id === prod.id) {
          elem.amount += 1;
        }
      });
    } else {
      tmpProducts.push(
        new Product(
          prod.id,
          prod.name,
          prod.price,
          prod.picture,
        )
      );
    }
  } else {
    tmpProducts.push(
      new Product(prod.id, prod.name, prod.price, prod.picture, 1)
    );
  }
  window.localStorage.setItem("basket", JSON.stringify(tmpProducts));
}

function dataList(data){
  el('.showcase').innerHTML = '';
  const template = el('#productItem').content;
  data.forEach(function(e) {
    el('.showcase').append(makeProductItem(template, e).cloneNode(true));
  });
}

function init(url) {
  fetch(url)
    .then(function(response) {
        if (response.status !== 200) {
            console.log('Looks like there was a problem. Status Code: ' + response.status);
            return;
        }
        
        response.json().then(function(jsondata) {
          if (Array.isArray(jsondata)) {
            data = jsondata;
          } else {
            data = Object.keys(jsondata).map(i => jsondata[i])
          }
          dataList(data);
           
          let addToCarts = document.querySelectorAll('.add-to-cart');

          addToCarts.forEach(function(addToCart) {
            addToCart.addEventListener('click', function() {
                let id = this.closest('.card').getAttribute('productId');
                fetch('/api/product/' + id).then(response => {
                  response.json().then(dataitem => {
                    addProduct(getProductItem(dataitem));
                  });
                });

            });
          });
          
          el('.cart-items').addEventListener('click', function(e) {
            renderCartItem(e.target)}, false);
          return data;
        })
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
    });
}

function productPlusMinus(id, sign){
  let tmpProducts = getProducts();
  tmpProducts.forEach(elem => {
      if(elem.id === +(id)){
        if (sign == '-') {
          elem.amount -= 1;
        }
        else if (sign == '+') {
          elem.amount += 1;
        }
      }
  });
  window.localStorage.setItem("basket",JSON.stringify(tmpProducts));
}

function removeProduct(index){
  let tmpProducts = getProducts();
  tmpProducts.splice(tmpProducts.indexOf(tmpProducts.find(x => x.id === +(index))), 1);
  window.localStorage.setItem("basket",JSON.stringify(tmpProducts));
}

function productInCart(content, item) {
  content.querySelector('.cart-item').setAttribute('id', item.id);
  content.querySelector('.item-title').textContent = item.name;
  content.querySelector('.item-price').textContent = item.price;
  content.querySelector('.quontity').textContent = item.amount;
  content.querySelector('.item-price').setAttribute('price', item.price);
  content.querySelector('.item-img').style.backgroundImage= 'url('+ item.picture+")";
  content.querySelector('.item-price').innerText = parseFloat(item.price * item.amount).toFixed(2);
  return content;
}

function updateTotal() {
  var quantities = 0,
  total = 0,
  $cartTotal = el('.subtotalTotal span'),
  items = el('.cart-items').children;
  Array.from(items).forEach(function (item) {
      total += parseFloat(item.querySelector('.item-price').textContent);
  });
  $cartTotal.textContent = parseFloat(Math.round(total * 100) / 100).toFixed(2);
}

function showCart() {
  let shoppingCart = getProducts();
  if (shoppingCart.length == 0) {
      console.log("Your Shopping Cart is Empty!");
      return;
  }
  el(".cart-items").innerHTML = '';
  shoppingCart.forEach(function (item) {
      let template = document.getElementById("cartItem").content;
      el(".cart-items").append(document.importNode(productInCart(template, item), true));
  });
  updateTotal();
}

function renderCartItem(e) {
  let id = e.closest('.cart-item').getAttribute('id');
  if (e.matches('.remove-item')) {
      removeProduct(id);
      e.parentNode.parentNode.remove();
  } else {
    let price = parseFloat(e.closest('.cart-item').querySelector('.item-price').getAttribute('price'));
    let val = parseInt(e.closest('.cart-item').querySelector('.quontity').innerText);
   
    if (e.matches('.plus')) {
      productPlusMinus(id, '+')
      val = e.previousElementSibling.innerText = val + 1;
    }
    if (e.matches('.minus')) {
      if (val > 1) {
        productPlusMinus(id, '-')
        val = e.nextElementSibling.innerText = val - 1;
      }
    }
    e.parentNode.nextElementSibling.querySelector('.item-price').innerText = parseFloat(price * val).toFixed(2);
}
  updateTotal();
}

(function() {
    initStorage();
    const url = el('#providerURL').value;
    data = init(url);

    let categoryUrl = document.querySelectorAll('.category');
    categoryUrl.forEach(function(u) {
      u.addEventListener('click', function() {
        let urlPath = el('#providerURL');
        urlPath.value = "/api/category/"+this.getAttribute('categoryId');
        init(urlPath.value);
      });
    });

    var radios = document.getElementsByName('sorting');
    radios.forEach(function(r){
      r.addEventListener('change', function() {
        switch (this.value) {
          case 'low':
            data.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
            dataList(data);
            break;
          case 'high':
            data.sort((a, b) => -parseFloat(a.price) + parseFloat(b.price));
            dataList(data);
            break;
          case 'newest':
            data.sort((a, b) => new Date(a.created_at).getTime() - new Date(b.created_at).getTime());
            dataList(data);
            break;
          default:
            dataList(data);
        }
      });
    });
    el(".cart-link").addEventListener("click", () => openCart());
    el(".overlay").addEventListener("click", () => closeCart());
    el("#dismiss").addEventListener("click", () => closeCart());

    el(".checkout").addEventListener("click", () => {
      
      closeCart();
      
      if (localStorage.basket && localStorage.basket.length > 2) {
        let cart = getProducts();
        // console.log("Cart content: ", cart);

       
        
        console.log("user content: ", user.id);

        fetch("/api/cart", {
          method: "POST",
          body: JSON.stringify(cart),
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content
          },
          credentials: "same-origin",
          // body: getProducts(),
        })
        .then(function(response) {
            localStorage.removeItem("basket");
            initStorage();
            el(".cart-items").innerHTML = "";
            updateTotal();
            return response.text();
        })
        .then(text => {
          return console.log(text);
        })
        .catch(error => console.error("Looks like there was a problem. Error Code: ", error));
      }
    });
  
})();
