<?php

namespace Modules\ManageMenuWebsite\Controllers;

use App\Controllers\BaseController;
use Modules\ManageMenuWebsite\Models\ModelMenu;
use CodeIgniter\I18n\Time;

class DataSubMenu extends BaseController
{
	protected $session;
	protected $ModelMenu;

	public function __construct(){
		$this->session = service('session');

		$this->ModelMenu = new ModelMenu();

	}

	public function sub_menu()
	{
		 
		$sub_menu = $this->ModelMenu->get_sub_menu();
		$menu = $this->ModelMenu->get_menu();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Sub Menu Webiste',
			'sub_menu' => $sub_menu,
			'menu' => $menu,
		];
		
		return view('Modules\ManageMenuWebsite\Views\sub_menu',$data);
	}

	public function sub_menu_save()
	{
		 
		$rules = [
			'id_menu' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'name' => [
				'rules'  => 'required|is_unique[sub_menu_website.nama_sub_menu]',
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

        $id_menu		= filterdata($this->request->getPost('id_menu'));
        $nama_menu		= filterdata($this->request->getPost('name'));
		$slug_menu    	= url_title(strtolower($nama_menu));
        $link		= filterdata($this->request->getPost('link'));
        $status		= filterdata($this->request->getPost('status'));
        $no_urut		= filterdata($this->request->getPost('nomor'));

		$this->ModelMenu->save_sub_menu($id_menu,$nama_menu,$slug_menu,$link,$status,$no_urut);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Sub Menu !' );
		return redirect()->to('/manage-sub-menu-website'); 

	}

	public function sub_menu_update()
	{
		 
        $id_rand		= filterdata($this->request->getPost('random_sub'));
		
		$rules = [
			'id_menu' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'name' => [
				'rules'  => 'required|is_unique[sub_menu_website.nama_sub_menu,random,{random_sub}]',
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

        $id_menu		= filterdata($this->request->getPost('id_menu'));
        $nama_menu		= filterdata($this->request->getPost('name'));
		$slug_menu    	= url_title(strtolower($nama_menu));
        $link		= filterdata($this->request->getPost('link'));
        $status		= filterdata($this->request->getPost('status'));
        $no_urut		= filterdata($this->request->getPost('nomor'));
		
		$this->ModelMenu->edit_sub_menu($id_menu,$id_rand,$nama_menu,$slug_menu,$link,$status,$no_urut);
		
		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Sub Menu !' );
		return redirect()->to('/manage-sub-menu-website'); 

	}

	
	public function sub_menu_delete()
	{
		 
        $id_rand	= filterdata($this->request->getPost('random_sub'));

		$this->ModelMenu->delete_sub_menu($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Menu !' );
		return redirect()->to('/manage-sub-menu-website'); 

	}
	
}
