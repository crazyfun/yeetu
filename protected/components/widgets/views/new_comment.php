 <div class="left_zn">
       	<h2><span class="left_tj_title">最新评论</span> 
        </h2>
                <ul>
                	<?php foreach($trave_comment_datas as $key => $value){ ?>
                	  <li>
                    	  <div class="left_zx_w"><a href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->trave_id,'n'=>$value->Trave->trave_title,'tc'=>true)); ?>" title="<?php echo $value->Trave->trave_name; ?>"><?php echo Util::cs($value->Trave->trave_name,18);?></a></div>
                        <div class="left_zx_d"><?php echo Util::cs($value->comment_content,18);?></div>
                        <div class="left_zx_r">
                        	<table>
                        		 <tbody>
                        		 	  <tr>
                        		 	  	  <td width="130" class="new_c_i"><?php echo $value->get_rating();?></td>
                        		 	  	  
                        		 	  	  <td width="" class="new_c_t"><?php echo date('Y-m-d H:i:s',$value->create_time);?></td>
                        		 	  </tr>
                        		 </tbody>
                        	</table>
                        </div>
                    </li>
                  
                   <?php } ?>
                    
        </ul>
        </div><!--left_zx end-->