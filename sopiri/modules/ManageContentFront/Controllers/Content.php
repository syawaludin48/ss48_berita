<?php

namespace Modules\ManageContentFront\Controllers;

use App\Controllers\BaseController;
use Modules\ManageContentFront\Models\ModelContent;

class Content extends BaseController
{
	protected $session;
	protected $ModelContent;

	public function __construct(){
		$this->session = service('session');

		$this->ModelContent = new ModelContent();

	}

	public function index($slug)
	{
		$content = $this->ModelContent->get_content($slug);
		$contact = $this->ModelContent->get_contact();
		
		$rand = $content['random'];
		$total = $content['view'] + 1;
		//add view
		$this->ModelContent->add_view($rand,$total);

		$recent = $this->ModelContent->get_recent(5);


        $data = [
			'seg1' => $this->request->uri->getSegment(1),
			'title' => $content['nama_content'],
			'content' => $content,
			'recent' => $recent,
			'contact' => $contact,
		];
		
		return view('Modules\ManageContentFront\Views\content', $data);
	}
	
}
