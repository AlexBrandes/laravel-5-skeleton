<?php namespace App\Http\Controllers\Admin;

class BaseController extends \App\Http\Controllers\Controller {

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
}