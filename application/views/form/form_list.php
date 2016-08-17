<!-- // Content area -->
<section class="container content-area" data-view="list">
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <?php if(isset($_SESSION['safety_form_succ'])) {?>
    
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <?php echo $_SESSION['safety_form_succ'];unset($_SESSION['safety_form_succ']);?>
      </div>
    
    <?php }?>

      <div class="inner-content">
      <h1>Forms</h1><hr>
        <div class="safety_forms">
          <div class="col-sm-12 col-md-12 content-bar">
           <a href="<?php echo site_url().'form/client_forms/accident_investigation_form'; ?>"><strong>Accident Investigation Form </strong></a>
          </div>
          <div class="col-sm-12 col-md-12 content-bar">
           <a href="<?php echo site_url().'form/client_forms/green_bee_safety_violation_form'; ?>"><strong>Safety Violation Form</strong></a>
          </div>
          <div class="col-sm-12 col-md-12 content-bar"> 
           <a href="<?php echo site_url().'form/client_forms/star_hardware_daily_sign_in_form'; ?>"><strong>Daily Sign in Sheet</strong></a>
          </div> 
          <div class="col-sm-12 col-md-12 content-bar">
           <a href="<?php echo site_url().'form/client_forms/green_bee_safety_inspection_check_list'; ?>"><strong>Safety Inspection Check List</strong></a>
          </div>   
          </div>
        </div>
        </aside>
      </div>
 </section>
