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
                            <a href="/manage-users/tambah-data" class="btn btn-primary d-none d-sm-inline-block" >
                                <i class="far fa-plus-square me-2"></i>Tambah Data
                            </a>
                            <a href="manage-users" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
                                <i class="far fa-plus-square me-2"></i>
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

                <div class="table-responsive"> 
                
                    <table class="table card-table table-vcenter text-nowrap datatable table-data" id="">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role Users</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($users as $r ): 
                            ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td><?= $r['username']; ?></td>
                                <td><?= $r['email']; ?></td>
                                <td><?= $r['name']; ?></td>
                                <td class="text-center">

                                    <a href="/manage-users/profile/<?= $r['random'] ?>"class="btn btn-sm bg-purple-lt py-1"><i class="fas fa-user-tie me-2"></i>Profile</a>
                                    <a href="/manage-users/edit-data/<?= $r['random'] ?>"class="btn btn-sm bg-teal-lt py-1"><i class="fas fa-edit me-2"></i>Edit</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-target="#delete<?= $r['random'] ?>" class="btn btn-sm bg-red-lt py-1"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                     
                                </td>
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
                                        
                                        <form action="<?= route_to('manage-delete-users') ?>" method="post">
                                        <?= csrf_field() ?>

                                        <input type="hidden" class="form-control" id="random" name="random" value="<?= $r['random'] ?>">

                                        <input type="hidden" name="img" value="<?= $r['user_image'] ?>">

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