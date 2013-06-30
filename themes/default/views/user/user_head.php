              <!--修改图像-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">修改图像</span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        		<?php 
                            	
                            	$form=$this->beginWidget('CActiveForm', array(
	        										'id'=>'userhead-form',
          										'action'=>$this->createUrl("user/headiframe",array()),
	        										'enableAjaxValidation'=>false,
	        										'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        										)); 
        										
        										?>
                        	<table cellpadding="0" cellspacing="0" class="wjsc">
                            	<tr><td width="70">&nbsp;</td><td><img id="user_head_img" src="<?php echo $this->head_img;?>" width="70" height="70" class="wjmember_pic"></td></tr>
                            	
                            
                            	<tr>
                            		  <td>选择照片：</td><td><?php echo $form->FileField($model,'head_img',array('id'=>'head_img'));?></td>
                            	</tr>
                            	<tr><td>&nbsp;</td><td><input type="button" value="上传新头像" class="wjsubmit" onclick="javascript:upload_user_head();" /><span class="show_upload_message" id="show_upload_message"></span></td></tr>
                            	<tr><td>&nbsp;</td><td><p class="wjgray">目前仅支持JPEG、PNG、GIF格式的图片，暂不支其他格式的图片。<br />请勿上传超过1M的图片</p></td></tr>
                            </table>
                            <?php $this->endWidget(); ?>
                            <div class="hidden_iframe">
                            	<iframe style="display: none;" src="<?php echo $this->createUrl("user/headiframe"); ?>" name="my_head" id="hidden_iframe">

                            	</iframe>
                            </div>
                    	</div>
                    </div>
                </div>
            	<!--修改图像-->
