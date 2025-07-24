<?php
namespace Modules\ManageUpload\Models;

use CodeIgniter\Model;

class ModelUpload extends Model
{
    //protected $table = 'users';
    //protected $useTimestamps = 'true';
	protected $db;

    public function __construct(){

		$this->db = \Config\Database::connect();

	}

    public function get_list_upload(){
		return $this->db
		->table('tb_upload')
		->select('img')
		->get()
		->getResultArray();
    }

}
