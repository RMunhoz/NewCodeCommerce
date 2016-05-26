<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function __construct(Category $category, Product $product)
    {
    	$this->categoryModel = $category;
    	$this->productModel = $product;
    }

    public function index()
    {
    	$pFeatured = $this->productModel->featured()->get();
    	$pRecommend = $this->productModel->recommend()->get();
    	$categories = $this->categoryModel->all();
    	return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
    }

}
