<?php if(isset($_SESSION['lession_suggestion_succ'])): ?>
  <div class="alert alert-success alert-dismissable col-md-12 lesson_succ" style="display:none;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x
    </button>
    <?php echo $_SESSION['lession_suggestion_succ'];unset($_SESSION['lession_suggestion_succ']);?>
  </div>
<?php endif; ?>
<form id="lesson_suggest" method="post" action="#">
          <div id="div-register-msg">
            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right">
            </div>
            <span class="form-title" id="text-register-msg">Lesson Suggestion
            </span>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control input-lg" value="<?php echo set_value('name',$form_data['name']); ?>" placeholder="Name" >
                <span class="vstar" 
                  <?php echo form_error('name', '
                <span class="help-block">', '
                </span>'); ?>
              </span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="company" id="company" class="form-control input-lg" value="<?php echo set_value('company',$form_data['company']); ?>" placeholder="Company" >
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
            <input type="text" name="email" id="email" class="form-control input-lg" value="<?php echo set_value('email',$form_data['email']); ?>" placeholder="Email" >
            <span class="vstar" 
              <?php echo form_error('email', '
              <span class="help-block">', '
              </span>'); ?>
            </span>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <input type="text" name="phone_no" id="phone_no" class="form-control input-lg" value="<?php echo set_value('phone_no',$form_data['phone_no']); ?>" placeholder="Phone No" >
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
        <textarea name="lesson_suggestion" id="lesson_suggestion" class="form-control input-lg" placeholder="Lesson Suggestion" ><?php echo set_value('lesson_suggestion',$form_data['lesson_suggestion']); ?></textarea>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <select name="contact_time" id="contact_time" class="form-control input-lg">
        <option value="">Select Best Time to Contact
        </option>
        <option value="morning" <?php echo ($form_data['contact_time']=="morning")?"selected":""; ?>>Morning
        </option>
        <option value="afternoon" <?php echo ($form_data['contact_time']=="afternoon")?"selected":""; ?>>Afternoon
        </option>
        <option value="evening" <?php echo ($form_data['contact_time']=="evening")?"selected":""; ?>>Evening
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

<input type="submit" value="SUBMIT" class="btn client-login lesson_suggestion1">
</form>
