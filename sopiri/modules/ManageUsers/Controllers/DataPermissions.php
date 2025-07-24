<?php

namespace Modules\ManageUsers\Controllers;

use App\Controllers\BaseController;
use Modules\ManageUsers\Models\ModelUsers;

class DataPermissions extends BaseController
{
	protected $session;
	protected $ModelUsers;

	public function __construct(){
		$this->session = service('session');

		$this->ModelUsers = new ModelUsers();

	}

	public function index()
	{

		$permissions = $this->ModelUsers->get_permissions();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Permissions Users',
			'permissions' => $permissions,
		];
		
		return view('Modules\ManageUsers\Views\permissions',$data);
	}	
	public function tambah_permissions()
	{
       	$name        = filterdata($this->request->getPost('name'));
        $description = filterdata($this->request->getPost('description'));
        
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[auth_permissions.name]',
				'errors' => [
					'required' => '{field} permissions harus di isi !!!',
					'is_unique' => '{field} permissions sudah terdaftar !!!'
				]
			],
			'description' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} permissions harus di isi !!!',
				]
			],
			
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'tambah');
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}
		
		$this->ModelUsers->save_permissions($name,$description);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Permissions !' );
		return redirect()->to('/manage-permissions'); 

	}
	public function edit_permissions()
	{
		$id_permissions   = filterdata($this->request->getPost('id_permissions'));
        $name        = filterdata($this->request->getPost('name'));
        $description = filterdata($this->request->getPost('description'));
		
		$rules = [
			'id_permissions'  => [
				'rules'  => 'required',
			],
			'name' => [
				'rules'  => 'required|is_unique[auth_permissions.name,id,{id_permissions}]',
				'errors' => [
					'required'  => '{field} permissions harus di isi !!!',
					'is_unique' => '{field} permissions <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'description'=> [
				'rules'  => 'required',
				'errors' => [
					'required'  => '{field} permissions harus di isi !!!',
				]
			]
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'edit'.$id_permissions);
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

		$this->ModelUsers->edit_permissions($id_permissions,$name,$description);
		
		$this->session->setFlashdata('sukses', 'Melakukan Update Data Permissions !' );
		return redirect()->to('/manage-permissions'); 
       
		
	}
	public function delete_permissions()
	{
		
        $id_permissions    = $this->request->getPost('id_permissions');

		$this->ModelUsers->delete_permissions($id_permissions);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Permissions !' );
		return redirect()->to('/manage-permissions'); 
       
		
	}
	
}
