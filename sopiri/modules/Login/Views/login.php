
<?= $this->extend('Modules\Login\Views\layout') ?>

<?= $this->section('content') ?>      



<!-- [ auth-signin ] start -->

<div class="container-tight pb-4">
        <div class="text-center mb-4">
          <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="<?= site_url('login.process') ?>" method="post" autocomplete="off">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>
        <?= csrf_field() ?>
                            
        <?php if ($config->validFields === ['email']): ?>
         
            <div class="mb-3">
              <label class="form-label" for="email"><?=lang('Auth.email')?></label>
              <input  type="text"  id="email" name="login" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="Enter email">
                <div class="invalid-feedback text-left">
                    <?= session('errors.login') ?>
                </div>
            </div>

        <?php else: ?>    

            <div class="mb-3">
              <label class="form-label" for="emailOrUsername"><?=lang('Auth.emailOrUsername')?></label>
              <input  type="text"  id="emailOrUsername" name="login" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="Enter email">
                <div class="invalid-feedback text-left">
                    <?= session('errors.login') ?>
                </div>
            </div>

        <?php endif; ?>

            <div class="mb-2">
              <label class="form-label">
                Password
                
                <?php if ($config->activeResetter): ?>
                <span class="form-label-description">
                  <a href="<?= route_to('forgot') ?>">I forgot password</a>
                </span>
                <?php endif; ?>

              </label>
              <div class="input-group input-group-flat">
                <input type="password" id="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?> "  placeholder="Password"  autocomplete="off">
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
                <div class="invalid-feedback text-left">
                    <?= session('errors.password') ?>
                </div>
              </div>
            </div>
            <div class="mb-2">
            <?php if ($config->allowRemembering): ?>
              <label class="form-check">
                <input type="checkbox" class="form-check-input" id="checkbox1" <?php if(old('remember')) : ?> checked <?php endif ?> >
                <span class="form-check-label" for="checkbox1">Remember me on this device</span>
              </label>
            <?php endif; ?>
            </div>
            <div class="form-footer">
              <button class="btn btn-primary w-100">Sign in</button>
            </div>
          </div>
          
          </div>
        </form>
        <!-- <div class="text-center text-muted mt-3">
          Don't have account yet? <a href="./sign-up.html" tabindex="-1">Sign up</a>
        </div> -->
      </div>
<!-- [ auth-signin ] end -->
<?= $this->endSection() ?>