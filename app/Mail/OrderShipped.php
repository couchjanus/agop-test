<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $invoice;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $order)
    {
        $this->order = $order;
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Shipped')
        ->markdown('emails.orders.shipped')
        ->with(['url'=>'http://my.cat', 'invoice'=>$this->invoice, 'order'=>$this->order]);
    }
}
