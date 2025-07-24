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
            <div class="col-sm-12 mb-3 ">
<?php /*
                <div class="p-3 text-center">
                  <img style="height:70%;" src="<?= base_url('assets/images/contact/qrkontak.png') ?>" alt="thumb"  class="img-fluid" />
                </div>
*/ ?>
                <div class="p-3 text-center" style="font-size:16px;">
                    <a href="<?= base_url() ?>"><h6 class="font-weight-bold mt-3">www.sopiri.com</h6></a>
                    <span><?= $contact['alamat'] ?></span><br><br>
					<a href="https://wa.me/<?= str_replace("+","",str_replace("-","",$contact['no_telp'])) ?>" target="_blank"><span class="fa fa-brands fa-whatsapp">:</span> <?= $contact['no_telp'] ?></a><br>
					
                    <h6 class="font-weight-bold mt-3">Ikuti Kami di Sosial Media:</h6>
					<a href="https://www.facebook.com/profile.php?id=61560186201839" target="_blank"><span class="fa fa-brands fa-facebook-f">: </span> <?= $contact['facebook'] ?></a><br>
					<a href="https://www.instagram.com/<?= str_replace("@","",$contact['ig']) ?>" target="_blank"><span class="fa fa-brands fa-instagram">: </span> <?= $contact['ig'] ?></a><br>
					<a href="https://www.tiktok.com/<?= $contact['tiktok'] ?>" target="_blank"><span class="fa fa-brands fa-tiktok" >: </span> <?= $contact['tiktok'] ?></a><br>
					<a href="https://www.youtube.com/@<?= str_replace(" ","",$contact['youtube']) ?>" target="_blank"><span class="fa fa-brands fa-youtube" >: </span> <?= $contact['youtube'] ?></a><br>
                </div>
            </div>
            

        </div>

      </div>
    </section>
    
</main>
<!-- End #main -->
<?= $this->endSection() ?>