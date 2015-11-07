<?php namespace Modules\Index\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class IndexController extends Controller {
	
	public function index()
	{
		return view('index::index');
	}
	
}