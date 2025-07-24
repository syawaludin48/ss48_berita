<?php 
namespace Modules\ManageUsers\Models;

use CodeIgniter\Model;
 
class ModelUsers extends Model
{
    //protected $table = 'users'
    //protected $useTimestamps = 'true'
	protected $db;

    public function __construct(){
		
		$this->db = \Config\Database::connect();

	}

    public function get_group_menu(){
		return $this->db
		->table('menu_group')
		->select('manage,nama_group,menu_group.id')
		->join('menu','menu.id_group=menu_group.id','left')
		->where('menu_group.deleted_at', null)
		->where('menu_group.status', 1)
		->groupBy('menu.id_group')
		->orderBy('menu_group.no_urut', 'asc')
		->get()
		->getResultArray();
    }
    public function get_users(){
		return $this->db
		->table('users')
		->select('random,user_image, users.id as usersid, username, email, name')
		->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
		->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
		->where('users.deleted_at', null)
		->get()
		->getResultArray();
        
    }
    public function get_auth_groups(){
		return $this->db
		->table('auth_groups')
		->select('*')
		->get()
		->getResultArray();
        
    }
    public function get_users_profile($id_rand){
		return $this->db
		->table('users')
		->select('users.random as random_users,users.id as usersid,tanggal_lahir, username, email,user_image,alamat,no_telp,fullname,jenis_kelamin')
		->join('profile_user', 'profile_user.random = users.random', 'left')
        ->where('users.random', $id_rand)
		->get()
		->getRowArray();
        
    }
	
    public function get_users_edit($id_rand){
		return $this->db
		->table('users')
		->select('*')
		->join('auth_groups_users','auth_groups_users.user_id=users.id','left')
        ->where('random', $id_rand)
		->get()
		->getRowArray();
        
    }
    public function get_users_profile_mahasiswa($id_rand){
		return $this->db
		->table('users')
		->select('*,users.random as random_users,users.nim as nim_mhs')
		->join('mahasiswa', 'mahasiswa.nim = users.nim', 'left')
        ->where('users.random', $id_rand)
		->get()
		->getRowArray();
        
    }
    public function get_groups_users(){
		return $this->db
		->table('users')
		->select('random, users.id as usersid, username, email, name')
		->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
		->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
		->where('users.deleted_at', null)
		->get()
		->getResultArray();
        
    }
    public function get_groups_permissions(){
		return $this->db
		->table('auth_groups_permissions')
		->select('auth_groups.name as name_groups, auth_permissions.name as name_permissions, auth_groups_permissions.group_id as g_id')
		->join('auth_groups', 'auth_groups.id = auth_groups_permissions.group_id')
		->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id')
		->groupBy('auth_groups_permissions.group_id')
		->get()
		->getResultArray();
        
    }
    public function get_permissions(){
		return $this->db
		->table('auth_permissions')
		->orderBy('description','asc')
		->get()
		->getResultArray();
        
    }
    public function get_groups(){
		return $this->db
		->table('auth_groups')
		->get()
		->getResultArray();
        
    }
    public function get_cek_users_($rand){
		return $this->db
		->table('users')
		->where('random',$rand)
		->get()
		->getRowArray();
        
    }
    public function get_cek_users($id_rand){
		return $this->db
		->table('profile_user')
		->where('random',$id_rand)
		->countAllResults();
        
    }

    public function get_jenis_kelamin(){
		return $this->db
		->table('jenis_kelamin')
		->orderBy('id','asc')
		->get()
		->getResultArray();
        
    }

	//SAVE DATA

    public function save_users($rand,$fullname,$email,$username,$pass,$groups_access){
		
		return $this->db
		->table('users')
		->insert([
			'random'		=> $rand,
			'fullname'		=> $fullname,
			'email'			=> $email,
			'username' 		=> $username,
			'password_hash' => $pass,
			'active' 		=> 1,
			'user_image' 	=> 'default.jpg',
			'created_at' 	=> date('Y-m-d h:i:s'),
		]);	

			
    }	

