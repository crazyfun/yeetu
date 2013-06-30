<div class="special_offer">
            	<div class="spe_top"><div class="t_title3">月热门排行</div></div>
            	<div>
                	<ul class="pro_list">
                		
                		 <?php foreach($trave_datas as $key => $value){ ?>
       	                 <li>
                            <strong class="price"><span>￥<?php echo $value->adult_price;?></span>起</strong>
                           <a title="<?php echo $value->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title))?>"><?php echo $value->trave_name;?> </a>
                        </li>
                    <?php
           
                      }
                   ?>  
                	</ul>
                </div>
            </div><!--special_offer end-->