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

                <?php $r = $contact; ?>

                    <div  class="mb-3" >
                        <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                    </div>

                    <form action="/manage-contact-website-update" method="post"  class="form form-horizontal" enctype="multipart/form-data" >
                        <?= csrf_field() ?>                    

                        <input type="hidden" name="random" value="<?= $r['random'] ?>" >
                        <input type="hidden" name="img" value="<?= $r['logo_website'] ?>" >
                        <input type="hidden" name="img2" value="<?= $r['logo_website_2'] ?>" >
                        <input type="hidden" name="img3" value="<?= $r['icon_website'] ?>" >
                        
                        <div class="form-group row required mb-3">
                            <label class="form-label col-sm-3 col-form-label">Nama Website</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?php if(session('errors.nama_website')) : ?>is-invalid<?php endif ?>" name="nama_website"  value="<?= $r['nama_website']; ?>"  placeholder="Enter Nama website">
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.nama_website') ?>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row required mb-3">
                            <label class="form-label col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email"  value="<?= $r['email']; ?>"  placeholder="Enter Email">
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.email') ?>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row required mb-3">
                            <label class="form-label col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?php if(session('errors.no_telp')) : ?>is-invalid<?php endif ?>" name="no_telp"  value="<?= $r['no_telp']; ?>"  placeholder="Enter Nama No Telp">
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.no_telp') ?>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row required mb-3">
                            <label class="form-label col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control <?php if(session('errors.alamat')) : ?>is-invalid<?php endif ?>"  name="alamat" id="full"  placeholder="Enter Alamat"><?= $r['alamat']; ?></textarea>
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.alamat') ?>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row required mb-3">
                            <label class="form-label col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea type="text" style="min-height:130px" class="form-control <?php if(session('errors.keterangan')) : ?>is-invalid<?php endif ?>"  name="keterangan" id="full"  placeholder="Enter Embed Google Maps "><?= $r['keterangan']; ?></textarea>
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.keterangan') ?>
                                </div> 
                            </div>
                        </div>

                        <div class="form-group row  mb-3">
                            <label class="form-label col-sm-3 col-form-label">Icon Website</label>
                            <div class="col-sm-9">                    
                                <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal image 500 Kb</span>     
                                <input type="file" class="form-control <?php if(session('errors.icon_website')) : ?>is-invalid<?php endif ?>" id="icon_website" name="icon_website" aria-describedby="inputGroupFileAddon01">
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.icon_website') ?>
                                </div> 
                                <?php if($r['icon_website'] <> ''){ ?>
                                <div class="w-100"></div>
                                <div class="mt-2">
                                    <img src="<?= base_url('assets') ?>/images/contact/<?= $r['icon_website'] ?>" style="max-width:200px">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row  mb-3">
                            <label class="form-label col-sm-3 col-form-label">Logo Website 1</label>
                            <div class="col-sm-9">                    
                                <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal image 500 Kb</span>     
                                <input type="file" class="form-control <?php if(session('errors.logo_website')) : ?>is-invalid<?php endif ?>" id="logo_website" name="logo_website" aria-describedby="inputGroupFileAddon01">
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.logo_website') ?>
                                </div> 
                                <?php if($r['logo_website'] <> ''){ ?>
                                <div class="w-100"></div>
                                <div class="mt-2">
                                    <img src="<?= base_url('assets') ?>/images/contact/<?= $r['logo_website'] ?>" style="max-width:200px">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row  mb-3">
                            <label class="form-label col-sm-3 col-form-label">Logo Website 2</label>
                            <div class="col-sm-9">                    
                                <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal image 500 Kb</span>     
                                <input type="file" class="form-control <?php if(session('errors.logo_website_2')) : ?>is-invalid<?php endif ?>" id="logo_website_2" name="logo_website_2" aria-describedby="inputGroupFileAddon01">
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.logo_website_2') ?>
                                </div> 
                                <?php if($r['logo_website_2'] <> ''){ ?>
                                <div class="w-100"></div>
                                <div class="mt-2">
                                    <img src="<?= base_url('assets') ?>/images/contact/<?= $r['logo_website_2'] ?>" style="max-width:200px">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        

                        <div class="mt-4">
                            <button type="submit" class="btn btn-teal ml-1">Update Contact Website</button>
                        </div>

                    </form>
            </div>
            
        </div>
    </div>

</div>

    

<?= $this->endSection() ?>