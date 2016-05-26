<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function place(CheckoutService $checkoutService, Order $orderModel, OrderItem $orderItem)
    {
    	if(!Session::has('cart'))
    	{
    		return false;
    	}

    	$cart = Session::get('cart');

    	if($cart->getTotal() > 0){

            $checkout = $checkoutService->createCheckoutBuilder();

    		$order = $orderModel->create(['user_id'=>Auth::user()->id, 'total'=>$cart->getTotal()]);

    		foreach($cart->all() as $k=>$item){
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'],2,".", ""), $item['qtd']));
    			$order->items()->create(['product_id'=>$k, 'price'=>$item['price'], 'qtd'=>$item['qtd']]);
    		}

            $cart->clear();

            $categories = Category::all();

            event(new CheckoutEvent(Auth::user(), $order));

            $response = $checkoutService->checkout($checkout->getCheckout());
    		
            return redirect($response->getRedirectionUrl());
    	}
        
        $categories = Category::all();
        $products = Product::all();
        
        return view('store.checkout', ['cart'=>'empty', 'categories'=>$categories]);
                                        
    }

    public function teste(CheckoutService $checkoutService)
    {
        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        return redirect($response->getRedirectionUrl());

    }
}
