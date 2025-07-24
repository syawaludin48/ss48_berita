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


                <!-- <div class="card"> -->
                    <ul class="nav nav-tabs nav-tabs-alt" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tabs-profile-10" class="nav-link active" data-bs-toggle="tab"><i class="fas fa-user-tie me-2"></i>Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-password-10" class="nav-link" data-bs-toggle="tab"><i class="fas fa-key me-2"></i>Buat Password Baru</a>
                    </li>
                    <li class="nav-item ms-auto">
                        <a href="#tabs-settings-10" class="nav-link" title="Settings" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                        </a>
                    </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-profile-10">
                                <div>

                                    <form action="/manage-users-profile-edit" method="post"  class="form form-horizontal" enctype="multipart/form-data" >
                                    <?= csrf_field() ?>

                                    <?php 

                                        $r = $users; 
                                        
                                        $db = \Config\Database::connect();
                                        $user = $db
                                        ->table('auth_groups')
                                        ->select('auth_groups.name,auth_groups.description')
                                        ->join('auth_groups_users','auth_groups_users.group_id=auth_groups.id','left')
                                        ->where('auth_groups_users.user_id', $r['usersid'])
                                        ->get()
                                        ->getRowArray();

                                        if($user['name'] == 'super_administrator'){
                                            $bg = 'bg-purple-lt';
                                        }elseif($user['name'] == 'administrator'){
                                            $bg = 'bg-green-lt';
                                        }else{
                                            $bg = 'bg-primary-lt';
                                        }

                                    ?>
                                
                                    <input type="hidden" name="img" value="<?= $r['user_image'] ?>">
                                    <input type="hidden" name="id_rand" value="<?= $r['random_users'] ?>">

                                        <div class="row">
                                            <div class="form-label col-sm-3">

                                                <div class="card-body p-4 text-center">
                                                    <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url(<?= base_url('assets/')?>/images/profile/<?= $r['user_image'] ?>)"></span>
                                                    <h3 class="m-0 mb-1"><a href="#"><?= $r['fullname'] ?></a></h3>
                                                    <div class="mt-1">
                                                        <span class="badge <?= $bg ?>"><?= $user['description']; ?></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-9">
                                                
                                                <div  class="mb-3" >
                                                    <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                                                </div>


                                                <div class="form-group row required mb-3">
                                                    <label  class="form-label col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username"  value="<?= $r['username']; ?><?= old('username') ?>"  placeholder="Enter Username">
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i><?= session('errors.username') ?>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="form-group row required mb-3">
                                                    <label  class="form-label col-sm-3 col-form-label">Nama Lengkap</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control <?php if(session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" value="<?= $r['fullname']; ?><?= old('fullname') ?>" placeholder="Enter Nama Lengkap">
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i><?= session('errors.fullname') ?>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group row required mb-3">
                                                    <label  class="form-label col-sm-3 col-form-label">Tanggal Lahir</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control <?php if(session('errors.tanggal_lahir')) : ?>is-invalid<?php endif ?>" name="tanggal_lahir"  value="<?= $r['tanggal_lahir']; ?><?= old('tanggal_lahir') ?>"placeholder="Enter Tanggal Lahir" >
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i><?= session('errors.tanggal_lahir') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row required mb-3">
                                                    <label  class="form-label col-sm-3 col-form-label">Jenis Kelamin</label>
                                                    <div class="col-sm-9">
                                                        <?php $i=1;foreach($jenis_kelamin as $js){?>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input form-check-success  <?php if(session('errors.jenis_kelamin')) : ?>is-invalid<?php endif ?>" name="jenis_kelamin" value="<?= $js['id'] ?>" <?php if($r['jenis_kelamin'] == $js['id'] or old('jenis_kelamin' == $js['id'] )){echo 'checked';} ?> id="<?= $i ?>">
                                                                <label class="form-check-label" for="<?= $i ?>"><?= $js['jenis_kelamin'] ?></label>
                                                            </div>
                                                        <?php $i++;} ?>
                                                            <div class="invalid-feedback">
                                                                <i class="bx bx-radio-circle"></i><?= session('errors.jenis_kelamin') ?>
                                                            </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group row required mb-3">
                                                    <label  class="form-label col-sm-3 col-form-label">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <textarea type="text" class="form-control <?php if(session('errors.alamat')) : ?>is-invalid<?php endif ?>" name="alamat" placeholder="Alamat" ><?= $r['alamat']; ?><?= old('alamat') ?></textarea>
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i><?= session('errors.alamat') ?>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group row required mb-3">
                                                    <label  class="form-label col-sm-3 col-form-label">E-mail</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email"  value="<?= $r['email'] ?><?= old('email') ?>" placeholder="E-mail" >
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i><?= session('errors.email') ?>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group row required mb-3">
                                                    <label  class="form-label col-sm-3 col-form-label">No. Telepon</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control <?php if(session('errors.no_telp')) : ?>is-invalid<?php endif ?>" name="no_telp"value="<?= $r['no_telp']; ?><?= old('no_telp') ?>" placeholder="No. Telepon" >
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i><?= session('errors.no_telp') ?>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group row required mb-3">
                                                    <label class="form-label col-sm-3 col-form-label">Foto Profile</label>
                                                    <div class="col-sm-9">                         
                                                        <span class="text-primary">Format image : jpg | jpeg | png - ukuran maksimal image 500 kb</span>  
                                                        <input type="file" class="form-control <?php if(session('errors.user_image')) : ?>is-invalid<?php endif ?>" id="user_image" name="user_image" aria-describedby="inputGroupFileAddon01">
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i><?= session('errors.user_image') ?>
                                                        </div> 
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        
                                        
                                        <div class="mt-4">

                                            <button type="submit" class="btn btn-teal ml-1">Update Profile Users</button>

                                        </div>

                                    </form>


                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-password-10">
                                <div>

                                <div  class="mb-3" >
                                        <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                                    </div>

                                    <form action="/manage-users-profile-password" method="post"  class="form form-horizontal" enctype="multipart/form-data" >
                                        <?= csrf_field() ?>

                                        <div class="form-group row required mb-3">
                                            <label class="form-label col-sm-3 col-form-label">Password Baru</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control <?php if(session('errors.password_baru')) : ?>is-invalid<?php endif ?>" name="password_baru"  value=""  placeholder="Enter Password Baru">
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i><?= session('errors.password_baru') ?>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="form-group row required mb-3">
                                            <label class="form-label col-sm-3 col-form-label">Confirm Password Baru</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control <?php if(session('errors.confirm_password_baru')) : ?>is-invalid<?php endif ?>" name="confirm_password_baru"  value=""  placeholder="Enter Confirm Password baru">
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i><?= session('errors.confirm_password_baru') ?>
                                                </div>  
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4">

                                            <button type="submit" class="btn btn-teal ml-1">Update Password</button>

                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-settings-10">
                                <div></div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                

            </div>
            
        </div>
    </div>

</div>

    

<?= $this->endSection() ?>