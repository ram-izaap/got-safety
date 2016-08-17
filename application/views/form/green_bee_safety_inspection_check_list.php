<section class="container content-area" data-view="list">
  <div class="row" data-row="default">

  <aside class="col-sm-12 bg-white inner-full">
<div class="col-sm-12 col-md-12" data-form="Lesson Suggestion">
            <!-- Begin # DIV Form -->
            <div class="" data-form="register">
              <!-- Begin # DIV Form -->
              <div id="div-lesson-forms">
                <form id="accident_investigation_form" name="accident_investigation_form" method="post">
                <input type="hidden" name="form_name" value="inspection_temp_sheet">
                <input type="hidden" name="form_rename" value="Safety Inspection Check List">
                <input type="hidden" name="form_type" value="Safety Inspection Check List">
                  <div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right">
                    </div>
                    <span class="form-title" id="text-register-msg">SAFETY INSPECTION CHECK LIST
                    </span>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" name="foreman_name" id="foreman_name" class="form-control input-lg" placeholder="Foreman Name" >
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" name="job_site" id="job_site" class="form-control input-lg" placeholder="Job Site" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Date: <?php echo date('m-d-Y'); ?></label>
                      </div>
                    </div>
                   </div>
                   <div class="row"> 
                    <div class="col-sm-12">
                      <div class="form-group">
                        <input type="text" name="supervisor" id="supervisor" class="form-control input-lg" placeholder="Supervisor" >
                      </div>
                    </div>
                  </div>
                  
                 
                

                  
                 
                 <div class="inspect_item">
                  <span class="form-title" id="text-register-msg">ITEM</span>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman have a "huddle-up"?</label>
                        <div>
                      <span>Yes<input name="question_1" value="yes" type="radio"></span><span>No<input name="question_1" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did crew perform stretching exercises before their shift?</label>
                         <div>
                        <span>Yes<input name="question_2" value="yes" type="radio"></span><span>No<input name="question_2" value="no" type="radio"></span></div>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman provide shade at  (80 degrees)? </label>
                        <div>
                         <span>Yes<input name="question_3" value="yes" type="radio"></span><span>No<input name="question_3" value="no" type="radio"></span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman provide water (2 gallons per person/day)? </label>
                        <div><span>Yes<input name="question_4" value="yes" type="radio"></span><span>No<input name="question_4" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                   <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman provide for the replenishing of water? </label>
                        <div><span>Yes<input name="question_5" value="yes" type="radio"></span><span>No<input name="question_5" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                   <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman assign a flag person? </label>
                        <div><span>Yes<input name="question_6" value="yes" type="radio"></span><span>No<input name="question_6" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman identify, communicate, and correct hazards? </label>
                        <div><span>Yes<input name="question_7" value="yes" type="radio"></span><span>No<input name="question_7" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                   <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Does foreman have the IIPP? </label>
                       <div><span>Yes<input name="question_8" value="yes" type="radio"></span><span>No<input name="question_8" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Does foreman have a map to the nearest medical clinic?</label>
                        <div><span>Yes<input name="question_9" value="yes" type="radio"></span><span>No<input name="question_9" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Does foreman have directions to the job site?</label>
                        <div><span>Yes<input name="question_10" value="yes" type="radio"></span><span>No<input name="question_10" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Does foreman have his first aid kit?</label>
                        <div><span>Yes<input name="question_11" value="yes" type="radio"></span><span>No<input name="question_11" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Does foreman have his fire extinguisher?</label>
                        <div><span>Yes<input name="question_12" value="yes" type="radio"></span><span>No<input name="question_12" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Does foreman have MSDS/SDS book on job site?</label>
                        <div><span>Yes<input name="question_13" value="yes" type="radio"></span><span>No<input name="question_13" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Does foreman know the weather?</label>
                       <div><span>Yes<input name="question_14" value="yes" type="radio"></span><span>No<input name="question_14" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman conduct the latest Safety Tailgate Meeting?</label>
                        <div><span>Yes<input name="question_15" value="yes" type="radio"></span><span>No<input name="question_15" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did foreman provide for timely rest and meal periods?</label>
                        <div><span>Yes<input name="question_16" value="yes" type="radio"></span><span>No<input name="question_16" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Did new employees receive training?</label>
                        <div><span>Yes<input name="question_17" value="yes" type="radio"></span><span>No<input name="question_17" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Power cords are in good working Condition?</label>
                        <div><span>Yes<input name="question_18" value="yes" type="radio"></span><span>No<input name="question_18" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Power tools are in good working Condition?</label>
                        <div><span>Yes<input name="question_19" value="yes" type="radio"></span><span>No<input name="question_19" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Nails are being removed or bent over? </label>
                        <div><span>Yes<input name="question_20" value="yes" type="radio"></span><span>No<input name="question_20" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Hard Hats and safety Vest are on at all times? </label>
                        <div><span>Yes<input name="question_21" value="yes" type="radio"></span><span>No<input name="question_21" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Safety Glass are on when needed? </label>
                        <div><span>Yes<input name="question_22" value="yes" type="radio"></span><span>No<input name="question_22" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Gloves when needed?  </label>
                        <div><span>Yes<input name="question_23" value="yes" type="radio"></span><span>No<input name="question_23" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Equipment is in safe working order ( no leaks, back up alarm is working and 3” seat belt is working)  </label>
                        <div><span>Yes<input name="question_24" value="yes" type="radio"></span><span>No<input name="question_24" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Operator is wearing seat belt?  </label>
                        <div><span>Yes<input name="question_25" value="yes" type="radio"></span><span>No<input name="question_25" value="no" type="radio"></span></div>
                      </div>
                    </div>
                  </div>
                 </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <textarea name="other" class="form-control input-lg" id="other" placeholder="Other"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <textarea name="details" class="form-control input-lg" id="details" placeholder="Details"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <textarea name="corrective_action" class="form-control input-lg" id="corrective_action" placeholder="Corrective Action"></textarea>
                      </div>
                    </div>
                  </div>
                  <input type="submit" value="SUBMIT" class="btn client-login safety_form_submit">
                </form>
              </div>
              <!-- End # DIV Form -->
            </div>
          </div>
          </aside>
          </div>
        </section>

