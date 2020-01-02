@extends('layouts.front')
@section('title', 'Homepage')
@section('content')

    <div class="col-12 my-4">
      <h2>Products <span class="forCategory"></span></h2>
    </div>
  
    <input type="hidden" id="providerURL" value="/api/products" />
 
    <div class="showcase row">
      
    </div>
<div class="modal js-modal">
        <div class="modal-image">
          <svg viewBox="0 0 32 32" style="fill:#48DB71"><path d="M1 14 L5 10 L13 18 L27 4 L31 8 L13 26 z"></path></svg>
        </div>
        <h3>Product <span id="prductInCart"></span> Added To Cart!</h3>
        <button class="js-close">Dismiss</button>
      </div>
<div class="wrap">
</div>

    <template id="productItem">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100" id="productId">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#" class="product-name"></a>
            </h4>
            <h5>$<span class="product-price"></span></h5>
            <p class="product-description card-text">
                  <span class="badge badge-success"></span>
            </p>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary add-to-cart">Add To Cart</button>
          </div>
        </div>
      </div>
  </template>

@stop