<?php 
namespace Modules\ManageMenu\Models;

use CodeIgniter\Model;
 
class ModelMenu extends Model
{
    //protected $table = 'users';
    //protected $useTimestamps = 'true';
	protected $db;

    public function __construct(){
		
		$this->db = \Config\Database::connect();

	}


    public function get_group_menu(){
		return $this->db
		->table('menu_group')
		->select('id,random,nama_group,no_urut,manage')
		->where('deleted_at', null)
		->orderBy('no_urut', 'asc')
		->get()
		->getResultArray();
    }
    public function get_menu(){
		return $this->db
		->table('menu')
		->select('nama_group,menu.manage,id_group,nama_menu,menu.random,link_menu,slug_menu,menu.status,menu.no_urut,menu.id')
		->join('menu_group','menu_group.id=menu.id_group','left')
		->where('menu.deleted_at', null)
		->orderBy('menu_group.nama_group', 'asc')
		->get()
		->getResultArray();
    }
    public function get_sub_menu(){
		return $this->db
		->table('sub_menu')
		->select('sub_menu.manage,nama_menu,sub_menu.random as random_sub,link_sub_menu,slug_sub_menu,nama_sub_menu,sub_menu.status as status_sub,sub_menu.no_urut as no_urut_sub,id_menu,sub_menu.id')
		->join('menu','menu.id=sub_menu.id_menu','left')
		->where('sub_menu.deleted_at', null)
		->orderBy('menu.no_urut', 'asc')
		->orderBy('menu.nama_menu', 'asc')
		->get()
		->getResultArray();
    }
   
	//SAVE DATA

    public function save_group_menu($nama_group_menu,$slug_group_menu,$no_urut,$manage){
		
		return $this->db
		->table('menu_group')
		->insert([
			'random'    => sha1(time().rand(00000,99999)),
			'nama_group' => $nama_group_menu,
			'manage' => $manage,
			'slug_group' => $slug_group_menu,
			'no_urut' 	=> $no_urut,
			'created_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
    public function save_menu($nama_menu,$slug_menu,$link,$status,$no_urut,$id_group,$manage){
		
		return $this->db
		->table('menu')
		->insert([
			'random'    => sha1(time().rand(00000,99999)),
			'nama_menu' => $nama_menu,
			'slug_menu' => $slug_menu,
			'link_menu' => $link,
			'id_group' => $id_group,
			'manage' => $manage,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'created_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
    public function save_sub_menu($id_menu,$nama_menu,$slug_menu,$link,$manage,$status,$no_urut){
		
		return $this->db
		->table('sub_menu')
		->insert([
			'random'    => sha1(time().rand(00000,99999)),
			'id_menu'   => $id_menu,
			'nama_sub_menu' => $nama_menu,
			'slug_sub_menu' => $slug_menu,
			'link_sub_menu ' => $link,
			'manage' => $manage,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'created_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
   
	//EDIT DATA
    public function edit_group_menu($id_rand,$nama_group_menu,$slug_group_menu,$no_urut,$manage){
		
		return $this->db
		->table('menu_group')
		->where('random', $id_rand)
		->update([
			'random'    => sha1(time().rand(00000,99999)),
			'nama_group' => $nama_group_menu,
			'slug_group' => $slug_group_menu,
			'manage' => $manage,
			'no_urut' 	=> $no_urut,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
	public function edit_menu($id_rand,$nama_menu,$slug_menu,$link,$status,$no_urut,$id_group,$manage){
		
		return $this->db
		->table('menu')
		->where('random', $id_rand)
		->update([
			'random'    => sha1(time().rand(00000,99999)),
			'nama_menu' => $nama_menu,
			'slug_menu' => $slug_menu,
			'link_menu ' => $link,
			'id_group' => $id_group,
			'manage' => $manage,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
	public function edit_sub_menu($id_menu,$id_rand,$nama_menu,$slug_menu,$link,$manage,$status,$no_urut){
		
		return $this->db
		->table('sub_menu')
		->where('random', $id_rand)
		->update([
			'random'    => sha1(time().rand(00000,99999)),
			'id_menu'   => $id_menu,
			'nama_sub_menu' => $nama_menu,
			'slug_sub_menu' => $slug_menu,
			'link_sub_menu ' => $link,
			'manage' => $manage,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
	
	//DELETE DATA

    public function delete_group_menu($id_rand){
		
		return $this->db
		->table('menu_group')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }

    public function delete_menu($id_rand){
		
		return $this->db
		->table('menu')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }
    public function delete_sub_menu($id_rand){
		
		return $this->db
		->table('sub_menu')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }

}