              <!--邮件订阅-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">邮件订阅</span></h3>
                	<div class="wjtab_con wjgivep">
                        <div class="wjgrgx"><h3>您好，<?php $real_name=$user_datas->real_name; if(empty($real_name)) echo $user_datas->user_login;else echo $real_name;?></h3></div>
                    		<table cellpadding="0" cellspacing="0">
                    			<tr><td><img src="/css/images/email2.gif" height="210" width="266"/></td></tr>
                    			<tr><td>您<span id="email_subscribe_desc"><?php $agreement_free=$user_datas->agreement_free;if($agreement_free=='1') echo "已经"; else echo "未"; ?></span>订阅易途旅游网资讯免费信息。</td></tr>
                          <tr><td><span class="wjaddadr">您的邮箱为：<?php echo $user_datas->email;?>  [<a href="<?php echo $this->createUrl('user/editemail');?>">修改</a>]</span> </td></tr>
                          <tr>
                          	
                          <td class="wjfocus_box">
                           <table cellpadding="0" cellspacing="0">

          							
          						
          									
          									<tr style="">
            									<td colspan="2"><span class="highLight" id="waiting"></span></td>
          									</tr>	
          									
          									
										       </table>									
                                 </td>
                                </tr>
                            	<tr><td><div id="cancel_subscribe" <?php if($agreement_free=='1') echo "style='display:block'";else echo "style='display:none'"?>><input type="button" value="取消订阅" onclick="javascript:subscribe('');" class="wjsubmit"/></div><div id="ok_subscribe" <?php if($agreement_free=='1') echo "style='display:none'";else echo "style='display:block'"?>><input type="button" value="订阅" onclick="javascript:subscribe('1');" class="wjsubmit"/></div></td></tr>
                            </table>
                		</div>
                </div>
                <!--邮件订阅结束-->