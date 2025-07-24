<?php

$db = \Config\Database::connect();

  $ur = $db
  ->table('auth_groups')
  ->select('auth_groups.name,auth_groups.description')
  ->join('auth_groups_users','auth_groups_users.group_id=auth_groups.id','left')
  ->where('auth_groups_users.user_id', user()->id)
  ->get()
  ->getRowArray();

  if($ur['name'] == 'super_administrator'){
	  $bg = 'bg-purple-lt';
  }elseif($ur['name'] == 'administrator'){
	  $bg = 'bg-green-lt';
  }else{
	  $bg = 'bg-blue-lt';
  }

?>
<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
<div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
	<span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav flex-row order-md-last">
	<div class="nav-item dropdown d-none d-md-flex me-3">
	  <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
		<!-- Download SVG icon from http://tabler-icons.io/i/bell -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
		<span class="badge bg-red"></span>
	  </a>
	  <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
		<div class="card">
		  <div class="card-body">
			  
		  </div>
		</div>
	  </div>
	</div>
	<div class="nav-item dropdown">
	  <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
		<span class="avatar avatar-sm" style="background-image: url(<?= base_url('assets/')?>/images/profile/<?= user()->user_image ?>)"></span>
		<div class="d-none d-xl-block ps-2">
		  <div class="font-weight-bold text-dark"><?= user()->fullname ?></div>
		  <div class="mt-1 small text-muted font-weight-bold "><?= $ur['description']; ?></div>
		</div>
	  </a>
	  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
		<a href="<?= base_url('manage-users/profile').'/'.user()->random; ?>" class="dropdown-item">Profile & account</a>
		<div class="dropdown-divider"></div>
		<a href="<?php echo base_url('logout') ?>" class="dropdown-item">Logout</a>
	  </div>
	</div>
  </div>
  <div class="collapse navbar-collapse" id="navbar-menu">
	<div class="font-weight-bold text-dark">
	WEBSITE KEMAHASISWAAAN UNIVERSITAS STEKOM
	  <!-- <form action="." method="get">
		<div class="input-icon">
		  <span class="input-icon-addon">
			  
			<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
		  </span>
		  <input type="text" class="form-control" placeholder="Search…" aria-label="Search in website">
		</div>
	  </form> -->
	</div>
  </div>
</div>
</header>