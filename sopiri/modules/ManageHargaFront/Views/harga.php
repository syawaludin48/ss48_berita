<?= $this->extend('Modules\ManageLayoutFront\Views\layout') ?>

<?= $this->section('content') ?>

<main id="main">

    <section class="inner-page mt-5">
      <div class="container" style="font-size:14px">

        <div class="col-sm-12 mb-5">

            <div class="mb-5 ">
                <h4 class="font-weight-bold px-2 py-1" style="font-family: 'Lora', serif;color:#073c64;border-left:5px solid #ffc107"><?= $judul ?></h4>
            </div>
            <div class="w-100"></div>
            
            <div class="row mx-auto">
                <div class="col-sm-4 col-12 mb-5" align="center">
                    <div class="card">
                        <p class="heading">
                            Paket Hemat
                        </p>
                        <p style="font-size:16px;">
                            Harga: 198rb
                        </p>
                        <p class="ml-2">
                            1 kali sesi Latihan<br>
                            2 jam/sesi
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 col-12 mb-5" align="center">
                    <div class="card">
                        <p class="heading">
                            Paket Pemula
                        </p>
                        <p style="font-size:16px;">
                            Harga: 388rb
                        </p>
                        <p class="ml-2">
                            2 kali sesi Latihan<br>
                            2 jam/sesi
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 col-12 mb-5" align="center">
                    <div class="card">
                        <p class="heading">
                            Paket Serius
                        </p>
                        <p style="font-size:16px;">
                            Harga: 588rb
                        </p>
                        <p class="ml-2">
                            3 kali sesi Latihan<br>
                            2 jam/sesi
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mx-auto">
                <div class="col-sm-2 col-12"></div>
                <div class="col-sm-4 col-12 mb-5" align="center">
                    <div class="card">
                        <p class="heading">
                            Paket Sultan
                        </p>
                        <p style="font-size:16px;">
                            Harga: 788rb
                        </p>
                        <p class="ml-2">
                            4 kali sesi Latihan<br>
                            2 jam/sesi
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 col-12 mb-5" align="center">
                    <div class="card">
                        <p class="heading">
                            Paket Eksekutif Orang Sibuk
                        </p>
                        <p style="font-size:16px;">
                            Harga: 1.388rb
                        </p>
                        <p class="ml-2">
                            1 hari 7 jam + SIM A
                        </p>
                    </div>
                </div>
                <div class="col-sm-2 col-12"></div>
            </div>

        </div>

      </div>
    </section>
    
</main>
<!-- End #main -->
<?= $this->endSection() ?>