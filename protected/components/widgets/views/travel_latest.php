       <div class="special_offer">
            	<div class="spe_top"><div class="t_title4">易途推荐</div></div>
            	<div class="zy_tj_list">
                	<ul class="pro_list">
                		<?php foreach($trave_datas as $key => $value){?>
                		    <li>
                            <strong class="price"><span>￥<?php echo $value->adult_price;?></span>起</strong>
                            <dl>                  
                            	<dt>
                                	<a href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title))?>"><?php echo $trave->get_trave_first_image($value->id);?></a>
                                </dt>
                        		<dd>
                                	<div><a title="<?php echo $value->trave_name; ?>" href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title))?>"><?php echo $value->trave_name;?></a></div>
                                    <div class="home_desc_content"><?php echo Util::cs($value->trave_shot_desc,40);?></div>
                                </dd>
                            </dl>
                        </li>
                		
                	  <?php } ?>
                       
                       
                	</ul>
                </div>
            </div><!--special_offer end-->