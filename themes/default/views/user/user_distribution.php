
                <!--管理配送地址-->
 				<div style="display:block;">
                    <h3 class="wjabout"><span class="sp">管理配送地址</span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                            <table cellpadding="0" cellspacing="0" class="wjcon_tableb">
                                <tr>
                                    <th width="70">收件人</th><th>详细地址</th><th width="130">手机</th><th width="135">固定电话</th><th width="98">操作</th>
                                </tr>
                                <?php foreach($user_contact_datas as $key => $value){?>
                                <tr>
                                    <td><?php echo $value->contact_name;?></td><td><?php echo $value->contact_address;?></td><td><?php echo $value->contact_phone;?></td><td><?php echo $value->contact_telephone;?></td><td><a href="<?php echo $this->createUrl('user/editdis',array('id'=>$value->id));?>">编辑</a>|<a href="<?php echo $this->createUrl('user/deletedis',array('id'=>$value->id));?>">删除</a></td>
                                </tr>
                                <?php } ?>                               	
                            </table>
                            <div><?php  $this->widget('CLinkPager',array('pages'=>$pages));?></div>
                            <div class=""><a class="wjamend" href="<?php echo $this->createUrl("user/editdis");?>">添加新地址</a></div>
                    	</div>
                    </div>
                </div>		
            	<!--管理配送地址-->
            