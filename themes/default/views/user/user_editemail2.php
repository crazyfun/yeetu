<!--邮件订阅修改邮箱-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">修改邮箱</span></h3>
                	<div class="wjgivep">
                        <div class="wjprocess_bar">
                        	<table cellpadding="0" cellspacing="0" width="100%"><tr><td  width="280" height="26" valign="middle">输入您的新邮箱</td><td class="wjnow_step" valign="middle">激活您的新邮箱</td><td valign="middle">完成</td></tr></table>
                        </div>
                        
                         <table class="yx_table" border="0" >
        									<tbody>
         										 <tr>
           										 <td class="reg_title"><span class="user_data_tip">设置新邮箱成功,你的新邮箱为 <?php echo $edit_email;?></span></td>
          									 </tr>
          									 <tr>
            										<td>我们已经给您的邮箱发送了一封验证邮件，请登录您邮箱点击验证链接完成修改。</td>
         										 </tr>
          									 <tr>
            										<td><?php echo $this->redirect_email($edit_email); ?></td>
          									 </tr>
          									 <tr>
            										<td class="reg_line" style="padding-top:20px"><img src="/css/images/login_io.gif "/>&nbsp;&nbsp;如果您未收到验证邮件，请查看邮件是否在垃圾邮件中</td>
          									 </tr>
          									 <tr>
            										<td class="reg_line" ><img src="/css/images/login_io.gif "/>&nbsp;&nbsp;如果不存在，请点击此处<a  href="<?php echo $this->createUrl("user/repeatactive",array('user_id'=>$user_id)) ?>">重新发送</a>验证邮件</td>
          									 </tr>
          									 <tr>
            										<td class="reg_line"><img src="/css/images/login_io.gif "/>&nbsp;&nbsp;如果三次点击后仍未收到验证邮件，请<a href="<?php echo $this->createUrl("statics/index",array('cid'=>'12')); ?>">联系我们</a>的客服，谢谢！</td>
          									</tr>
          									<tr>
            										<td>&nbsp;</td>
          									</tr>
          									<tr>
            										<td>&nbsp;</td>
          									</tr>
        									</tbody>
      									</table>
      
                		</div>
                </div>
         <!--邮件订阅修改邮箱结束-->
      