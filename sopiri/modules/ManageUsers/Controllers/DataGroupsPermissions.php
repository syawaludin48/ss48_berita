<?php

namespace Modules\ManageUsers\Controllers;

use App\Controllers\BaseController;
use Modules\ManageUsers\Models\ModelUsers;

class DataGroupsPermissions extends BaseController
{
	protected $session;
	protected $ModelUsers;

	public function __construct(){
		$this->session = service('session');

		$this->ModelUsers = new ModelUsers();

	}

	public function index()
	{

		$users = $this->ModelUsers->get_groups_permissions();
		$permissions = $this->ModelUsers->get_permissions();
		$groups = $this->ModelUsers->get_groups();
		

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Group Permissions Users',
			'users' => $users,
			'permissions' => $permissions,
			'groups' => $groups,
		];
		
		return view('Modules\ManageUsers\Views\groups_permissions',$data);
	}

	public function tambah_groups_permissions()
	{
		
		$rules = [
			'groups' => [
				'rules'  => 'required|is_unique[auth_groups_permissions.group_id]',
				'errors' => [
					'required'  => '{field} harus di pilih !!!',
					'is_unique' => 'groups sudah terdaftar !!!'
				]
			],'pemissions' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '{field} harus di pilih !!!',
				]
			]
		];


		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'tambah');
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

		$count = count($this->request->getPost('pemissions'));
        $id_groups    = filterdata($this->request->getPost('groups'));
		$pemissions   = implode(',',$this->request->getPost('pemissions'));


		for($i=0;$i < $count;$i++){

			$data = explode(',',$pemissions);
			$id_permissions = $data[$i];

			$this->ModelUsers->save_groups_permissions($id_groups,$id_permissions);

		}
		
		$this->session->setFlashdata('sukses', 'Melakukan Update Data Groups Permissions !' );
		return redirect()->to('/manage-groups-permissions'); 
       
		
	}
	public function edit_groups_permissions()
	{
		$rules = [
			'groups' => [
				'rules'  => 'required|is_unique[auth_groups_permissions.group_id,group_id,{id_groups}]',
				'errors' => [
					'required'  => '{field} harus di pilih !!!',
					'is_unique' => 'groups sudah terdaftar !!!'
				]
			],'pemissions' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '{field} harus di pilih !!!',
				]
			]
		];


        $id    = $this->request->getPost('id_groups');

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'list'.$id);
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}
		

		$count = count($this->request->getPost('pemissions'));
        $id_groups1    = filterdata($this->request->getPost('groups'));
        $id_groups2    = filterdata($this->request->getPost('id_groups'));
		$pemissions   = implode(',',$this->request->getPost('pemissions'));
		
		$this->ModelUsers->delete_groups_pemissions($id_groups2);

		for($i=0;$i < $count;$i++){

			$data = explode(',',$pemissions);
			$id_permissions = $data[$i];

			$this->ModelUsers->edit_groups_permissions($id_groups1,$id_permissions);

		}
		
		$this->session->setFlashdata('sukses', 'Melakukan Update Data Groups Permissions !' );
		return redirect()->to('/manage-groups-permissions'); 
       
		
	}
	public function delete_groups_permissions()
	{
		
        $id_groups    = $this->request->getPost('id_groups');

		$this->ModelUsers->delete_groups_permissions($id_groups);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Groups Permissions !' );
		return redirect()->to('/manage-groups-permissions'); 
       
		
	}
	
}
