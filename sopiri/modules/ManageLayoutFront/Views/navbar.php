		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-light" arial-label="Furni navigation bar">

			<div class="container">
                <a href="<?= base_url() ?>" class="navbar-brand " style="font-size:26px;"><img style="width:25%;" src="<?= base_url('assets/images/contact/'.$contact['logo_website_2'])?>" alt="" class="img-fluid"> Sopiri<span>.com</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        		<?php 
        			
            		$db = \Config\Database::connect();
            
            		$menu = $db
            		->table('menu_website')
            		->select('id,link_menu,nama_menu')
            		->where('deleted_at', null)
            		->where('status', 0)
            		->orderBY('no_urut', 'asc')
            		->get()
            		->getResultArray();
            		
        			foreach($menu as $m){
        				
        			if(cek_link($m['link_menu'])){
        				$link_menu = $m['link_menu'];
        			}else{
        				$link_menu = base_url($m['link_menu']);
        			}
        
        		?>
						<li><a class="nav-link" href="<?= $link_menu ?>"><?= $m['nama_menu'] ?></a></li>
	        	<?php } ?>
					</ul>

				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->