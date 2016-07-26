	<ul class="lesson_list" style="height:375px;overflow:auto;">
      <?php foreach($get_attachment as $list): ?>
      <li>
        <a style="cursor:pointer" href="#" lesson_id="<?php echo $list['id'];?>" attachment_id=<?php echo $list['att_id']; ?> language_id=<?php echo $list['language'];?>> 
          <?php echo $list['att_title'];?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

