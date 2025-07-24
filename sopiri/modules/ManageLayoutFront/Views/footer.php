		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="row g-2 mb-5">
					<div class="col-lg-4">
                      <div class="text-center"><img src="<?= base_url('assets/images/contact/'.$contact['logo_website'])?>" style="max-width:200px" alt="" class="img-fluid"></div><br>
                      <p>
                        <?= $contact['alamat'] ?><br>
                        <strong>No WA:</strong> <a href="https://wa.me/<?= str_replace("+","",str_replace("-","",$contact['no_telp'])) ?>" target="_blank"><?= $contact['no_telp'] ?></a><br>
                      </p>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-6 col-12">
								<ul class="list-unstyled">
            						<li><a href="https://www.facebook.com/profile.php?id=61560186201839" target="_blank"><span class="fa fa-brands fa-facebook-f">:</span> <?= $contact['facebook'] ?></a></li>
            						<li><a href="https://www.instagram.com/<?= str_replace("@","",$contact['ig']) ?>" target="_blank"><span class="fa fa-brands fa-instagram">:</span> <?= $contact['ig'] ?></a></li>
            						<li><a href="https://www.tiktok.com/<?= $contact['tiktok'] ?>" target="_blank"><span class="fa fa-brands fa-tiktok">:</span> <?= $contact['tiktok'] ?></a></li>
            						<li><a href="https://www.youtube.com/@<?= str_replace(" ","",$contact['youtube']) ?>" target="_blank"><span class="fa fa-brands fa-youtube">:</span> <?= $contact['youtube'] ?></a></li>
								</ul>
							</div>
							
							<div class="col-6 col-sm-6 col-md-6 col-12">
								<ul class="list-unstyled">
									<li><a href="<?= base_url('content/tentang-kami') ?>">Tentang</a></li>
									<li><a href="<?= base_url('content/materi-dan-persyaratan') ?>">Materi dan Syarat</a></li>
									<li><a href="<?= base_url('list-paket') ?>">List Paket</a></li>
									<li><a href="<?= base_url('content/tanya-jawab') ?>">QnA</a></li>
								</ul>
							</div>

						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; <a href="https://sopiri.com">Sopiri.com</a></p>
						</div>
					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	