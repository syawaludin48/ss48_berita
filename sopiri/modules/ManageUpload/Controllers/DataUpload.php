<?php

namespace Modules\ManageUpload\Controllers;

use App\Controllers\BaseController;
use Modules\ManageUpload\Models\ModelUpload;
use CodeIgniter\I18n\Time;

class DataUpload extends BaseController
{
	protected $session;
	protected $ModelUpload;

	public function __construct(){
		$this->session = service('session');

		$this->ModelUpload = new ModelUpload();

	}

 function daftar_file($dir)
 {
   if(is_dir($dir))
   {
   if($handle = opendir($dir))
   {
   //tampilkan semua file dalam folder kecuali
   while(($file = readdir($handle)) !== false)
   {
   echo '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>'."\n";
   }
   closedir($handle);
   }
   }
 }

	public function upload_list()
	{
    $extensionList = array("png", "jpg", "gif");


    $dir = FCPATH .'/assets/images/upload/';
    if(is_dir($dir))
    {
    if($handle = opendir($dir))
    {
    //tampilkan semua file dalam folder kecuali
    while(($file = readdir($handle)) !== false)
    {

       $pecah = explode(".", $file);
       $ekstensi = $pecah[1];
        
       if (in_array($ekstensi, $extensionList))
       {

      // echo '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>'."\n";
        $url = base_url('assets/images/upload/'.$file);
        $data[]['url'] = $url;

       }
    }
    closedir($handle);
    }
    }

		// $upload_list = $this->ModelUpload->get_list_upload();
    // foreach ($upload_list as $list) {
    //   $url = base_url('assets/images/galeri/'.$list['img']);
    //   $data[]['url'] = $url;
    // }
    echo json_encode($data);
	}

}
