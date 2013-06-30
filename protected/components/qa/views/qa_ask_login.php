                      
                     <?php $form=$this->beginWidget('CActiveForm', array(
	        							'id'=>'userlogin-form',
          							'action'=>Yii::app()->getController()->createUrl("site/login",array()),
	        							'enableAjaxValidation'=>false,
       							 )); ?> 
       							 <?php echo CHtml::hiddenField("login_type","asklogin",array());?>
                       <table width="200px" border="0" align="right">
                            <tbody>
                              <tr>
                                <td colspan="3" class="ask_login">会员登录</td>
                              </tr>
                              <tr>
                                <td width="65" height="25" style=""text-align:right;">登录帐号：</td>
                                <td height="25" colspan="2"><?php echo $form->textField($model,"user_login",array('class'=>'asking_input4'));?>
                                </td>
                              </tr>
                              <tr>
                                <td height="25" style=""text-align:right;">密　　码：</td>
                                <td height="25" colspan="2"><?php echo $form->passwordField($model,"password",array('class'=>'asking_input4'));?></td>
                              </tr>
                              <tr>
                                <td height="25" style=""text-align:right;">验 证 码：</td>
                                <td height="25" colspan="2">
                                  <?php echo $form->textField($model,"verification_code",array('class'=>'asking_input4')); ?></td>
                              </tr>
                              <tr>
                              	<td height="25"></td>
                              	<td height="25" colspan="2">
                              	   <a id="on_click_code" onclick="document.getElementById('__code__').src = '<?php echo Yii::app()->request->baseUrl;?>/index.php/site/imagecode?id=' + ++ts; return false"><img id="__code__" src="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/imagecode?id=<?= $ts ?>" /></a>
                              	</td>
                              </tr>
                              <tr>
                                <td height="20"></td>
                                <td height="20" colspan="2"><?php echo $form->checkBox($model,'rememberme');?>
                                  <span class="ask_font">记住我的登录状态</span></td>
                              </tr>
                              <tr>
                                <td height="25">&nbsp;</td>
                                <td width="53" height="25"><input type="image" src="/css/images/tour_t_button.gif" />
                                  </td>
                                <td width="74" height="25"><a href="<?php echo Yii::app()->getController()->createUrl("register/index"); ?>" class="ask_font1">注册会员</a></td>
                              </tr>
                            </tbody>
                          </table>
                      <?php $this->endWidget(); ?>
                      
                      <script language="javascript">
                      	jQuery(document).ready(function(){
                      	  jQuery("#on_click_code").click();
                      	 });
                      	ts = "<?= $ts ?>";
                      </script>