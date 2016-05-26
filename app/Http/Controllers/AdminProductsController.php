<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use CodeCommerce\Tag;
use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Requests\ProductRequest;
use CodeCommerce\Http\Requests\ProductImageRequest;
use CodeCommerce\Http\Controllers\Controller;

class AdminProductsController extends Controller
{
    private $productsModel;

    public function __construct(Product $product)
    {
    	$this->productModel = $product;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
    	$products = $this->productModel->paginate(10);

    	return view('admin.products.index', compact('products'));
    }

    public function create(Category $category)
    {
        $categories = $category->lists('name', 'id');
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $input = $request->all();
        $input['recommend'] = $request->get('recommend') ? true : false;
        $input['featured'] = $request->get('featured') ? true : false;
        $arrayTags = $this->tagToArray($input['tags']);
        $product = $this->productModel->fill($input);
        $product->save();
        $product->tags()->sync($arrayTags);
        Session::flash('message-success', 'Product, adicionado com sucesso!!!');
        return redirect()->route('products.index');
    }

    private function tagToArray($tags)
    {
        $tags = explode(",", $tags);
        $tags = array_map('trim', $tags);

        $tagCollection = [];
        foreach ($tags as $tag) {
            $t = Tag::firstOrCreate(['name' => $tag]);
            array_push($tagCollection, $t->id);
        }

        return $tagCollection;
    }

    public function edit(Category $category, $id)
    {
        $categories = $category->lists('name', 'id');
        $product = $this->productModel->find($id);
        $product->tags = $product->tag_list;
        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $input = $request->all();
        $input['featured'] = $request->get('featured') ? true : false;
        $input['recommend'] = $request->get('recommend') ? true : false;

        $arrayTags = $this->tagToArray($input['tags']);

        $this->productModel->find($id)->update($input);

        $product = $this->productModel->find($id);
        $product->tags()->sync($arrayTags);
        Session::flash('message-success', 'Product, editado com sucesso!!!');
        return redirect()->route('products.index');;
    }

    public function destroy($id)
    {
        $this->productModel->find($id)->delete();
        Session::flash('message-error', 'Product, deletado com sucesso!!!');
        return redirect()->route('products.index'); 
    }

    public function images($id)
    {
        $product = $this->productModel->find($id);
        return view('admin.products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->productModel->find($id);
        return view('admin.products.create_image', compact('product'));
    }

    public function storeImage(ProductImageRequest $request, $id, ProductImage $productImage)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);
        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));
        //Session::flash('message-success', 'Image incluida com sucesso!!!');
        return redirect()->route('products.images',['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);
        if (file_exists(public_path().'/uploads/'.$image->id.'.'.$image->extension)) {
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
        }        
        $product = $image->product;
        $image->delete();
        Session::flash('message-error', 'Imagem, deletada com sucesso!!!');
        return redirect()->route('products.images', ['id'=>$product->id]);
    }


}
