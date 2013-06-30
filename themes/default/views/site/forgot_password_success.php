 <div class="login_l">
    <div class="reg">
    	
      <table border="0" width="550">
        <tbody>
          <tr>
            <td>我们已经给您的<span class="user_data_tip"><?php echo $user_email;?></span>邮箱发送了一封邮件，请登录您邮箱查看并完成密码找回。</td>
          </tr>
          <tr>
            <td><?php echo $this->redirect_email($model->email); ?></td>
          </tr>
          <tr>
            <td class="reg_line" style="padding-top:20px"><img src="/css/images/login_io.gif "/>&nbsp;&nbsp;如果您未收到邮件，请查看邮件是否在垃圾邮件中</td>
          </tr>
          <tr>
            <td><img src="/css/images/login_io.gif "/>&nbsp;&nbsp;如果不存在，请点击此处<a href="<?php echo $this->createUrl("site/repeatactive",array('user_email'=>$user_email)) ?>">重新发送</a>邮件</td>
          </tr>
          <tr>
            <td><img src="/css/images/login_io.gif "/>&nbsp;&nbsp;如果三次点击后仍未收到邮件，请<a href="<?php echo $this->createUrl("statics/index",array('cid'=>'12')); ?>">联系我们</a>的客服，谢谢！</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="login_r">
    <div class="login_r_t"></div>
    <div class="login_r_tilte">
      <h2>易途旅游网会员可以享有</h2>
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