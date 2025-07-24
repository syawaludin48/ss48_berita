<?= $this->extend('Modules\ManageLayoutFront\Views\layout') ?>

<?= $this->section('content') ?>

<main id="main">


    <section class="inner-page mt-5">
      <div class="container" style="font-size:14px">

            <div class="row">
                <div class="col-sm-12 mb-5">

                    <div class="mb-5 ">
                        <h4 class="font-weight-bold px-2 py-1" style="font-family: 'Lora', serif;color:#073c64;border-left:5px solid #ffc107"><?= $content['nama_content'] ?></h4>
                        <!-- <hr class="mt-0" style="width:80px;height:2px;background-color:#ffc107;float:left"> -->
                    </div>
                    <div class="w-100"></div>
                    <div>
                        <?= $content['content'] ?>
                    </div>

                </div>
            </div>

      </div>
    </section>

  </main><!-- End #main -->

<?= $this->endSection() ?>