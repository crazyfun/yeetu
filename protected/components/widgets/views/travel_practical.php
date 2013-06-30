 <div class="locality">
          <h2><img src='/css/images/lvyoushiyongbangzhu.jpg' width='120' heihgt='30'/></h2>
          <ul class=locality_help>
          	<?php foreach($help_datas as $key => $value){ ?>
          	  <?php foreach($value['help'] as $key1=> $value1){ ?>
                <li><a href="<?php echo $this->controller->createUrl('help/index', array('cid'=> $key, '#' => 'q'.($key1+1)));?>" ><?php echo $value1->title;?></a></li>
             
               <?php } ?>
             
            
          <?php } ?>
          </ul>
        </div>