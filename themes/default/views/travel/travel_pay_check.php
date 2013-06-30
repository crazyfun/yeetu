<!--head end-->
  <div id="step4" class="step"></div>
  <!-- step end -->
  <div class="order_main">
    <div class="order_main1">
      <div  class="warp" >
        <div class="order_box">
        	
        	<?php  
      			 echo CHtml::beginForm($this->createUrl(""),"POST",array("id"=>'travelpay'));
       			 echo CHtml::hiddenField("trave_id",$trave_id);
       			 echo CHtml::hiddenField("order_id",$order_id);
       			 echo CHtml::hiddenField("pay_price",$pay_price);
      			 echo CHtml::hiddenField("total_price",$total_price);
      			 echo CHtml::hiddenField("is_invoice",$is_invoice);
      			 echo CHtml::hiddenField("separate_id",$separate_id);
      			 echo CHtml::hiddenField("pay_type",$pay_type);
     			 ?>
                 <div class="order_title" style="float:none;">支付方式：
                 	<span class="jiekspan">
             	 	<?php 
             	 	   $pay_style_array=CV::$PAY_STYLE;
             	 	   echo $pay_style_array[$pay_type];
             	 	?>
             	 		</span>
             	 </div>
     		<table cellpadding="0" cellspacing="0" class="tabzhifu" width="800"> 	 
                 	<tr class="l_solid"><td class="br_1" align="right" width="175" style="padding-top:15px;"><span>订单号</span>：</td><td style="padding-top:15px;"><span class="colyel"><?php echo $order_id;?></span></td></tr>
             	 	<tr class="l_solid"><td class="br_1" align="right">支付时间：</td><td><span class="colyel"><?php echo date("Y-m-d H:i:s");?></span></td></tr>
             	 	<tr class="l_solid"><td class="br_1" align="right">支付内容：</td><td><span class="colyel"><?php $trave=new Trave(); $trave_datas=$trave->get_table_datas($trave_id);echo $trave_datas->trave_name."(".$trave_datas->trave_number.")"; ?>旅游线路支付</span></td></tr>
             	 	<tr class="l_solid"><td align="right" class="br_1" height="30">支付描述：</td><td><span class="colyel">易途旅游网旅游线路在线支付</span></td></tr>
               	 	<tr class="l_solid"><td class="br_1" align="right">是否需要发票：</td><td><span class="colyel"><?php if(!empty($is_invoice)) echo "需要"; else echo "不需要"; ?></span></td></tr>
             	 	<tr class="l_solid"><td class="br_1" align="right">支付金额：</td><td><b class="jiekspan"><?php echo $total_price;?>元</b></td></tr>				 
                <?php switch($pay_type){
                	      case '1':
                ?>
                    <tr class="l_solid"><td class="br_1" align="right">门市地址：</td><td><span class="colyel">上海市岭南路1115号中铁大厦707</span></td></tr>
                    <tr>
                    	<td>&nbsp;</td>
                        <td>
                         <div class="order_nest" style="width:auto; padding:0px;">
                         	
                         	<?php 
        	  								  $trave_order=new traveorder();
        	      							$trave_order_datas=$trave_order->get_table_datas($order_id);
        	      							$order_status=$trave_order_datas->order_status;
        	      						  if($order_status=='8'){
                								echo '<font color="#FF0000">此订单已取消，请联系客服。</font>';
                							}else{
                								echo '<font color="#FF0000">您已下单，为了保证您顺利出游，请等待我们的客服专员确认后再行付款或查看您的<a href="'.$this->createUrl("user/order",array()).'">订单。</a></font>';
                							}
       									?>
                        </div>
                       <?php echo CHtml::endForm();?>
          				</td>
                    </tr>
                 <?php break;
                       case '2':
                 ?>
                    <tr>
                    	<td>&nbsp;</td>
                        <td>
                         <div class="order_nest" style="width:auto; padding:0px;">
                         	<?php 
        	  								$trave_ordain=$trave_datas->trave_ordain;
        	  								$trave_order=new traveorder();
        	      							$trave_order_datas=$trave_order->get_table_datas($order_id);
        	      							$order_status=$trave_order_datas->order_status;
        	      							$pay_status=$trave_order_datas->pay_status;
        	 								  if($trave_ordain=='1'&&($pay_status=='1'||$pay_status=='3')){
        								      if($pay_type=='2'){
                                  echo $alipay_button;
                                }else{
                                    echo '<input name="pament" type="submit" value="提交"/>';
                                }
                            }else{
        	      							
        	      							if(($order_status=='2'||$order_status=='3'||$order_status=='4'||$order_status=='5'||$order_status=='6'||$order_status=='7')&&($pay_status=='1'||$pay_status=='3')){
                    						if($pay_type=='2'){
                                  echo $alipay_button;
                                }else{
                                    echo '<input name="pament" type="submit" value="提交"/>';
                                }
                							}else if($order_status=='8'){
                								echo '<font color="#FF0000">此订单已取消，请联系客服。</font>';
                							}else{
                								echo '<font color="#FF0000">您已下单，为了保证您顺利出游，请等待我们的客服专员确认后再行付款或查看您的<a href="'.$this->createUrl("user/order",array()).'">订单。</a></font>';
                							}
       											}  
       									?>
                        </div>
                       <?php echo CHtml::endForm();?>
          				</td>
                    </tr>
                 <?php break;
                      case '3':
                 ?>
                     <tr>
                    	<td>&nbsp;</td>
                        <td>
                         <div class="order_nest" style="width:auto; padding:0px;">
                         	
                         	<?php 
        	  								$trave_ordain=$trave_datas->trave_ordain;
        	  								$trave_order=new traveorder();
        	      							$trave_order_datas=$trave_order->get_table_datas($order_id);
        	      							$order_status=$trave_order_datas->order_status;
        	      							$pay_status=$trave_order_datas->pay_status;
        	 								  if($trave_ordain=='1'&&($pay_status=='1'||$pay_status=='3')){
        								      if($pay_type=='2'){
                                  echo $alipay_button;
                                }else{
                                    echo '<input name="pament" type="submit" value="提交"/>';
                                }
                            }else{
        	      							if(($order_status=='2'||$order_status=='3'||$order_status=='4'||$order_status=='5'||$order_status=='6'||$order_status=='7')&&($pay_status=='1'||$pay_status=='3')){
                    						if($pay_type=='2'){
                                  echo $alipay_button;
                                }else{
                                    echo '<input name="pament" type="submit" value="提交"/>';
                                }
                							}else if($order_status=='8'){
                								echo '<font color="#FF0000">此订单已取消，请联系客服。</font>';
                							}else{
                								echo '<font color="#FF0000">您已下单，为了保证您顺利出游，请等待我们的客服专员确认后再行付款或查看您的<a href="'.$this->createUrl("user/order",array()).'">订单。</a></font>';
                							}
 
       											}  
       									?>
                        </div>
                       <?php echo CHtml::endForm();?>
          				</td>
                    </tr>
                 <?php break;
                     case '4':
                 ?>
                    <tr class="l_solid"><td class="br_1" align="right">银行帐号信息：</td><td><span class="colyel">户名：上海易途旅行社有限公司,开户行：中国工商银行静安新城支行，账号：1001 1224 1900 5004 553
</span></td></tr>
                    <tr>
                    	<td>&nbsp;</td>
                        <td>
                         <div class="order_nest" style="width:auto; padding:0px;">
                         	<?php 
        	  								  $trave_order=new traveorder();
        	      							$trave_order_datas=$trave_order->get_table_datas($order_id);
        	      							$order_status=$trave_order_datas->order_status;
        	      						  if($order_status=='8'){
                								echo '<font color="#FF0000">此订单已取消，请联系客服。</font>';
                							}else{
                								echo '<font color="#FF0000">您已下单，为了保证您顺利出游，请等待我们的客服专员确认后再行付款或查看您的<a href="'.$this->createUrl("user/order",array()).'">订单。</a></font>';
                							}
       									?>
                        </div>
                       <?php echo CHtml::endForm();?>
          				</td>
                    </tr>
                 <?php break;
                     default:
                       break;
                    }
                 ?>    
                 
                    <tr>
                    	 <td colspan="2" style="text-align:right;">
                    	 <div>
                       	  <font color="#FF0000">如果金额过大，请联系我们为您拆单后再行支付或查看您的<a href="<?php echo $this->createUrl("user/order",array());?>">订单。</a></font>
                      </div>
                     </td>
                    </tr>
                    
                    
                    
                    
          </table>
             </div>
        </div> 
        <!-- <div><iframe frameborder="0" style="width: 100%;" src="/html/contract/package.html"></iframe></div>-->
        <div class="order_line"></div>
        <div class="order_warn" style="margin-left:20px;">
          <p>温馨提醒<br />
            <?php $trave_datas=$trave->get_table_datas($trave_id);echo $trave_datas->trave_tips; ?>
        </div>
        <div class="order_line"></div>
        <div class="clear_float"></div>
      </div>
    </div>
  <div class="line_box1"></div>
  
  
