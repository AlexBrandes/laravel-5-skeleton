<?php namespace App\Http\Controllers\Admin;

class IndexController extends BaseController {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make('admin/index');
	}
	
}