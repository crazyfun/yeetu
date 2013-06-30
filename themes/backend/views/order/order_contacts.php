   <div class="order_title">联系人信息</div>
   <?php echo CHtml::hiddenField("contact_id",$travel_people[0]['id'],array('id'=>'contact_id'));  ?>
      <table class="news_input">
        <tr>
          <td width="85" align="right">联系人：<br /></td>
          <td>
     
          	<?php echo CHtml::textField("contact_name",$travel_people[0]['contact_name'],array("class"=>"txt_m","id"=>"contact_name"));?>
          </td>
        </tr>
        <tr>
          <td align="right">手机：</td>
          <td>
            <?php echo CHtml::textField("contact_phone",$travel_people[0]['contact_phone'],array("class"=>"txt_m","id"=>"contact_phone"));?>
        </tr>
        <tr>
          <td align="right">邮箱：</td>
          <td>
            <?php echo CHtml::textField("contact_email",$travel_people[0]['contact_email'],array("class"=>"txt_m","id"=>"contact_email"));?>
            </td>
        </tr>
       
        <tr>
          <td align="right">固定电话：</td>
          <td>
           <?php echo CHtml::textField("area_code",$travel_people[0]['area_code'],array("class"=>"txt_s1","id"=>"user_area_code"));?>
            -
            <?php echo CHtml::textField("user_telephone",$travel_people[0]['user_telephone'],array("class"=>"txt_s2","id"=>"user_telephone"));?>
            <span>格式：区号-电话号码</span>
            </td>
        </tr>
        
        
        <tr>
          <td align="right">联系地址：</td>
          <td>
            <?php echo CHtml::textField("contact_address",$travel_people[0]['contact_address'],array("class"=>"txt_m","id"=>"user_address"));?>
        </tr>
        
      </table>
      
    <?php if(!empty($order_id)){ ?>
      <div class="order_title">游客信息</div>
        <?php 
        foreach($travel_people as $key => $value){
        	
        if($key!=0){
        	 	
          echo CHtml::hiddenField("People[$key][id]",$value['id'],array("class"=>"txt_m","id"=>"contact_id_".$key));

         ?>
        <table class="news_input1">
        <tr>
          <td width="85" align="left"><strong>第<?php echo $key;?>位游客</strong></td>
        </tr>
        <tr>
          <td width="85" align="right"> 姓名：<br /></td>
          <td>
             <?php echo CHtml::textField("People[$key][contact_name]",$value['contact_name'],array("class"=>"txt_m","id"=>"contact_name_".$key));?>
           
            <span class="err_notice"  id="notice_contact_name_<?php echo $key; ?>"></span> </td>
        </tr>
        <tr>
          <td align="right">证件类型：</td>
          <td>
          	  <?php echo CHtml::dropDownList("People[$key][contact_code_type]",$value['contact_code_type'],CV::$CODE_TYPE,array("id"=>'contact_code_type_'.$key,'class'=>'contact_code_type','contact_code_type'=> $key,'code_index'=> $key ));?>
          </td>

        </tr>
        <tr id="user_code_content_<?php echo $key;?>">
          <td align="right" >证件号码：</td>
          <td>
            <?php echo CHtml::textField("People[$key][contact_code]",$value['contact_code'],array("class"=>"txt_m","id"=>"contact_code_".$key));?>
            <span class="err_notice" id="contact_code_code_<?php echo $key; ?>"></span></td>
        </tr>
    
       <tr id="user_birthday_content_<?php echo $key;?>" >
       	<td colspan='2'>
       	<table class="news_input2">
          <td align="right">出生日期：</td>
          <td>
          	<?php 
          	 echo "<select name=\"People[$key][year]\">";
          	  for($jj=1910;$jj<=2011;$jj++){
          	  	$select_value="";
          	  	if($value['year']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
          	  }
          	echo "</select>";
          	?>
            年
            <?php
              echo "<select name=\"People[$key][month]\">";
              
              for($jj=1;$jj<=12;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($value['month']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              } 
              echo "</select>";
            ?>
            月
            <?php
              echo "<select name=\"People[$key][day]\">";
              
              for($jj=1;$jj<=31;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($value['day']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              }  
              echo "</select>";
            ?>
            日</td>
        </tr>
        
        
        <tr id="user_valid_content_<?php echo $key;?>">
          <td align="right">有效期：</td>
          <td>
          	<?php 
          	 echo "<select name=\"People[$key][valid_year]\">";
          	  for($jj=1910;$jj<=2011;$jj++){
          	  	$select_value="";
          	  	if($value['valid_year']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  }
          	echo "</select>";
          	?>
            年
            <?php
              echo "<select name=\"People[$key][valid_month]\">";
              
              for($jj=1;$jj<=12;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($value['valid_month']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              } 
              echo "</select>";
            ?>
            月
            <?php
              echo "<select name=\"People[$key][valid_day]\">";
              
              for($jj=1;$jj<=31;$jj++){
              	if($jj<=9){
              		$jj="0".$jj;
              	}
              	$select_value="";
              	if($value['valid_day']==$jj)
          	  	   $select_value=" selected='SELECTED' ";
          	  	echo "<option value='".$jj."' ".$select_value.">".$jj."</option>";
          	  	
              }  
              echo "</select>";
            ?>
            日</td>
        </tr>
        
        
        <tr>
          <td align="right">国籍：<br /></td>
          <td>
          	  <?php echo CHtml::dropDownList("People[$key][nation]",$value['nation'],CV::$COUNTRY_LISTS,array("id"=>'nation_'.$key));?>
           </td>
        </tr>
        </table>
      </td>
    </tr>
    

        <tr>
          <td align="right">性别：<br /></td>
          <td>
            <?php echo CHtml::dropDownList("People[$key][contact_sex]",$value['contact_sex'],array('1'=>'男','2'=>'女'),array("id"=>'contact_sex_'.$key));?>
           </td>
        </tr>
        
        <tr>
          <td align="right">手机：</td>
          <td>
          	<?php echo CHtml::textField("People[$key][contact_phone]",$value['contact_phone'],array("class"=>"txt_m","id"=>"contact_phone_".$key));?>
            <span class="err_notice" id="notice_contact_phone_<?php echo $key;?>"></td>
        </tr>
      </table>
    <?php
       } 
      } 
     }
    ?>
    
    
    <script language="javascript">
    	jQuery(function($) {
  		
  		 jQuery(".contact_code_type").each(function(i){
  		 	  
          var code_index=jQuery(this).attr("code_index");
  		  	var select_value=jQuery(this).val();
  		  	switch(select_value){
       	  	 case '1':
       	  	    jQuery("#user_code_content_"+String(code_index)).show();
       	  	    jQuery("#user_birthday_content_"+String(code_index)).hide();
       	  	   break;
       	  	 default:
       	  	    jQuery("#user_birthday_content_"+String(code_index)).show();
       	  	   break;
       	  }
       });
       
       jQuery(".contact_code_type").change(function(){
       	  var code_index=jQuery(this).attr("code_index");
       	  var select_value=jQuery(this).val();
       	  switch(select_value){
       	  	 case '1':
       	  	    jQuery("#user_code_content_"+String(code_index)).show();
       	  	    jQuery("#user_birthday_content_"+String(code_index)).hide();
       	  	 
       	  	   break;
       	  	 default:
       	  	    jQuery("#user_birthday_content_"+String(code_index)).show();

       	  	   break;
       	  }
       	
       	});
    }); 
    	
    </script>