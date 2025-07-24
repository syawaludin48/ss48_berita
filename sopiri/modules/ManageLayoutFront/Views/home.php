<?= $this->extend('Modules\ManageLayoutFront\Views\layout') ?>

<?= $this->section('content') ?>
      
<main id="main"  >
<?php $db = \Config\Database::connect(); ?>

<!-- ======= Services Section ======= -->

		<!-- Start Popular Product -->
		<div class=" mt-5">
			<div class="container">
				<div class="row">

					<div class="col-12 col-md-6 col-lg-4 mb-2 mb-lg-0">
						<div class="product-item-sm d-flex">
							<div class="">
								<img src="<?= base_url('assets/images/depan/1.png')?>" alt="Image" class="img-fluid">
							</div>
						</div>
					</div>

					<div class="col-12 col-md-6 col-lg-4 mb-2 mb-lg-0">
						<div class="product-item-sm d-flex">
							<div class="">
								<img src="<?= base_url('assets/images/depan/2.png')?>" alt="Image" class="img-fluid">
							</div>
						</div>
					</div>

					<div class="col-12 col-md-6 col-lg-4 mb-2 mb-lg-0">
						<div class="product-item-sm d-flex">
							<div class="">
								<img src="<?= base_url('assets/images/depan/3.png')?>" alt="Image" class="img-fluid">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Popular Product -->


		<!-- Start Why Choose Us Section -->
		<div class="mt-5">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h2 class="section-title">Mengapa SOPIRI.com ?</h2>
						<div class="row my-5">
							<div class="col-12 col-md-12">
								<div class="feature">
									<h3>Harga Terjangkau : </h3>
									<p>Belajar mengemudi di Sopiri.com Driving School menyenangkan dan hemat biaya. Berbagai pilihan program dan waktu yang dapat menyesuaikan dengan keinginan anda.</p>
								</div>
							</div>
							<div class="col-12 col-md-12">
								<div class="feature">
									<h3>Jadwal Super Fleksibel : </h3>
									<p>Jadwal dapat disesuaikan dengan keinginan siswa.</p>
								</div>
							</div>
							<div class="col-12 col-md-12">
								<div class="feature">
									<h3>Pemesanan : </h3>
									<p>Booking jadwal bisa dilakukan via WhatsApp 24 jam.</p>
								</div>
							</div>
							<div class="col-12 col-md-12">
								<div class="feature">
									<h3>Instruktur yang Ramah Sopan Aman dan Menyenangkan : </h3>
									<p>Seluruh Instruktur Kami dipastikan bersih, wangi, dan sopan. Mereka juga sabar dan memahami dalam membimbing Anda.</p>
								</div>
							</div>

						</div>
						<p><a href="<?= base_url('content/tentang-kami') ?>" class="btn btn-secondary me-2">Selengkapnya</a></p>
					</div>

					<div class="col-lg-5">
						<div class="">
							<img src="<?= base_url('assets/images/depan/woman-taking-her-driver-s-license-test-vehicle (4).jpg')?>" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->

		<!-- Start We Help Section -->
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
							<div class="grid grid-1"><img src="<?= base_url('assets/images/depan/person-taking-driver-s-license-exam (4).jpg')?>" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="<?= base_url('assets/images/depan/top-view-electric-cars-parking-lot (1).jpg')?>" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="<?= base_url('assets/images/depan/man-using-satellite-navigation-system (1).jpg')?>" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title mb-4">Materi Pelajaran</h2>

						<ul class="list-unstyled custom-list my-4">
							<li>Mengenal rambu-rambu lalu lintas</li>
							<li>Mengenal dan memahami interior mobil</li>
							<li>Cara menahan keseimbangan kopling di tanjakan</li>
							<li>Parkir seri, parallel, serong, maju, dan mundur</li>
							<li>Pemahaman di jalan raya</li>
						</ul>
						<p><a href="<?= base_url('content/materi-dan-persyaratan') ?>" class="btn btn-secondary me-2">Selengkapnya</a></p>
					</div>
				</div>
			</div>
		</div>
		<!-- End We Help Section -->


		<!-- Start Testimonial Slider -->
		<div class="testimonial-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 mx-auto text-center">
						<h2 class="section-title">Testimonials</h2>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="testimonial-slider-wrap text-center">

							<div id="testimonial-nav">
								<span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
								<span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
							</div>

							<div class="testimonial-slider">
								
								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>
                                						<a href="https://youtu.be/7snDJ8ZQNVQ" target="_blank"><span class="fa fa-brands fa-youtube">:</span> https://youtu.be/7snDJ8ZQNVQ</a><br>
                                						<a href="https://vt.tiktok.com/ZSYAFtCsW/" target="_blank"><span class="fa fa-brands fa-tiktok">:</span> https://vt.tiktok.com/ZSYAFtCsW/</a><br>
                                						<a href="https://www.instagram.com/reel/C8Et1wOg8_x/" target="_blank"><span class="fa fa-brands fa-instagram">:</span> https://www.instagram.com/reel/C8Et1wOg8_x/</a><br>
													</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img style="max-width:250px;" src="<?= base_url('assets/images/testimoni/irt.jpg')?>" alt="" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Testimoni Ibu Rumah Tangga</h3>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->

								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>
                                						<a href="https://youtu.be/2kN--34aI48" target="_blank"><span class="fa fa-brands fa-youtube">:</span> https://youtu.be/2kN--34aI48</a><br>
                                						<a href="https://vt.tiktok.com/ZSYAYdf4k/" target="_blank"><span class="fa fa-brands fa-tiktok">:</span> https://vt.tiktok.com/ZSYAYdf4k/</a><br>
                                						<a href="https://www.instagram.com/reel/C8EuXQKx1Wd/" target="_blank"><span class="fa fa-brands fa-instagram">:</span> https://www.instagram.com/reel/C8EuXQKx1Wd/</a><br>
													</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img style="max-width:250px;" src="<?= base_url('assets/images/testimoni/mahasiswa.jpg')?>" alt="" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Testimoni Mahasiswa</h3>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->


							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Testimonial Slider -->


</main>
<!-- End #main -->        

<?= $this->endSection() ?>