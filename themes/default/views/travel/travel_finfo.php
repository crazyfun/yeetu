
<div id="step2" class="step"></div>

  <!-- step end -->
  <div class="order_main">
    <div class="order_main1">
      <div class="clear_float"></div>
       <?php  
          echo CHtml::beginForm($this->createUrl("travel/insertfti"),"POST",array("id"=>'insertfti','onsubmit'=>'return validate_contact();'));
          echo CHtml::hiddenField("travel_action","1",array('id'=>'hidden_travel_action'));
          echo CHtml::hiddenField("trave_id",$trave_id);
          echo CHtml::hiddenField("hidden_adult_nums",$adult_nums,array('id'=>'hidden_adult_nums'));
          echo CHtml::hiddenField("hidden_child_nums",$child_nums,array('id'=>'hidden_child_nums'));
          echo CHtml::hiddenField('hidden_room_nums',$room_nums,array('id'=>'hidden_room_nums'));
          echo CHtml::hiddenField("hidden_start_date",$select_trave_date,array('id'=>'hidden_start_date'));
          echo CHtml::hiddenField("hidden_room_id",$hidden_room_id,array('id'=>'hidden_room_id'));
          echo CHtml::hiddenField("hidden_hotel_id",$hidden_hotel_id,array('id'=>'hidden_hotel_id'));
          echo CHtml::hiddenField("hidden_trave_route_number",$hidden_trave_route_number,array('id'=>'hidden_trave_route_number'));
          echo CHtml::hiddenField("hidden_total_price",$hidden_total_price,array('id'=>'hidden_total_price'));
          echo CHtml::hiddenField("hidden_insurance_ids",$insurance_ids,array('id'=>'hidden_insurance_ids'));
          echo CHtml::hiddenField('start_date_id',$start_date_id,array('id'=>'start_date_id'));
       ?>
      <div class="order_title">联系人信息</div>
      <table class="news_input">
        <tr>
          <td width="85" align="right"><span class="cred">*</span>联系人：<br /></td>
          <td>
     
          	<?php echo CHtml::textField("real_name",$model->contact_name,array("class"=>"txt_m","id"=>"user_real_name"));?>
            <span class="err_notice" id="notice_user_name"><?php echo $model->getError('contact_name'); ?></span>
          </td>
        </tr>
        <tr>
          <td align="right"><span class="cred">*</span>手机：</td>
          <td>
            <?php echo CHtml::textField("user_phone",$model->contact_phone,array("onchange"=>"javascript:check_phone(this.value);","class"=>"txt_m","id"=>"user_phone"));?>
            <span class="err_notice" id="notice_user_phone"><?php echo $model->getError('contact_phone'); ?></span></td>
        </tr>
        <tr>
          <td align="right"><span class="cred">*</span>邮箱：</td>
          <td>
            <?php echo CHtml::textField("email",$model->contact_email,array("class"=>"txt_m","id"=>"user_email","onchange"=>'javascript:check_email(this.value);'));?>
            <span class="err_notice" id="notice_user_email"><?php echo $model->getError('contact_email'); ?></span></span></td>
        </tr>
       
        <tr>
          <td align="right">固定电话：</td>
          <td>
           <?php echo CHtml::textField("area_code",$model->area_code,array("class"=>"txt_s1","id"=>"user_area_code"));?>
            -
            <?php echo CHtml::textField("user_telephone",$model->user_telephone,array("onchange"=>"javascript:check_telephone(this.value);","class"=>"txt_s2","id"=>"user_telephone"));?>
            <span>格式：区号-电话号码</span>
            <span class="err_notice" id="notice_user_telephone"><?php echo $model->getError('user_telephone'); ?></span></td>
            </td>
        </tr>
        
        
        <tr>
          <td align="right"><span class="cred">*</span>联系地址：</td>
          <td>
            <?php echo CHtml::textField("user_address",$model->contact_address,array("class"=>"txt_m","id"=>"user_address"));?>
            <span class="err_notice" id="notice_user_address"><?php echo $model->getError('contact_address'); ?></span></td>
        </tr>
        
      </table>
      <div class="order_title">游客信息<span class="cyellow ">请准确填写游客信息，以免在办理出游手续时发生问题。儿童游客如无相关证件，证件类型请选择“其他”，并填写出生日期。</span></div>
        <?php 
         $total_nums=$adult_nums+$child_nums;
         for($ii=1;$ii<=$total_nums;$ii++){
         ?>
        <table class="news_input1">
        <tr>
          <td width="85" align="left"><strong>第<?php echo $ii;?>位游客</strong></td>
          <td class="cgrey"><?php if($ii==1) echo '[<a href="javascript:cope_user_datas();" >复制联系人信息</a>]';?></td>
        </tr>
        <tr>
          <td width="85" align="right"> 姓名：<br /></td>
          <td>
             <?php echo CHtml::textField("real_name_".$ii,$travel_people[$ii]['real_name'],array("class"=>"txt_m","id"=>"user_real_name_".$ii));?>
           
            <span class="err_notice"  id="notice_user_name_<?php echo $ii; ?>"><?php echo $errors['error_real_name_'.$ii][0]; ?></span> </td>
        </tr>
        <tr>
          <td align="right">证件类型：</td>
          <td>
          	  <?php echo CHtml::dropDownList("code_type_".$ii,$travel_people[$ii]['code_type'],CV::$CODE_TYPE,array("id"=>'code_type_'.$ii,'class'=>'user_code_type','code_index'=> $ii ));?>
          
            证件说明<a class="trave_tipsy" title="购票或办理登机需要的有效证件类型：中国大陆籍乘客的居民身份证、护照、港澳通行证、军官证、武警警官证、士兵证、军队学员、军队文职干部证、军队离退休干部证和军队职工证。16岁以下未成年人可凭其户口簿或户口所在地公安机关出具的身份证么登机；港、澳地区居民和台湾同胞的回乡证、台胞证；外籍乘客的护照、旅行证、外交官证等；民航总局规定的其他有效登机身份证件。安检时，工作人员将何时机票上姓名与证件的一致性，且只能使用对应的证件原件乘机，否则请影响您顺利登机，请认真填写证件内容并核实，出游时请携带好有效证件原件。"><img src="/css/images/qus.gif"/></a> </td>
        </tr>
        <tr id="user_code_content_<?php echo $ii;?>">
          <td align="right" >证件号码：</td>
          <td>
            <?php echo CHtml::textField("user_code_".$ii,$travel_people[$ii]['user_code'],array("onchange"=>"javascript:check_cardid(this.value,'".$ii."');","class"=>"txt_m","id"=>"user_code_".$ii));?>
            <span class="err_notice" id="notice_user_code_<?php echo $ii; ?>"><?php echo $errors['error_user_code_'.$ii][0]; ?></span></td>
        </tr>
    
       <tr id="user_birthday_content_<?php echo $ii;?>" >
          	<td colspan='2'>
       	<table class="news_input2">
       	 <tr>
       	   <td width="85" align="right">证件有效期:</td>
       	   
       	   <td>
       	   	   <?php 
          	 echo "<select name='valid_year_".$ii."'>";
          	  for($jj=2011;$jj<=2025;$jj++){
          	  	$select_value="";
          	  	if($travel_people[$ii]['valid_year']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
          	  }
          	echo "</select>";
          	?>
            年
            <?php
              echo "<select name='valid_month_".$ii."'>";
              
              for($jj=1;$jj<=12;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($travel_people[$ii]['valid_month']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              } 
              echo "</select>";
            ?>
            月
            <?php
              echo "<select name='valid_day_".$ii."'>";
              
              for($jj=1;$jj<=31;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($travel_people[$ii]['valid_day']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              }  
              echo "</select>";
            ?>
            日
       	   	</td>	
       	 </tr>
       	 <tr>
       	 	  <td align="right">
       	 	  	国籍:
       	 	  </td>
       	 	  <td>
              <?php echo CHtml::dropDownList("nation_".$ii,empty($travel_people[$ii]['nation'])?"CHN":$travel_people[$ii]['nation'],CV::$COUNTRY_LISTS,array());?>
       	 	  </td>
       	</tr>

       	 <tr>
          <td align="right">出生日期：</td>
          <td>
          	<?php 
          	 echo "<select name='year_".$ii."'>";
          	 
          	 
          	  for($jj=1910;$jj<=2011;$jj++){
          	  	$select_value="";
          	  	if($travel_people[$ii]['year']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
          	  }
          	echo "</select>";
          	?>
            年
            <?php
              echo "<select name='month_".$ii."'>";
              
              for($jj=1;$jj<=12;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($travel_people[$ii]['month']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              } 
              echo "</select>";
            ?>
            月
            <?php
              echo "<select name='day_".$ii."'>";
              
              for($jj=1;$jj<=31;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($travel_people[$ii]['day']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              }  
              echo "</select>";
            ?>
            日
            </td>
          </tr>
           </table>
         </td>
        </tr>
        
        
        <tr>
          <td align="right">性别：<br /></td>
          <td>
            <?php echo CHtml::dropDownList("user_sex_".$ii,$travel_people[$ii]['user_sex'],array('1'=>'男','2'=>'女'),array("id"=>'user_sex_'.$ii));?>
           </td>
        </tr>
        
        <tr>
          <td align="right">手机：</td>
          <td>
          	<?php echo CHtml::textField("user_phone_".$ii,$travel_people[$ii]['user_phone'],array("onchange"=>"check_phone(this.value);","class"=>"txt_m","id"=>"user_phone_".$ii));?>
            <span class="err_notice" id="notice_user_phone_<?php echo $ii;?>"><?php echo $errors['error_user_phone_'.$ii][0]; ?></span></td>
        </tr>
      </table>
    <?php } ?>
      
    
      <div class="order_line"></div>
      <div class="order_title">游客信息<span class="cyellow">请仔细阅读合同范本，具体出游信息以您填写的订单为准，付款完成后您可在“我的订单”下载包含完整订单信息的旅游合同</span></div>
      <!-- <div><iframe frameborder="0" style="width: 100%;" src="/html/contract/package.html"></iframe></div>-->
      <div class="order_box">
        <h2>补充条款</h2>
        <div class="order_table_b"> 1.自助游产品均为即时计价，请以我方最终确认价格为准。<br />
          2.若您所预订的机票为团队优惠套票，一经开出，不得签转退票；因存在航班调整的可能（包括航空公司、起飞时间的变化），故最终航班情况以出票时的具体信息为准。<br />
          3.为不耽误您的行程，请您至少在航班起飞前90分钟到达机场办理相关手续。<br />
          4.由于列车、航班等公共交通工具延误或取消，以及第三方侵害等不可归责于旅行社的原因导致旅游者人身、财产权受到损害的，旅行社不承担责任，但会积极协助解决旅游者与责任方之间的纠纷。<br />
          5.酒店价格为团队优惠房价，一经成交无法退订。若因游客方原因无法出行，需游客自行承担相应损失。<br />
          6.按照国际惯例，酒店须在14：00后方能办理入住，在12：00之前办理退房手续。<br />
          7.游客入住酒店后如需升级或者更换房型，需补交升级或者更换的房差费用。<br />
          8.黄金周、特殊节日等旅游旺季，房间预订以款到确认为准，一经确认不得随意变更。<br />
          9.游泳、漂流、潜水等水上运动，均存在危险。参与前请根据自身条件，并充分参考当地海事部门及其它专业机构相关公告及建议后量力而行。<br />
          10.有严重高血压、心脏病的客人，参与此行程前请根据自身条件，遵医嘱，谨慎出行。</div>
        <!-- order_box end -->
      </div>
      <div class="order_line"></div>
      <div class="notice_check">
        <?php echo CHtml::checkBox("order_agree",$model->order_agree,array());?>
        <label>我已阅读并接受以上合同条款、补充条款、保险条款和其他所有内容</label>
         <span class="err_notice"><?php echo $model->getError('order_agree'); ?></span>
      </div>
      <div class="order_line"></div>
      <div class="order_nest">
        <input type="submit" src="/css/images/login_x_bt.gif"/>
      </div>
      <?php echo CHtml::endForm();?>
      <div class="clear_float"></div>
    </div>
  </div>
  <div class="line_box1"></div>
  
  <script language="javascript">
 	
	//验证旅客信息的表单
	function validate_contact(){
		var validate_flag=true;
		var adult_nums="<?= $adult_nums ?>";
		var child_nums="<?= $child_nums ?>";
		var user_real_name=document.getElementById("user_real_name").value;
		
		if(!user_real_name){
			
			document.getElementById("notice_user_name").innerHTML="联系人不能为空";
			validate_flag=false;
		}else{
			document.getElementById("notice_user_name").innerHTML="";
		}
		var user_phone=document.getElementById("user_phone").value;
		if(!user_phone){
			document.getElementById("notice_user_phone").innerHTML="手机号码不能为空";
			validate_flag=false;
		}else{
			//if(!is_phone(user_phone,'cell')){
				//document.getElementById("notice_user_phone").innerHTML="手机号码格式不正确";
				//validate_flag=false;
			//}else{
				document.getElementById("notice_user_phone").innerHTML="";
			//}
		}
		
		var user_email=document.getElementById("user_email").value;
		if(!user_email){
			document.getElementById("notice_user_email").innerHTML="邮件不能为空";
			validate_flag=false;
		}else{
			  if(!is_email(user_email)){
			  	  document.getElementById("notice_user_email").innerHTML="邮件格式不正确";
			  	  validate_flag=false;
			  }else{
			  	document.getElementById("notice_user_email").innerHTML="";
			  }
		}
		var user_telephone=document.getElementById("user_telephone").value;
		var user_area_code=document.getElementById("user_area_code").value;
		if(user_telephone){
			 if(!user_area_code){
			 	  document.getElementById("notice_user_telephone").innerHTML="请选择区号";
			 	  validate_flag=false;
			}else{
				//if(!is_phone(user_area_code+"-"+user_telephone,"tele")){
					//document.getElementById("notice_user_telephone").innerHTML="电话号码格式不正确";
					//validate_flag=false;
				//}else{
					document.getElementById("notice_user_telephone").innerHTML="";
				//}
			}
		}
		var user_address=document.getElementById("user_address").value;
		if(!user_address){
			 document.getElementById("notice_user_address").innerHTML="联系地址不能为空";
			 validate_flag=false;
		}else{
			document.getElementById("notice_user_address").innerHTML="";
		}
    if(!child_nums){
    	child_nums=0;
    }
    if(!adult_nums){
    	adult_nums=0;
    }
		var total_nums=parseInt(adult_nums)+parseInt(child_nums);
		
		for(var ii=1;ii<=total_nums;ii++){
			var user_real_name=document.getElementById("user_real_name_"+String(ii)).value;
			var code_type=document.getElementById("code_type_"+String(ii));
			var user_code=document.getElementById("user_code_"+String(ii)).value;
			var code_select=code_type.options[code_type.selectedIndex].value;
			var user_phone=document.getElementById("user_phone_"+String(ii)).value;
			if(!user_real_name){
				document.getElementById("notice_user_name_"+String(ii)).innerHTML="联系人不能为空";
				validate_flag=false;
			}else{
				document.getElementById("notice_user_name_"+String(ii)).innerHTML="";
			}
			switch(code_select){
				case '1':
				   if(!user_code){
				   	  document.getElementById("notice_user_code_"+String(ii)).innerHTML="身份证号码不能为空";
				   	  validate_flag=false;
				  }else{
				   if((iscardno(user_code) === false)&&(checkprovince(user_code) === false)&&(checkbirthday(user_code) === false)&&(checkparity(user_code) === false)){
				   	  document.getElementById("notice_user_code_"+String(ii)).innerHTML="身份证号码格式不正确";
				   	  validate_flag=false;
				   }else{
				   	document.getElementById("notice_user_code_"+String(ii)).innerHTML="";
				  }
				  }
				  break;
				case '2':
				  break;
				default:
				  break;
			}
			if(!user_phone){
					document.getElementById("notice_user_phone_"+String(ii)).innerHTML="手机号码不能为空";
					validate_flag=false;
			}else{
				//if(!is_phone(user_phone,'cell')){
					//document.getElementById("notice_user_phone_"+String(ii)).innerHTML="手机号码格式不正确";
					//validate_flag=false;
			//}else{
				document.getElementById("notice_user_phone_"+String(ii)).innerHTML="";
			//}
		}
		}
		return validate_flag;
	}
  </script>
  
  
