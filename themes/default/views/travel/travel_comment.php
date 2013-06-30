    <div id="trave_comment_datas" class="trave_describe_content wj_plc">
              <?php 
                
                  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$comment_dataProvider,
												'itemView'=>'comment_item',
												'ajaxUpdate'=>true,
										));
               ?>
            	 </div>
                  <div class="sthtab">
                  	  <?php echo CHtml::beginForm($this->createUrl("travel/travelcomment"),"POST",array("id"=>'travelcomment','onsubmit'=>'return false;'));?>
                  	  <?php echo CHtml::hiddenField("total_rating","",array("id"=>"total_rating")); ?>
                  	  <?php echo CHtml::hiddenField("trave_id",$trave_id,array("id"=>"comment_trave_id")); ?>
                      <table cellpadding="0" cellspacing="0">
                      	<?php if(!Yii::app()->user->isGuest){ ?><tr><td align="right"><div class="comment_user_img"><img src='<?php echo $user_img;?>'/></div></td><td><?php echo $user_login;?></td></tr><?php } ?>
                         <tr>
                         	<td width="75" height="30px" align="right">总体评价：</td>
                           <td>
                            	<div class="rating-wrap">
                                	<ul>
                                    	  <li>
                                        	<a class="one-star" rating_value='1'  title="1分"></a>
                                        </li>
                                        <li>
                                        	<a class="two-stars" rating_value='2'  title="2分"></a>
                                        </li>
                                        <li>
                                        	<a class="three-stars" rating_value='3'  title="3分"></a>
                                        </li>
                                        <li>
                                        	<a class="four-stars" rating_value='4'  title="4分"></a>
                                        </li>
                                        <li>
                                        	<a class="five-stars" rating_value='5'  title="5分"></a>
                                        </li>
                                    </ul>	
                                </div>
                                <span class="hint" id="hint">点击星星为线路打分</span>
                            </td>
                         </tr>
                         <tr>
                         	<td align="right" height="40px" valign="middle"></td>
                            <td valign="middle"><span class="wj_redtxt">*</span>&nbsp;&nbsp;&nbsp;景点：<?php echo CHtml::dropDownList("comment_scape","",CV::$RATING_VALUES,array());?><span class="wj_redtxt">*</span>&nbsp;&nbsp;&nbsp;住宿：<?php echo CHtml::dropDownList("comment_stay","",CV::$RATING_VALUES,array());?><span class="wj_redtxt">*</span>&nbsp;&nbsp;&nbsp;用餐：<?php echo CHtml::dropDownList("comment_dining","",CV::$RATING_VALUES,array());?><span class="wj_redtxt">*</span>&nbsp;&nbsp;&nbsp;车辆：<?php echo CHtml::dropDownList("comment_cat","",CV::$RATING_VALUES,array());?><span class="wj_redtxt">*</span>&nbsp;&nbsp;&nbsp;购物：<?php echo CHtml::dropDownList("comment_shop","",CV::$RATING_VALUES,array());?></td>
                         </tr>
                         
                         <tr>
                         	<td align="right" height="40px" valign="middle"></td>
                            <td valign="middle"><span class="wj_redtxt">*</span>&nbsp;&nbsp;&nbsp;导游：<?php echo CHtml::dropDownList("comment_guide","",CV::$RATING_VALUES,array());?><span class="wj_redtxt">*</span>&nbsp;&nbsp;&nbsp;服务：<?php echo CHtml::dropDownList("comment_server","",CV::$RATING_VALUES,array());?><span class="wj_redtxt">*</span></td>
                         </tr>
                         
                         
                         <tr>
                         	<td align="right">点评内容：</td>
                            <td>
                            	<textarea onkeyup="javascript:remaining_word('comment_content',100,'remaining_word');" name="comment_content" id="comment_content"></textarea><br />
                                <span>最多100个字,你还可输入<span id="remaining_word">100</span>个字</span>
                            </td>
                         </tr>
                         
                        <!-- 
                         <tr>
                         	<td align="right">验证码：</td>
                            <td>
                            	<?php echo CHtml::textField("verification_code",$verification_code,array('class'=>'gm_login_input',"id"=>"verification_code")); ?>&nbsp;<a id="comment_on_click" onclick="document.getElementById('__code__').src = '<?php echo Yii::app()->request->baseUrl;?>/index.php/travel/imagecode?id=' + ++ts; return false"><img id="__code__" src="<?php echo Yii::app()->request->baseUrl;?>/index.php/travel/imagecode?id=<?= $ts ?>"/></a>
                            </td>
                         </tr>
                        --> 
                         
                         
                         <tr>
                         	<td>&nbsp;</td>
                            <td height="50"><?php if(Yii::app()->user->isGuest){ ?> <a class="wjamend" href="<?php echo $this->createUrl("site/login"); ?>">请先登录</a><?php }else{ ?><input value="发表评论"  type="button" id="trave_comment_button" onclick="javascript:submit_serial_form('travelcomment');" class="wjamend"/> <?php } ?></td>
                         </tr>
                      </table>	
              <?php echo CHtml::endForm();?>
              
              <div id="show_operate_tips" style="display:none;" >
    	           <div id="show_operate_tips_content" class="show_operate_tips">
    	           </div>	
    	        </div>
           </div>

            <script language="javascript">
            	 var trave_id="<?= $trave_id ?>"
	             ts = "<?= $ts ?>";
           	</script>
  
