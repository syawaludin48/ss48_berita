<?php

namespace Modules\ManageUsers\Controllers;

use App\Controllers\BaseController;
use Modules\ManageUsers\Models\ModelUsers;

class DataGroups extends BaseController
{
	protected $session;
	protected $ModelUsers;

	public function __construct(){
		$this->session = service('session');

		$this->ModelUsers = new ModelUsers();

	}

	public function index()
	{

		$users = $this->ModelUsers->get_groups();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Group Users',
			'users' => $users,
		];
		
		return view('Modules\ManageUsers\Views\groups',$data);
	}
	public function tambah_groups()
	{
       	$name        = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[auth_groups.name]',
				'errors' => [
					'required' => '{field} groups harus di isi !!!',
					'is_unique' => '{field} groups sudah terdaftar !!!'
				]
			],
			'description' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} harus di isi !!!',
				]
			]
			
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'tambah');
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}
		
		$this->ModelUsers->save_groups($name,$description);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Groups !' );
		return redirect()->to('/manage-groups'); 

	}
	public function edit_groups()
	{
		$id_groups   = $this->request->getPost('id_groups');
        $name        = $this->request->getPost('name');
        $description = $this->request->getPost('description');
		
		$rules = [
			'id_groups'  => [
				'rules'  => 'required',
			],
			'name' => [
				'rules'  => 'required|is_unique[auth_groups.name,id,{id_groups}]',
				'errors' => [
					'required'  => '{field} groups harus di isi !!!',
					'is_unique' => '{field} groups <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'description' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} harus di isi !!!',
				]
			]
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'edit'.$id_groups);
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

		$this->ModelUsers->edit_groups($id_groups,$name,$description);
		
		$this->session->setFlashdata('sukses', 'Melakukan Update Data Groups !' );
		return redirect()->to('/manage-groups'); 
       
		
	}
	public function delete_groups()
	{
		
        $id_groups    = $this->request->getPost('id_groups');

		$this->ModelUsers->delete_groups($id_groups);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Groups !' );
		return redirect()->to('/manage-groups'); 
       
		
	}
	
}
