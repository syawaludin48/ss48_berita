<?php

namespace Modules\ManageContent\Controllers;

use App\Controllers\BaseController;
use Modules\ManageContent\Models\ModelContent;
use CodeIgniter\I18n\Time;

class DataKategori extends BaseController
{
	protected $session;
	protected $ModelContent;

	public function __construct(){
		$this->session = service('session');

		$this->ModelContent = new ModelContent();

	}

	public function kategori()
	{		
		$kategori = $this->ModelContent->get_content_kategori();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Content Kategori Webiste',
			'kategori' => $kategori,
		];
		
		return view('Modules\ManageContent\Views\kategori',$data);
	}

	public function menu_save()
	{
		 
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[menu.nama_menu]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'link' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'id_group' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'manage' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'status' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'nomor' => [
				'rules'  => 'required|alpha',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'alpha' 	=> '<b>{field}</b> harus karakter / alfabet !!!'
				]
			],
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'tambah');
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $nama_menu		= filterdata($this->request->getPost('name'));
		$slug_menu    	= url_title(strtolower($nama_menu));
        $link		= filterdata($this->request->getPost('link'));
        $id_group		= filterdata($this->request->getPost('id_group'));
        $manage		= filterdata($this->request->getPost('manage'));
        $status		= filterdata($this->request->getPost('status'));
        $no_urut		= filterdata($this->request->getPost('nomor'));

		$this->ModelContent->save_menu($nama_menu,$slug_menu,$link,$manage,$status,$no_urut,$id_group);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Menu !' );
		return redirect()->to('/manage-menu'); 

	}

	public function kategori_save()
	{
		 
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[content_kategori.nama_kategori]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'tambah');
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $nama_kategori		= filterdata($this->request->getPost('name'));
		$slug_kategori    	= url_title(strtolower($nama_kategori));

		$this->ModelContent->save_kategori($nama_kategori,$slug_kategori);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Content Kategori !' );
		return redirect()->to('/manage-content-kategori'); 

	}

	public function menu_update()
	{
		 
        $id_rand		= filterdata($this->request->getPost('random'));
		
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[menu.nama_menu,random,{random}]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'link' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'id_group' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'manage' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'status' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'nomor' => [
				'rules'  => 'required|alpha',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'alpha' 	=> '<b>{field}</b> harus karakter / alfabet !!!'
				]
			],
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'edit'.$id_rand);
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $nama_menu		= filterdata($this->request->getPost('name'));
		$slug_menu    	= url_title(strtolower($nama_menu));
        $link		= filterdata($this->request->getPost('link'));
        $id_group		= filterdata($this->request->getPost('id_group'));
        $manage		= filterdata($this->request->getPost('manage'));
        $status		= filterdata($this->request->getPost('status'));
        $no_urut		= filterdata($this->request->getPost('nomor'));
		
		$this->ModelContent->edit_menu($id_rand,$nama_menu,$slug_menu,$link,$manage,$status,$no_urut,$id_group);
		
		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Menu !' );
		return redirect()->to('/manage-menu'); 

	}

	public function kategori_update()
	{
		 
        $id_rand		= filterdata($this->request->getPost('random'));
		
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[content_kategori.nama_kategori,random,{random}]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'edit'.$id_rand);
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $nama_kategori		= filterdata($this->request->getPost('name'));
		$slug_kategori    	= url_title(strtolower($nama_kategori));
		
		$this->ModelContent->edit_kategori($id_rand,$nama_kategori,$slug_kategori);
		
		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Content Kategori !' );
		return redirect()->to('/manage-content-kategori'); 

	}
	
	public function menu_delete()
	{
		 
        $id_rand	= filterdata($this->request->getPost('random'));

		$this->ModelContent->delete_menu($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Menu !' );
		return redirect()->to('/manage-menu'); 

	}
	
	public function kategori_delete()
	{
		 
        $id_rand	= filterdata($this->request->getPost('random'));

		$this->ModelContent->delete_kategori($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Content Kategori !' );
		return redirect()->to('/manage-content-kategori'); 

	}

}
