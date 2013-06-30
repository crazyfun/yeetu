	 <!--wj_mainl end-->
    <div class="member">
            <div class="member_box">
              <div class="member_left">
                <div class="wjgrgx1"><b>基本信息：</b></div>
                <table width="450" border="1" cellpadding="0" cellspacing="0" class="wjtablebor">
                  <tr>
                    <td width="89" class="wjcard_td"><span class="wjcard">会员ID</span>:</td>
                    <td width="139" align="left"><?php echo $user->id; ?></td>
                    <td width="86" class="wjcard_td"><span class="wjcard">邮  箱</span>:</td>
                    <td width="144" align="left"><?php echo $user->email; ?></td>
                  </tr>
                  <tr>
                    <td class="wjcard_td"><span class="wjcard">姓  名</span>:</td>
                    <td align="left"><?php echo $user->real_name; ?></td>
                    <td class="wjcard_td"><span class="wjcard">性  别</span>:</td>
                    <td align="left"><?php $sex_array=array('1'=>'男','2'=>'女'); echo $sex_array[$user->user_sex]; ?></td>
                  </tr>
                  <tr>
                    <td class="wjcard_td"><span class="wjcard">积  分</span>:</td>
                    <td align="left"><?php echo $user->credit;?></td>
                    <td class="wjcard_td"><span class="wjcard">等  级</span>:</td>
                    <td align="left"><?php $user_level=CV::$USER_LEVEL;echo $user_level[$user->level];  ?></td>
                  </tr>
                  <tr>
                    <td class="wjcard_td"><span class="wjcard">订  单</span>:</td>
                    <td align="left"><?php echo $user->order_count; ?></td>
                    <td class="wjcard_td"><span class="wjcard">完成订单</span>:</td>
                    <td align="left"><?php echo $user->completed_order_count;?></td>
                  </tr>
                  <tr>
                    
                    <td class="wjcard_td"><span class="wjcard">抵用券</span>:</td>
                    <td align="left"><?php echo $user->coupon; ?></td>
                    
                    <td class="wjcard_td"><span class="wjcard"></span></td>
                    <td align="left"></td>
                    
                    
                  </tr>
                  <tr>
                    <td colspan="2" align="right" class="wjtjac">
                    <?php echo CHtml::link('我的提问(' .$user->question_count . ')', $this->createUrl('qa/self', array('t'=>'my-question')));?>
                    </td>
                    <td colspan="2" align="right" class="wjtjac">
                    <?php echo CHtml::link('我的回答(' .$user->answer_count . ')', $this->createUrl('qa/self', array('t'=>'my-answer')));?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="member_right">
                <div class="wjgrgx1"><b>最近浏览历史记录</b></div>
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
                                    
                                    <td>
                                    <?php echo CHtml::link(CHtml::encode(Util::cs($data->Trave->trave_name, 10)), 
                                    $this->createUrl('travel/detail', array('id' => $data->trave_id,'n'=> $data->Trave->trave_title )),
                                    array('target' => '_blank', 'title' => CHtml::encode($data->Trave->trave_name))); ?>
                                    </td>
                                    
                                    <td>
                                    <?php echo date("Y-m-d H:i:s",$data->create_time);?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                    		<?php endif; ?>
              </div>
            </div>
            <div class="member_box">
              <div class="wjgrgx1"><b>我的最新的订单</b></div>
              <?php  if (!empty($trave_order_datas)):?>
                             <table cellpadding="0" cellspacing="0" class="wjtablebor" border="1">
                                <tr>
                                    <th width="60">订单编号</th><th width="70">下单时间</th><th>产品名称</th><th width="75">价格</th><th width="60">订单状态</th><th width="70">付款状态</th><th width="75">操作</th>
                                </tr>
                                
                                <?php foreach($trave_order_datas as $key => $value){?>
                                
                                
                                <tr>
                                    <td><?php echo $value->id;?></td><td><?php echo date("Y/m/d",$value->create_time);?></td><td><a href="<?php $trave_name=$value->get_trave_name(); echo $this->createUrl('travel/detail', array('id' => $value->trave_id,'n'=>$value->trave->trave_title)); ?>"><?php echo Util::cs($trave_name,18); ?></a></td><td><?php echo $value->total_price;?>元</td><td><?php echo $value->get_order_status(); ?></td><td><?php echo $value->get_trave_pay_status();?></td><td><div class="wjtjac"><?php echo $value->get_order_operate("",$order_status); ?></div></td>
                                </tr>
                                
                                
                              <?php } ?>
                                      	
                            </table>
                <?php else:?>
                <table cellpadding="0" cellspacing="0" class="wjtablebor" border="1">
                <tr>
                  <td align="center"><span class="wjLight"><b>目前没有订单记录</b></span></td>
                </tr>
              </table>
              <?php endif; ?>
            </div>
            <div class="member_box"> 
              <div class="member_right">
                <div class="wjgrgx1"><b>易途旅游网推荐产品：</b></div>
                <ul class="member_ul">
                <?php foreach ($trave_recommend_datas as $data):?>
                  <li> <?php echo CHtml::link(CHtml::encode(Util::cs($data->trave_name, 25)), 
                                    $this->createUrl('travel/detail', array('id' => $data->id,'n'=>$data->trave_title )),
                                    array('target' => '_blank', 'title' => CHtml::encode($data->trave_name))); ?></li>
                  <?php endforeach;?>
                </ul>
              </div>
              <div class="member_left">
                <div class="wjgrgx1"><b>易途旅游网特价产品：</b></div>
                <ul class="member_ul">
                  <?php foreach ($trave_bargain_datas as $data):?>
                  <li> <?php echo CHtml::link(CHtml::encode(Util::cs($data->trave_name, 25)), 
                                    $this->createUrl('travel/detail', array('id' => $data->id,'n'=>$data->trave_title )),
                                    array('target' => '_blank', 'title' => CHtml::encode($data->trave_name))); ?></li>
                  <?php endforeach;?>
                </ul>
              </div>
            </div>
            <div class="clear_float"></div>
          </div>
  