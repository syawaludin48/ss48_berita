<?php

namespace Modules\ManageContent\Controllers;

use App\Controllers\BaseController;
use Modules\ManageContent\Models\ModelContent as ModelContent;
use CodeIgniter\I18n\Time;

class DataContent extends BaseController
{
	protected $session;
	protected $ModelContent;

	public function __construct(){
		$this->session = service('session');

		$this->ModelContent = new ModelContent();

	}

	public function content()
	{
		 
		$content = $this->ModelContent->get_content();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Content Webiste',
			'content' => $content,
		];
		
		return view('Modules\ManageContent\Views\content',$data);
	}
	public function content_tambah()
	{
		 
		$kategori = $this->ModelContent->get_content_kategori();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tambah Data',
			'title' => 'Data Content Webiste',
			'kategori' => $kategori,
		];
		
		return view('Modules\ManageContent\Views\content_tambah',$data);
	}
	public function content_edit($id_rand)
	{
		 
		$kategori = $this->ModelContent->get_content_kategori();

		$content = $this->ModelContent->get_content_edit($id_rand);

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Edit Data',
			'title' => 'Data Content Webiste',
			'content' => $content,
			'kategori' => $kategori,
		];
		
		return view('Modules\ManageContent\Views\content_edit',$data);
	}

	public function content_save()
	{
		 
		$rules = [
			'nama_content' => [
				'rules'  => 'required|is_unique[content.nama_content]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'content_website' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'content_kategori' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'thumbnail'=> [
				'rules'  => 'max_size[thumbnail,300]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
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

		$nama_content 		= filterdata($this->request->getPost('nama_content'));
		$slug_content 		= url_title(strtolower($nama_content));
		$content			= php_tags($this->request->getPost('content_website'));
		$content_kategori   = filterdata($this->request->getPost('content_kategori'));
		$draf 				= filterdata($this->request->getPost('draf'));

		$tanggal = filterdata($this->request->getPost('tanggal'));
		
		if($tanggal <> ''){
			$date = $tanggal;
			$tgl_post = $tanggal.' '.date('H:i:s');
		}else{
			$date = date('Y-m-d');
			$tgl_post = date('Y-m-d H:i:s');
		}

        $img_thumbnail = $this->request->getFile('thumbnail');

		if($img_thumbnail->getError() ==  4 ){
			
			$name_thumbnail = 'default.svg';			

		}else{

			$name_thumbnail = $img_thumbnail->getRandomName();

			$image = \Config\Services::image()
			->withFile($img_thumbnail)
			->fit(150, 150, 'center')
			->save(FCPATH .'/assets/images/content/thumbnail/'. $name_thumbnail);

			$img_thumbnail->move(WRITEPATH . 'uploads');

		}

		$this->ModelContent->save_content_website($nama_content,$slug_content,$content,$content_kategori,$tgl_post,$draf,$name_thumbnail,$date);

		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Content Website !' );
		return redirect()->to('/manage-content-website'); 


	}

	public function content_update()
	{
		 
		$rules = [
			'nama_content' => [
				'rules'  => 'required|is_unique[content.nama_content,random,{random}]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'content_website' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'content_kategori' => [
				'rules'  => 'required',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
				]
			],
			'thumbnail'=> [
				'rules'  => 'max_size[thumbnail,300]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
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
		$nama_content 		= filterdata($this->request->getPost('nama_content'));
		$slug_content 		= url_title(strtolower($nama_content));
		$content			= php_tags($this->request->getPost('content_website'));
		$content_kategori   = filterdata($this->request->getPost('content_kategori'));
		$draf 				= filterdata($this->request->getPost('draf'));

		$tanggal = filterdata($this->request->getPost('tanggal'));

		if($tanggal <> ''){
			$tgl_post = $tanggal.' '.date('H:i:s');
		}else{
			$tgl_post = date('Y-m-d H:i:s');
		}

        $img_thumbnail = $this->request->getFile('thumbnail');


		$name_thumbnail = $img_thumbnail->getRandomName();

		$query = $this->ModelContent->get_content_edit($id_rand);

		$id_content = $query['id'];

		// $cek_editor = $this->ModelContent->get_cek_editor($id_content);
		
		if($img_thumbnail->getError() ==  4 ){
			
			$this->ModelContent->edit_content_website_no_image($id_rand,$nama_content,$slug_content,$content,$content_kategori,$draf,$tgl_post,$tanggal);	
				$this->ModelContent->save_editor_content($id_content);

		}else{
						
			$image = \Config\Services::image()
			->withFile($img_thumbnail)
			->fit(150, 150, 'center')
			->save(FCPATH .'/assets/images/content/thumbnail/'. $name_thumbnail);

			$img_thumbnail->move(WRITEPATH . 'uploads');

			$img = filterdata($this->request->getPost('img'));
	
			if($img <> 'default.svg'){	
				if(file_exists('assets/images/content/thumbnail/'.$img)){
					unlink('assets/images/content/thumbnail/'.$img);
				}
			}

			$this->ModelContent->edit_content_website_image($id_rand,$nama_content,$slug_content,$content,$draf,$name_thumbnail,$tgl_post,$tanggal);	
				$this->ModelContent->save_editor_content($id_content);	

		}


		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Content Website !' );
		return redirect()->to('/manage-content-website'); 


	}

	public function content_delete()
	{
		 
        $id_rand		= $this->request->getPost('random');		
		
		$img = filterdata($this->request->getPost('img'));

		if($img <> 'default.svg'){	
			if(file_exists('assets/images/content/thumbnail/'.$img)){
				unlink('assets/images/content/thumbnail/'.$img);
			}
		}

		$this->ModelContent->delete_content($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Content Website !' );
		return redirect()->to('/manage-content-website'); 

	}


}
