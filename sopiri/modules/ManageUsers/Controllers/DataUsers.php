<?php

namespace Modules\ManageUsers\Controllers;

use App\Controllers\BaseController;
use Modules\ManageUsers\Models\ModelUsers;
use CodeIgniter\I18n\Time;
use Myth\Auth\Entities\User;

class DataUsers extends BaseController
{
	protected $config;
	protected $session;
	protected $ModelUsers;

	public function __construct(){
		$this->session = service('session');
		$this->config = config('Auth');

		$this->ModelUsers = new ModelUsers();
		$this->auth = service('authentication');

	}

	public function index()
	{

		$users = $this->ModelUsers->get_users();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Users',
			'users' => $users,
		];

		return view('Modules\ManageUsers\Views\users',$data);
	}

	public function profile($id_rand)
	{

		$users = $this->ModelUsers->get_users_profile($id_rand);


		$jenis_kelamin = $this->ModelUsers->get_jenis_kelamin();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Profile',
			'title' => 'Data Profile Users',
			'users' => $users,
			'jenis_kelamin' => $jenis_kelamin,
		];

		return view('Modules\ManageUsers\Views\profile',$data);
	}


	public function tambah_users()
	{

		$auth_groups = $this->ModelUsers->get_auth_groups();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tambah Data',
			'title' => 'Data Users',
			'auth_groups' => $auth_groups,
		];

		return view('Modules\ManageUsers\Views\tambah_user',$data);
	}

	public function edit_users($id_rand)
	{

		$users = $this->ModelUsers->get_users_edit($id_rand);
		$auth_groups = $this->ModelUsers->get_auth_groups();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Edit Data',
			'title' => 'Data Users',
			'users' => $users,
			'auth_groups' => $auth_groups,
		];

		return view('Modules\ManageUsers\Views\edit_user',$data);
	}

	public function save_users()
	{
		$rules = [
			'fullname' => [
				'rules'  => 'required|is_unique[users.fullname]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '{field} <b>{value}</b> sudah terdaftar !!!',
				]
			],
			'email' => [
				'rules'  => 'required|valid_email|is_unique[users.email]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '{field} <b>{value}</b> sudah terdaftar !!!',
					'valid_email'  => '<b>{value}</b> format bukan email !!!',
				]
			],
			'username' => [
				'rules'  => 'required|alpha_numeric|is_unique[users.username]|min_length[4]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!',
					'min_length'  => '<b>{field}</b> minimal 4 karakter !!!',
					'alpha_numeric'  => '<b>{field}</b> selain huruf dan angka tidak boleh !!!',
				]
			],
			'password' => [
				'rules'  => 'required|min_length[8]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'min_length'  => '<b>{field}</b> minimal 8 karakter !!!',
				]
			],
			'confirm_password' => [
				'rules'  => 'required|matches[password]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'matches'  => '<b>{field}</b> tidak sama dengan password !!!',
				]
			],
			'groups_access' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			]
		];

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $fullname		= filterdata($this->request->getPost('fullname'));
        $email		= filterdata($this->request->getPost('email'));
		$username   = filterdata($this->request->getPost('username'));
        $password   = filterdata($this->request->getPost('password'));
        $groups_access   = filterdata($this->request->getPost('groups_access'));

		$pass = setPassword($password);

		$rand = sha1(time().rand(00000,99999));

		$this->ModelUsers->save_users($rand,$fullname,$email,$username,$pass,$groups_access);

		$users = $this->ModelUsers->get_cek_users_($rand);
		$user_id = $users['id'];

		$this->ModelUsers->save_groups_users($groups_access,$user_id);


		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Users !' );
		return redirect()->to('/manage-users');

	}
	public function update_users()
	{

		$password		= filterdata($this->request->getPost('password'));

		if($password <> '' ){

			$rules = [
				'fullname' => [
					'rules'  => 'required|is_unique[users.fullname,random,{random}]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'is_unique' => '{field} <b>{value}</b> sudah terdaftar !!!',
					]
				],
				'email' => [
					'rules'  => 'required|valid_email|is_unique[users.email,random,{random}]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'is_unique' => '{field} <b>{value}</b> sudah terdaftar !!!',
						'valid_email'  => '<b>{value}</b> format bukan email !!!',
					]
				],
				'username' => [
					'rules'  => 'required|alpha_numeric|is_unique[users.username,random,{random}]|min_length[4]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!',
						'min_length'  => '<b>{field}</b> minimal 4 karakter !!!',
						'alpha_numeric'  => '<b>{field}</b> selain huruf dan angka tidak boleh !!!',
					]
				],
				'password' => [
					'rules'  => 'required|min_length[8]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'min_length'  => '<b>{field}</b> minimal 8 karakter !!!',
					]
				],
				'confirm_password' => [
					'rules'  => 'required|matches[password]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'matches'  => '<b>{field}</b> tidak sama dengan password !!!',
					]
				],
				'groups_access' => [
					'rules'  => 'required',
					'errors' => [
						'required'  => '<b>{field}</b> harus di pilih !!!',
					]
				]
			];

		}else{

			$rules = [
				'fullname' => [
					'rules'  => 'required|is_unique[users.fullname,random,{random}]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'is_unique' => '{field} <b>{value}</b> sudah terdaftar !!!',
					]
				],
				'email' => [
					'rules'  => 'required|valid_email|is_unique[users.email,random,{random}]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'is_unique' => '{field} <b>{value}</b> sudah terdaftar !!!',
						'valid_email'  => '<b>{value}</b> format bukan email !!!',
					]
				],
				'username' => [
					'rules'  => 'required|alpha_numeric|is_unique[users.username,random,{random}]|min_length[4]',
					'errors' => [
						'required'  => '<b>{field}</b> harus di isi !!!',
						'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!',
						'min_length'  => '<b>{field}</b> minimal 4 karakter !!!',
						'alpha_numeric'  => '<b>{field}</b> selain huruf dan angka tidak boleh !!!',
					]
				],
				'groups_access' => [
					'rules'  => 'required',
					'errors' => [
						'required'  => '<b>{field}</b> harus di pilih !!!',
					]
				]
			];

		}


		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $id_rand		= filterdata($this->request->getPost('random'));
        $fullname		= filterdata($this->request->getPost('fullname'));
        $email		= filterdata($this->request->getPost('email'));
		$username   = filterdata($this->request->getPost('username'));
        $password   = filterdata($this->request->getPost('password'));
        $groups_access   = filterdata($this->request->getPost('groups_access'));

		$pass = setPassword($password);

		$rand = sha1(time().rand(00000,99999));

		if($password <> ''){

			$this->ModelUsers->edit_users_1($id_rand,$rand,$fullname,$email,$username,$pass,$groups_access);

		}else{

			$this->ModelUsers->edit_users_2($id_rand,$rand,$fullname,$email,$username,$pass,$groups_access);

		}

		$users = $this->ModelUsers->get_cek_users_($rand);
		$user_id = $users['id'];

		$this->ModelUsers->edit_groups_users($groups_access,$user_id);


		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Users !' );
		return redirect()->to('/manage-users');

	}
	public function edit_profile()
	{
		$rules = [
			'id_rand'  => [
				'rules'  => 'required',
			],
			'username' => [
				'rules'  => 'required|is_unique[users.username,username,{username}]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'fullname'=> [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'tanggal_lahir'=> [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'jenis_kelamin'=> [
				'rules'  => 'required|numeric',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'numeric'   => '<b>{field}</b> harus di angka tidak boleh karakter !!!',
				]
			],
			'alamat'=> [
				'rules'  => 'required|min_length[20]|max_length[150]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'min_length'  => '<b>{field}</b> minimal 20 karakter !!!',
					'max_length'  => '<b>{field}</b> maksimal 150 karakter !!!',
				]
			],
			'email'=> [
				'rules'  => 'required|is_unique[users.email,email,{email}]|valid_email',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!',
					'valid_email'  => 'harus email !!!',
				]
			],
			'no_telp'=> [
				'rules'  => 'required|numeric|min_length[10]|max_length[15]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'numeric'   => '<b>{field}</b> harus di angka tidak boleh karakter !!!',
					'min_length'  => '<b>{field}</b> minimal 10 angka !!!',
					'max_length'  => '<b>{field}</b> maksimal 15 angka !!!',
				]
			],
			'user_image'=> [
				'rules'  => 'max_size[user_image,200kb]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size'  => 'ukuran <b>{field}</b> anda terlalu besar !!!',
					'is_image'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
					'mime_in'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
				]
			]
		];

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $id_rand		= filterdata($this->request->getPost('id_rand'));
		$username    	= filterdata($this->request->getPost('username'));
        $fullname    	= filterdata($this->request->getPost('fullname'));
        $tanggal_lahir 	= filterdata($this->request->getPost('tanggal_lahir'));
        $jenis_kelamin 	= filterdata($this->request->getPost('jenis_kelamin'));
        $alamat 		= filterdata($this->request->getPost('alamat'));
        $email 			= filterdata($this->request->getPost('email'));
        $no_telp 		= filterdata($this->request->getPost('no_telp'));
        $img 			= $this->request->getPost('img');
		//dd($img);
		//Update Users
        $foto_profile = $this->request->getFile('user_image');

		$nama_foto = $foto_profile->getRandomName();

		if($foto_profile->getError() ==  4 ){

			$this->ModelUsers->edit_users_no_image($id_rand,$username,$fullname,$email);

		}else{

			// move file to folder

			$image = \Config\Services::image()
			->withFile($foto_profile)
			->fit(150, 150, 'center')
			->save(FCPATH .'/assets/images/profile/'. $nama_foto);

			$foto_profile->move(WRITEPATH . 'uploads');


			if($img <> 'default.jpg'){
				if(file_exists('assets/images/profile/'.$img)){
					unlink('assets/images/profile/'.$img);
				}
			}

			$this->ModelUsers->edit_users_image($id_rand,$username,$fullname,$email,$nama_foto);

		}

		$cek = $this->ModelUsers->get_cek_users($id_rand);

		if($cek > 0){
			$this->ModelUsers->edit_profile_users($id_rand,$tanggal_lahir,$jenis_kelamin,$alamat,$no_telp);
		}else{
			$this->ModelUsers->save_profile_users($id_rand,$tanggal_lahir,$jenis_kelamin,$alamat,$no_telp);
		}

		$this->session->setFlashdata('sukses', 'Melakukan Update Data Profile Users !' );
		return redirect()->to('/manage-users/profile'.'/'.$id_rand);

	}



	public function edit_password()
	{

		$rules = [
			'id_rand'  => [
				'rules'  => 'required',
			],
			// 'password_lama' => [
			// 	'rules'  => 'required|min_length[8]',
			// 	'errors' => [
			// 		'required'  => '<b>{field}</b> harus di isi !!!',
			// 		'min_length' => '<b>{field}</b> minimal 8 karakter !!!'
			// 	]
			// ],
			'password_baru'=> [
				'rules'  => 'required|min_length[8]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'min_length' => '<b>{field}</b> minimal 8 karakter !!!'
				]
			],
			'confirm_password_baru'=> [
				'rules'  => 'required|matches[password_baru]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'matches'  => '<b>{field}</b> tidak sama  !!!',
				]
			]

		];

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $id_rand		= filterdata($this->request->getPost('id_rand'));
		$password_baru    	= setPassword($this->request->getPost('password_baru'));

		$this->ModelUsers->edit_password($id_rand,$password_baru);

		$this->session->setFlashdata('sukses', 'Melakukan Update Password Users !' );
		return redirect()->to('/manage-users/profile'.'/'.$id_rand);

	}
	public function delete_users()
	{

        $id_rand    = $this->request->getPost('random');
        $img    = $this->request->getPost('img');

		if($img <> 'default.jpg'){
			if(file_exists('assets/images/profile/'.$img)){
				unlink('assets/images/profile/'.$img);
			}
		}

		$this->ModelUsers->delete_users($id_rand);

		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Users !' );
		return redirect()->to('/manage-users');


	}


}
