<!--head end--><!--
  <div class="left_box reg">
  	<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
  	
  	
  	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'forgotpassword-form',
          'action'=>$this->createUrl("site/sendphone",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        
        <?php echo CHtml::hiddenField("step","1");?>
        
    <table width="420" border="0" align="right">
      <tbody>
        <tr>
          <td colspan="2" class="reg_title" style="padding-bottom:10px">通过手机找回密码</td>
        </tr>
        <tr>
          <td colspan="2" style="padding-bottom:10px"><div id="user_phone_tip"></div></td>
        </tr>
        <tr>
          <td width="80"><strong>手　　机：</strong></td>
          <td width="310"><?php echo $form->textField($model,"user_phone",array('id'=>"user_phone",'class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'user_phone'); ?></span> 
          </td>
        </tr>
    
        <tr>
          <td><strong>验 证 码：</strong></td>
          <td><?php echo $form->textField($model,"user_phone_verification",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'user_phone_verification'); ?></span>  
          </td>
        </tr>
      
        <tr>
          <td></td>
          <td><input name="image" type="image" class="f_l" src="/css/images/login_x_bt.gif" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <?php $this->endWidget(); ?>
    
   
  </div> 
  
  <div class="right_box reg">
  	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'forgotpassword-form',
          'action'=>$this->createUrl("site/sendemail",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        
     
    <table width="420" border="0" align="left">
      <tbody>
        <tr>
          <td colspan="2" class="reg_title" style="padding-bottom:10px">通过邮箱找回密码</td>
        </tr>
        <tr>
          <td width="80"><strong>邮　　箱：</strong></td>
          <td width="365"><?php echo $form->textField($model,"email",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'email'); ?></span>
              <br />
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input name="image2" type="image" class="f_l" src="/css/images/login_x_bt.gif" />
             </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </tbody>
    </table>
     <?php $this->endWidget(); ?>
  </div>
  <div class="line_box1"></div>
  
   -->
  
  <div class="login_l">
  	<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    <div class="reg">
        <?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'forgotpassword-form',
          'action'=>$this->createUrl("site/sendemail",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
    <table width="420" border="0" align="left">
      <tbody>
        <tr>
          <td colspan="2" class="reg_title" style="padding-bottom:10px">通过邮箱找回密码</td>
        </tr>
        <tr>
          <td width="80"><strong>邮　　箱：</strong></td>
          <td width="365"><?php echo $form->textField($model,"email",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'email'); ?></span>
              <br />
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input name="image2" type="image" class="f_l" src="/css/images/login_x_bt.gif" />
             </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </tbody>
    </table>
     <?php $this->endWidget(); ?>
    </div>
  </div>
  <div class="login_r">
    <div class="login_r_t"></div>
    <div class="login_r_tilte">
      <h2>易途会员可以享有</h2>
    </div>
    <div class="login_r_m">
    	<ul>
      	<div><img src="/css/images/login_io.gif "/><li>累积消费记录并获得抵押券，提高会员等级，享受更多特权</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>每周获得会员邮件周刊，最新、最热旅游线路尽在掌握</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>每逢重大节日或促销活动，您将会获得专题活动邮件，特价信息、优惠线路绝不错过</li></div>
      </ul>
    </div>
    <div class="login_r_tilte">
      <h2>我们的承诺</h2>
    </div>
    <div class="login_r_m">
    	<ul>
      	<div> <img src="/css/images/login_io.gif "/><li>即时电话回访追踪您的旅游感受，改进我们的服务质量</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>随时为您解答各种的疑惑，聆听您的意见</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>严密保管您的个人资料，绝不泄露您的信息</li></div>
      </ul>
    </div>
    <div class="login_r_b"></div>
  </div>
  <div class="line_box1"></div>
  <div id="member_agreement" style="display:none;z-index:200;" >
    	 <div class="member_agreement">
    	 	  <div  class="sreaty">
<p>用户协议<br />
  <strong>一、服务条款</strong><br />
  易途旅游网提供的服务将完全按照其发布的使用协议、服务条款和操作规则严格执行。为获得易途旅游网服务，服务使用人（以下称“会员”）应当同意本协议的全部条款并按照页面上的提示完成全部的注册程序。</p>
<p><strong>二、目的</strong><br />
  本协议是以规定用户使用易途旅游网提供的服务时，易途旅游网与会员间的权利、义务、服务条款等基本事宜为目的。</p>
<p><strong>三、遵守法律及法律效力</strong><br />
  本服务使用协议在向会员公告后，开始提供服务或以其他方式向会员提供服务同时产生法律效力。</p>
<p>会员同意遵守《中华人民共和国保密法》、《计算机信息系统国际联网保密管理规定》、《中华人民共和国计算机信息系统安全保护条例》、《计算机信息网络国际联网安全保护管理办法》、《中华人民共和国计算机信息网络国际联网管理暂行规定》及其实施办法等相关法律法规的任何及所有的规定，并对会员以任何方式使用服务的任何行为及其结果承担全部责任。</p>
<p>在任何情况下，如果本网站合理地认为会员的任何行为，包括但不限于会员的任何言论和其他行为违反或可能违反上述法律和法规的任何规定，本网站可在任何时候不经任何事先通知终止向会员提供服务。</p>
<p>本网站可能不时的修改本协议的有关条款，一旦条款内容发生变动，本网站将会在相关的页面提示修改内容。在更改此使用服务协议时，本网站将说明更改内容的执行日期，变更理由等。且应同现行的使用服务协议一起，在更改内容发生效力前7日内及发生效力前日向会员公告。</p>
<p>会员需仔细阅读使用服务协议更改内容，会员由于不知变更内容所带来的伤害，本网站一概不予负责。</p>
<p>如果不同意本网站对服务条款所做的修改，用户有权停止使用网络服务。如果用户继续使用网络服务，则视为用户接受服务条款的变动。</p>
<p><strong>四、服务内容</strong><br />
  易途旅游网服务的具体内容由本网站根据实际情况提供，本网站保留随时变更、中断或终止部分或全部易途旅游网服务的权利。</p>
<p><strong>五、会员的义务</strong><br />
  用户在申请使用本网站服务时，必须向本网站提供准确的个人资料，如个人资料有任何变动，必须及时更新。</p>
<p>用户注册成功后，本网站将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负责保管；用户应当对以其用户帐号进行的所有活动和事件负法律责任。</p>
<p>用户在使用本网站网络服务过程中，必须遵循以下原则：</p>
<p>遵守中国有关的法律和法规； <br />
  不得为任何非法目的而使用网络服务系统； <br />
  遵守所有与网络服务有关的网络协议、规定和程序； <br />
  不得利用易途旅游网服务系统传输任何危害社会，侵蚀道德风尚，宣传不法宗教组织等内容； <br />
  不得利用易途旅游网服务系统进行任何可能对互联网的正常运转造成不利影响的行为； <br />
  不得利用易途旅游网服务系统上载、张贴或传送任何非法、有害、胁迫、滥用、骚扰、侵害、中伤、粗俗、猥亵、诽谤、侵害他人隐私、辱骂性的、恐吓性的、庸俗淫秽的及有害或种族歧视的或道德上令人不快的包括其他任何非法的信息资料； <br />
  不得利用易途旅游网服务系统进行任何不利于本网站的行为； <br />
  如发现任何非法使用用户帐号或帐号出现安全漏洞的情况，应立即通告本网站。 <br />
  <strong>六、本网站的权利及义务</strong><br />
  本网站除特殊情况外（例如：协助公安等相关部门调查破案等），致力于努力保护会员的个人资料不被外漏，且不得在未经本人的同意下向第三者提供会员的个人资料。</p>
<p>本网站根据提供服务的过程，经营上的变化，无需向会员得到同意即可更改，变更所提供服务的内容。</p>
<p>本网站在提供服务过程中，应及时解决会员提出的不满事宜，如在解决过程中确有难处，可以采取公开通知方式或向会员发送电子邮件寻求解决办法。</p>
<p>本网站在下列情况下可以不通过向会员通知，直接删除其上载的内容：</p>
<p>有损于本网站，会员或第三者名誉的内容； <br />
  利用易途旅游网服务系统上载、张贴或传送任何非法、有害、胁迫、滥用、骚扰、侵害、中伤、粗俗、猥亵、诽谤、侵害他人隐私、辱骂性的、恐吓性的、庸俗淫秽的及有害或种族歧视的或道德上令人不快的包括其他任何非法的内容； <br />
  侵害本网站或第三者的版权，著作权等内容； <br />
  存在与本网站提供的服务无关的内容； <br />
  无故盗用他人的ID(固有用户名)，姓名上载、张贴或传送任何内容及恶意更改，伪造他人上载内容。 <br />
  <strong>七、易途旅游网的著作权，肖像权等</strong><br />
  包括会员间对上载内容的共享等情况在内，对于会员上载的内容的一切权利及责任应由会员承担。</p>
<p>易途旅游网内所有的照片，图片，文章，文字等的版权归原文作者和本网站共同所有，任何人需要转载易途旅游网内的内容，必须征得原文作者或本网站同意（授权）。由于本网站有些内容转载自互联网，如您感觉有侵犯您权益的行为，请联系本站，本站将作更改或删除。</p>
<p>会员承担开设易途旅游网内容的一切权利及责任，本网站不负责易途旅游网内容的信任度，正确度等的一切责任。</p>
<p>在无相关法律规定的情况下，本网站不履行对于会员开设的易途旅游网内容的定期确认，监督的义务。</p>
<p>本网站对于由于会员利用易途旅游网服务时侵害他人的著作权，肖像权等的情况，不承担，负责任何民事，刑事的责任。如果发生由于会员侵害他人的著作权，肖像权等的情况，本网站被第三者告发，起诉，涉及损失赔偿等时，会员必须声明其行为与本网站无关且本网站不负责任何法律责任。</p>
<p><strong>八、免责声明</strong><br />
  会员明确同意其使用易途旅游网服务所存在的风险将完全由其自己承担；因其使用易途旅游网而产生的一切后果也由其自己承担，本网站对用户不承担任何责任。</p>
<p>本网站不担保易途旅游网服务一定能满足用户的要求，也不担保网络服务不会中断，对易途旅游网服务的及时性、安全性、准确性也都不作担保。</p>
<p><strong>九、服务变更、中断或终止</strong><br />
  如因系统维护或升级的需要而需暂停易途旅游网服务，本网站将尽可能事先进行通告。</p>
<p>如发生下列任何一种情形，本网站有权随时中断或终止向用户提供本协议项下的易途旅游网服务而无需通知用户：</p>
<p>用户提供的个人资料不真实； <br />
  用户违反本协议中规定的使用规则。 <br />
  除前款所述情形外，本网站同时保留在不事先通知用户的情况下随时中断或终止部分或全部用户协议服务的权利，对于所有服务的中断或终止而造成的任何损失，本网站无需对用户或任何第三方承担任何责任。</p>
<p><strong>十、违约赔偿</strong><br />
  用户同意保障和维护本网站及其他用户的利益，如因用户违反有关法律、法规或本协议项下的任何条款而给本网站或任何其他第三者造成损失，用户同意承担由此造成的损害赔偿责任。</p>
<p><strong>十一、修改协议</strong><br />
  本网站将可能不时的修改本协议的有关条款，一旦条款内容发生变动，本网站将会在相关的页面提示修改内容。</p>
<p>如果不同意本网站对服务条款所做的修改，用户有权停止使用易途旅游网服务。如果用户继续使用易途旅游网服务，则视为用户接受服务条款的变动。</p>
<p><strong>十二、法律管辖</strong><br />
  本协议的订立、执行和解释及争议的解决均应适用中国法律。</p>
<p>如双方就本协议内容或其执行发生任何争议，双方应尽量友好协商解决；协商不成时，任何一方均可向本网站所在地的人民法院提起诉讼。</p>
<p><strong>十三、其他规定</strong><br />
  本协议构成双方对本协议之约定事项及其他有关事宜的完整协议，除本协议规定的之外，未赋予本协议各方其他权利。</p>
<p>如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。 <br />
</p>
</div>
    	 </div>
  </div>
