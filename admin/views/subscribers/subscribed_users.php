<div id="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
              <div class="col-lg-12" style="margin-left: -10px;">
                <h1 class="pull-left"><b>Subscribed Users</b></h1>
                </div>
                
                
                 
                 <?php /*
                    if ($message = $this->service_message->render()) :
        		               echo $message;
                     endif; */
                    ?>
				<div class="col-lg-12" style="margin-left: -10px;">
					<ol class="breadcrumb">
						<li><a href="<?=site_url('home')?>">Home</a>
						</li>
						<li class="active"><span>Subscribed Users</span>
						</li>
					</ol>
					
					
				</div>
			</div>
			<input type="hidden" name="page_name" class="page_name" value="user" />
			<?php echo $grid;?>
			<?php //echo '<pre>';print_r($this->session->all_userdata());die;?>
		</div>
	</div>

