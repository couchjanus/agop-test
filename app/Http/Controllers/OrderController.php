<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderItem;
use Auth;

use Illuminate\Support\Collection;

class OrderController extends Controller
{
    protected $user;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           $this->user = Auth::user();
            return $next($request);
        });
    }

    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // Create a new collection instance.
        $collection = new Collection($data);
        // dump($request);

        $item_count = $collection->sum('amount');
        // dump($item_count);
        
        $getSubTotal = $collection->map(function ($item, $k) {
            return ($item['price']*$item['amount']);
        });
        $grand_total = $getSubTotal->sum();
        // dump($grand_total);

        // $user = auth()->user();
        // auth('api')->user()
        // $user = auth('api')->user();
        // if ($user){
        // dump($user->id);
        // } else {
        //     dump('No User');
        // }
        
        // $order = Order::create([
        //     'user_id'           => Auth::user()->id,
        //     'status'            =>  'pending',
        //     'grand_total'       =>  $grand_total,
        //     'item_count'        =>  $item_count,
        //     'payment_status'    =>  0,
        //     'payment_method'    =>  null,
        // ]);

        // if ($order) {

        //     foreach ($collection as $item)
        //     {
        //         // dump($item);
        //         // dump($item['id']);
        //         // dump($item['amount']);
        //         // dump($item['price']);
                
        //         $orderItem = new OrderItem([
        //             'product_id'    =>  $item['id'],
        //             'quantity'      =>  $item['amount'],
        //             'price'         =>  $item['price']
        //         ]);

        //         $order->items()->save($orderItem);
        //     }
        // }

        // return $order;

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
   
}
