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
                    <div class="ux-card">
                        <img src="https://img1.wsimg.com/fos/react/sprite.svg#domains" height="32" width="32" />
                        <span class="title"><a href="">catstewardesses</a></span>
                        <span class="price">$12.99</span>
                        <span class="tier">.com</span>
                        <span class="term">1 year</span>
                        <span class="attr">Privacy: ON</span>
                        <span class="renews">Renews at $14.99/yr</span>
                        <button class="btn btn-canvas btn-xs remove" href="product/remove"><span
                            class="uxicon uxicon-trash"></span>Remove</button>
                    </div>
                </div>
                <div class="summary col-md-6">
                    <dl class="subtotal">
                        <dt>Subtotal</dt>
                            <dd>$14.99</dd>
                        <dt><a href="/taxes">Estimated Taxes & Fees</a></dt>
                            <dd>$3.42</dd>
                    </dl>
                    <dl class="total">
                        <dt>Total</dt>
                            <dd>$18.41</dd>
                    </dl>
                    <dl class="support">
                        <dt><a href="/savings/">Total savings</a></dt>
                            <dd>$150.00</dd>
                            <dt><a href="/promocode/add">Have a promocode?</a></dt>
                    </dl>
                    <div class="payment">
                        <a href="payment/add">Add</a>
                        <h4 class="headline-primary">Payment</h3>

                        <div class="ux-card">
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
                        <button type="button" disabled="disabled" class="btn btn-danger">Complete Purchase</button>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
