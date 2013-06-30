
                <!--个人资料-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">个人资料</span></h3>
                     <div class="wjtab_con">
                        <div class="wjgrgx"><b>个人资料更新</b></div>
                        <table width="780" cellpadding="0" cellspacing="0">
                            <tr><td width="94" align="right"><span class="wjcard">会员ID</span>：</td><td align="left"><?php echo $user_datas->id;?></td></tr>
                            <tr><td align="right"><span class="wjcard">邮箱</span>：</td><td align="left" class="wjtelnums"><span><?php echo $user_datas->email;?></span><a href="<?php echo $this->createUrl('user/editemail'); ?>" rel="nofollow">[修改]</a><?php if($user_datas->email_validate!='2'){ ?>&nbsp;&nbsp;<a href="javascript:send_validate_email('<?php echo $user_datas->id;?>');">[验证邮箱]</a><?php } ?></td></tr>
                        </table>
                        <div class="wjdashed"></div>
                        <table width="780" cellpadding="0" cellspacing="0">
                            <tr><td width="94" align="right"><span class="wjcard">真实姓名</span>：</td><td align="left"><?php echo $user_datas->real_name;?></td></tr>
                            <tr><td align="right"><span class="wjcard">昵称</span>：</td><td align="left"><?php echo $user_datas->nice_name;?></td></tr>
                            <tr><td align="right"><span class="wjcard">性别</span>：</td><td align="left"><?php $sex_name=array('1'=>'男','2'=>'女'); echo $sex_name[$user_datas->user_sex];?></td></tr>
                            <tr><td align="right"><span class="wjcard">生日</span>：</td><td align="left"><?php echo $user_datas->user_birthday;?></td></tr>
                            <tr><td align="right"><span class="wjcard">手机号码</span>：</td><td align="left"><?php echo $user_datas->user_phone;?></td></tr>
                            <tr><td align="right"><span class="wjcard">固定电话</span>：</td><td align="left"><?php echo $user_datas->user_telephone;?></td></tr>
                            <tr><td align="right"><span class="wjcard">联系地址</span>：</td><td align="left"><?php echo $user_datas->user_address;?></td></tr>
                            <tr><td align="right"><span class="wjcard">邮编</span>：</td><td align="left"><?php echo $user_datas->user_zip;?></td></tr>
                            <tr><td align="right">&nbsp;</td><td align="left" height="50" valign="middle"><a class="wjamend" href="<?php echo $this->createUrl('user/editin');?>" rel="nofollow">修 改</a></td></tr>
                        </table>
                    </div>
                </div>
                <div id="show_operate_tips" style="display:none;" >
    	           <div id="show_operate_tips_content" class="show_operate_tips">
    	           </div>	
    	        </div>
                <!--个人资料结束-->
      