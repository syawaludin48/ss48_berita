<?php 
namespace Modules\ManageGaleri\Models;

use CodeIgniter\Model;
 
class ModelGaleriMaster extends Model
{
    //protected $table = 'users';
    //protected $useTimestamps = 'true';
	protected $db;

    public function __construct(){
		
		$this->db = \Config\Database::connect();

	}

    public function get_id_berita_master($id_rand){
		return $this->db
		->table('galeri_master')
		->select('id')
		->where('random', $id_rand)
		->get()
		->getRowArray();
    }
    public function get_kategori(){
		return $this->db
		->table('galeri_kategori')
		->where('deleted_at', null)
		->get()
		->getResultArray();
    }

    public function get_kategori_select(){
		return $this->db
		->table('galeri_kategori')
		->where('deleted_at', null)
		->where('status', 0)
		->get()
		->getResultArray();
    }

    public function get_galeri(){
		return $this->db
		->table('galeri_master')
		->select('*')
		->where('deleted_at', null)
		->orderBy('tanggal','desc')
		->get()
		->getResultArray();
    }

    public function get_galeri_galeri($id_galeri){
		return $this->db
		->table('galeri_sub')
		->where('id_galeri',$id_galeri)
		->get()
		->getResultArray();
    }

    public function get_galeri_edit($id_rand){
		return $this->db
		->table('galeri_master')
		->select('*')
		->where('random', $id_rand)
		->where('deleted_at', null)
		->get()
		->getRowArray();
    }
    public function get_id_galeri($random){
		return $this->db
		->table('galeri_master')
		->select('id,random')
		->where('random', $random)
		->get()
		->getRowArray();
    }
    public function get_galeri_sub($id_galeri){
		return $this->db
		->table('galeri_sub')
		->select('random,img')
		->where('id_galeri', $id_galeri)
		->get()
		->getResultArray();
    }

	//SAVE DATA

    public function save_kategori($nama_kategori,$slug_kategori,$status){
		
		return $this->db
		->table('galeri_kategori')
		->insert([
			'random'        => sha1(time().rand(00000,99999)),
			'slug_kategori' => $slug_kategori,
			'nama_kategori' => $nama_kategori,
			'id_user' => user()->id,
			'status' => $status,
			'created_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }
    public function save_master_galeri($random,$nama_galeri,$slug_galeri,$status,$name_thumbnail,$kategori){
		
		return $this->db
		->table('galeri_master')
		->insert([
			'random'        => $random,
			'nama_galeri' => $nama_galeri,
			'slug_galeri' => $slug_galeri,
			'id_kategori' => $kategori,
			'status' => $status,
			'tanggal' => date('Y-m-d'),
			'id_user' => user()->id,
			'thumbnail' => $name_thumbnail,
			'created_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }
    public function save_img_galeri($id_galeri,$nama_file){
		
		return $this->db
		->table('galeri_sub')
		->insert([
			'random'        => sha1(time().rand(11111,99999)),
			'id_galeri' => $id_galeri,
			'img' => $nama_file,
		]);	
			
    }

	//EDIT DATA
    public function edit_master_galeri($id_rand,$nama_galeri,$slug_galeri,$status,$name_thumbnail,$kategori){
		
		return $this->db
		->table('galeri_master')
		->where('random', $id_rand)
		->update([
			'random'        => sha1(time().rand(00000,99999)),
			'nama_galeri' => $nama_galeri,
			'slug_galeri' => $slug_galeri,
			'id_kategori' => $kategori,
			'status' => $status,
			// 'tanggal' => date('Y-m-d'),
			'id_user' => user()->id,
			'thumbnail' => $name_thumbnail,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }
    public function edit_kategori($id_rand,$nama_kategori,$slug_kategori,$status){
		
		return $this->db
		->table('galeri_kategori')
		->where('random', $id_rand)
		->update([
			'random'        => sha1(time().rand(00000,99999)),
			'slug_kategori' => $slug_kategori,
			'nama_kategori' => $nama_kategori,
			'id_user' => user()->id,
			'status' => $status,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }
    
	//DELETE DATA

    public function delete_kategori($id_rand){
		
		return $this->db
		->table('galeri_kategori')
		->where('random', $id_rand)
		->update([
			'id_user' => user()->id,
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }
    public function delete_galeri($id_rand){
		
		return $this->db
		->table('galeri_master')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }

    public function delete_galeri_sub($id_galeri){
		
		return $this->db
		->table('galeri_sub')
		->where('id_galeri', $id_galeri)
		->delete();	
			
    }
    public function delete_galeri_galeri($id_rand){
		
		return $this->db
		->table('galeri_sub')
		->where('random', $id_rand)
		->delete();	
			
    }

}