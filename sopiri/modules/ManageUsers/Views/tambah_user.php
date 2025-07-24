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
                            <a href="/manage-users" class="btn btn-secondary d-none d-sm-inline-block">
                                <i class="fas fa-undo me-2"></i>Back
                            </a>
                            <a href="/manage-users" class="btn btn-secondary d-sm-none btn-icon" >
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

                <form action="/manage-save-users" method="post"  class="form form-horizontal" enctype="multipart/form-data" >
                    <?= csrf_field() ?>

                    <div class="form-group row required mb-3">
                        <label  class="form-label col-sm-3 col-form-label">Nama Lengkap </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php if(session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname"  value="<?= old('fullname'); ?>"  placeholder="Enter fullname">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.fullname') ?>
                            </div>  
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label  class="form-label col-3 col-form-label">E-mail</label>
                        <div class="col-sm-9">
                            <input type="text"  class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email"  value="<?= old('email'); ?>" placeholder="E-mail" >
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.email') ?>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label  class="form-label col-sm-3 col-form-label">Username </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username"  value="<?= old('username'); ?>"  placeholder="Enter Username">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.username') ?>
                            </div>  
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label  class="form-label col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" name="password"  value="<?= old('password'); ?>"  placeholder="Enter Password">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.password') ?>
                            </div>  
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label  class="form-label col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control <?php if(session('errors.confirm_password')) : ?>is-invalid<?php endif ?>" name="confirm_password"  value="<?= old('confirm_password'); ?>"  placeholder="Enter Confirm Password">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.confirm_password') ?>
                            </div>  
                        </div>
                    </div>
                    <div class="form-group row required mb-3">
                        <label  class="form-label col-sm-3 col-form-label">Groups Access</label>
                        <div class="col-sm-9">
                            <select id="select2bs4" class="form-select py-2  <?php if(session('errors.groups_access')) : ?>is-invalid<?php endif ?>" name="groups_access" >
                                <option value="">Please Select</option>
                                <?php foreach($auth_groups as $k){ ?>
                                <option value="<?= $k['id'] ?>" <?php if(old('groups_access') == $k['id']){echo 'selected';} ?> ><?= $k['name'] ?> - <?= $k['description'] ?></option>
                                <?php } ?>
                            </select>   
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i><?= session('errors.groups_access') ?>
                            </div>      
                        </div>
                    </div>
                    
                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary ml-1">Tambah Users</button>

                    </div>

                </form>

            </div>
            
        </div>
    </div>

</div>

    

<?= $this->endSection() ?>