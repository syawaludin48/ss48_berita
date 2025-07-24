<?php

namespace Modules\ManageHargaFront\Controllers;

use App\Controllers\BaseController;
use Modules\ManageHargaFront\Models\ModelHarga;

class Harga extends BaseController
{
	protected $session;
	protected $ModelHarga;

	public function __construct(){
		$this->ModelHarga = new ModelHarga();
	}

	public function index()
	{
		$contact = $this->ModelHarga->get_contact();

        $data = [
			'seg1' => $this->request->uri->getSegment(1),
			'title' => "Daftar Paket",
			'judul' => "PAKET BELAJAR MANUAL / MATIC",
			'contact' => $contact,
		];
		
		return view('Modules\ManageHargaFront\Views\harga', $data);
	}
	
	
}
