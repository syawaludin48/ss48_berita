<?php 
namespace Modules\ManageContentFront\Models;

use CodeIgniter\Model;
 
class ModelContent extends Model
{
    //protected $table = 'users';
    //protected $useTimestamps = 'true';
	protected $db;

    public function __construct(){
		
		$this->db = \Config\Database::connect();

	}

    public function get_contact(){
		return $this->db
		->table('contact')
		->get()
		->getRowArray();
    }
    public function get_content($slug){
		return $this->db
		->table('content')
		->where('slug_content', $slug)
		->where('deleted_at', null)
		->where('draf', 0)
		->get()
		->getRowArray();
    }

    public function get_recent($page){
		return $this->db
		->table('content')
		->where('deleted_at', null)
		->where('draf', 0)
		->orderBy('tanggal','desc')
		->limit($page)
		->get()
		->getResultArray();
    }
	
    public function add_view($rand,$total){		
		return $this->db
		->table('content')
		->where('random', $rand)
		->update([
			'view' => $total,
		]);	
    }
	
}