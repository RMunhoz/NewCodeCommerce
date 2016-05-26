<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class TestController extends Controller
{
    public function getLogin()
    {
    	$data = [
    		'email'		=>	'rogerio_munhoz@hotmail.com.br',
    		'password'	=>	'123456'
    	];

    	if(Auth::check()){
    		return "logado";
    	}
    	return "falhou";
    }	

    public function getLogout()
    {
		Auth::logout();

		if(Auth::check()){
		return "logado";
		}
		return "Não esta logado";	
    }
    
}
