            <div id="trave_consulting_datas" class="wj_plc">
              <?php 
                
                  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$consulting_dataProvider,
												'itemView'=>'consulting_item',
												'ajaxUpdate'=>true,
										));
               ?>
           </div>

             <div class="trave_describe_content">
            	  	<?php echo CHtml::beginForm($this->createUrl("travel/travelconsulting"),"POST",array("id"=>'travelconsulting','onsubmit'=>'return false;'));?>
            	  	<?php echo CHtml::hiddenField("trave_id",$trave_id,array()); ?>
            	  	  <table class="r_two_table" >
                <tbody>
                  <?php if(!Yii::app()->user->isGuest){ ?><tr><td align="right"><div class="comment_user_img"><img src='<?php echo $user_img;?>'/></div></td><td><?php echo $user_login;?></td></tr><?php } ?>
                  <tr>
                    <td width="75">&nbsp;</td>
                    <td width="555" height="30"><span class="Query_xbt">请输入您的问题，我们会在24小时内给您解答（最多可输入<span id="remaining_consulting_word">3000</span>字）</span></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><strong>咨询内容：</strong></td>
                    <td height="30"><textarea name="consulting_content" id="consulting_content" onkeyup="javascript:remaining_travelconsulting_word('consulting_content',3000,'remaining_consulting_word');" class="Query_Online_input Query_border"></textarea></td>
                  </tr>
                  <tr>
                    <td align="right"><strong>邮   箱：</strong></td>
                    <td height="30"><input type="text" name="consulting_email" id="consulting_email" class="Query_Online_input1 Query_border" />
                    <span class="Query_xbt">详细解答会同时发送至您的邮箱。</span></td>
                  </tr>
                  <!--
                  <tr>
                    <td align="right"><strong>验证码：</strong></td>
                    <td height="30">
                    	<?php echo CHtml::textField("verification_code",$verification_code,array('class'=>'gm_login_input',"id"=>"consulting_verification_code")); ?>&nbsp;<a id="consulting_on_click" onclick="document.getElementById('consulting__code__').src = '<?php echo Yii::app()->request->baseUrl;?>/index.php/travel/consultimagecode?id=' + ++ts; return false"><img id="consulting__code__" src="<?php echo Yii::app()->request->baseUrl;?>/index.php/travel/consultimagecode?id=<?= $ts ?> " /></a>
                    		
                    </td>
                  </tr>
                  -->
                  <tr>
                    <td></td>
                    <td height="30">
                    	 <input value="我要咨询"  type="button" id="consulting_buttong" onclick="javascript:submit_consulting('travelconsulting');" class="wjamend"/>
                       <span class="Query_xbt">您也可以拨打 021-56880166咨询或预订 </span>
                      </td>
                  </tr>
                </tbody>
              </table>
              
              <?php echo CHtml::endForm();?>
        </div>