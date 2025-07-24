<?= $this->extend('Modules\ManageLayout\Views\layout') ?>

<?= $this->section('content') ?>
      
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
            

        
            <div class="p-3">
                <?php 
                    $fullname = strtolower(user()->fullname);

                    if($fullname <> ''){
                        $nama = $fullname;
                    }else{
                        $nama = strtolower(user()->username);
                    }
                ?>
                <h3 class="text-capitalize">Hallo, <?= $nama ?>.</h3><br>
                <span>Selamat datang di sistem administrator <B>WEBSITE STIE STEKOM</B></span>
            </div>
          
          </div>
        </div>

<?= $this->endSection() ?>