    public function save_groups_users($groups_access,$user_id){
		
		return $this->db
		->table('auth_groups_users')
		->insert([
			'group_id'		=> $groups_access,
			'user_id'		=> $user_id,
		]);	
			
    }	
    public function save_profile_users($id_rand,$tanggal_lahir,$jenis_kelamin,$alamat,$no_telp){
		
		return $this->db
		->table('profile_user')
		->insert([
			'random'		=> $id_rand,
			'tanggal_lahir'	=> $tanggal_lahir,
			'jenis_kelamin' => $jenis_kelamin,
			'alamat' 		=> $alamat,
			'no_telp' 		=> $no_telp,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }	
    public function save_groups($name,$description){
		
		return $this->db
		->table('auth_groups')
		->insert([
			'name'        => $name,
			'description' => $description,
		]);	
			
    }
    public function save_permissions($name,$description){
		
		return $this->db
		->table('auth_permissions')
		->insert([
			'name'        => $name,
			'description' => $description,
		]);	
			
    }
    public function save_groups_permissions($id_groups,$id_permissions){
		
		return $this->db
		->table('auth_groups_permissions')
		->insert([
			'group_id'        => $id_groups,
			'permission_id' => $id_permissions,
		]);	
			
    }	
	//EDIT DATA
	public function edit_users_1($id_rand,$rand,$fullname,$email,$username,$pass,$groups_access){
		
		return $this->db
		->table('users')
		->where('random',$id_rand)
		->update([
			'random'		=> $rand,
			'fullname'		=> $fullname,
			'email'			=> $email,
			'username' 		=> $username,
			'password_hash' => $pass,
			'active' 		=> 1,
			'user_image' 	=> 'default.jpg',
			'created_at' 	=> date('Y-m-d h:i:s'),
		]);	

			
    }	

	public function edit_users_2($id_rand,$rand,$fullname,$email,$username,$pass,$groups_access){
		
		return $this->db
		->table('users')
		->where('random',$id_rand)
		->update([
			'random'		=> $rand,
			'fullname'		=> $fullname,
			'email'			=> $email,
			'username' 		=> $username,
			// 'password_hash' => $pass,
			'active' 		=> 1,
			'user_image' 	=> 'default.jpg',
			'created_at' 	=> date('Y-m-d h:i:s'),
		]);	

			
    }	
    public function edit_groups_users($groups_access,$user_id){
		
		return $this->db
		->table('auth_groups_users')
		->where('user_id',$user_id)
		->update([
			'group_id'		=> $groups_access,
			'user_id'		=> $user_id,
		]);	
			
    }	
    public function edit_password($id_rand,$password_baru){
		
		return $this->db
		->table('users')
		->where('random', $id_rand)
		->update([
			'password_hash'	=> $password_baru,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }	
    public function edit_profile_users($id_rand,$tanggal_lahir,$jenis_kelamin,$alamat,$no_telp){
		
		return $this->db
		->table('profile_user')
		->where('random', $id_rand)
		->update([
			'tanggal_lahir'	=> $tanggal_lahir,
			'jenis_kelamin' => $jenis_kelamin,
			'alamat' 		=> $alamat,
			'no_telp' 		=> $no_telp,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }	
    public function edit_profile_users_mahasiswa($nim,$prodi,$angkatan,$fakultas,$tanggal_lahir,$jenis_kelamin,$alamat,$no_telp){
		
		return $this->db
		->table('mahasiswa')
		->where('nim', $nim)
		->update([
			'prodi'			=> $prodi,
			'angkatan'		=> $angkatan,
			'fakultas'		=> $fakultas,
			'tanggal_lahir'	=> $tanggal_lahir,
			'jenis_kelamin' => $jenis_kelamin,
			'alamat' 		=> $alamat,
			'no_telp' 		=> $no_telp,
			'updated_at' 	=> date('Y-m-d h:i:s'),
		]);	
			
    }	
    public function edit_users_image($id_rand,$username,$fullname,$email,$nama_foto){
		
		return $this->db
		->table('users')
		->where('random', $id_rand)
		->update([
			'username'	=> $username,
			'fullname'	=> $fullname,
			'email'		=> $email,
			'user_image'=> $nama_foto,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }	
    public function edit_users_no_image($id_rand,$username,$fullname,$email){
		
		return $this->db
		->table('users')
		->where('random', $id_rand)
		->update([
			'username'	=> $username,
			'fullname'	=> $fullname,
			'email'		=> $email,
			'updated_at'=> date('Y-m-d h:i:s'),
		]);	
			
    }	
    public function edit_groups($id_groups,$name,$description){
		
		return $this->db
		->table('auth_groups')
		->where('id', $id_groups)
		->update([
			'name'        => $name,
			'description' => $description,
		]);
			
    }	
    public function edit_permissions($id_permissions,$name,$description){
		
		return $this->db
		->table('auth_permissions')
		->where('id', $id_permissions)
		->update([
			'name'        => $name,
			'description' => $description,
		]);	
			
    }	
    public function edit_groups_permissions($id_groups1,$id_permissions){
		
		return $this->db
		->table('auth_groups_permissions')
		->insert([
			'group_id'        => $id_groups1,
			'permission_id' => $id_permissions,
		]);	
			
    }		
	
	//DELETE DATA

    public function delete_users($id_rand){
		
		return $this->db
		->table('users')
		->where('random', $id_rand)
		->update([
			'deleted_at' => date('Y-m-d h:i:s'),
		]);	
			
    }
    public function delete_groups_pemissions($id_groups2){
		
		return $this->db
		->table('auth_groups_permissions')
		->where('group_id', $id_groups2)
		->delete();
			
    }	
    public function delete_groups_permissions($id_groups){
		
		return $this->db
		->table('auth_groups_permissions')
		->where('group_id', $id_groups)
		->delete();
			
    }	
    public function delete_permissions($id_permissions){
		
		return $this->db
		->table('auth_permissions')
		->where('id', $id_permissions)
		->delete();

		return $this->db
		->table('auth_groups_permissions')
		->where('permission_id', $id_permissions)
		->delete();
			
    }	
    public function delete_groups($id_groups){
		
		return $this->db
		->table('auth_groups')
		->where('id', $id_groups)
		->delete();

		return $this->db
		->table('auth_groups_permissions')
		->where('group_id', $id_groups)
		->delete();
			
    }	

}