<?= $this->extend('Modules\ManageLayout\Views\layout') ?>

<?= $this->section('content') ?>


<?php if(session('errors')): ?>

<script>
    $( document ).ready(function() {
        $('#<?= session('KetForm') ?>').modal('show');
    });
</script>

<?php endif; ?>

<?php if(session()->getFlashdata('sukses')){ ?>  
    
    <script>        
        $(document).ready(function(){
            setTimeout(function(){
                $('#sukses').modal('show');
            }, 100);
            });

    </script>

<?php } ?>

        <!-- [ breadcrumb ] start -->
        
        <div class="container-fluid">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            <?= $pretitle ?>
                        </div>
                        <h2 class="page-title">
                            <?= $title ?>
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="/manage-galeri-master" class="btn btn-secondary d-none d-sm-inline-block">
                                <i class="fas fa-long-arrow-alt-left me-2"></i>Back
                            </a>
                            <a href="/manage-galeri-master" class="btn btn-secondary d-sm-none btn-icon" >
                                <i class="fas fa-long-arrow-alt-left me-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- [ breadcrumb ] end -->
 
<div class="page-body">

    <div class="container-fluid">
        <div class="card">

            <div class="card-header py-1 bg-primary">
            <!-- <h3 class="card-title">Invoices</h3> -->
            </div>

            <div class="card-body border-bottom py-3">
                
                <div  class="mb-3" >
                    <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                </div>

                <?php  $r = $galeri; ?>
                <form action="/manage-galeri-master-update" method="post"  class="form form-horizontal" enctype="multipart/form-data" >
                    <?= csrf_field() ?>                    


                    <input type="hidden" name="random" value="<?= $r['random'] ?>" >
                        <input type="hidden" name="img" value="<?= $r['thumbnail'] ?>" >

                    <div class="form-group row required mb-3">
                        <label for="inputPassword" class="form-label col-sm-3 col-form-label">Nama Galeri</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php if(session('errors.nama_galeri')) : ?>is-invalid<?php endif ?>" name="nama_galeri"  value="<?= $r['nama_galeri']; ?>"  placeholder="Enter Nama Galeri">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.nama_galeri') ?>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label  class="col-sm-3 col-form-label">Kategori Galeri</label>
                        <div class="col-sm-9">
                            <select id="select2bs42" class="form-label form-select <?php if(session('errors.kategori')) : ?>is-invalid<?php endif ?>" name="kategori" >
                                <option value="">Please Select</option>
                                <?php foreach($kategori as $k){ ?>
                                <option value="<?= $k['id'] ?>" <?php if($r['id_kategori'] == $k['id']){echo 'selected';} ?> ><?= $k['nama_kategori'] ?></option>
                                <?php } ?>
                            </select>   
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.kategori') ?>
                            </div>      
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label for="inputPassword" class="form-label col-sm-3 col-form-label">Status Galeri</label>
                        <div class="col-sm-9">
                            
                            <div class="form-check">
                                <input class="form-check-input <?php if(session('errors.status')) : ?>is-invalid<?php endif ?>" type="radio" name="status" value="1" <?php if($r['status'] == 1){echo 'checked';}else{} ?> id="1" >
                                <label class="form-check-label" for="1">Non Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input <?php if(session('errors.status')) : ?>is-invalid<?php endif ?>" type="radio" name="status" value="0" <?php if($r['status'] == 0){echo 'checked';}else{} ?> id="2" >
                                <label class="form-check-label" for="2">Aktif</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label class="form-label col-sm-3 col-form-label">Thumbnail</label>
                        <div class="col-sm-9">                    
                            <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal image 500 kb</span>     
                            <input type="file" class="form-control <?php if(session('errors.thumbnail')) : ?>is-invalid<?php endif ?>" id="thumbnail" name="thumbnail" aria-describedby="inputGroupFileAddon01">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.thumbnail') ?>
                            </div> 
                            <?php if($r['thumbnail'] <> ''){ ?>
                            <div class="w-100"></div>
                            <div class="mt-2">
                                <img src="<?= base_url('assets') ?>/images/galeri/thumbnail/<?= $r['thumbnail'] ?>" style="max-width:200px">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label class="form-label col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">                    
                            <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal masing masing image 200 kb</span>     
                            <input type="file" class="form-control <?php if(session('errors.img_galeri')) : ?>is-invalid<?php endif ?>" id="img_galeri" multiple name="img_galeri[]" aria-describedby="inputGroupFileAddon01">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.img_galeri') ?>
                            </div> 
                        </div>
                    </div>
                   
                    
                    <div class="mt-4">

                        <button type="submit" class="btn btn-teal ml-1">Update Galeri Master</button>

                    </div>

                </form>

            </div>
            
        </div>
    </div>

</div>

    

<?= $this->endSection() ?>