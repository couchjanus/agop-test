@extends('layouts.front')
@section('title', 'Homepage')
@section('page')

    <div class="col-12 my-4">
      <h2>Products <span class="forCategory"></span></h2>
    </div>
  
    <input type="hidden" id="providerURL" value="/api/products" />
 
    <div class="showcase row"></div>
    
    

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


  <template id="cartItem">
    <div class="cart-item">
        <div class="item item-name"><span class="item-title"></span><i
                class="far fa-times-circle float-right remove-item"></i></div>
        <div class="item item-img"> </div>

        <div class="item item-quontity">
            <i class="fas fa-minus-circle adding minus"></i>
            <span class="adding quontity">1</span>
            <i class="fas fa-plus-circle adding plus"></i>
        </div>
        <div class="item">$<span class="item-price">00.00</span></div>
    </div>
</template>

@endsection