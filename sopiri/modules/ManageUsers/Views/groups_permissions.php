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
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-backdrop="static" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="far fa-plus-square me-2"></i>Tambah Data
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-backdrop="static" data-bs-toggle="modal" data-bs-target="#tambah" aria-label="Create new report">
                                <i class="far fa-plus-square me-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah -->

            <div class="modal modal-blur fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div  class="mb-2" >
                            <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                        </div>

                        <form action="<?= route_to('manage-tambah-groups-permissions') ?>" method="post">
                        <?= csrf_field() ?> 

                        <span class="font-weight-bold">Groups : 
                                <?php if(session('errors.groups')){ ?>
                                <span class="text-danger"><i class="bx bx-radio-circle"></i><?= session('errors.groups') ?></span>
                                <?php } ?>
                            </span><br>

                                <div class="row">
                                <?php

                                    $i = 1;
                                    foreach($groups as $rr):

                                ?>
                                    <div class="col-sm-3">
                                        <div class='form-check'>
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="form-check-input form-check-primary" value="<?= $rr['id'] ?>" <?php if(old('groups') == $rr['id']){ echo 'checked';} ?> name="groups" id="<?= $i ?>">
                                                <label class="form-check-label" for="<?= $i ?>"><?= $rr['name'] ?></label>
                                                
                                            </div>
                                        </div>
                                    </div>

                                <?php 
                                    $i++;    
                                    endforeach; 
                                ?>
                                </div>
                                <br>

                                <span class="font-weight-bold">Permissions :
                                <?php if(session('errors.pemissions')){ ?>
                                <span class="text-danger"><i class="bx bx-radio-circle"></i><?= session('errors.pemissions') ?></span>
                                <?php } ?>
                            </span><br>
                                <!-- <div class="row"> -->
                                    
                                <?php

                                    $i = 1;
                                    foreach($permissions as $rr):
                                        
                                        if(cek_manage_group_menu($rr['name'])){
                                            $bg = 'bg-purple rounded';
                                        }else{
                                            
                                            if(cek_manage_menu($rr['name'])){
                                                $bg = 'bg-teal rounded';
                                            }else{
                                                $bg = '';
                                            }

                                        }
                                ?>
                                    <!-- <div class="col-sm-6"> -->
                                        <div class='form-check '>
                                            <div class="custom-control custom-checkbox <?= $bg ?>">
                                                <input type="checkbox" class="form-check-input form-check-primary"  value="<?= $rr['id'] ?>" name="pemissions[]" id="<?= $i ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="form-check-label" for="<?= $i ?>"><?= $rr['description'] ?></label>

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-check-label" for="<?= $i ?>"><?= $rr['name'] ?></label>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->

                                <?php 
                                    $i++;    
                                    endforeach; 
                                ?>
                                <!-- </div> -->




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
                                <th class="text-center">Group</th>
                                <th class="text-center">Total Permissions</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                                $db = \Config\Database::connect();

                                $no = 1;
                                foreach($users as $r ): 
                                
                                    $builder = $db->table('auth_groups_permissions');
                                    $builder->where('group_id', $r['g_id']);
                                    $total = $builder->countAllResults();
                            ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td><?= $r['name_groups']; ?></td>
                                <td class="text-center"><?= $total; ?></td>
                                <td class="text-center">

                                    <a href="#" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-target="#edit<?= $r['g_id'] ?>" class="btn btn-sm bg-teal-lt py-1"><i class="far fa-edit me-2"></i>Edit</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-target="#delete<?= $r['g_id'] ?>" class="btn btn-sm bg-red-lt py-1"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                     
                                </td>
                            </tr>
                            
                            <!-- Modal Edit -->

                            <div class="modal modal-blur fade" id="edit<?= $r['g_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div  class="mb-2" >
                                            <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                                        </div>

                                        <form action="<?= route_to('manage-edit-groups-permissions') ?>" method="post">
                                            <?= csrf_field() ?>
                                                    
                                            <span class="font-weight-bold">Groups : 
                                                <?php if(session('errors.groups')){ ?>
                                                <span class="text-danger"><i class="bx bx-radio-circle"></i><?= session('errors.groups') ?></span>
                                                <?php } ?>
                                            </span><br>
                                                <div class="row">
                                                <?php

                                                    $i = 1;
                                                    foreach($groups as $rr):

                                                ?>
                                                    <div class="col-sm-3">
                                                        <div class='form-check'>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="radio" class="form-check-input form-check-success" value="<?= $rr['id'] ?>" <?php if($r['g_id'] == $rr['id']){echo 'checked';} ?> name="groups" id="<?= $i ?>">
                                                                <label class="form-check-label" for="<?= $i ?>"><?= $rr['name'] ?></label>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php 
                                                    $i++;    
                                                    endforeach; 
                                                ?>
                                                </div><br> 

                                                <span class="font-weight-bold">Permissions :
                                                    <?php if(session('errors.pemissions')){ ?>
                                                    <span class="text-danger"><i class="bx bx-radio-circle"></i><?= session('errors.pemissions') ?></span>
                                                    <?php } ?>
                                                </span><br>

                                                <!-- <div class="row"> -->
                                                <?php
                                                

                                                    $i = 1;
                                                    foreach($permissions as $rr):

                                                        if(cek_manage_group_menu($rr['name'])){
                                                            $bg = 'bg-purple rounded';
                                                        }else{
                                                            
                                                            if(cek_manage_menu($rr['name'])){
                                                                $bg = 'bg-teal rounded';
                                                            }else{
                                                                $bg = '';
                                                            }

                                                        }
                                                        
                                                        $builder = $db->table('auth_groups_permissions');
                                                        $builder->where('group_id', $r['g_id']);
                                                        $builder->where('permission_id', $rr['id']);                                                
                                                        $checked = $builder->countAllResults();

                                                ?>
                                                    <input type="hidden" name="id_groups" value="<?= $r['g_id'] ?>">
                                                    <!-- <div class="col-sm-6"> -->
                                                        <div class='form-check'>
                                                            <div class="custom-control custom-checkbox <?= $bg ?>">
                                                                <input type="checkbox" class="form-check-input form-check-success" name="pemissions[]" value="<?= $rr['id'] ?>"  <?php if($checked > 0){echo 'checked';} ?> id="<?= $i ?>">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label class="form-check-label" for="<?= $i ?>"><?= $rr['description'] ?></label>

                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="form-check-label" for="<?= $i ?>"><?= $rr['name'] ?></label>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- </div> -->

                                                <?php 
                                                    $i++;    
                                                    endforeach; 
                                                ?>
                                                <!-- </div> -->




                                    </div>

                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-link text-teal link-secondary" data-bs-dismiss="modal">
                                            Cancel
                                            </a>
                                            <button type="submit" class="btn btn-teal ml-1">Update</button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal Delete -->
                                
                            <div class="modal modal-blur fade" id="delete<?= $r['g_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        
                                        <form action="<?= route_to('manage-delete-groups-permissions') ?>" method="post">
                                        <?= csrf_field() ?>

                                        <input type="hidden" class="form-control" id="id_groups" name="id_groups" value="<?= $r['g_id'] ?>">

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