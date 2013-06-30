                <!--我的点评-->
 				<div style="display:block;">
                    <h3 class="wjabout"><span class="sp">我的点评</span></h3>
          <?php echo CHtml::form($this->createUrl('user/reviews'), 'get')?>
					<table class="htj_table">
					<tr>
					<td>线路名称:<?php echo CHtml::textField("trave_name",$trave_name,array());?></td>
					<td><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"搜  索",'class'=>'htj_table_sbtn')); ?></td>
					</tr>
                    </table>
                    <?php echo CHtml::endForm();?>
                    
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        	
                            <table cellpadding="0" cellspacing="0" class="wjtablebor_2">
                                <tr>
                                    <th width="70">线路编号</th><th width="150">线路名称</th><th width="70">满意</th><th>点评内容</th><th width="70">评论时间</th>
                                </tr>
                                
                                <?php foreach($trave_comment_datas as $key => $value){?>
                                <tr>
                                    <td><?php echo $value->Trave->trave_number; ?></td>
                                    <td><a title="<?php echo $value->Trave->trave_name?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->trave_id,'n'=>$value->Trave->trave_title)) ?>"><?php echo Util::cs($value->Trave->trave_name,8); ?></a></td>
                                    <td><span class="around_satisf"><?php echo $value->get_rating(); ?></span></td>
                                    <td><?php echo Util::cs($value->comment_content,20); ?></td>
                                    <td><?php echo date('Y-m-d H:i:s',$value->create_time); ?></td>
                                </tr>     
                              <?php } ?>                         	
                            </table>
                            <div><?php  $this->widget('CLinkPager',array('pages'=>$pages));?></div>
                    	</div>
                    </div>
                </div>		
            	<!--我的点评-->
            	
            	<?php
  $this->widget('application.extensions.tipsy.Tipsy', array(
   'trigger' => 'hover',
   'items' => array(
     array('id' => '.trave_tipsy','gravity' => 'sw','html'=>true),

  ),  
));
?>  
