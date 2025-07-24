<?php

namespace Modules\ManageContactFront\Controllers;

use App\Controllers\BaseController;
use Modules\ManageContactFront\Models\ModelContact;

class Contact extends BaseController
{
	protected $session;
	protected $ModelContact;

	public function __construct(){
		$this->ModelContact = new ModelContact();
	}

	public function index()
	{
		$contact = $this->ModelContact->get_contact();

        $data = [
			'seg1' => $this->request->uri->getSegment(1),
			'title' => "Kontak Kami",
			'judul' => "Kontak Kami",
			'contact' => $contact,
		];
		
		return view('Modules\ManageContactFront\Views\kontak', $data);
	}
	
	
}
