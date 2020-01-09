<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;

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
            $product = Product::where('id', $item->id)->with('categories')->with('images')->with('brand')->first();
            $product['quantity'] = $item->quantity;
            $products->push($product);
        }

        // return Response::json($products);

        return view('profile.order', compact('products'));
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
    
    public function ship(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        // Ship order...
        Mail::to($request->user())->send(new OrderShipped($order));
        return redirect()->route('order.index')->with('success','Your Order Ship Sended Successfully.');
    }
}
