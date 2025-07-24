
    <?php 
        $db = \Config\Database::connect();
        $uri = service('uri');

		$topbar = $db
		->table('x_topbar')
		->select('namatopbar,link')
		->where('deleted_at', null)
		->where('status', 0)
		->orderBY('nourut', 'asc')
		->get()
		->getResultArray();
		
    ?>

  <header id="header" class="fixed-top">
    <div class="top-bar">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="topbar-left">
                    <ul>
                        <?php foreach($topbar as $tp){  ?>
                        <li><a href="<?= $tp['link'] ?>" target="_blank" class="text-capitalize"><?= $tp['namatopbar'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="topbar-right">
                </div>
            </div>
        </div>
    </div>
  </header>