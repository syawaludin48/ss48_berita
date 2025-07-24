<?php

namespace Modules\ManageLayoutFront\Controllers;

use App\Controllers\BaseController;
use Modules\ManageLayoutFront\Models\ModelLayout as ModelLayout;

class Layout extends BaseController
{
	protected $session;
	protected $ModelLayout;

	public function __construct(){
		$this->session = service('session');

		$this->ModelLayout = new ModelLayout();

	}


	public function index()
	{
		$contact = $this->ModelLayout->get_contact();

        $data = [
			'seg1' => $this->request->uri->getSegment(1),
			'title' => $contact['nama_website'],
			'contact' => $contact,
		];
		
		return view('Modules\ManageLayoutFront\Views\home', $data);
	}
	
}
