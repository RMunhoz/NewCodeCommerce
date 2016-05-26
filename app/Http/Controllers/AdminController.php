<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class AdminController extends Controller
{

	public function __construct(){
       $this->middleware('auth');
       $this->middleware('admin');
       //$this->middleware('admin', ['only' =>['edit','update','destroy','create']]);
    }

   	public function index()
   	{
   		return view('admin.index');
   	}
}
