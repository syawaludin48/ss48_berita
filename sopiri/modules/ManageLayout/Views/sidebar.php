        <?php

        $db = \Config\Database::connect();

          $tema = $db
          ->table('temaku')
          ->select('class,font_color')
          ->where('status', 0)
          ->get()
          ->getRowArray();

        ?>

        <aside class="navbar navbar-vertical navbar-expand-lg  <?= $tema['class'] ?> ">
        <div class="container-fluid mb-5">


        <?php

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

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-lg-none"><span class="badge <?= $bg ?>" ><?= $ur['description']; ?></span>
            <!-- <a href=".">
              <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a> -->
          </h1>

          <div class="text-center d-none d-lg-inline-block mt-3">
            <span class="avatar avatar-md avatar-rounded" style="background-image: url(<?= base_url('assets/')?>/images/profile/<?= user()->user_image ?>)"></span>
             
            <div class="nav-item dropdown my-1 ">
              <a href="#" class="nav-link d-flex justify-content-center" data-bs-toggle="dropdown">
                <h5 class="text-uppercase <?= $tema['font_color'] ?>"><?= user()->fullname ?></h5>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?= base_url('manage-users/profile').'/'.user()->random; ?>" class="dropdown-item">Profile & account</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url('logout') ?>" class="dropdown-item">Logout</a>
              </div>
            </div>
            
            <div style="margin-top:-10px">
                <span class="badge <?= $bg ?>" style="font-size:9px" ><?= $ur['description']; ?></span>
            </div>
            

          </div>
          
          <div class="navbar-nav flex-row d-lg-none">

            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(<?= base_url('assets/')?>/images/profile/<?= user()->user_image ?>)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div><?= user()->fullname ?></div>
                  <div class="mt-1 small text-muted"><?= $ur['description']; ?></div>
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
            <ul class="navbar-nav pt-lg-3">
                
              

              <?php 
              
                // $group_menu = $db
                // ->table('menu_group')
                // ->select('menu.manage,menu.status,nama_group,menu_group.id,menu.id as menu_id')
                // ->join('menu','menu.id_group=menu_group.id','left')
                // ->where('menu_group.deleted_at', null)
                // ->where('menu.status', 0)
                // ->groupBy('menu.id_group')
                // ->orderBy('menu_group.no_urut', 'asc')
                // ->get()
                // ->getResultArray();

                $group_menu = $db
                ->table('menu_group')
                ->select('id,manage,nama_group')
                ->where('deleted_at', null)
                ->orderBy('no_urut', 'asc')
                ->get()
                ->getResultArray();
                // dd($group_menu);

                foreach($group_menu as $mg){ 
                  
                // if( $mg['status'] == 0): 
                if(has_permission($mg['manage'])):

                ?>
                    <li class="nav-item">
                        <a class="nav-link">
                        <span class="nav-link-title text-primary font-weight-bold" style="font-size:14px">
                        <?= $mg['nama_group']; ?>
                        </span>
                        </a>
                    </li>

                <?php

                    $db = \Config\Database::connect();

                    $menu= $db
                    ->table('menu')
                    ->select('nama_menu,manage,link_menu,id')
                    ->where('id_group', $mg['id'])
                    ->where('deleted_at', null)
                    ->where('status', 0)
                    ->orderBy('no_urut', 'asc')
                    ->get()
                    ->getResultArray();

                    foreach($menu as $m){ 

                    if(has_permission($m['manage'])):

                        $db = \Config\Database::connect();
                
                        $count = $db
                        ->table('sub_menu')
                        ->select('nama_sub_menu,link_sub_menu,id')
                        ->where('id_menu', $m['id'])
                        ->where('deleted_at', null)
                        ->where('status', 0)
                        ->orderBy('no_urut', 'asc')
                        ->countAllResults();

                        $menuall = $db
                        ->table('menu')
                        ->select('menu.id as menu_id')
                        ->join('sub_menu','sub_menu.id_menu=menu.id','left')
                        ->where('menu.link_menu', $seg[0])
                        ->orWhere('sub_menu.link_sub_menu', $seg[0])
                        ->get()
                        ->getRowArray();


                        if($menuall['menu_id'] == $m['id']){
                            $show = 'show';
                            $bold = 'font-weight-bold';
                        }else{
                            $show = '';
                            $bold = '';
                        }                        

                        if($count > 0){ 
                            $link_m = '#';
                        }else{
                            $link_m = base_url($m['link_menu']);
                        }
                        
                    ?>


                    <li class="nav-item dropdown">
                        <?php if($count > 0){ ?>                            
                            <a class="nav-link dropdown-toggle" href="<?= $link_m ?>" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
                            </span>
                            <span class="nav-link-title <?= $bold ?>">
                                <?= $m['nama_menu'] ?>
                            </span>
                            </a>
                            <div class="dropdown-menu <?= $show ?>">
                                
                                <?php 
                                    $db = \Config\Database::connect();
                            
                                    $sub_menu = $db
                                    ->table('sub_menu')
                                    ->select('nama_sub_menu,link_sub_menu,id,manage,')
                                    ->where('id_menu', $m['id'])
                                    ->where('deleted_at', null)
                                    ->where('status', 0)
                                    ->orderBy('no_urut', 'asc')
                                    ->get()
                                    ->getResultArray();
                                ?>

                                <?php 
                                    foreach($sub_menu as $sub){
                                      

                                    if($sub['link_sub_menu'] == $seg[0]){
                                        $act = 'active';
                                        $bg = 'bg-primary';
                                    }else{
                                        $act = '';
                                        $bg = 'bg-secondary';
                                    }
                                  
                                ?>
                                    <?php if( has_permission($sub['manage'])): ?>     
                                    <a class="dropdown-item <?= $act ?>" href="<?php echo base_url($sub['link_sub_menu']) ?>" >
                                    <span class="badge <?= $bg ?> me-1"></span><?= $sub['nama_sub_menu'] ?>
                                    </a>                
                                    <?php endif; ?>
                                <?php } ?> 
                            
                            </div>

                        <?php }else{ ?>  

                            <a class="nav-link" href="<?= $link_m ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
                            </span>
                            <span class="nav-link-title <?= $bold ?>">
                                <?= $m['nama_menu'] ?>
                            </span>
                            </a>

                        <?php } ?>

                    </li>
                    <?php endif; ?>
         
                    <?php } ?> 
                    <?php endif; ?>
                <?php } ?>

              <li class="nav-item">
                  <a class="nav-link">
                  <span class="nav-link-title text-primary font-weight-bold" style="font-size:14px">
                  User 
                  </span>
                  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('logout') ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Log Out
                  </span>
                </a>
              </li>
                
              
            </ul>


          </div>
        </div>
      </aside>