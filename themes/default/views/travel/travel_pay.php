
  <!--head end-->
  <div id="step4" class="step"></div>
  <!-- step end -->
  <div class="order_main">
    <div class="order_main1">
      <div  class="warp" >
        <div class="clear_float"></div>
        <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          
          
        <div class="order_title">付款信息息<span class="cyellow "><a href="<?php echo $this->createUrl("help/index",array('cid'=>'25')); ?>">如何进行大额支付</a></span></div>
        <div class="order_pay_box">订单号: <?php echo $order_id; ?>
        </div>
        <div class="order_pay_box">线路名称:  <?php $trave=new Trave(); $trave_datas=$trave->get_table_datas($trave_id);echo $trave_datas->trave_name; ?>
        </div>
        
      <?php  
       echo CHtml::beginForm($this->createUrl("travel/travelpay"),"POST",array("id"=>'travelpay'));

       echo CHtml::hiddenField("trave_id",$trave_id);
       echo CHtml::hiddenField("order_id",$order_id);
       echo CHtml::hiddenField("separate_id",$separate_id);
       echo CHtml::hiddenField("total_price",$total_price);
     ?>
        <div class="order_pay_box">您需要支付：<span class="order_show"><?php echo $total_price;?></span>元</div>
        <div class="order_title">发票信息<span class="cyellow ">
          <?php echo CHtml::checkBox("is_invoice",'1',array()); ?>
          需要开发票</span></div>
        <div class="order_title">请选择支付方式</div>
        <div class="order_box">
        	<!--
          <div class="pay_list">
            <?php echo CHtml::radioButton("pay_type",'',array("value"=>'3'));?>
            <strong>易宝</strong>&nbsp;&nbsp;易宝接口基本支持国内各大银行，您可以选择易宝余额或者网上银行（注：需开通相关银行的网银功能）支付。
            </li>
          </div>
          
          <div class="pay_list">
            <?php echo CHtml::radioButton("pay_type",'',array("value"=>'2','CHECKED'=>'CHECKED'));?>
            <strong>支付宝</strong>&nbsp;&nbsp;支付宝接口基本支持国内各大银行，您可以选择易宝余额或者网上银行（注：需开通相关银行的网银功能）支付。
            </li>
          </div>
          -->
          <div class="pay_list">
            <?php echo CHtml::radioButton("pay_type",'',array("value"=>'4'));?>
            <strong>银行汇款</strong>
            </li>
          </div>
          
          <div class="pay_list">
            <?php echo CHtml::radioButton("pay_type",'',array("value"=>'1'));?>
            <strong>刷卡和现金</strong>
            </li>
          </div>
       
        </div> 
        
        <div class="order_nest">
        	<input name="image" type="submit" value="付 款"/>
        	<span class="my_order_view"><a href="<?php echo $this->createUrl('user/orderview',array('id'=>$order_id));?>">查看订单</a></span>
        	
        </div>
        <?php echo CHtml::endForm();?>
        <!-- <div><iframe frameborder="0" style="width: 100%;" src="/html/contract/package.html"></iframe></div>-->
        <div class="order_line"></div>
        <div class="order_warn">
          <p>温馨提醒<br />
            <?php $trave_datas=$trave->get_table_datas($trave_id);echo $trave_datas->trave_tips; ?>
        </div>
        <div class="order_line"></div>
        
        <div class="clear_float"></div>
      </div>
    </div>
  </div>
  <div class="line_box1"></div>
  
  
