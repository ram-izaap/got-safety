	<ul class="lesson_list" style="height:375px;overflow:auto;">
      <?php foreach($get_attachment as $list): ?>
      <li>
        <a style="cursor:pointer" href="#" lesson_id="<?php echo $list['id'];?>" attachment_id=<?php echo $list['att_id']; ?> language_id=<?php echo $list['language'];?>> 
          
               <?php echo ($list['rec_lesson']==1)?"<b>*Recommended Lesson - </b>" .$list['att_title']:$list['att_title'];?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

