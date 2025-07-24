<?php

namespace Modules\ManageGaleri\Controllers;

use App\Controllers\BaseController;
use Modules\ManageGaleri\Models\ModelGaleriMaster as ModelGaleriMaster;
use CodeIgniter\I18n\Time;

class DataKategori extends BaseController
{
	protected $session;
	protected $ModelGaleriMaster;

	public function __construct(){
		$this->session = service('session');

		$this->ModelGaleriMaster = new ModelGaleriMaster();

	}

	public function kategori_galeri()
	{
		 
		$kategori = $this->ModelGaleriMaster->get_kategori();

		$data = [
			'seg' => $this->request->uri->getSegments(),
			'pretitle' => 'Tabel Data',
			'title' => 'Data Kategori Galeri',
			'kategori' => $kategori
		];
		
		return view('Modules\ManageGaleri\Views\kategori',$data);
	}


	public function kategori_galeri_save()
	{
		 
		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[galeri_kategori.nama_kategori]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'status' => [
				'rules'  => 'required|is_unique[galeri_kategori.nama_kategori]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'tambah');
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $nama_kategori		= filterdata($this->request->getPost('name'));
		$slug_kategori    	= url_title(strtolower($nama_kategori));
        $status		= filterdata($this->request->getPost('status'));

		$this->ModelGaleriMaster->save_kategori($nama_kategori,$slug_kategori,$status);
		
		$this->session->setFlashdata('sukses', 'Melakukan Tambah Data Kategori Galeri !' );
		return redirect()->to('/manage-galeri-kategori'); 

	}

	public function kategori_galeri_update()
	{
		 
        $id_rand		= $this->request->getPost('random');

		$rules = [
			'name' => [
				'rules'  => 'required|is_unique[galeri_kategori.nama_kategori,random,{random}]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di isi !!!',
					'is_unique' => '<b>{field}</b> <b>{value}</b> sudah terdaftar !!!'
				]
			],
			'status' => [
				'rules'  => 'required|is_unique[galeri_kategori.nama_kategori]',
				'errors' => [
					'required'  => '<b>{field}</b> harus di pilih !!!',
				]
			],
		];

		if (! $this->validate($rules))
		{
			$this->session->setFlashdata('KetForm', 'edit'.$id_rand);
			return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
		}

        $nama_kategori		= filterdata($this->request->getPost('name'));
		$slug_kategori    	= url_title(strtolower($nama_kategori));
        $status		= filterdata($this->request->getPost('status'));

		$this->ModelGaleriMaster->edit_kategori($id_rand,$nama_kategori,$slug_kategori,$status);
		
		$this->session->setFlashdata('sukses', 'Melakukan Edit Data Kategori Galeri !' );
		return redirect()->to('/manage-galeri-kategori'); 

	}

	public function kategori_galeri_delete()
	{
		 
        $id_rand		= $this->request->getPost('random');		

		$this->ModelGaleriMaster->delete_kategori($id_rand);
		
		$this->session->setFlashdata('sukses', 'Melakukan Delete Data Kategori Galeri !' );
		return redirect()->to('/manage-galeri-kategori'); 

	}
	
	
}
