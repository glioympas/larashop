<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Product;
use App\Cart;
use App\Order;

use Auth;

use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::all();
    	return view('shop.index', compact('products'));
    }

    public function addToCart(Request $request, $id)
    {
    	$product = Product::findOrFail($id);
    	$oldCart = Session::has('cart') ? Session::get('cart') : null;

    	$cart = new Cart($oldCart);
    	$cart->add($product , $product->id);

    	//save cart to session
    	$request->session()->put('cart' , $cart);
    	return ['added'=>'ok']; //returning the json for the AJAX request
    }

    public function shoppingCart()
    {
    	if(!Session::has('cart'))
    		return view('shop.shopping-cart');

    	$oldCart = Session::get('cart');
    	$cart = new Cart($oldCart);

    	return view('shop.shopping-cart', [
    		'products' => $cart->items,
    		'totalQty' => $cart->totalQty,
    		'totalPrice' => $cart->totalPrice
    	]);
    }


    public function checkout()
    {
    	if(!Session::has('cart'))
    		return redirect()->route('products.shoppingCart');

    	$oldCart = Session::get('cart');
    	$cart = new Cart($oldCart);

    	$total = $cart->totalPrice;
    	return view('shop.checkout', compact('total'));

    }

    public function emptyCart(Request $request)
    {
    	if(Session::has('cart'))
    		$request->session()->forget('cart'); //Delete cart from the session , simply as that.

    	return ['empty'=>'ok']; //returning the json for the AJAX request.
    }

    public function postCheckout(Request $request)
    {
    	if(!Session::has('cart'))
    		return redirect()->route('products.shoppingCart');

    	$oldCart = Session::get('cart');
    	$cart = new Cart($oldCart);


    	Stripe::setApiKey('sk_test_IjIBnm0ER3kWStMiSQint6Tq');
    	try{
    		$charge = Charge::create(array(
    			"amount" => $cart->totalPrice * 100,
    			"currency" => "usd",
    			"source" => $request->stripeToken,
    			"description" => "Testing Charge for demonstration. Love programming."
    		));

        $order = new Order(); //without mass assign. just for reference
        $order->cart = serialize($cart);
        $order->address = $request->address;
        $order->name = $request->name;
        $order->payment_id = $charge->id; //by stripe.

        Auth::user()->orders()->save($order);

    	}catch(\Exception $e)
    	{
    		return redirect()->route('checkout')->with('error',$e->getMessage());
    	}



    	Session::forget('cart');
    	return redirect()->route('products.index')->with('success','Successfully buyed.');

    }


}
