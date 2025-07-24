<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta3
* @link https://tabler.io
* Copyright 2018-2021 The Tabler Authors
* Copyright 2018-2021 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?= $pretitle ?> - <?= $title ?></title>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <!-- CSS files -->
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler-vendors.min.css" rel="stylesheet"/>
    <!-- <link href="<?php //echo base_url('assets/vendor')?>/css/demo.min.css" rel="stylesheet"/> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/administrator')?>/css/jq.multiinput.min.css">


    <link rel="stylesheet" href="<?php echo base_url('assets/administrator')?>/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/administrator')?>/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
	 <!-- Select2 -->

    <link rel="stylesheet" href="<?php echo base_url('assets/administrator')?>/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/administrator')?>/select2-bootstrap4-theme/select2-bootstrap4.min.css">


	<style>
        .form-group.required .col-form-label:after {
            content:"*";
            color:red;
        }
        .form-group.required:not(.form-check-label)  .form-label:after {
            content:"*";
            color:red;
        }


    </style>

  </head>
  <body class="antialiased">
    <div class="wrapper">

        <!-- SIDEBAR -->
        <?= $this->include('Modules\ManageLayout\Views\sidebar') ?>
        <?= $this->include('Modules\ManageLayout\Views\navbar') ?>

      <div class="page-wrapper">


        <!-- PAGE HEADER -->
        <?php // $this->include('Modules\ManageLayout\Views\pageheader') ?>

        <!-- CONTENT -->
        <?= $this->renderSection('content') ?>

        <!-- FOOTER -->
        <?php // $this->include('Modules\ManageLayout\Views\footer') ?>

      </div>
    </div>


    <!-- Libs JS -->
    <script src="<?php echo base_url('assets/vendor')?>/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- panggil ckeditor.js -->
    <!-- <script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url('assets/administrator')?>/ckeditor/ckeditor.js"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script type="text/javascript" src="<?php echo base_url('assets/administrator')?>/ckeditor/adapters/jquery.js"></script>
    <!-- Tabler Core -->
    <script src="<?php echo base_url('assets/vendor')?>/js/tabler.min.js"></script>
    <!-- Simple Datatable -->
    <script src="<?php echo base_url('assets/administrator')?>/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url('assets/administrator')?>/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo base_url('assets/administrator')?>/datatables-responsive/js/responsive.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script src="<?php echo base_url('assets/administrator')?>/select2/js/select2.full.min.js"></script>
    <script src="<?php echo base_url('assets/administrator')?>/js/jq.multiinput.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){

			setTimeout(function(){
           	 	$('#sukses').modal('hide');
        	}, 2000);

            $('.table-data').DataTable(
                {
                    "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
                }
            );
            $('.table-data-editors').DataTable(
                {
                    "ordering": false,
                    "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
                }
            );


        	$('textarea.texteditor').ckeditor();

          $("#select1").select2({
              placeholder: "Please Select"
          });
          $("#select2").select2({
              placeholder: "Please Select"
          });

          $('#select2bs4').select2({
          theme: 'bootstrap4'
          });

          $('#select2bs41').select2({
          theme: 'bootstrap4'
          });
          $('#select2bs42').select2({
          theme: 'bootstrap4'
          });


        });
    </script>

    <script>
            function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
            }
    </script>


	<div class="modal modal-blur fade" id="sukses" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-success"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>
            <h3>Succedeed</h3>
            <div class="text-muted"><?= session()->getFlashdata('sukses') ?></div>
          </div>
          <div class="modal-footer bg-success py-1">
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
