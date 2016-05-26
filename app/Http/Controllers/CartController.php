<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use CodeCommerce\Cart;
use CodeCommerce\Product;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class CartController extends Controller
{
	private $cart;
	//private $productModel;

	public function __construct(Cart $cart)
	{
		return $this->cart = $cart;
		//return $this->productModel = $product;
	}

    public function index()
    {
    	if(!Session::has('cart'))
    	{
    		Session::set('cart', $this->cart);
    	}
    	return view('store.cart', ['cart' => Session::get('cart')]);
    }

    public function add($id)
    {
    	$cart = $this->getCart();
    	$product = Product::find($id);
    	$cart->add($id, $product->name, $product->price);
    	Session::set('cart', $cart);
    	return redirect()->route('cart');
    }

    public function destroy($id)
    {
    	$cart = $this->getCart();
    	$cart->remove($id);
    	Session::set('cart', $cart);
    	return redirect()->route('cart');
    }

    private function getCart()
    {
    	if(Session::has('cart')){
    		$cart = Session::get('cart');
    	}else{
    		$cart = $this->cart;    		
    	}
    	return $cart;	
    }

    public function update(Requests\CartRequest $request, $id)
    {
        $qtd = $request->get("qtd");
        $cart = $this->getCart();
        $cart->setQtd($id, $qtd);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }
}

