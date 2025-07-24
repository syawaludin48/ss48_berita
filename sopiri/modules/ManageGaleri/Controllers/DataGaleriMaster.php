<?php

namespace Modules\ManageGaleri\Controllers;

use App\Controllers\BaseController;
use Modules\ManageGaleri\Models\ModelGaleriMaster;
use CodeIgniter\I18n\Time;

class DataGaleriMaster extends BaseController
{
	protected $session;
	protected $ModelGaleriMaster;

	public function __construct(){
		$this->session = service('session');

		$this->ModelGaleriMaster = new ModelGaleriMaster();

	}

	public function galeri()
	{

		$galeri = $this->ModelGaleriMaster->get_galeri();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Galeri Master',
			'galeri' => $galeri,
		];
		
		return view('Modules\ManageGaleri\Views\galeri_master',$data);
	}
	public function galeri_sub($id_rand)
	{
		$random = $id_rand;
		$query = $this->ModelGaleriMaster->get_id_galeri($random);
		$id_galeri = $query['id'];
		$galeri = $this->ModelGaleriMaster->get_galeri_galeri($id_galeri);
		
		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Galeri',
			'galeri' => $galeri,
			'gal' => $query,
		];
		
		return view('Modules\ManageGaleri\Views\galeri',$data);
	}
	public function galeri_tambah()
	{


		$kategori = $this->ModelGaleriMaster->get_kategori_select();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tambah Data',
			'title' => 'Data Galeri Master',
			'kategori' => $kategori
		];
		
		return view('Modules\ManageGaleri\Views\galeri_master_tambah',$data);
	}
	public function galeri_edit($id_rand)
	{
		 
		$kategori = $this->ModelGaleriMaster->get_kategori_select();
		$galeri = $this->ModelGaleriMaster->get_galeri_edit($id_rand);
		
		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Edit Data',
			'title' => 'Data galeri Webiste',
			'galeri' => $galeri,
			'kategori' => $kategori
		];
		
		return view('Modules\ManageGaleri\Views\galeri_master_edit',$data);
	}

	public function galeri_save()
	{
		 
		$rules = [
			'nama_galeri' => [
				'rules'  => 'required|is_unique[galeri_master.nama_galeri]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'status' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'kategori' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'thumbnail'=> [
				'rules'  => 'uploaded[thumbnail]|max_size[thumbnail,500]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded'  => '<b>{field}</b> harus di pilih !!!',
					'max_size'  => 'ukuran <b>{field}</b> anda terlalu besar !!!',
					'is_image'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
					'mime_in'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
				]
			],
			'img_galeri'=> [
				'rules'  => 'uploaded[img_galeri]|max_size[img_galeri,400]|is_image[img_galeri]|mime_in[img_galeri,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded'  => '<b>{field}</b> harus di pilih !!!',
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

		$nama_galeri 		= filterdata($this->request->getPost('nama_galeri'));
		$slug_galeri 		= url_title(strtolower($nama_galeri));
		$status 		= filterdata($this->request->getPost('status'));
		$kategori 		= filterdata($this->request->getPost('kategori'));

        $thumbnail = $this->request->getFile('thumbnail');
		$img_galeri = $this->request->getFileMultiple('img_galeri');
		

		$name_thumbnail = $thumbnail->getRandomName();

		$image = \Config\Services::image()
		->withFile($thumbnail)
		->fit(350, 250, 'center')
		->save(FCPATH .'/assets/images/galeri/thumbnail/'. $name_thumbnail);

		$thumbnail->move(WRITEPATH . 'uploads');

		$random = sha1(time().rand(111111,999999));
		$this->ModelGaleriMaster->save_master_galeri($random,$nama_galeri,$slug_galeri,$status,$name_thumbnail,$kategori);

		$query = $this->ModelGaleriMaster->get_id_galeri($random);
		$id_galeri = $query['id'];
		
		$no = 1;
		foreach($img_galeri as $files)
		{
			if ($files->isValid() && ! $files->hasMoved())
			{
				$nama_file = $no.$files->getRandomName();
				$files->move('assets/images/galeri', $nama_file);

				$this->ModelGaleriMaster->save_img_galeri($id_galeri,$nama_file);
			}
			
		$no++;
		}
		


		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Galeri Master !' );
		return redirect()->to('/manage-galeri-master'); 


	}

	public function galeri_save_save()
	{
		 
		$rules = [
			'img_galeri'=> [
				'rules'  => 'uploaded[img_galeri]|max_size[img_galeri,400]|is_image[img_galeri]|mime_in[img_galeri,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded'  => '<b>{field}</b> harus di pilih !!!',
					'max_size'  => 'ukuran <b>{field}</b> anda terlalu besar !!!',
					'is_image'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
					'mime_in'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
				]
			]
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'tambah');
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

		$id_galeri 	= filterdata($this->request->getPost('id_galeri'));
		$random 	= filterdata($this->request->getPost('random'));
		$img_galeri = $this->request->getFileMultiple('img_galeri');
		
		$no = 1;
		foreach($img_galeri as $files)
		{
			if ($files->isValid() && ! $files->hasMoved())
			{
				$nama_file = $no.$files->getRandomName();
				$files->move('assets/images/galeri', $nama_file);

				$this->ModelGaleriMaster->save_img_galeri($id_galeri,$nama_file);
			}
			
		$no++;
		}
		


		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Galeri !' );
		return redirect()->to('/manage-galeri-master/galeri/'.$random); 


	}
	public function galeri_update()
	{
		$rules = [
			'nama_galeri' => [
				'rules'  => 'required|is_unique[galeri_master.nama_galeri,random,{random}]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'status' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'kategori' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
			'thumbnail'=> [
				'rules'  => 'max_size[thumbnail,500]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size'  => 'ukuran <b>{field}</b> anda terlalu besar !!!',
					'is_image'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
					'mime_in'  => '<b>{field}</b> yang anda pilih bukan gambar !!!',
				]
			],
			'img_galeri'=> [
				'rules'  => 'max_size[img_galeri,400]|is_image[img_galeri]|mime_in[img_galeri,image/jpg,image/jpeg,image/png]',
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

		$id_rand 		= filterdata($this->request->getPost('random'));
		$nama_galeri 		= filterdata($this->request->getPost('nama_galeri'));
		$slug_galeri 		= url_title(strtolower($nama_galeri));
		$status 		= filterdata($this->request->getPost('status'));
		$kategori 		= filterdata($this->request->getPost('kategori'));
		$img 		= filterdata($this->request->getPost('img'));

        $thumbnail = $this->request->getFile('thumbnail');
		$img_galeri = $this->request->getFileMultiple('img_galeri');

		if($thumbnail->getError() ==  4 ){

			$name_thumbnail = $img;

		}else{
			
			if($img <> ''){
				if(file_exists('assets/images/galeri/thumbnail/'.$img)){
					unlink('assets/images/galeri/thumbnail/'.$img);
				}
			}

			$name_thumbnail = $thumbnail->getRandomName();

			$image = \Config\Services::image()
			->withFile($thumbnail)
			->fit(350, 250, 'center')
			->save(FCPATH .'/assets/images/galeri/thumbnail/'. $name_thumbnail);

			$thumbnail->move(WRITEPATH . 'uploads');


		}


		$random = $id_rand;	
		$query = $this->ModelGaleriMaster->get_id_galeri($random);
		$id_galeri = $query['id'];
		
		//Delete Galeri
		$unlink_file = $this->ModelGaleriMaster->get_galeri_sub($id_galeri);
		foreach($unlink_file as $un){
			unlink('assets/images/galeri/'.$un['img']);
		}
		$this->ModelGaleriMaster->delete_galeri_sub($id_galeri);

		//edit
		$this->ModelGaleriMaster->edit_master_galeri($id_rand,$nama_galeri,$slug_galeri,$status,$name_thumbnail,$kategori);

		$no = 1;
		foreach($img_galeri as $files)
		{
			if ($files->isValid() && ! $files->hasMoved())
			{
				$nama_file = $no.$files->getRandomName();
				$files->move('assets/images/galeri', $nama_file);

				$this->ModelGaleriMaster->save_img_galeri($id_galeri,$nama_file);
			}
			
		$no++;
		}

		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Galeri Master !' );
		return redirect()->to('/manage-galeri-master'); 
		


	}

	public function galeri_delete()
	{
		 
        $id_rand		= $this->request->getPost('random');
        $img		= $this->request->getPost('img');		

		$q = $this->ModelGaleriMaster->get_id_berita_master($id_rand);
		$id_galeri = $q['id'];

		if($img <> ''){
			if(file_exists('assets/images/galeri/thumbnail/'.$img)){
				unlink('assets/images/galeri/thumbnail/'.$img);
			}
		}

		$this->ModelGaleriMaster->delete_galeri($id_rand);
		
		$query = $this->ModelGaleriMaster->get_galeri_sub($id_galeri);

		foreach($query as $r){

			$image = $r['img'];
			if($image <> ''){
				if(file_exists('assets/images/galeri/'.$image)){
					unlink('assets/images/galeri/'.$image);
				}
			}

			$id_rand = $r['random'];
			$this->ModelGaleriMaster->delete_galeri_galeri($id_rand);

		}
	
		
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data galeri !' );
		return redirect()->to('/manage-galeri-master'); 

	}
	public function galeri_delete_galeri()
	{
		 
        $link		= $this->request->getPost('link');
        $id_rand		= $this->request->getPost('random');
        $img		= $this->request->getPost('img');			
		
		if($img <> ''){
			if(file_exists('assets/images/galeri/'.$img)){
				unlink('assets/images/galeri/'.$img);
			}
		}

		$this->ModelGaleriMaster->delete_galeri_galeri($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data galeri !' );
		return redirect()->to('/manage-galeri-master/galeri/'.$link); 

	}
}
