<!DOCTYPE HTML>
<html>
	<head>
	
		<?php include_title(); ?>
        <?php include_metas(); ?>
        <?php include_links(); ?>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<link rel="shortcut icon" href="favicon.ico"/>
        <?php include_stylesheets(); ?>
        <?php include_raws() ?>
        
        <script>
         //declare global JS variables here
         var base_url = '<?php echo base_url();?>';
         var current_controller = '<?php echo $this->uri->segment(1, 'index');?>';
         var current_method = '<?php echo $this->uri->segment(2, 'index');?>';
         var namespace = '<?php echo $this->namespace;?>';
         var previous_url = '<?php echo $this->previous_url;?>';
        </script>
        
        
	</head>
	<?php if( $this->session->userdata('admin_data') ==""){ ?>
	<body>
	
		<section class="body_container">
			
			<?php echo $content; ?>
						
		</section>
	
		
	<?php  } else { ?>
	
	<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
	
       
		<div id="theme-wrapper">
			<?php $this->load->view('_partials/header'); ?>
			<div id="page-wrapper" class="container">
			 	<div class="row">
					<div class="page-content-wrapper">
						<div class="page-content">

							<?php echo $content; ?>
						</div>
					</div>
					<?php $this->load->view('_partials/footer'); ?>
				</div>
			</div>
			
		</div>
		
		<?php } ?>
		
		<!-- javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
		<![endif]--> 
		
		<?php include_javascripts(); ?>
		
		<?php 
		
			if(is_array($this->init_scripts))
			{
				foreach ($this->init_scripts as $file)
					$this->load->view($file, $this->data);
			}
		?>
	</body>
</html>
