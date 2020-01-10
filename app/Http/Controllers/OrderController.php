<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

use App\Order;
use App\Product;
use App\OrderItem;

use Illuminate\Support\Collection;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        // Create a new collection instance.
        $collection = new Collection($data['cart']);

        $item_count = $collection->sum('amount');
        $getSubTotal = $collection->map(function ($item, $k) {
            return ($item['price']*$item['amount']);
        });
        $grand_total = $getSubTotal->sum();
       
        $order = Order::create([
            'user_id'           => $data['user_id'],
            'status'            =>  'pending',
            'grand_total'       =>  $grand_total,
            'item_count'        =>  $item_count,
            'payment_status'    =>  0,
            'payment_method'    =>  null,
        ]);

        if ($order) {

            foreach ($collection as $item)
            {
                $orderItem = new OrderItem([
                    'product_id'    =>  $item['id'],
                    'quantity'      =>  $item['amount'],
                    'price'         =>  $item['price']
                ]);

                $order->items()->save($orderItem);
            }
        }

        $response = [
            'status' => 'success',
            'message' => 'order stored',
        ];
        return response()->json($response);
    }

    public function index()
    {
        return Order::all();
    }

    public function show(Order $order)
    {
        // return Response::json($order);
        $items = OrderItem::where('order_id', $order->id)->get();

        // return Response::json($items);
        $products = collect([]);

        foreach ($items as $item) {
            $product = Product::where('id', $item->product_id)->with('categories')->with('images')->with('brand')->first();
            $product['quantity'] = $item->quantity;
            $products->push($product);
        }

        // return Response::json($products);

        return view('profile.order', compact('products', 'order'));
    }

    public function findOrderById($id)
    {
        return Order::where('id', $id)->first();
    }
    public function newOrder(Request $request)
    {
        $data = $request->json()->all();

        $response = [
            'status' => 'success',
            'message' => 'order stored',
        ];
        return response()->json($response);
    }
    
    public function orderShipped(Request $request, $id)
    {
        // Ship order...
        $order = Order::findOrFail($id);
        $items = OrderItem::where('order_id', $order->id)->get();
        $invoice = collect([]);

        foreach ($items as $item) {
            $product = Product::where('id', $item->product_id)->with('categories')->with('images')->with('brand')->first();
            $product['quantity'] = $item->quantity;
            $invoice->push($product);
        }
            
        Mail::to($request->user())->send(new OrderShipped($invoice, $order));

        if (Mail::failures()) {
            return redirect()->route('profile.orders')->with('info','Sorry! Please try again latter');
        }else{
            return redirect()->route('profile.orders')->with('success','Great! Your Order Ship Sended Successfully in your mail.');
        }
    }
}
