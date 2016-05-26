<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class MailController extends Controller
{
    public function create()
    {
    	return view('emails.contact');
    }
}
