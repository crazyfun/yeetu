<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">

			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add"></div>
			<div class="input_line">
				<div class="input_name">发送对象</div>
				<div class="input_long_content">
				    <?php echo $model->message;?>
        </div>
			</div>
			
			<div class="input_line">
				<div class="input_name">信息类型</div>
				<div class="input_long_content">
				  <?php echo CV::$BATCH_TYPE[$model->batch_type];?>
				</div>
			</div>
			
			<div class="input_line">
				<div class="input_name">主题</div>
				<div class="input_long_content">
				  <?php echo $model->title;?>
				</div>
			</div>
			
		  <div class="input_line">
				<div class="input_name">内容</div>
				<div class="input_long_content">
				  <?php echo $model->content;?>
				</div>
			</div>
			
		
		 <div class="input_line">
				<div class="input_name">描述</div>
				<div class="input_long_content">
				  <?php echo $model->describe;?>
				</div>
			</div>
			
			
			<div class="input_line">
				<div class="input_name">发送状态</div>
				<div class="input_long_content">
				  <?php echo $model->get_status();?>
				</div>
			</div>
			
			
			<div class="input_line">
				<div class="input_name">是否是全部发送</div>
				<div class="input_long_content">
				  <?php echo $model->get_all();?>
				</div>
			</div>
			
			<div class="input_line">
				<div class="input_name">定制时间</div>
				<div class="input_long_content">
				  <?php echo $model->custom_date;?>
				</div>
			</div>
			
			
			<div class="input_line">
				<div class="input_name">发送时间</div>
				<div class="input_long_content">
				  <?php echo date('Y-m-d H:i:s',$model->send_date);?>
				</div>
			</div>
			
			
			<div class="input_line">
				<div class="input_name">创建时间</div>
				<div class="input_long_content">
					<?php echo date('Y-m-d H:i:s',$model->create_time);?>
				</div>
			</div>
			
			
			<div class="input_line hasbgbot">
				
			</div>
		</div>
		<!-- /.edit_content -->
	</div>
	<!-- /.show_right_content -->
</div>
<!-- /#page_content -->