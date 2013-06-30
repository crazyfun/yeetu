<table cellspacing="0" class="view_order_table" >
	    	<thead>
	    		 <tr>
            	<th align="left" width="210">保险名称</th>
	          	<th width="195" align="left"> 说明</th>
	          	<th align="center" width="70"> 小计</th>
            </tr>
	    		</thead>
	      <tbody>
	      	<?php 
	      	    foreach($insurance_datas as $key => $value){
	      	 ?>
	      	    	  <tr>
                   <td><div class="insurance_name"><div class="click_tip"><a class="trave_tipsy" title="<?php echo $value->insurance_describe;?>"><?php echo $value->insurance_name;?></a></div></div></td>
                   <td align="left"><?php echo $value->insurance_explain; ?></td>
                   <td align="center"><span  class="o_price"><?php echo (($adult_nums+$child_nums)*$value->insurance_pice);?></span></td>
                  </tr>     
         <?php  
           }
	      	?>
          </tbody>
        </table>	
        
