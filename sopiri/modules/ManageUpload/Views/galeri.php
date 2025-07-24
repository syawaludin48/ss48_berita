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
                        
                    <?php if(has_permission('manage-tambah-data')){ ?>
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-backdrop="static" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="far fa-plus-square me-2"></i>Tambah Data
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-backdrop="static" data-bs-toggle="modal" data-bs-target="#tambah" aria-label="Create new report">
                                <i class="far fa-plus-square me-2"></i>
                            </a>
                            <a href="/manage-galeri-master" class="btn btn-secondary d-none d-sm-inline-block">
                                <i class="fas fa-long-arrow-alt-left me-2"></i>Back
                            </a>
                            <a href="/manage-galeri-master" class="btn btn-secondary d-sm-none btn-icon" >
                                <i class="fas fa-long-arrow-alt-left me-2"></i>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            
            <div class="modal modal-blur fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div  class="mb-2" >
                                <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                            </div>

                            <form action="<?= route_to('manage-galeri-master-save-galeri') ?>" method="post"  enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <input type="hidden" name="random" value="<?= $gal['random'] ?>" >
                            <input type="hidden" name="id_galeri" value="<?= $gal['id'] ?>" >
                            
                            <div class="form-group required mb-2">
                                <label class="form-label">Image</label>              
                                <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal masing masing image 200 kb</span>     
                                <input type="file" class="form-control <?php if(session('errors.img_galeri')) : ?>is-invalid<?php endif ?>" id="img_galeri" multiple name="img_galeri[]" aria-describedby="inputGroupFileAddon01">
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i><?= session('errors.img_galeri') ?>
                                </div> 
                            </div> 

                        </div>
                        
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                            </a>
                            <button type="submit" class="btn btn-primary ml-1">Tambah</button>
                        </div>
                        </form>

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

                <div class="table-responsive"> 
                
                    <table class="table card-table table-vcenter text-nowrap datatable table-data" id="">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Image</th>
                                <?php if(has_permission('manage-delete-data')){ ?>
                                <th class="text-center">Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($galeri as $r ): 
                            ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td><img src="<?= base_url('assets/images/galeri/'.$r['img']) ?>" class="img-fluid" style="max-width:300px"> </td>
                                
                                <?php if(has_permission('manage-delete-data')){ ?>
                               
                                    <td class="text-center">

                                        <?php if(has_permission('manage-delete-data')){ ?>
                                            <a href="#" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-target="#delete<?= $r['random'] ?>" class="btn btn-sm bg-red-lt py-1"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                        <?php } ?>   

                                    </td>
                                
                                <?php } ?> 

                            </tr>
                            
                            
                            <!-- Modal Delete -->
                                
                            <div class="modal modal-blur fade" id="delete<?= $r['random'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="modal-status bg-danger"></div>
                                        <div class="modal-body text-center py-4">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                                            <h3>Apakah anda yakin ?</h3>
                                            <div class="text-muted">Apakah anda benar-benar ingin menghapus data ini? Apa yang telah anda lakukan tidak dapat dibatalkan.</div>
                                        </div>
                                        
                                        <form action="<?= route_to('manage-galeri-master-delete-galeri') ?>" method="post">
                                        <?= csrf_field() ?>

                                        <input type="hidden" class="form-control" id="link" name="link" value="<?= $gal['random'] ?>">
                                            <input type="hidden" class="form-control" id="random" name="random" value="<?= $r['random'] ?>">
                                            <input type="hidden" name="img" value="<?= $r['img'] ?>" >

                                        <div class="modal-footer">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="#" class="btn btn-white w-100" data-bs-dismiss="modal">Cancel</a>
                                                    </div>
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <?php 
                                $no++;
                                endforeach; 
                            ?>
                            
                        </tbody>
                    </table>

                </div>

            </div>
            
        </div>
    </div>

</div>

    

<?= $this->endSection() ?>