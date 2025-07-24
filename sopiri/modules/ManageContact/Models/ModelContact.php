<?php 
namespace Modules\ManageContact\Models;

use CodeIgniter\Model;
 
class ModelContact extends Model
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
		->select('*')
		->get()
		->getRowArray();
    }

	
	//EDIT DATA
	public function edit_contact_image($id_rand,$nama_website,$slug_website,$email,$no_telp,$alamat,$keterangan,$name_logo_website,$name_logo_website2,$name_icon_website){
		
		return $this->db
		->table('contact')
		->where('random', $id_rand)
		->update([
			// 'random'        => sha1(time().rand(00000,99999)),
			'nama_website' => $nama_website,
			'slug_website' => $slug_website,
			'email' => $email,
			'no_telp' => $no_telp,
			'alamat' => $alamat,
			'keterangan' => $keterangan,
			'logo_website' => $name_logo_website,
			'logo_website_2' => $name_logo_website2,
			'icon_website' => $name_icon_website,
			'id_user' => user()->id,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }
	

}