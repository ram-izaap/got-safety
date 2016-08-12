 <!-- // Content area -->

<style>
.signoffdata {
    margin: auto;
    max-width: 550px;
    padding: 30px;
    width: 100%;
}
.sigPad {width:auto !important;}

.chosen-container.chosen-container-single.chosen-container-active {
    width: 80% !important;
}
#empid{float:left !important;}

</style>   

 <section class="container content-area" data-view="list">
 <!-- rwo default --> 
  <div class="row" data-row="default">

       <aside class="col-sm-12 bg-white inner-full">
         <div class="inner-content">
            <h1 class="text-center">Safety-Lesson Attendance Acceptance</h1>
            <div class="signoffdata">
             
            <h2>Type your name/Escriba su nombre</h2>
            <div class="">
                <select id="empid" name="empid" data-placeholder="Select Employee" class="chosen-select-deselect" tabindex="2">
                  <option value=""></option>
                  <?php if(is_array($employees) && !empty($employees)):
                        foreach($employees as $emp): ?>
                              <option value="<?php echo $emp['id'];?>"><?php echo $emp['employee_name'];?></option>
                  <?php 
                        endforeach;
                  endif;
                  ?>
                </select>
            </div>

            <div class="sigPad" id="signaturepad">
                  <h2>Draw your signature/Dibuja tu firma</h2>
                  <ul class="sigNav">
                        <li class="drawIt"><a href="#draw-it" >Draw It</a></li>
                        <li class="clearButton"><a href="#clear">Clear</a></li>
                  </ul>
                  <div class="sig sigWrapper" style="height:auto;">
                        <div class="typed"></div>
                        <canvas class="pad" width="485" height="250"></canvas>
                        <input type="hidden" name="output-3" id="signdata" class="output">
                  </div>
            </div>

            <div class="text-center">
                  Signing and Clicking this button indicates that I have received and understand this training material / Firmar y hacer clic en este botón indica que he recibido y entender este material de formación.
            
                  <button class="btn btn-danger btn-lg" onclick="signofflesson('<?php echo $client_id;?>','<?php echo $lesson_id;?>');">I AGREE / ESTOY DE ACUERDO</button> 

            </div>      
             
            
            </div>

         </div>

   </aside>

  </div>
  
 </section>
   