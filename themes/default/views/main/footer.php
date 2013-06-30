

	<div id="floatTools" class="float0831">
			<div class="floatL">
				<a title="查看在线客服" class="btnOpen" id="aFloatTools_Show" style="display: none;" onclick="javascript:$('#divFloatToolsView').animate({width: 'show', opacity: 'show'}, 'normal',function(){ $('#divFloatToolsView').show(); });$('#aFloatTools_Show').attr('style','display:none');$('#aFloatTools_Hide').attr('style','display:block');" href="javascript:void(0);">展开</a> 
				<a title="关闭在线客服" class="btnCtn" id="aFloatTools_Hide" style="display: block;" onclick="javascript:$('#divFloatToolsView').animate({width: 'hide', opacity: 'hide'}, 'normal',function(){ $('#divFloatToolsView').hide(); });$('#aFloatTools_Show').attr('style','display:block');$('#aFloatTools_Hide').attr('style','display:none');" href="javascript:void(0);">收缩</a>
			</div>
			<div id="divFloatToolsView" class="floatR" style="display:block;">
				<div class="tp"></div>
				<div class="cn">
					<ul>
						<li class="top">
							<h3 class="titZx">
								QQ咨询
							</h3>
						</li>
						<li>
							<span class="icoZx">在线咨询</span>
						</li>
						<li>
							<a class="qqOn" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=290030958&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:290030958:41 &r=0.8940031429092906" alt="易途旅行网" title="易途旅行网"></a>
						</li>
						
						
					</ul>
					
				
					
					<ul>
						<li>
							<h3 class="titDh">
								电话咨询
							</h3>
						</li>
						<li>
							<span class="icoTl">021-56880166</span>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
<div class="content">  
 	
 	  <?php
      	if($this->beginCache("HelpIndex", array('duration'=>"1"))){
              $this->widget('Helpindex'); 
             $this->endCache(); 
        }
       ?>   
       
       
    <div class="footer">
    	
    	  <?php
    	      $this->widget('FriendLinks');
    	  ?>
      <?php
      	if($this->beginCache("Foot_Link", array('duration'=>"1"))){
              $this->widget('Foot_Link', array(
               
              )); 
             $this->endCache(); 
        }     
     ?>
    <div class="footer_div">Copyright&copy; 2010-2019 41ly.cn 隐私保护 易途网版权所有 沪ICP备05000883号
    
    </div>
    </div><!--footer end-->
</div>    

    
