<!--ul class="product_list">-->
        <div class="search_sclist  bgcolor">
            <div class="product_cover"> <a title="<?php echo $data->trave_name;?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$data->id,'n'=>$data->trave_title,'st'=>$this->trave_esregion_en_name))?>"><?php echo $data->get_trave_search_first_image($data->id);?></a> </div>
            <div class="package_price">
              <div class="price_box"> <span class="base_price"><strong><?php $trave_category=$data->trave_category;if($trave_category=='4'){ echo '一团一议'; }else{ echo $data->adult_price."元起";}?></strong></span></div>
              <?php 
                if(empty($district)){
                  $district=new District();
                }
              ?>
              <div class="stregion"><strong>订单数:<span class='around_price'><?php echo $data->trave_numbers > $data->system_indent? $data->trave_numbers : $data->system_indent;?></span></strong></div> 
              <div class="stregion"><strong><?php if(empty($trave_comment)){
			         				 		$trave_comment=new TraveComment();
			         				 	}
			         				 	?>
			         				 	<span class="b_around_satisf"><?php echo $trave_comment->get_trave_satisfied($data->id);?></span></strong></div>
			        <div class="clear_float"></div>
			        <div class="stregion"><a href="<?php echo $this->createUrl('search/index',array('trave_sregion'=>$data->trave_sregion)); ?>"><?php $sdistrict_datas=$district->get_table_datas($data->trave_sregion); echo $sdistrict_datas->district_name; ?>出发</a></div> 
            </div>
            
            <div class="product_summary layoutfix">
            	<?php $trave_characteristic=$data->get_trave_characteristic(); ?>
              <h4> <a title="<?php echo $data->trave_name;?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$data->id,'n'=>$data->trave_title,'st'=>$this->trave_esregion_en_name))?>"><?php echo $data->trave_name;?></a><?php  if($data->trave_recommend=='2'){echo '<span class="characteristic_img"><img  src="/css/images/tuijian_img.png"/></span>';} if($data->trave_bargain=='2'){echo '<span class="characteristic_img"><img src="/css/images/tejia_img.png"/></span>';} if($data->trave_hot=='2'){echo '<span class="characteristic_img"><img  src="/css/images/remai_img.png"/></span>';}?> </h4>
              <div class="product_extrainfo">
              	<table>
			         		<tbody>
			         			
			         			<tr>
			         				
			         				
			         				 <td width="90" style="text-align:left;">
			         				 	  类型:<?php $s_trave_category=CV::$SEARCH_TRAVE_CATEGORY;echo "<a href='".$this->createUrl('search/index',array('tcid'=>$data->trave_category,'trave_sregion'=>$this->trave_esregion))."'>".$s_trave_category[$data->trave_category]."</a>"; ?>
			         				 </td>
	
			         				 <td width="90" style="text-align:left;">
			         				 	  目的地:<?php $district_datas=$district->get_table_datas($data->trave_region); echo "<a href='".$this->createUrl('search/index',array('did'=>$data->trave_region,'trave_sregion'=>$this->trave_esregion))."'>".$district_datas->district_name."</a>"; ?>
			         				 </td>
			         				 
			         				  <td  style="text-align:left;">
			         				 	  
			         				 	     <?php 
			         				 	             
			         				 	             
			         				 	             if(!empty($trave_characteristic)){
			         				 	             	echo "特色:";
			         			                 foreach($trave_characteristic as $key => $value){
			         			                 	  echo "&nbsp;&nbsp;<a href='".$this->createUrl('search/index',array('trave_characteristic'=>$key,'trave_sregion'=>$this->trave_esregion))."'>".$value."</a>";
			         			                 }
			         				 	            
			         				 	          } 
			         				 	      ?>
			         				 </td>
			         			</tr>
			         			<tr>
			         				<td colspan="3" style="word-break:normal;word-wrap:break-word;">
		                    <div class="trave_search_shot_des">
                             <?php echo Util::cs($data->trave_shot_desc,100);?>
                        </div>
		                  </td>
			         			</tr>
			         		</tbody>	
			         	</table>
			        </div>
              <div class="clear_float"></div>
              <!-- 只显示两行用class : hotel_intro -->
              <div style=" text-align:right;margin:5px 0;"> <a href="<?php echo $this->createUrl("travel/detail",array('id'=>$data->id,'n'=>$data->trave_title,'st'=>$this->trave_esregion_en_name))?>" class="detailed_infor_down">更多介绍</a></div>
            </div>
          </div>   
          
          
             
                 
