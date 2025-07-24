
<?php 
    
		$db = \Config\Database::connect();
    
    $hero = $db
    ->table('hero')
    ->where('draf', 0)
    ->get()
    ->getRowArray();

?>
  <section id="hero" class="d-flex align-items-center" style="background: url(<?= base_url('assets/images/hero/'.$hero['image_hero']) ?>) top center;">
    <div class="container">
      <h1><?= $hero['judul_hero'] ?></h1>
      <h6><?= $hero['keterangan_hero'] ?></h6>
      <a href="<?= $hero['link_hero'] ?>" class="btn-get-started scrollto font-weight-bold" target="_BLANK">Read More</a>
    </div>
  </section>