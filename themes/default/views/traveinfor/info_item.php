
	  <div class="travel_infor_item">
	  	 <div class="travel_infor_title"><a href="<?php echo Yii::app()->getController()->createUrl("traveinfor/details",array('id'=>$data->id)); ?>"><?php echo $data->information_title;?></a></div>
	  	 <div class="travel_infor_desc"><?php echo $data->information_desc;?></div>
	  	 <div class="travel_infor_infor"><span class="tii_span">主题:<?php echo $data->Infortheme->theme_name;?></span><span class="tii_span">查看次数:<?php echo $data->view_numbs;?></span><span class="tii_span">发布人:<?php echo $data->User->user_login;?></span><span class="tii_span">发布时间:<?php echo date('Y-m-d H:i:s',$data->create_time);?></span></div>  	
	  </div>
	

                    
                 
