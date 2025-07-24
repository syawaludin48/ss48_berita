<?php 
namespace Modules\ManageContent\Models;

use CodeIgniter\Model;
 
class ModelContent extends Model
{
    //protected $table = 'users';
    //protected $useTimestamps = 'true';
	protected $db;

    public function __construct(){
		
		$this->db = \Config\Database::connect();

	}

    public function get_content(){
		return $this->db
		->table('content')
		->select('content.id,content.random,thumbnail,draf,nama_content,nama_kategori,slug_kategori,slug_content,content.created_at as tanggal_post')
		->join('content_kategori','content_kategori.id=content.kategori','left')
		->where('content.deleted_at', null)
		->orderBy('content_kategori.nama_kategori', 'asc')
		->orderBy('content.tanggal', 'desc')
		->get()
		->getResultArray();
    }

    public function get_content_edit($id_rand){
		return $this->db
		->table('content')
		->select('*,created_at as tanggal_post')
		->where('random', $id_rand)
		->where('deleted_at', null)
		->get()
		->getRowArray();
    }

	
    public function get_cek_editor($id_content){
		return $this->db
		->table('content_editor')
		->where('id_content', $id_content)
		->where('id_user', user()->id)
		->countAllResults();
    }

	//SAVE DATA

    public function save_content_website($nama_content,$slug_content,$content,$content_kategori,$tgl_post,$draf,$name_thumbnail,$date){
		
		return $this->db
		->table('content')
		->insert([
			'random'        => sha1(time().rand(00000,99999)),
			'nama_content' => $nama_content,
			'slug_content' => $slug_content,
			'content' => $content,
			'kategori' => $content_kategori,
			'draf' => $draf,
			'tanggal' => $date,
			'id_user' => user()->id,
			'thumbnail' => $name_thumbnail,
			'created_at' 	=> $tgl_post,
		]);	
			
    }
	//EDIT DATA
	public function save_editor_content($id_content){
		
		return $this->db
		->table('content_editor')
		->insert([
			'id_content' => $id_content,
			'id_user' => user()->id,
			'tanggal' => date('Y-m-d H:i:s'),
		]);	
			
    }
	public function edit_content_website_no_image($id_rand,$nama_content,$slug_content,$content,$content_kategori,$draf,$tgl_post,$tanggal){
		
		return $this->db
		->table('content')
		->where('random', $id_rand)
		->update([
			'random'        => sha1(time().rand(00000,99999)),
			'nama_content' => $nama_content,
			'slug_content' => $slug_content,
			'content' => $content,
			'kategori' => $content_kategori,
			'draf' => $draf,
			'tanggal' => $tanggal,
			'id_user' => user()->id,
			'created_at' 	=> $tgl_post,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }

	public function edit_content_website_image($id_rand,$nama_content,$slug_content,$content,$draf,$name_thumbnail,$tgl_post,$tanggal){
		
		return $this->db
		->table('content')
		->where('random', $id_rand)
		->update([
			'random'        => sha1(time().rand(00000,99999)),
			'nama_content' => $nama_content,
			'slug_content' => $slug_content,
			'content' => $content,
			'draf' => $draf,
			'tanggal' => $tanggal,
			'id_user' => user()->id,
			'thumbnail' => $name_thumbnail,
			'created_at' 	=> $tgl_post,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }
    
	//DELETE DATA

    public function delete_content($id_rand){
		
		return $this->db
		->table('content')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }

	// Content Kategori
	
    public function get_content_kategori(){
		return $this->db
		->table('content_kategori')
		->where('deleted_at', null)
		->orderBy('nama_kategori', 'asc')
		->get()
		->getResultArray();
    }

	//SAVE DATA

    public function save_kategori($nama_kategori,$slug_kategori){
		
		return $this->db
		->table('content_kategori')
		->insert([
			'random'        => sha1(time().rand(00000,99999)),
			'nama_kategori' => $nama_kategori,
			'slug_kategori' => $slug_kategori,
			'created_at' 	=> date('Y-m-d H:i:s'),
		]);	
			
    }

	//EDIT DATA

    public function edit_kategori($id_rand,$nama_kategori,$slug_kategori){
		
		return $this->db
		->table('content_kategori')
		->where('random', $id_rand)
		->update([
			'random'        => sha1(time().rand(00000,99999)),
			'nama_kategori' => $nama_kategori,
			'slug_kategori' => $slug_kategori,
			'updated_at' 	=> date('Y-m-d H:i:s'),
		]);	
			
    }

	//DELETE DATA

    public function delete_kategori($id_rand){
		
		return $this->db
		->table('content_kategori')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }


}