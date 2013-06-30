
                <!--抵用券-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">浏览历史记录</span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        	<?php if(empty($trave_histroy_datas)):?>
                        	<p>您还没有浏览记录。</p>
                        	<?php else: ?>
                            <table cellpadding="0" cellspacing="0" class="wjtablebor" border="1">
                                <tr height="30">
                                    <th>线路编号</th><th>线路名称</th><th>浏览时间</th>
                                </tr>
                                <?php foreach($trave_histroy_datas as $data):?>
                                <tr>
                                    <td>
                                    	<?php echo CHtml::encode($data->Trave->trave_number); ?>
                                    </td>
                                    
                                    <td><!-- <a title="<?php echo $data->Trave->trave_name?>">
                                    <?php echo CHtml::link(CHtml::encode($data->Trave->trave_name), 
                                    $this->createUrl('travel/traveldetail', array('trave_id' => $data->trave_id."-".$data->Trave->trave_title)),
                                    array('target' => '_blank')); ?>
									</a> -->
									<a title="<?php echo $data->Trave->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl('travel/detail',array('id'=>$data->trave_id,'n'=>$data->Trave->trave_title));?>" target="_blank">
          			           <span><?php echo Util::cs($data->Trave->trave_name,35);?></span>
          			       </a>
                                    </td>
                                    
                                    <td>
                                    <?php echo date("Y-m-d H:i:s",$data->create_time);?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <div><?php  $this->widget('CLinkPager',array('pages'=>$pages));?></div>
                    		<?php endif; ?>
                    	</div>
                    </div>
                </div>
            	<!--抵用券-->
     