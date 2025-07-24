<?= $this->extend('Modules\ManageLayout\Views\layout') ?>

<?= $this->section('content') ?>


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
                            <a href="/manage-content-website" class="btn btn-secondary d-none d-sm-inline-block">
                                <i class="fas fa-undo me-2"></i>Back
                            </a>
                            <a href="/manage-content-website" class="btn btn-secondary d-sm-none btn-icon" >
                                <i class="fas fa-undo me-2"></i>
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

                <form action="/manage-save-content-website" method="post"  class="form form-horizontal" enctype="multipart/form-data" >
                    <?= csrf_field() ?>                    

                    <div class="form-group row required mb-3">
                        <label class="form-label col-sm-3 col-form-label">Nama Content</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php if(session('errors.nama_content')) : ?>is-invalid<?php endif ?>" name="nama_content"  value="<?= old('nama_content'); ?>"  placeholder="Enter Nama Content">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.nama_content') ?>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label class="form-label col-sm-3 col-form-label">Content Website</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control texteditor <?php if(session('errors.content_website')) : ?>is-invalid<?php endif ?>"  name="content_website" id="full"  placeholder="Enter Content Content"><?= old('content_website'); ?></textarea>
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.content_website') ?>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label class="form-label col-sm-3 col-form-label">Status Content</label>
                        <div class="col-sm-9">
                                
                            <div class="form-check">
                                <input class="form-check-input <?php if(session('errors.draf')) : ?>is-invalid<?php endif ?>" type="radio" name="draf" value="1" id="1" checked>
                                <label class="form-check-label" for="1">Draf</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input <?php if(session('errors.draf')) : ?>is-invalid<?php endif ?>" type="radio" name="draf" value="0" id="2" >
                                <label class="form-check-label" for="2">Posting</label>
                            </div>

                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.draf') ?>
                            </div>      
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label  class="form-label col-sm-3 col-form-label">Content Kategori</label>
                        <div class="col-sm-9">
                            <select id="select2bs4" class="form-select py-2  <?php if(session('errors.content_kategori')) : ?>is-invalid<?php endif ?>" name="content_kategori" >
                                <option value="">Please Select</option>
                                <?php foreach($kategori as $k){ ?>
                                <option value="<?= $k['id'] ?>" <?php if(old('content_kategori') == $k['id']){echo 'selected';} ?> ><?= $k['nama_kategori'] ?></option>
                                <?php } ?>
                            </select>   
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.content_kategori') ?>
                            </div>      
                        </div>
                    </div>
                    <div class="form-group row  mb-3">
                        <label class="form-label col-sm-3 col-form-label">Tanggal Post</label>
                        <div class="col-sm-9">
                            <span class="text-primary">Jika tanggal tidak di tentukan, maka akan sesuai tanggal sekarang !!!</span>
                            <input type="date" class="form-control <?php if(session('errors.tanggal')) : ?>is-invalid<?php endif ?>" name="tanggal"  value="<?= old('tanggal'); ?>"  placeholder="Enter Tanggal Post">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.tanggal') ?>
                            </div> 
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="form-label col-sm-3 col-form-label">Thumbnail Content</label>
                        <div class="col-sm-9">                    
                            <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal image 300 kb</span>     
                            <input type="file" class="form-control <?php if(session('errors.thumbnail')) : ?>is-invalid<?php endif ?>" id="thumbnail" name="thumbnail" aria-describedby="inputGroupFileAddon01">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.thumbnail') ?>
                            </div> 
                        </div>
                    </div>
                   
                    
                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary ml-1">Tambah Content</button>

                    </div>

                </form>

            </div>
            
        </div>
    </div>

</div>

    

<?= $this->endSection() ?>