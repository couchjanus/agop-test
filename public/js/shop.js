function el(selector) {
    return document.querySelector(selector);
}

function makeProductItem($template, product) {
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
          console.log('Fetch Date :', jsondata);
          if (Array.isArray(jsondata)) {
            data = jsondata;
          } else {
            data = jsondata.products;
            document.querySelector('.forCategory').textContent = "For Category "+jsondata.name ;
          }
          dataList(data);
           
          let addToCarts = document.querySelectorAll('.add-to-cart');

          addToCarts.forEach(function(addToCart) {
                addToCart.addEventListener('click', function() {
                  let modal = document.querySelector('.modal');
                  let prod = this.closest('.card').querySelector('.product-name').textContent;
                  document.querySelector('#prductInCart').textContent = prod;
                  modal.style.display = "block";
                });
            });
            return data;
        })
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
    });
}

(function() {
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
})();
