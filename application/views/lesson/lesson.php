<!-- // Content area -->
<section class="container content-area" data-view="list">
  <!-- rwo default --> 
  <div class="row" data-row="default" >
    <aside class="col-sm-12 bg-white inner-full">
    
     
      <div class="inner-content sidebar-fixed">
        <div class="col-sm-9 col-md-9 content-bar">
        
        <?php if(isset($_SESSION['lession_suggestion_succ'])): ?>
        <div class="alert alert-success alert-dismissable col-md-12">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          <?php echo $_SESSION['lession_suggestion_succ'];unset($_SESSION['lession_suggestion_succ']);?>
        </div>
        <?php endif; ?>

          <div class="col-sm-12 col-md-12" id="lesson_content">
            <h1>Safety Lessons
            </h1>
            <hr>
            <p>The California Code states that “regular” training must take place, i.e., monthly for businesses such as yours. A business whose employees are primarily out in the field, such as construction co., must provide training every 10 working days.
            </p>
            <p>If you hire a new employee, they must be trained in safety practices prior to working. These requirements are valid for every employee. Also, the documentation of same is important -  make sure the attendance sheets are signed and kept.
            </p>
          </div>
          <div class="clearfix">
          </div>
          <div class="col-sm-12 col-md-12" data-form="Lesson Suggestion">
            <!-- Begin # DIV Form -->
            <div class="" data-form="register">
              <!-- Begin # DIV Form -->
              <div id="div-forms">
                <!-- Begin | Register Form -->
                <form id="lesson_suggest" method="post" action="<?php echo base_url(); ?>lesson/lesson_suggestion">
                  <div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right">
                    </div>
                    <span class="form-title" id="text-register-msg">Lesson Suggestion
                    </span>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control input-lg" value="" placeholder="Name" onfocus="(this.value == 'Name') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Name')">
                        <span class="vstar" 
                          <?php echo form_error('name', '
	                      <span class="help-block">', '
	                      </span>'); ?>
	                    </span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="company" id="company" class="form-control input-lg" value="" placeholder="Company" onfocus="(this.value == 'Company') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Company')">
                      <span class="vstar" 
                       <?php echo form_error('company', '
                       <span class="help-block">', '
                       </span>'); ?>
                      </span>
                  </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="email" id="email" class="form-control input-lg" value="" placeholder="Email" onfocus="(this.value == 'Email') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Email')">
                    <span class="vstar" 
                      <?php echo form_error('email', '
                      <span class="help-block">', '
                      </span>'); ?>
                    </span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" name="phone_no" id="phone_no" class="form-control input-lg" value="" placeholder="Phone No" onfocus="(this.value == 'Phone No') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Phone No')">
                  <span class="vstar" 
                   <?php echo form_error('phone_no', '
                   <span class="help-block">', '
                   </span>'); ?>
                  </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <textarea name="lesson_suggestion" id="lesson_suggestion" class="form-control input-lg" placeholder="Lesson Suggestion" onfocus="(this.value == 'Lesson Suggestion') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Lesson Suggestion')"></textarea>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <select name="contact_time" id="contact_time" class="form-control input-lg">
                <option value="">Select Best Time to Contact
                </option>
                <option value="morning">Morning
                </option>
                <option value="afternoon">Afternoon
                </option>
                <option value="evening">Evening
                </option>
              </select>
              <span class="vstar" 
               <?php echo form_error('contact_time', '
               <span class="help-block">', '
               </span>'); ?>
              </span>
          </div>
        </div>
      </div>

      <input type="submit" value="SUBMIT" class="btn client-login">
      </form>
  </div>
  <!-- End # DIV Form -->
  </div>
</div>
</div>
<!--  Right menu  -->
<div class="col-sm-3 col-md-3 right-bar cart_item">
  <div class="product-bag radius-5 clearfix">
    <div class="row">
      <div class="col-xs-12">Safety Lessons
      </div>
    </div>
  </div>
  <div class="clearfix">
  </div>
  <br>
  <div class="col-sm-12 col-md-12">
    <select name="language" class="table-group-action-input form-control input-medium lang">
      <?php if(isset($get_language)): foreach($get_language as $fkey => $fvalue): ?>
      <option value="<?php echo $fvalue['id']; ?>">
        <?php echo $fvalue['lang'];?>
      </option>
      <?php endforeach; endif;  ?>
    </select>
    <br>
    <input type="text" class="form-control" placeholder="Search Lesson By Title..." name="search_title" class="search_title">
  </div> 
  <div class="" data-nav="gs-attendance" id="content-load1">
    <ul class="lesson_list" style="height:375px;overflow:auto;">
      <?php foreach($get_attachment as $list): ?>
      <li >
        <a style="cursor:pointer" href="#" lesson_id="<?php echo $list['id'];?>" attachment_id=<?php echo $list['att_id']; ?> language_id=<?php echo $list['language'];?>> <?php echo $list['att_title'];?></a>
    </li>
  <?php endforeach; ?>
  </ul>
</div>
</div>
</div>
</aside>
<!-- rwo default --> 
</div>
</section>
<!-- Content area // -->
