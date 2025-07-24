<?php 
namespace Modules\ManageMenuWebsite\Models;

use CodeIgniter\Model;
 
class ModelMenu extends Model
{
    //protected $table = 'users';
    //protected $useTimestamps = 'true';
	protected $db;

    public function __construct(){
		
		$this->db = \Config\Database::connect();

	}

    public function get_menu(){
		return $this->db
		->table('menu_website')
		->select('nama_menu,random,link_menu,slug_menu,status,no_urut,id')
		->where('deleted_at', null)
		->orderBy('no_urut', 'asc')
		->get()
		->getResultArray();
    }
    public function get_sub_menu(){
		return $this->db
		->table('sub_menu_website')
		->select('nama_menu,sub_menu_website.random as random_sub,link_sub_menu,slug_sub_menu,nama_sub_menu,sub_menu_website.status as status_sub,sub_menu_website.no_urut as no_urut_sub,id_menu,sub_menu_website.id')
		->join('menu_website','menu_website.id=sub_menu_website.id_menu','left')
		->where('sub_menu_website.deleted_at', null)
		->orderBy('menu_website.no_urut', 'asc')
		->orderBy('sub_menu_website.no_urut', 'asc')
		->get()
		->getResultArray();
    }
    public function get_sub_sub_menu(){
		return $this->db
		->table('sub_sub_menu_website')
		->select('id_sub_menu,nama_sub_menu,sub_sub_menu_website.random as random_sub,link_sub_sub_menu,slug_sub_sub_menu,nama_sub_sub_menu,sub_sub_menu_website.status as status_sub,sub_sub_menu_website.no_urut as no_urut_sub,id_menu')
		->join('sub_menu_website','sub_menu_website.id=sub_sub_menu_website.id_sub_menu','left')
		->where('sub_sub_menu_website.deleted_at', null)
		->orderBy('sub_menu_website.no_urut', 'asc')
		->orderBy('sub_sub_menu_website.no_urut', 'asc')
		->get()
		->getResultArray();
    }
	//SAVE DATA

    public function save_menu($nama_menu,$slug_menu,$link,$status,$no_urut){
		
		return $this->db
		->table('menu_website')
		->insert([
			'random'    => sha1(time().rand(00000,99999)),
			'nama_menu' => $nama_menu,
			'slug_menu' => $slug_menu,
			'link_menu' => $link,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'created_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
    public function save_sub_menu($id_menu,$nama_menu,$slug_menu,$link,$status,$no_urut){
		
		return $this->db
		->table('sub_menu_website')
		->insert([
			'random'    => sha1(time().rand(00000,99999)),
			'id_menu'   => $id_menu,
			'nama_sub_menu' => $nama_menu,
			'slug_sub_menu' => $slug_menu,
			'link_sub_menu' => $link,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'created_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
    public function save_sub_sub_menu($id_menu,$nama_menu,$slug_menu,$link,$status,$no_urut){
		
		return $this->db
		->table('sub_sub_menu_website')
		->insert([
			'random'    => sha1(time().rand(00000,99999)),
			'id_sub_menu'   => $id_menu,
			'nama_sub_sub_menu' => $nama_menu,
			'slug_sub_sub_menu' => $slug_menu,
			'link_sub_sub_menu' => $link,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'created_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
	//EDIT DATA
	public function edit_menu($id_rand,$nama_menu,$slug_menu,$link,$status,$no_urut){
		
		return $this->db
		->table('menu_website')
		->where('random', $id_rand)
		->update([
			'random'    => sha1(time().rand(00000,99999)),
			'nama_menu' => $nama_menu,
			'slug_menu' => $slug_menu,
			'link_menu' => $link,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
	public function edit_sub_menu($id_menu,$id_rand,$nama_menu,$slug_menu,$link,$status,$no_urut){
		
		return $this->db
		->table('sub_menu_website')
		->where('random', $id_rand)
		->update([
			'random'    => sha1(time().rand(00000,99999)),
			'id_menu'   => $id_menu,
			'nama_sub_menu' => $nama_menu,
			'slug_sub_menu' => $slug_menu,
			'link_sub_menu' => $link,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
	public function edit_sub_sub_menu($id_menu,$id_rand,$nama_menu,$slug_menu,$link,$status,$no_urut){
		
		return $this->db
		->table('sub_sub_menu_website')
		->where('random', $id_rand)
		->update([
			'random'    => sha1(time().rand(00000,99999)),
			'id_sub_menu'   => $id_menu,
			'nama_sub_sub_menu' => $nama_menu,
			'slug_sub_sub_menu' => $slug_menu,
			'link_sub_sub_menu' => $link,
			'status' 	=> $status,
			'no_urut' 	=> $no_urut,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }
    
	//DELETE DATA

    public function delete_menu($id_rand){
		
		return $this->db
		->table('menu_website')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }
    public function delete_sub_menu($id_rand){
		
		return $this->db
		->table('sub_menu_website')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }
    public function delete_sub_sub_menu($id_rand){
		
		return $this->db
		->table('sub_sub_menu_website')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }

}