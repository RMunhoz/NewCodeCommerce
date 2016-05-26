<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Tag;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{
	private $categoryModel;
	private $productModel;
    private $tagModel;

    public function __construct(Category $category, Product $product, Tag $tag)
    {
    	$this->categoryModel = $category;
    	$this->productModel = $product;
        $this->tagModel = $tag;
    }

    public function index()
    {
    	$pFeatured = $this->productModel->featured()->get();
    	$pRecommend = $this->productModel->recommend()->get();
    	$categories = $this->categoryModel->all();
    	return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
    }

    public function category($id)
    {
    	$categories = $this->categoryModel->all();
    	$category = $this->categoryModel->find($id);
    	$products = $this->productModel->findCategory($id)->get();
    	return view('store.findCategory', compact('categories','category', 'products'));
    }

    public function product($id)
    {
        $categories = $this->categoryModel->all();
        $product = $this->productModel->find($id);
        return view('store.productDetails', compact('categories', 'product'));
    }

    public function tag($id)
    {
        $categories = $this->categoryModel->all();
        $tag = $this->tagModel->find($id);
        $products = $tag->products;
        return view('store.tag', compact('categories', 'products', 'tag'));
    }
}
