   <div class="view_order_box">
   	 <h2>联系人</h2>
    <table  cellspacing="0" class="view_order_table">
          <tr>
            <th width="113" align="left">姓名</th>
            <th width="155" align="center">手机</th>
            <th width="172" align="center">邮箱</th>
            <th width="130" align="center">固定电话</th>
            <th align="center">联系地址</th>
          </tr>
          <tr>
            <td><?php echo $travel_people[0]['contact_name'];?></td>
            <td align="center"><?php echo $travel_people[0]['contact_phone'];?></td>
            <td align="center" class="order_date"><span><?php echo $travel_people[0]['contact_email'];?></span></td>
            <td align="center"><?php echo $travel_people[0]['contact_telephone'];?></td>
            <td align="center"><?php echo $travel_people[0]['contact_address'];?></td>
          </tr>
        </table>
	    <!-- order_tab end -->
      </div>  
	  <div class="view_order_box">
      <h2>游客信息</h2>
	    <table  cellspacing="0" class="view_order_table">
          <tr>
            <th width="113" align="left">姓名</th>
            <th width="135" align="center">证件类型</th>
            <th align="center">证件号码</th>
            <th width="64" align="center">性别</th>
            <th width="114" align="center">手机</th>
          </tr>
          
          <?php foreach($travel_people as $key => $value){
          	 if($key!=0){
          ?>
          <tr>
            <td><?php echo $value['contact_name'];?></td>
            <td align="center"><?php $code_type_array=CV::$CODE_TYPE;echo $code_type_array[$value['contact_code_type']];?></td>
            <td align="center" class="order_date"><span><?php echo $value['contact_code'];?></span></td>
            <td align="center"><?php $sex_array=array('1'=>'男','2'=>'女'); echo $sex_array[$value['contact_sex']]; ?></td>
            <td align="center"><?php echo $value['contact_phone'];?></td>
          </tr>

        <?php }} ?>
        </table>
      </div>
     