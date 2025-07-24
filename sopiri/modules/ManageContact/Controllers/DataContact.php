<?php

namespace Modules\ManageContact\Controllers;

use App\Controllers\BaseController;
use Modules\ManageContact\Models\ModelContact as ModelContact;
use CodeIgniter\I18n\Time;

class DataContact extends BaseController
{
	protected $session;
	protected $ModelContact;

	public function __construct(){
		$this->session = service('session');

		$this->ModelContact = new ModelContact();

	}

	public function contact_edit()
	{
		 
		$contact = $this->ModelContact->get_contact();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Contact Website',
			'contact' => $contact,
		];
		
		return view('Modules\ManageContact\Views\contact',$data);
	}
	

	public function contact_update()
	{
		 
		$rules = [
			'nama_website' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'email' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'no_telp' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'alamat' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'keterangan' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'icon_website'=> [
				'rules'  => 'max_size[icon_website,500]|is_image[icon_website]|mime_in[icon_website,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size'  => 'ukuran <b>{field}</b> anda terlalu besar !!!',
					'is_image'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
					'mime_in'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
				]
			],
			'logo_website'=> [
				'rules'  => 'max_size[logo_website,500]|is_image[logo_website]|mime_in[logo_website,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size'  => 'ukuran <b>{field}</b> anda terlalu besar !!!',
					'is_image'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
					'mime_in'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
				]
			],
			'logo_website_2'=> [
				'rules'  => 'max_size[logo_website_2,500]|is_image[logo_website_2]|mime_in[logo_website_2,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size'  => 'ukuran <b>{field}</b> anda terlalu besar !!!',
					'is_image'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
					'mime_in'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
				]
			]
		];

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

		$id_rand 		= filterdata($this->request->getPost('random'));
		$nama_website 		= filterdata($this->request->getPost('nama_website'));
		$slug_website 		= url_title(strtolower($nama_website));
		$email 		= filterdata($this->request->getPost('email'));
		$no_telp 		= filterdata($this->request->getPost('no_telp'));
		$alamat 	= php_tags($this->request->getPost('alamat'));
		$keterangan 	= php_tags($this->request->getPost('keterangan'));
		$img1 		= filterdata($this->request->getPost('img'));
		$img2 		= filterdata($this->request->getPost('img2'));
		$img3 		= filterdata($this->request->getPost('img3'));

        $logo_website = $this->request->getFile('logo_website');
        $logo_website2 = $this->request->getFile('logo_website_2');
        $icon_website = $this->request->getFile('icon_website');


		
		if($logo_website->getError() ==  4 ){
			$name_logo_website = $img1;

		}else{

			$name_logo_website = $logo_website->getRandomName();

			// $logo_website->move('assets/images/contact', $name_logo_website);
			
			$image = \Config\Services::image()
			->withFile($logo_website)
			->resize(150, 150, true, 'height')
			->save(FCPATH .'/assets/images/contact/'. $name_logo_website);

			$logo_website->move(WRITEPATH . 'uploads');


			if($img1 <> ''){
				if(file_exists('assets/images/contact/'.$img1)){
					unlink('assets/images/contact/'.$img1);
				}
			}


		}
		
		if($logo_website2->getError() ==  4 ){
			$name_logo_website2 = $img2;	

		}else{

			$name_logo_website2 = $logo_website2->getRandomName();

			// $logo_website->move('assets/images/contact', $name_logo_website);
						
			$image = \Config\Services::image()
			->withFile($logo_website2)
			->resize(150, 150, true, 'height')
			->save(FCPATH .'/assets/images/contact/'. $name_logo_website2);

			$logo_website2->move(WRITEPATH . 'uploads');

			if($img2 <> ''){
				if(file_exists('assets/images/contact/'.$img2)){
					unlink('assets/images/contact/'.$img2);
				}
			}


		}

		if($icon_website->getError() ==  4 ){
			$name_icon_website = $img3;	

		}else{

			$name_icon_website = $icon_website->getRandomName();

			// $logo_website->move('assets/images/contact', $name_logo_website);
						
			$image = \Config\Services::image()
			->withFile($icon_website)
			->resize(150, 150, true, 'height')
			->save(FCPATH .'/assets/images/contact/'. $name_icon_website);

			$icon_website->move(WRITEPATH . 'uploads');

			if($img3 <> ''){
				if(file_exists('assets/images/contact/'.$img3)){
					unlink('assets/images/contact/'.$img3);
				}
			}


		}

		$this->ModelContact->edit_contact_image($id_rand,$nama_website,$slug_website,$email,$no_telp,$alamat,$keterangan,$name_logo_website,$name_logo_website2,$name_icon_website);

		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Contact Website !' );
		return redirect()->to('/manage-contact-website'); 


	}

}
