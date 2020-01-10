@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $url, 'color' => 'success'])
View Order
@endcomponent

@component('mail::panel')
This is the panel content.

@endcomponent
@component('mail::table')
| Images       | Product      | Price        | Amount   |
| -------------|:------------:| ----------:  | ---------: |
@foreach($invoice as $product)
| <img src="{{ asset('/storage/'.$product->images[0]->filepath) }}" alt="{{ $product->name }}" width="200px">      | {{ $product->name }}      | {{ $product->price }}        | {{ $product->quantity }}   |
@endforeach
| {{ $order->id }}     | {{ $order->updated_at }} | {{ $order->grand_total }}      | {{ $order->item_count }}      |
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
