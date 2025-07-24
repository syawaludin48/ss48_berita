<?php

namespace Modules\ManageMenu\Controllers;

use App\Controllers\BaseController;
use Modules\ManageMenu\Models\ModelMenu;
use CodeIgniter\I18n\Time;

class DataGroupMenu extends BaseController
{
	protected $session;
	protected $ModelMenu;

	public function __construct(){
		$this->session = service('session');

		$this->ModelMenu = new ModelMenu();

	}

	public function group_menu()
	{
		 	
		$menu = $this->ModelMenu->get_menu();
		$group_menu_ = $this->ModelMenu->get_group_menu();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Menu Group Webiste',
			'group_menu_table' => $group_menu_,
			'menu' => $menu,
		];
		
		return view('Modules\ManageMenu\Views\group_menu',$data);
	}

	public function group_menu_save()
	{
		 
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[menu_group.nama_group]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'manage' => [
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

        $nama_group_menu		= filterdata($this->request->getPost('name'));
		$slug_group_menu    	= url_title(strtolower($nama_group_menu));
        $manage		= filterdata($this->request->getPost('manage'));
        $no_urut		= filterdata($this->request->getPost('nomor'));

		$this->ModelMenu->save_group_menu($nama_group_menu,$slug_group_menu,$no_urut,$manage);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Group Menu !' );
		return redirect()->to('/manage-menu-group'); 

	}

	public function group_menu_update()
	{
		 
        $id_rand		= filterdata($this->request->getPost('random'));
		
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[menu_group.nama_group,random,{random}]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'manage' => [
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

        $nama_group_menu		= filterdata($this->request->getPost('name'));
		$slug_group_menu    	= url_title(strtolower($nama_group_menu));
        $manage		= filterdata($this->request->getPost('manage'));
        $no_urut		= filterdata($this->request->getPost('nomor'));
        $status		= filterdata($this->request->getPost('status'));
		
		$this->ModelMenu->edit_group_menu($id_rand,$nama_group_menu,$slug_group_menu,$no_urut,$manage);
		
		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Group Menu !' );
		return redirect()->to('/manage-menu-group'); 

	}

	
	public function group_menu_delete()
	{
		 
        $id_rand	= filterdata($this->request->getPost('random'));

		$this->ModelMenu->delete_group_menu($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Group Menu !' );
		return redirect()->to('/manage-menu-group'); 

	}
	
}
