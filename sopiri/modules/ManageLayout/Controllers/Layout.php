<?php

namespace Modules\ManageLayout\Controllers;

use App\Controllers\BaseController;
use Modules\ManageLayout\Models\ModelLayout as ModelLayout;

class Layout extends BaseController
{
	protected $session;
	protected $ModelLayout;

	public function __construct(){

		$this->session = service('session');
		$this->auth = service('authentication');

		$this->ModelLayout = new ModelLayout();

	}


	public function admin()
	{
		return redirect()->to('manage-home');
	}

	public function index()
	{
		if (! $this->auth->check())
		{
			return redirect()->to('login');
		}


        $data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Dashboard',
			'title' => 'Admin',
		];
		
		return view('Modules\ManageLayout\Views\home',$data);
	}
	
}
