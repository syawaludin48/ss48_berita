<?php

namespace Modules\ManageMenuWebsite\Controllers;

use App\Controllers\BaseController;
use Modules\ManageMenuWebsite\Models\ModelMenu;
use CodeIgniter\I18n\Time;

class DataMenu extends BaseController
{
	protected $session;
	protected $ModelMenu;

	public function __construct(){
		$this->session = service('session');

		$this->ModelMenu = new ModelMenu();

	}

	public function menu()
	{
		 
		$menu = $this->ModelMenu->get_menu();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Menu Webiste',
			'menu' => $menu,
		];
		
		return view('Modules\ManageMenuWebsite\Views\menu',$data);
	}

	public function menu_save()
	{
		 
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[menu_website.nama_menu]',
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

        $nama_menu		= filterdata($this->request->getPost('name'));
		$slug_menu    	= url_title(strtolower($nama_menu));
        $link		= filterdata($this->request->getPost('link'));
        $status		= filterdata($this->request->getPost('status'));
        $no_urut		= filterdata($this->request->getPost('nomor'));

		$this->ModelMenu->save_menu($nama_menu,$slug_menu,$link,$status,$no_urut);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Menu !' );
		return redirect()->to('/manage-menu-website'); 

	}

	public function menu_update()
	{
		 
        $id_rand		= filterdata($this->request->getPost('random'));
		
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[menu_website.nama_menu,random,{random}]',
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

        $nama_menu		= filterdata($this->request->getPost('name'));
		$slug_menu    	= url_title(strtolower($nama_menu));
        $link		= filterdata($this->request->getPost('link'));
        $status		= filterdata($this->request->getPost('status'));
        $no_urut		= filterdata($this->request->getPost('nomor'));
		
		$this->ModelMenu->edit_menu($id_rand,$nama_menu,$slug_menu,$link,$status,$no_urut);
		
		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Menu !' );
		return redirect()->to('/manage-menu-website'); 

	}

	
	public function menu_delete()
	{
		 
        $id_rand	= filterdata($this->request->getPost('random'));

		$this->ModelMenu->delete_menu($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Menu !' );
		return redirect()->to('/manage-menu-website'); 

	}
	
}
