function el(selector) {
    return document.querySelector(selector);
}

function makeProductItem($template, product) {
    $template.querySelector('.card').setAttribute('productId', product.id);
    $template.querySelector('.product-name').textContent = product.name;
    $template.querySelector('.product-price').textContent = product.price;
    $template.querySelector('.product-description').textContent = product.description;
    $template.querySelector('.card-img-top').setAttribute('src', '/storage/'+product.images[0].filepath);
    return $template;
}
 
function dataList(data){
  document.querySelector('.showcase').innerHTML = '';
  const template = el('#productItem').content;
  data.forEach(function(el) {
    document
        .querySelector('.showcase')
        .append(makeProductItem(template, el).cloneNode(true));
  });
}

function init(url) {
  fetch(url)
    .then(function(response) {
        if (response.status !== 200) {
            console.log(
                'Looks like there was a problem. Status Code: ' +
                    response.status
            );
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

          document.querySelector('.cart-items').addEventListener(
            'click',
            function(e) {
                if (e.target && e.target.matches('.remove-item')) {
                    let index = e.target.closest('.cart-item').getAttribute('id');
                    removeProduct(index);
                    e.target.parentNode.parentNode.remove();
                    updateTotal();
                }
                if (e.target && e.target.matches('.plus')) {
                    let el = e.target;
                    let price = parseFloat(
                        el.parentNode.nextElementSibling
                            .querySelector('.item-price')
                            .getAttribute('price')
                    );

                    let id = el.closest('.cart-item').getAttribute('id');
                    plusProduct(id);
                    let val = parseInt(el.previousElementSibling.innerText);
                    val = el.previousElementSibling.innerText = val + 1;
                    
                    el.parentNode.nextElementSibling.querySelector(
                        '.item-price'
                    ).innerText = parseFloat(price * val).toFixed(2);
                    updateTotal();
                }

                if (e.target && e.target.matches('.minus')) {
                    let el = e.target;
                    let price = parseFloat(
                        el.parentNode.nextElementSibling
                            .querySelector('.item-price')
                            .getAttribute('price')
                    );
                    
                    let val = parseInt(el.nextElementSibling.innerText);
                    let id = el.closest('.cart-item').getAttribute('id');
                    if (val > 1) {
                        minusProduct(id);
                        val = el.nextElementSibling.innerText = val - 1;
                    }
                    el.parentNode.nextElementSibling.querySelector(
                        '.item-price'
                    ).innerText = parseFloat(price * val).toFixed(2);
                    updateTotal();
                }
            },
            false
        );
          return data;
        })
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
    });
}

(function() {
    initStorage();
      
    if (localStorage) {
        console.log("It's basket storage");
    }

    const url = document.getElementById('providerURL').value;
    data = init(url);
    let categoryUrl = document.querySelectorAll('.category');
    categoryUrl.forEach(function(u) {
      u.addEventListener('click', function() {
        let urlPath = document.getElementById('providerURL');
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

    document.querySelector('.js-close').addEventListener('click', function(){
      let modal = document.querySelector('.modal');
      modal.style.display = "none";
    });

    document.querySelector(".cart-link").addEventListener("click", () => openCart());
    document.querySelector(".overlay").addEventListener("click", () => closeCart());
    document.querySelector("#dismiss").addEventListener("click", () => closeCart());

})();

function openCart() {
  showCart();
  document.getElementById("cart").classList.toggle("active");
  document.querySelector(".overlay").classList.toggle("active");
}

function closeCart() {
  document.getElementById("cart").classList.remove("active");
  document.querySelector(".overlay").classList.remove("active");
}

function initStorage() {
  window.localStorage.getItem("basket") ?
    window.localStorage.getItem("basket") :
    window.localStorage.setItem("basket", JSON.stringify([]));
}

class Product {
  constructor(id, name, price, picture, amount) {
    this.id = id;
    this.name = name;
    this.price = price;
    this.picture = picture;
    this.amount = amount;
  }
}


function getProducts() {
  return JSON.parse(window.localStorage.getItem("basket"));
}

function addProductToCart(content, item) {
  content.querySelector('.item-title').textContent = item.querySelector(
      '.product-name'
  ).textContent;

  content.querySelector('.item-price').textContent = item.querySelector(
      '.product-price'
  ).textContent;

  content
      .querySelector('.item-price')
      .setAttribute(
          'price',
          item.querySelector('.product-price').textContent
      );

  content.querySelector('.item-img').style.backgroundImage =
      'url(' + item.querySelector('img').getAttribute('src') + ')';
  return content;
}

function dataItem(id) {
  return data[id];
}

function getProductItem(item) {
  var picture = item.images[0].filepath;
  return {
    id: item.id,
    price: item.price,
    name: item.name,
    picture: "/storage/" + picture
  };
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
          1
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


function plusProduct(id){
  let tmpProducts = getProducts();
  tmpProducts.forEach(elem => {
      if(elem.id === +(id)){
        elem.amount += 1;
      }
  });
  window.localStorage.setItem("basket",JSON.stringify(tmpProducts));
}

function minusProduct(id){
  let tmpProducts = getProducts();
  tmpProducts.forEach(elem => {
      if(elem.id === +(id)){
        elem.amount -= 1;
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
  content.querySelector('.item-price'
  ).innerText = parseFloat(item.price * item.amount).toFixed(2);
  return content;
}

function updateTotal() {
  var quantities = 0,
  total = 0,
  $cartTotal = document.querySelector('.subtotalTotal span'),
  items = document.querySelector('.cart-items').children;
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
  document.querySelector(".cart-items").innerHTML = '';
  shoppingCart.forEach(function (item) {
      let template = document.getElementById("cartItem").content;
      productInCart(template, item);
      
      document.querySelector(".cart-items").append(document.importNode(productInCart(template, item), true));

  });
  updateTotal();
}
