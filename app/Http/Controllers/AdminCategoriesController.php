<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Requests\CategoryRequest;
use CodeCommerce\Http\Controllers\Controller;

class AdminCategoriesController extends Controller
{
	private $categoryModel;

    public function __construct(Category $category)
    {
    	$this->categoryModel = $category;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
    	$categories = $this->categoryModel->paginate(5);

    	return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        $category = $this->categoryModel->fill($input);
        $category->save();
        Session::flash('message-success', 'Category, adicionada com sucesso!!!');
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->categoryModel->find($id)->delete();
        Session::flash('message-error', 'Category, deletada com sucesso!!!');
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    { 
        $this->categoryModel->find($id)->update($request->all());
        Session::flash('message-success', 'Category, modificada com sucesso!!!');
        return redirect()->route('categories.index');
    }

}
