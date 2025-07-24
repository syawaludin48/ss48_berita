<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= $title ?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url('assets') ?>/images/contact/<?= $contact['icon_website'] ?>" rel="icon">
	<link href="<?= base_url('assets') ?>/images/contact/<?= $contact['icon_website'] ?>" rel="apple-touch-icon">

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css?v=2.6" />
	<!-- Vendor CSS Files -->
	<link href="<?= base_url('assets/front')?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/mdi/css/materialdesignicons.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/owl.carousel/assets/owl.theme.default.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

	<link href="<?= base_url('assets/administrator')?>/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="<?= base_url('assets/administrator')?>/datatables-responsive/css/responsive.bootstrap4.css" rel="stylesheet">
	<link href="<?= base_url('assets/administrator')?>/select2/css/select2.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/administrator')?>/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet">
	<!-- Animate CSS -->
	<link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Monda:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">




	<!-- Template Main CSS File -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/css/tiny-slider.css" rel="stylesheet">
	<link href="<?= base_url('assets/front')?>/css/style.css" rel="stylesheet">

  <style>
    .card {
      position: relative;
      width: 240px;
      height: 304px;
      background-color: #000;
      display: flex;
      flex-direction: column;
      justify-content: end;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      color: white;
    }
    
    .card::before {
      content: '';
      position: absolute;
      inset: 0;
      left: -5px;
      margin: auto;
      width: 250px;
      height: 324px;
      border-radius: 10px;
      background: linear-gradient(-45deg, #e81cff 0%, #40c9ff 100% );
      z-index: -10;
      pointer-events: none;
      transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .card::after {
      content: "";
      z-index: -1;
      position: absolute;
      inset: 0;
      background: linear-gradient(-45deg, #fc00ff 0%, #00dbde 100% );
      transform: translate3d(0, 0, 0) scale(0.95);
      filter: blur(20px);
    }
    
    .heading {
      font-size: 24px;
      text-transform: capitalize;
      font-weight: 700;
    }
    
    .card p:not(.heading) {
      font-size: 14px;
    }
    
    .card p:last-child {
      color: #fff;
      font-weight: 600;
    }
    
    .card:hover::after {
      filter: blur(30px);
    }
    
    .card:hover::before {
      transform: rotate(-90deg) scaleX(1.34) scaleY(0.77);
    }
      
  </style>

	<style>
        .form-group.required .col-form-label:after {
            content:" *";
            color:red;
        }
        .form-group.required:not(.form-check-label)  .form-label:after {
            content:" *";
            color:red;
        }
    </style>
    
</head>

<body >

  <!-- ======= Top Bar ======= -->

  <!-- ======= Header ======= -->
        <?= $this->include('Modules\ManageLayoutFront\Views\navbar') ?> 
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
    <?php if( $seg1== ''){ ?>
        <?= $this->include('Modules\ManageLayoutFront\Views\slide') ?>         
    <?php } ?>
  <!-- End Hero -->

  <!-- CONTENT -->
        <?= $this->renderSection('content') ?>

  <!-- ======= Footer ======= -->
        <?= $this->include('Modules\ManageLayoutFront\Views\footer') ?> 
  <!-- End Footer -->


  <!-- Vendor JS Files -->
  
	<script src="<?= base_url('assets/front')?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/php-email-form/validate.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/venobox/venobox.min.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/waypoints/jquery.waypoints.min.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/counterup/counterup.min.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="<?= base_url('assets/front')?>/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

	<!-- Simple Datatable -->
	<script src="<?= base_url('assets/administrator')?>/datatables/jquery.dataTables.js"></script>
	<script src="<?= base_url('assets/administrator')?>/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<script src="<?= base_url('assets/administrator')?>/datatables-responsive/js/responsive.bootstrap4.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

	<script src="<?= base_url('assets/administrator')?>/select2/js/select2.full.min.js"></script>
	<script src="<?= base_url('assets/administrator')?>/js/jq.multiinput.js"></script>
	<!-- Template Main JS File -->
	<script src="<?= base_url('assets/front/js/bootstrap.bundle.min.js')?>"></script>
	<script src="<?= base_url('assets/front/js/tiny-slider.js')?>"></script>
	<script src="<?= base_url('assets/front/js/custom.js')?>"></script>	
	


</body>

</html>