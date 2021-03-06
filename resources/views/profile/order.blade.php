@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3 mb-3">
            @include('profile.partials._menu')
        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-6">
                @foreach($products as $key => $product)
                    <div class="ux-card">
                        <img src="/storage/{{ $product->images[0]->filepath }}" height="32" width="32" />
                        <span class="title"><a href="">{{ $product->name }}</a></span>
                        Price: <span class="price">{{ $product->price }}</span>
                        Amount: <span class="quantity">{{ $product->quantity }}</span>
                        Subtotal: <span class="subtotal">104.00</span>
                        <span class="tier">Category: {{ $product->categories[0]->name }}</span>
                        <span class="renews">{{ $product->description }}</span>
                    </div>
                @endforeach
                </div>
                <div class="summary col-md-6">
                <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
                    <dl class="subtotal1">
                        <dt>Subtotal</dt>
                            <dd class="clean-total">$14.99</dd>
                        <dt><a href="">Estimated Taxes & Fees</a></dt>
                            <dd>$<span class="taxes">3.42</span></dd>
                    </dl>
                    <dl class="total">
                        <dt>Total</dt>
                            <dd><div class="summary-promo hide">
                                <div class="promo-title">Promotion</div>
                                <div class="promo-value final-value" id="basket-promo"></div>
                            </div></dd>
                            <dd><div class="total-value final-value" id="basket-total">130.00</div></dd>
                    </dl>
                    <dl class="support">
                        <dt><a href="">Total savings</a></dt>
                            <dd>$<span class="total-save">150.00</span></dd>
                            <dt>
                            <h4>Have a promo code?</h4>
                            <form class="form-inline">
                                <div class="input-group">
                                    <input id="promo-code" class="form-control-plaintext promo-code-field" name="promo-code" maxlength="5" placeholder="Enter a promotional code"> 
                                    <input type="button" class="btn btn-primary promo-code-btn" value="Apply">
                                </div>
                            </form>
                        </dt>
                    </dl>
                    <div class="payment">
                        <a href="payment/add">Add</a>
                        <h4 class="headline-primary">Payment</h3>

                        <div class="card">
                            <a href="/payment/{id}"><img
                                src="https://img1.wsimg.com/fos/react/sprite.svg#visa" height="32"
                                                width="50" /> John Doe</a>
                        </div>
                    </div>

                    <div class="terms">
                        <h3 class="headline-primary">Terms & Conditions</h3>
                        <p class="review">Clicking on "I Agree" means you agree to GoDaddy's <a href="terms/show">Terms & Conditions</a>.</p>
                        <p class="review"><strong>Products automatically</strong> renew until cancelled, and are billed to your payment method on file. Turn off auto-renew in your GoDaddy account.</p>
                        <p class="agreed">I've read and agreed to the <a href="terms/show">Term & Conditions</a>.</p>
                        <button type="button" class="btn btn-danger review">I Agree</button>
                    </div>
                    <div class="complete">
                        <a href="{{ route('order.ship', $order->id) }}">
                            <button type="button" disabled="disabled" class="btn btn-danger">Complete Purchase</button>
                        </a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var promoCode;
    var promoPrice;

    $(document).ready(function () {
      updateSumItems();
      updateSubtotal();
      updateTotal();
    });
   
    function updateSumItems() {
      var sumItems = 0;
      $('.quantity').each(function () {
        sumItems += parseInt($(this).text());
      });
      $('.total-items').text(sumItems);
    }

    function updateSubtotal() {
        $('.ux-card').each(function () {
            let subtotal = 0;
            subtotal += parseFloat($(this).children('.price').text())*
            parseFloat($(this).children('.quantity').text());
            $(this).children('.subtotal').text(subtotal);
        });
    }

    function updateTotal(promo=false) {
        var total = 0;
        if (promo) {
            var subtotal = 0;

            $('.ux-card').each(function () {
                subtotal += parseFloat($(this).children('.subtotal').text());
            });

            total = subtotal;

            //If there is a valid promoCode, and subtotal < 10 subtract from total
            var promoPrice = parseFloat($('.promo-value').text());
            if (promoPrice) {
                if (subtotal >= 10) {
                    total -= promoPrice;
                } else {
                    alert('Order must be more than $10 for Promo code to apply.');
                    $('.summary-promo').addClass('hide');
                }
            
                $('.clean-total').text(total);
                let tax = parseFloat($('span.taxes').text());
                $('#basket-total').text(tax + total);
                $('span.total-save').text(tax + total);
            }
        } else {
            $('.ux-card').each(function () {
                total += parseFloat($(this).children('.subtotal').text());
            });
            $('.clean-total').text(total);
            let tax = parseFloat($('span.taxes').text());
            $('#basket-total').text(tax + total);
            $('span.total-save').text(tax + total);
        }
    }

    $('.terms button').on('click', function () {
        $(".review").hide();
        $(".agreed").show();
        $(".complete button").removeAttr("disabled");
    });

    $('.agreed').on('click', function () {
        $(".review").show();
        $(".agreed").hide();
        $(".complete button").attr("disabled", "disabled");
    });

    $('.promo-code-btn').click(function () {

      promoCode = $('#promo-code').val();

      if (promoCode == '10off' || promoCode == '10OFF') {
        //If promoPrice has no value, set it as 10 for the 10OFF promocode
        if (!promoPrice) {
          promoPrice = 10;
        } else if (promoCode) {
          promoPrice = promoPrice * 1;
        }
      } else if (promoCode != '') {
        alert("Invalid Promo Code");
        promoPrice = 0;
      }

      //If there is a promoPrice that has been set (it means there is a valid promoCode input) show promo
      if (promoPrice) {
        $('.summary-promo').removeClass('hide');
        $('.promo-value').text(promoPrice.toFixed(2));
        updateTotal(true);
      }
    });

</script>
@endpush