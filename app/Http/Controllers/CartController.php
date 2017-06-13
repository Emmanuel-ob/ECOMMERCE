<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;
use Auth;
use Session;
use Stripe\Charge;
use Stripe\Stripe;



class CartController extends Controller
{
	private $product;
    
   
    public function __construct(Product $productModel){
        //parent::__construct();
        $this->product = $productModel;
        
    }
    
    //Add to cart
     public function add(Request $request, $id)
    {
    $product_from_db = Product::find($id);
    $product = [];
    
    //you can add all data you need like this etc...
    $itemId = $product_from_db->id;
    $itemName = $product_from_db->name;
    $itemPrice = $product_from_db->price;
    $quantity = $request->quantity;   
    $checker = "product.$itemName";
    $itemCum_price = $itemPrice * $quantity;
    
    $product = ['name' => $itemName, 'price' => $itemPrice, 'quantity' => $quantity, 'id' => $itemId];
    if (\Session::has($checker)){
        $product['quantity'] = \Session::get($checker)['quantity'] + $quantity;        
        $product['price'] = \Session::get($checker)['price'] + ($quantity * $itemPrice);        
        \Session::pull($checker);
        \Session::put($checker, $product);
        //$data = \Session::get('product');
        //dd($data);
    } else {
      \Session::put($checker, $product);
        }
    

    return redirect()->back();
}
    
    //Display all product from DB
    public function show()
    {  
    $items = $this->product->all(); 
    return view('cart', compact('items'));
    }
    
    //shows items in cart
    public function showCart()
    {   

    $totalAmount =0;
    if(\Session::has('product')){   
    foreach(\Session::get('product') as $element ){
    $totalAmount += $element['price'];
    } 
     }
    #dd($totalAmount);
    return view('viewCart', compact('totalAmount'));
    }

   //Removes a particular item from cart
    public function remove(Request $request)
    {  
      $product = [];
      $itemIdentifier = $request->itemName;
      $checking = "product.$itemIdentifier";
      if( \Session::has($checking)){
        \Session::forget($checking);
      } 
         return redirect()->back();
    }
    
    //This clears the cart
    public function removeAll(Request $request)

    {
      \Session::forget('product'); 
       
    return redirect()->to('/cart');
      
     }

    //Renders image view page  
    public function image()
    {
       
    return view('imageUpload');
      
     }

      //saves image
      public function saveImage(Request $request)

    {
        //$user = 'Emma';
        $userId = 2;
        $file = $request->file('image');
        $fileName = $request['firstName'] . '-' . $userId . '.jpg';
        if($file){
            Storage::disk('local')->put($fileName, File::get($file));
        } 
    return redirect()->back();
      
     }
    
    //Fetches image to image source in template
    public function getImage($fileName)

    {
      $file = Storage::disk('local')->get($fileName);
    return new Response($file, 200);
     }


     public function getCheckout(Request $request)
    {

        
        if(!\Session::has('product')){   
         
        return redirect()->to('/cart');
       }


        if(!Auth::check()){
          Session::put('oldUrl', $request->url());
          return redirect()->route('user.signin');
        }
       
       $total =0;
       foreach(\Session::get('product') as $element ){
        $total += $element['price'];
        }
        
        return view('shop.checkout', ['total' => $total]);
    }

     public function postCheckout(Request $request)
    {

        if(!\Session::has('product')){   
         
        return redirect()->to('/cart');
       }

       if(!Auth::check()){
          return redirect()->route('user.signin');
       }       
         $total =0;
       foreach(\Session::get('product') as $element ){
        $total += $element['price'];
        }

        Stripe::setApiKey('sk_test_d3ynGiMqexM8klRSXdzQcAjl');

        try {
            $charge = Charge::create(array(
                "amount" => $total * 100,
                "currency" => "ngn",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $cart = \Session::get('product');
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;
            
            Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        \Session::forget('product');
        return redirect()->route('cart')->with('success', 'Successfully purchased products!');
    }

    
}
