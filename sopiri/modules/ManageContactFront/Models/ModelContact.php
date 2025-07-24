<?php 
namespace Modules\ManageContactFront\Models;

use CodeIgniter\Model;
 
class ModelContact extends Model
{
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
	
}