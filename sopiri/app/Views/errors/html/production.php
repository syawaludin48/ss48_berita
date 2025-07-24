<!-- <!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">

	<title>Whoops!</title>

	<style type="text/css">
		<?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
	</style>
</head>
<body>

	<div class="container text-center">

		<h1 class="headline">Whoops!</h1>

		<p class="lead">We seem to have hit a snag. Please try again later...</p>

	</div>

</body>

</html> -->
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Blank Page</title>

  
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" /> 

    <!-- CSS files -->
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler-vendors.min.css" rel="stylesheet"/>
    <!-- <link href="<?php //echo base_url('assets/vendor')?>/css/demo.min.css" rel="stylesheet"/> -->
    
  </head>
  <body class="antialiased">
    <div class="wrapper">

      <div class="page-wrapper">


	   <div class="page-body">
          <div class="container-xl d-flex flex-column justify-content-center">
            <div class="empty">
              <div class="empty-img"><img src="<?= base_url('assets')?>/images/errorpage.jpg"  alt="">
              </div>
              <p class="empty-title">Oops… You just found an error page</p>
              <p class="empty-subtitle text-muted">
			  We are sorry but our server encountered an internal error.
              </p>
              <div class="empty-action">
                <a href="javascript:window.history.go(-1);" class="btn btn-primary">
                  <i class="fas fa-undo mx-2"></i>Back to previous page !!!
                </a>
              </div>
            </div>
          </div>
        </div>



      </div>


    </div>

	
    <!-- Tabler Core -->
    <script src="<?php echo base_url('assets/vendor')?>/js/tabler.min.js"></script>

  </body>
</html>