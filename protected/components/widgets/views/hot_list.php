     <div class="hot_place">
            	<div class="h_palce_bg">
            		  <?php 
				
					if(!empty($hotViews)){
						foreach($hotViews as $h){
							echo CHtml::link($h->name,$h->link);
						}
					}
				?>
            		<div class="clear_float"></div>
                </div>
            </div><!--hot_place end-->
