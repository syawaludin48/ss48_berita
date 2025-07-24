<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?= $title ?></title>
    <!-- CSS files -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <link href="<?php echo base_url('assets/vendor')?>/css/tabler.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="<?php echo base_url('assets/administrator')?>/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/administrator')?>/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">

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
  <body class="antialiased" style="font-family: 'Roboto Slab', serif;">
    <div class="wrapper">
      
      <div class="page-wrapper">
        <div class="container-xl">
          
        </div>

            <?= $this->renderSection('content') ?>
            
        
      </div>
    </div>
    
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo base_url('assets/vendor')?>/js/tabler.min.js"></script>

    <script src="<?php echo base_url('assets/administrator')?>/select2/js/select2.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
			
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
          
          

        });
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