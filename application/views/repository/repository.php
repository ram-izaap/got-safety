
<section class="container content-area" data-view="list">
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
       <div class="inner-content ztree_main">
         <h1>Repository</h1><hr>
           <div class="col-sm-12 col-md-12 content-bar">
             <div class="zTreeDemoBackground left">
               <ul id="treeDemo" class="ztree"></ul>
             </div>
           </div>
       </div>
    </aside>
  </div>
</section>
<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/frontend/jquery.min.js"></script>

<SCRIPT type="text/javascript">

  var setting = { };
  var zNodes = <?php echo $result; ?>;

  $(document).ready(function(){
      $.fn.zTree.init($("#treeDemo"), setting, zNodes);
  });
    
  </SCRIPT>


