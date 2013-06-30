<div class="order_title">保险信息</div>
<table cellspacing="0" class="view_order_table" >
	    	<thead>
	    		 <tr>
            	<th align="left" width="210">保险名称</th>
            	<th align="left" width="100">保险期限</th>
	          	<th width="250" align="left"> 保险价格/人</th>
	          	<th align="center" width="70">每人一份</th>
            </tr>
	    		</thead>
	      <tbody>
	      	<?php 
	      	    foreach($insurance_datas as $key => $value){
	      	 ?>
	      	    	  <tr>
                   <td><?php echo $value->insurance_name;?></td>
                   <td><?php echo $value->insurance_period;?></td>
                   <td align="left"><?php echo $value->insurance_pice; ?></td>
                   <td align="center"><span  class="o_price"><?php $insurance_ids_array=explode(',',$insurance_ids);if(in_array($value->id,$insurance_ids_array)) $checked=true;else $checked=false; echo CHtml::checkBox('insurance_check[]',$checked,array('value'=>$value->id,'class'=>'insurance_check','price'=>$value->insurance_pice)); ?></span></td>
                  </tr>     
         <?php  
           }
	      	?>
          </tbody>
        </table>	
        
        
  <script language="javascript">
  	  

  </script>
