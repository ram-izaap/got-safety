<!-- // Content area -->
<section class="container content-area" data-view="list">
  <!-- rwo default --> 
  <div class="row" data-row="default" >
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content sidebar-fixed">
        <div class="col-sm-9 col-md-9 content-bar">
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
              <div id="div-lesson-forms">
                <?php echo $lesson_suggestion; ?>
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
                <a style="cursor:pointer" href="#" lesson_id="<?php echo $list['id'];?>" attachment_id=
                   <?php echo $list['att_id']; ?> language_id=
                <?php echo $list['language'];?>> 
                <?php echo ($list['rec_lesson']==1)?"<b>*Recommended Lesson - </b>" .$list['att_title']:$list['att_title'];?>
              </a>
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
