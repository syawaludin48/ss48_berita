
<?= $this->extend('Modules\Login\Views\layout') ?>

<?= $this->section('content') ?>      



<!-- [ auth-signin ] start -->

<div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="<?= route_to('reset-password') ?>" method="post">
		<?= csrf_field() ?>
		<?php $random = sha1(time().rand(111111,999999)); ?>
		
          <div class="card-body">
            <h2 class="card-title text-center mb-4"><?=lang('Auth.resetYourPassword')?></h2>            
            <p><?=lang('Auth.enterCodeEmailPassword')?></p><br>

            <div class="mb-3">
              <label class="form-label">Token</label>
              <input type="text" class="form-control <?php if(session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="Enter token" value="<?= old('token') ?>">
				<div class="invalid-feedback text-left">
					<?= session('errors.token') ?>
				</div>
            </div>
            <div class="mb-3">
              <label class="form-label">E-mail</label>
              <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="Enter email" value="<?= old('email') ?>">
				<div class="invalid-feedback text-left">
					<?= session('errors.email') ?>
				</div>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Enter password" value="<?= old('password') ?>">
				<div class="invalid-feedback text-left">
					<?= session('errors.password') ?>
				</div>
            </div>
            <div class="mb-3">
              <label class="form-label"><?=lang('Auth.repeatPassword')?></label>
              <input type="password" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="Enter pass confirm" value="<?= old('pass_confirm') ?>">
				<div class="invalid-feedback text-left">
					<?= session('errors.pass_confirm') ?>
				</div>
            </div>

            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100"><?=lang('Auth.resetPassword')?></button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="<?= route_to('login') ?>" tabindex="-1">Sign in</a>
        </div>
      </div>
<!-- [ auth-signin ] end -->
<?= $this->endSection() ?>