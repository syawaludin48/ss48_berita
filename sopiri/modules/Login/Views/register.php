
<?= $this->extend('Modules\Login\Views\layout') ?>

<?= $this->section('content') ?>      



<!-- [ auth-signin ] start -->

<div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="<?= route_to('register') ?>" method="post">
		<?= csrf_field() ?>
		<?php $random = sha1(time().rand(111111,999999)); ?>
		
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>

            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Enter username" value="<?= old('username') ?>">
				<div class="invalid-feedback text-left">
					<?= session('errors.username') ?>
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

            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms and policy</a>.</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="<?= route_to('login') ?>" tabindex="-1">Sign in</a>
        </div>
      </div>
<!-- [ auth-signin ] end -->
<?= $this->endSection() ?>