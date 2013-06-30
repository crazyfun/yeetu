<?php
class User extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public $con_password;
	public $user_password;
	public $agreement;
	public $verification_code;
	public $rememberme;
	public $user_phone_verification;
	public $hidden_user_phone;
	public $old_login_time;
	private $_identity;
	

  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_login,email,con_password,password', 'required','message'=>'{attribute}不能为空','on'=>'registe'),
			array('user_login','exist_user_login','on'=>'registe'),
			array('email','exist_email','on'=>'registe'),
			//array('user_phone','user_phone_validate','on'=>'registe'),
			array('password','length','min'=>6,'message'=>'密码不能小于6个字符','on'=>'registe'),
			//array('user_phone','exist_user_phone','on'=>'registe'),
			array('con_password', 'compare', 'compareAttribute'=>'password','message'=>'两次输入的密码不一致','on'=>'registe'),
			array('agreement', 'compare', 'compareValue'=>'1','message'=>'未同意易途会员协议','on'=>'registe'),
			
			array('user_login,email', 'required','message'=>'{attribute}不能为空','on'=>'AdminRegiste'),
			array('user_login','exist_user_login','on'=>'AdminRegiste'),
			array('email','exist_email','on'=>'AdminRegiste'),
			//array('user_phone','user_phone_validate','on'=>'AdminRegiste'),
			//array('user_phone','exist_user_phone','on'=>'AdminRegiste'),
			
			array('user_login,password','required','message'=>'{attribute}不能为空','on'=>'login'),
			array('verification_code','required','message'=>'验证码不能为空','on'=>'login'),
			array('rememberme', 'boolean','on'=>'login'),
			// password needs to be authenticated
			array('password', 'authenticate','on'=>'login'),
			array('user_login,password','required','message'=>'{attribute}不能为空','on'=>'HomeLogin'),
			array('password','home_authenticate','on'=>'HomeLogin'),
			
      //array('user_phone','required','message'=>'手机号码不能为空','on'=>'phone'),
      //array('user_phone','user_phone_validate','on'=>'phone'),
      //array('user_phone','validate_user_phone','on'=>'phone'),

      
      array('email','required','message'=>'邮件不能为空','on'=>'forgotpassword'),
      array('user_login','required','message'=>'用户名或邮件为空','on'=>'AdminLogin'),
      array('password','required','message'=>'密码不能为空','on'=>'AdminLogin'),
      array('password','admin_authenticate','on'=>'AdminLogin'),
      array('verification_code','required','message'=>'验证码不能为空','on'=>'AdminLogin'),
      array('rememberme', 'boolean','on'=>'AdminLogin'),
      array('email', 'required','message'=>'{attribute}不能为空','on'=>'EditEmail'),
      array('email','exist_email','on'=>'EditEmail'),
      
      //array('user_phone,user_phone_verification','required','message'=>'{attribute}不能为空','on'=>'EditPhone'),
      //array('user_phone','user_phone_validate','on'=>'EditPhone'),
      //array('user_phone','exist_user_phone','on'=>'EditPhone'),
      
     // array('user_telephone','user_telephone_validate','on'=>'EditIn'),
      //array('user_zip','is_user_zip','on'=>'EditIn'), 
      //array('user_phone','user_phone_validate','on'=>'EditIn'),
      array('con_password,password,user_password','required','message'=>'{attribute}不能为空','on'=>'ChangePassword'),
      array('con_password', 'compare', 'compareAttribute'=>'password','message'=>'两次输入的密码不一致','on'=>'ChangePassword'),
      array('password','length','min'=>6,'message'=>'密码不能小于6个字符','on'=>'ChangePassword'),
      array('user_login,email','required','message'=>'{attribute}不能为空','on'=>'OrderRegister'),
      array('email','exist_email','on'=>'OrderRegister'),
      array('user_login','exist_user_login_order','on'=>'OrderRegister'),
      //array('user_phone','user_phone_validate','on'=>'OrderRegister'),
      //array('user_phone','exist_user_phone','on'=>'OrderRegister'),
      
      
      
			array('user_sex, user_active, status,email_validate', 'numerical', 'integerOnly'=>true),
			array('user_login,user_phone,real_name,nice_name,user_birthday,user_telephone', 'length', 'max'=>30),
			array('login_ip,registe_ip','length','max'=>20),
			array('email', 'length', 'max'=>80),
			array('password', 'length', 'max'=>40),
			array('salt', 'length', 'max'=>10),
			array('user_address,head_img,real_password', 'length', 'max'=>100),
			array('user_zip', 'length', 'max'=>10),
			array('permissions','length','max'=>200),
			array('credit','safe'),
			array('login_time, create_time,coupon,level,permissions_type', 'length', 'max'=>11),
			array('agreement_free','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('agreement_free,id, user_login, email, password, salt, user_phone, real_name, user_sex, user_address, user_zip, user_active, login_ip, login_time, status, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'TraveHistory' => array(self::HAS_MANY, 'TraveHistory', 'create_id'),
			'answer_count' => array(self::STAT,'Answer', 'user_id'),
			'question_count' => array(self::STAT, 'Question', 'user_id'),
			'order_count' => array(self::STAT, 'Traveorder', 'create_id'),
			'completed_order_count' => array(self::STAT, 'Traveorder', 'create_id', 'condition'=>'(order_status=6 OR order_status=7)'),
		);
	}
	
	/**
	 * 用户最近的浏览历史记录
	 * @param int $limit
	 */
	public function get_recently_history($limit=5)
	{
		if (!$this->IsNewRecord)
			return TraveHistory::model()->recently($limit)->with('Trave')->findAll('t.create_id=:create_id' ,array(':create_id'=>$this->id));
		else 
			return array();
	}
	
	/**
	 * 用户最近的订单记录
	 * @param int $limit
	 */
	public function get_recently_order($limit=5)
	{
		if (!$this->IsNewRecord)
			return Traveorder::model()->recently($limit)->findAll('create_id=:create_id' ,array(':create_id'=>$this->id));
		else 
			return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '用户ID',
			'user_login' => '登录账号',
			'head_img'=>'用户的头像',
			'email' => '电子邮件',
			'password' => '密码',
			'real_password'=>'真正密码',
			'con_password'=>'确认密码',
			'salt' => '安全码',
			'user_phone' => '手机号码',
			'user_phone_verification'=>'手机验证码',
			'user_telephone'=>'座机',
			'real_name' => '真实姓名',
			'nice_name'=>'昵称',
			'user_sex' => '性别',
			'user_birthday'=>'用户生日',
			'user_address' => '联系地址',
			'user_zip' => '邮编',
			'user_active' => '用户激活',
			'email_validate'=>'邮箱验证',
			'agreement_free'=>'旅游资讯信息',
			'coupon'=>'优惠劵',
			'credit'=>'积分',
			'level'=>'用户等级',
			'login_ip' => '登录IP',
			'registe_ip'=>'注册IP',
			'login_time' => '登录时间',
			'status' => '用户状态',
			'permissions' => '用户权限值',
			'permissions_type' => '分站ID',
			'create_time' => '注册时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_login',$this->user_login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('real_name',$this->real_name,true);
		$criteria->compare('user_sex',$this->user_sex);
		$criteria->compare('user_address',$this->user_address,true);
		$criteria->compare('user_zip',$this->user_zip,true);
		$criteria->compare('user_active',$this->user_active,true);
		$creteria->compare('agreement_free',$this->agreement_free,true);
		$criteria->compare('login_ip',$this->login_ip,true);
		$criteria->compare('registe_ip',$this->registe_ip,true);
		$criteria->compare('login_time',$this->login_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

		/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	 //搜索数据
	public function searchdatas(){

	  $user_login=$_REQUEST['user_login'];
	  $level=$_REQUEST['level'];
	  $user_active=$_REQUEST['user_active'];
	  $status=$_REQUEST['status'];
	  $create_time=$_REQUEST['create_time'];
	  $user_phone=$_REQUEST['user_phone'];
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$conditions=array();
		$params=array();
		$page_params=array();
		if(!empty($user_login)){
			 array_push($conditions,"user_login LIKE :user_login");
			 $params[':user_login']="%$user_login%";
			 $page_params['user_login']=$user_login;
		}
		if(!empty($level)){
			array_push($conditions,"level =:level");
			 $params[':level']=$level;
			 $page_params['level']=$level; 
		}
		if(!empty($user_active)){
			 array_push($conditions,"user_active =:user_active");
			 $params[':user_active']=$user_active;
			 $page_params['user_active']=$user_active;
		}
		if(!empty($status)){
			 array_push($conditions,"status =:status");
			 $params[':status']=$status;
			 $page_params['status']=$status;
		}
		if(!empty($create_time)){
			array_push($conditions,"FROM_UNIXTIME(create_time,'%Y-%m-%d')=:create_time");
			$params[':create_time']=$create_time;
			$page_params['create_time']=$create_time;
		}
		if(!empty($user_phone)){
			 array_push($conditions,"user_phone LIKE :user_phone");
			 $params[':user_phone']="%$user_phone%";
			 $page_params['user_phone']=$user_phone;
		}
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(" AND ", $conditions),
			    'params'=>$params,
			    'with'=>array(),
			),
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
		
		


	}
	
	public function permissions_searchdatas(){
		$user_login=$_REQUEST['user_login'];
	  $user_active=$_REQUEST['user_active'];
	  $status=$_REQUEST['status'];
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$conditions=array();
		$params=array();
		$page_params=array();
		if(!empty($user_login)){
			 array_push($conditions,"user_login LIKE :user_login");
			 $params[':user_login']="%$user_login%";
			 $page_params['user_login']=$user_login;
		}
		
		if(!empty($user_active)){
			 array_push($conditions,"user_active =:user_active");
			 $params[':user_active']=$user_active;
			 $page_params['user_active']=$user_active;
		}
		if(!empty($status)){
			 array_push($conditions,"status =:status");
			 $params[':status']=$status;
			 $page_params['status']=$status;
		}

		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(" AND ", $conditions),
			    'params'=>$params,
			    'with'=>array(),
			    'order'=>'t.id DESC',
			),
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=>$page_params,
      ),
		));
	}
	public function primaryKey()
{
    return 'id';
    // 对于复合主键，要返回一个类似如下的数组
    // return array('pk1', 'pk2');
}
		//插入一笔旅游的数据
	public function insert_user(){
		if(!$this->hasErrors()){
			 
				$datas=$this->save();
				
			  return $datas;
		}
	}
	

	
	
	//用户注册
	public function registe(){
		
		$this->insert_user();
		
	}
	
	
	//检测用户名
	function exist_user_login(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->user_login!=$this->user_login){
			 	 $find_datas=$this->find(array(
          'select'=>'user_login',
          'condition'=>'user_login=:user_login',
          'params'=>array(':user_login' => $this->user_login),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'user_login',
         'condition'=>'user_login=:user_login',
         'params'=>array(':user_login' => $this->user_login),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("user_login","用户名已存在");
     	 return false;
     }else{
     	  $str_len=Util::strLength($this->user_login);
     	  if($str_len<2){
     	  	   $this->addError("user_login","用户名小于2个字符");
     	  	   return false;
     	  }
     	  if($str_len > 16){
     	  	 $this->addError("user_login","用户名大于16个字符");
     	  	 return false;
     	  }
     }
     return true;
    
	}
	//检测后台增加订单后的会员
	function exist_user_login_order(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->user_login!=$this->user_login){
			 	 $find_datas=$this->find(array(
          'select'=>'user_login',
          'condition'=>'user_login=:user_login',
          'params'=>array(':user_login' => $this->user_login),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'user_login',
         'condition'=>'user_login=:user_login',
         'params'=>array(':user_login' => $this->user_login),
       ));
		}
     if(!empty($find_datas)){
     	 $this->user_login=Util::randStr(10);
     	 exist_user_login_order();
     }else{
       return true;	
     }
	}
	

	//检测用户邮箱
	function exist_email(){
		
		$id=$this->id;
		
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->email!=$this->email){
			 	 $find_datas=$this->find(array(
          'select'=>'email',
          'condition'=>'email=:email',
          'params'=>array(':email' => $this->email),
         ));
			 }
		}else{
		
			$find_datas=$this->find(array(
         'select'=>'email',
         'condition'=>'email=:email',
         'params'=>array(':email' => $this->email),
       ));
		}
	
     if(!empty($find_datas)){
       
     	 $this->addError("email","邮箱已存在");
     	 return false;
     }else{
     
     	 if(!Util::ie($this->email)){
     	 	  $this->addError("email","邮箱格式不正确");
     	 	  return false;
     	 }else{
     	 	return true;
     	}
    }
    
	}
	
	function exist_user_phone(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->user_phone!=$this->user_phone){
			 	 $find_datas=$this->find(array(
          'select'=>'user_phone',
          'condition'=>'user_phone=:user_phone',
          'params'=>array(':user_phone' => $this->user_phone),
         ));
			 }
		}else{
		
			$find_datas=$this->find(array(
         'select'=>'user_phone',
         'condition'=>'user_phone=:user_phone',
         'params'=>array(':user_phone' => $this->user_phone),
       ));
		}
		
     if(!empty($find_datas)){
     	 $this->addError("user_phone","手机号码已存在");
     	 return false;
     }else{
     	 	return true;
     }

	}
	
	
	function validate_user_phone(){
		 $find_datas=$this->find(array(
         'select'=>'user_phone',
         'condition'=>'user_phone=:user_phone',
         'params'=>array(':user_phone' => $this->user_phone),
     ));
     if(empty($find_datas)){
      	$this->addError("user_phone","手机号码不存在");
      	return false;
     }else{
    	 return true;
     }
	}
	
	
	function user_phone_validate(){
		
		if(!Util::is_phone($this->user_phone,"cell")){
			$this->addError("user_phone","手机号码格式不正确");
			return false;
		}else{
			return true;
		}
	}

	function user_telephone_validate(){
		if(!empty($this->user_telephone)){
			if(!Util::is_phone($this->user_telephone,"tele")){
			 $this->addError("user_telephone","座机号码格式不正确");
			 return false;
		 }else{
			return true;
		 }
			
		}
	}
	
	function user_password_validate($user_id){
		
		if(empty($this->user_password)){
			$this->addError("user_password","当前密码不能为空");
			return false;
		}else{
			$user_datas=$this->get_table_datas($user_id);
			$hc_password=Util::hc($this->user_password,$user_datas->salt);
			if($hc_password!=$user_datas->password){
				$this->addError("user_password","当前密码错误");
			  return false;
			}else{
				return $user_datas;
			}
			
		}
		
	}
	
		//邮编验证
	function is_user_zip(){
		if(Util::validate_zip($this->user_zip)){
			return true;
		}else{
			$this->addError('user_zip','邮编格式不正确');
			return false;
		}
	}
	
	
	function beforeSave(){
	 if(parent::beforeSave()){
			if($this->isNewRecord){
				  $serial=new Serial;
				  $search_serial_datas['serial_name']='User Serial';
				  $serial_datas=$serial->get_table_datas("",$search_serial_datas);
				  $this->id=$serial_datas[0]->serial_value;
				  $salt=Util::randStr(6);
				  $this->salt=$salt;
				  if(empty($this->password)){
				  	$this->password=Util::randStr(6);
				  	//保存未修改的password用户发邮件
				    $this->con_password=$this->password;
				    
				  }
				  $this->real_password=$this->password;
				  $this->password=Util::hc($this->password,$salt);
				  
				  $this->registe_ip=Util::getip();
		      $this->create_time=Util::current_time('timestamp');
			}else{
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	function afterSave(){
					$serial=new Serial;
				  $search_serial_datas['serial_name']='User Serial';
				  $serial_datas=$serial->get_table_datas("",$search_serial_datas);
				  $attributes['serial_value']=$serial_datas[0]->serial_value+1;
				  $serial->update_table_datas($serial_datas[0]->id,$attributes);
		      return true;
	}
 public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$img_code=Yii::app()->session->get("__img_code__");
			if(md5(strtoupper($this->verification_code))!==$img_code){
				 $this->addError('verification_code','验证码不正确');
				 return false;
		  }else{
				 $this->_identity=new UserIdentity($this->user_login,$this->password);
				  if(!$this->_identity->authenticate()){
				  	 if($this->_identity->errorCode===UserIdentity::ERROR_ACTIVE){
      	      $this->addError('user_login',"账号未激活,请激活你的账号");
             }else{
             	 $this->addError('password','用户名或密码不正确');
             }
					}
		}
	}
}

public function home_authenticate($attribute,$params){
	 
		if(!$this->hasErrors())
		{
				 $this->_identity=new UserIdentity($this->user_login,$this->password);
				  if(!$this->_identity->authenticate()){
				  	
				  	if($this->_identity->errorCode===UserIdentity::ERROR_ACTIVE){
      	      $this->addError('user_login',"账号未激活,请激活你的账号");
             }else{
             	 $this->addError('password','用户名或密码不正确');
             }
					}
	 }
}

public function admin_authenticate($attribute,$params){
		if(!$this->hasErrors()){
			$img_code=Yii::app()->session->get("__img_code__");
			if(md5(strtoupper($this->verification_code))!==$img_code){
				 $this->addError('verification_code','验证码不正确');
				 return false;
		  }else{
		  	
				 $this->_identity=new UserIdentity($this->user_login,$this->password);
				 $this->_identity->permissions_type=$this->permissions_type;
				 
				  if(!$this->_identity->authenticate()){
						  	
				  	if($this->_identity->errorCode===UserIdentity::ERROR_ADMIN){
      	      $this->addError('user_login',"该账号不是管理员");
             }else if($this->_identity->errorCode===UserIdentity::ERROR_PERMISSIONS){
             	$this->addError('user_login',"该帐号不是该分站管理员");
             }else{
             	 $this->addError('password','用户名或密码不正确');
             }             
					}
			 }
		}
}
	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	//登录
	public function login()
	{

		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->user_login,$this->password);
			$this->_identity->authenticate();
		}
		
		if($this->_identity->errorCode===UserIdentity::ERROR_ACTIVE){
      	$this->addError('user_login',"账号未激活,请激活你的账号");
      	return false;
      	        
    }
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
				$duration=$this->rememberme ? (3600*24*14) : (3600*1); // 30 days
				Yii::app()->user->allowAutoLogin=true;
				Yii::app()->user->login($this->_identity,$duration);
				$this->change_user_login_state();
				return true;
		}else
			return false;
	}
	
	
	
	public function admin_login(){

		 if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->user_login,$this->password);
			$this->_identity->permissions_type=$this->permissions_type;
			$this->_identity->authenticate();
		}
		
		if($this->_identity->errorCode===UserIdentity::ERROR_ADMIN){
      	$this->addError('user_login',"该账号不是管理员");
      	return false;
      	        
    }
    if($this->_identity->errorCode===UserIdentity::ERROR_PERMISSIONS){
    	$this->addError('user_login',"该帐号不是该分站管理员");
      return false;
    }
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			  if($this->rememberme){
			  	$duration=(3600*24*14);
			  	Yii::app()->session->timeout=(3600*24*14);
			  }else{
			  	$duration=(3600*1);
			  	Yii::app()->session->timeout=(3600*1);
			  }
				Yii::app()->user->allowAutoLogin=true;
				Yii::app()->user->login($this->_identity,$duration);
				Yii::app()->session->add('permissions_type',$this->permissions_type);
				$this->change_user_login_state();
				return true;
		}else
			return false;
	}
	
	//修改用户的登录状态
	public function change_user_login_state(){
		$user_id=Yii::app()->user->id;
		$user_datas=$this->find(array('select'=>'id,login_time','condition'=>'id=:id','params'=>array(':id'=>$user_id)));
		$this->old_login_time=$user_datas->login_time;
		$update_array=array();
		$update_array['login_ip']=Util::getip();
		$update_array['login_time']=Util::current_time('timestamp');
		
	
		$this->update_table_datas($user_id,$update_array);
	}
	//发送忘记密码邮件
	public function send_forgot_password(){
		 require_once('config.inc.php');
     require_once('uc_client/client.php');
		 $condition['email']=$this->email;
		 $user_datas=$this->get_table_datas("",$condition);
		 $user_data=$user_datas[0];
		 if(empty($user_datas)){
		 	  $this->addError('email','邮件不存在,请重新输入');
		 	  return false;
		 }
		 $send_mail=new SendMail("Forgot Email");

		 $validate_flag=$user_data->validate_user_email();

		 if(!$validate_flag){
		   Yii::app()->getController()->redirect(Yii::app()->getController()->createUrl('error/erroremail',array()));	
		 }
		 $login_active=Yii::app()->getController()->createAbsoluteUrl("site/login",array());
		 $login_active=CHtml::link($login_active,$login_active);
		 $reset_password=Util::randStr(6);
		 $mail_result=$send_mail->send_forgot_password_mail("",$user_data->email,$user_data->user_login,$reset_password,$login_active);
		 if($mail_result){
				$update_password=Util::hc($reset_password,$user_data->salt);
				$update_condition['password']=$update_password;
				$update_condition['real_password']=$reset_password;
		 	  $result=$this->update_table_datas($user_data->id,$update_condition);
		 	  if($result){
					   $ucresult = uc_user_edit($user_data->user_login,'', $reset_password, "",'1');
		 	  }
		 	  
		 	  return true;
		 }
	}
	//短信重设密码
	public function send_forgot_phone(){ 
		 $http_session=new CHttpSession();
		 $phone_verification=Yii::app ()->session['phone_verification'];
		 if($phone_verification!=Util::hc($this->user_phone_verification,"")){
		 	   $this->addError('user_phone_verification','验证码不正确');
		 	   return false;
		 }   
		 $user_datas=$this->findAll("(user_phone=:user_phone)",array(':user_phone'=>$this->user_phone));
		 $user_data=$user_datas[0];
		 $reset_password=Util::randStr(6);
		 $send_mail=new SendMail("Correct Phone");
		 $phone_result=$send_mail->send_reset_phone("",$this->user_phone,$reset_password);
		 if($phone_result){
		 	$update_password=Util::hc($reset_password,$user_data->salt);
		 	$update_condition['password']=$update_password;
		 	$this->update_table_datas($user_data->id,$update_condition);
		 	 return true;
		 }
	}
	
	//会员注册验证手机号码
	public function send_registe_phone(){

		 $http_session=new CHttpSession();
		 $phone_verification=Yii::app ()->session['phone_verification'];
		 if($phone_verification!=Util::hc($this->user_phone_verification,"")){
		 	   $this->addError('user_phone_verification','验证码不正确');
		 	   return false;
		 } else{
		 	   
		     return true;	
		}
	}


	//重命名文件名
	function rename_file($file_name,$user_id=""){
		$user_id=empty($user_id)?(Yii::app()->getController()->user->id):$user_id;
		if(empty($file_name))
		   return;
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		array_push($implode_array,time());
		array_push($implode_array,end($explode_array));
	  return implode('.',$implode_array);
	}
	
	
		//获得图片保存的路径
	function get_image_path($user_id=""){
		$user_id=empty($user_id)?(Yii::app()->getController()->user->id):$user_id;
		  $trave_image_path="upload/head/".$user_id."/";
		  if(!is_dir($trave_image_path)){
			 Util::makeDirectory($trave_image_path);
		 }
		 return $trave_image_path;

	}
	
	//获取用户头像
	public function get_user_head($width,$height,$user_id=""){
		if(empty($user_id)){
			$user_id=$this->id;
			$user_head=$this->head_img;
			$user_sex=$this->user_sex;
		}else{
		  $user_datas=$this->get_table_datas($user_id);
	    $user_head=$user_datas->head_img;
	    $user_sex=$user_datas->user_sex;
		}
		
	  if(empty($user_id)){
	     return Util::rename_thumb_file($width,$height,'/upload/head/','none.gif');
	  }else{
	  	
	  	if($user_sex=='1'){
	  		 if(!empty($user_head)){
	  		 	 return Util::rename_thumb_file($width,$height,"/".$this->get_image_path($user_id),$user_head);
	  		 }else{
	  		 	 return Util::rename_thumb_file($width,$height,'/upload/head/','none.gif');
	  		}
	  	}else if($user_sex=='2'){
	  		if(!empty($user_head)){
	  			 return Util::rename_thumb_file($width,$height,"/".$this->get_image_path($user_id),$user_head);
	  		 }else{
	  		 	return Util::rename_thumb_file($width,$height,'/upload/head/','none.gif');
	  		 }
	  	}else{
	  		 if(!empty($user_head)){
	  		 	 return Util::rename_thumb_file($width,$height,"/".$this->get_image_path($user_id),$user_head);
	  		 }else{
	  		 	 return Util::rename_thumb_file($width,$height,'/upload/head/','none.gif');
	  		}
	  		
	  	}
	  }
	}
	
	//获得管理用户的选择项
	public function get_select_admin(){
	 $user_datas=$this->findAll("status=:status",array(':status'=>'2'));
   $select=array();
   $select['']='关联用户';
   foreach($user_datas as $key => $value){
   	$select[$value->id]=$value->user_login;
   }
   return $select;
 }
 //获得用户操作
 function get_user_operate(){
 		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改信息',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 
		 $return_str.=CHtml::link('修改积分',array("$controller_id/editcredit","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link('修改抵用劵',array("$controller_id/editcoupon","id"=>$this->id),array('class'=>'operate_button'));
		 
		 //$return_str.=CHtml::link('修改密码',array("$controller_id/password","id"=>$this->id),array('class'=>'operate_button'));

		 
		 return $return_str;
 }
 
 //获得权限用户的操作
 function get_permissions_user_operate(){
 	   $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $user_id=Yii::app()->user->id;
		 $user_datas=$this->get_table_datas($user_id);
		 $permissions_type=$user_datas->permissions_type;
		 if($this->status=='2'&&((!$permissions_type)||($permissions_type==$this->permissions_type))){
		 	 $return_str.=CHtml::link('取消管理员',array("$controller_id/setadmin","id"=>$this->id,'status'=>'1'),array('class'=>'operate_button'));
		 	 $return_str.=CHtml::link('分配权限',array("$controller_id/setpermissions","id"=>$this->id),array('class'=>'operate_button'));
		 }else{
		 	if($this->status!='2'){
		 		if(!$permissions_type&&$user_id=='1'){
			    $return_str.=CHtml::link('设为管理员',array("$controller_id/setfp","id"=>$this->id),array('class'=>'operate_button'));
			  }else{
			  	$return_str.=CHtml::link('设为管理员',array("$controller_id/setadmin","id"=>$this->id,'status'=>'2'),array('class'=>'operate_button'));
			  }
			}
		 }
		 
		 return $return_str;
}
 
 //获得用户的性别
 function get_user_sex(){
 	$user_sex_datas=array("1"=>"男","2"=>"女");
 	return $user_sex_datas[$this->user_sex];
 	
 }
 
 //获取用户的激活状态
 function get_user_active(){
 	$user_active_datas=array(""=>"是否激活","1"=>"未激活","2"=>"已激活");
 	$return_str=$user_active_datas[$this->user_active];
 	if($this->user_active!='2'){
 		$return_str.="(".CHtml::link("激活",Yii::app()->getController()->createUrl("user/active",array('id'=>$this->id)),array('class'=>'operate_button')).")";
 	}
 	return $return_str;
}

//获得权限的激活状态
 function get_permissions_user_active(){
 	$user_active_datas=array(""=>"是否激活","1"=>"未激活","2"=>"已激活");
 	$return_str=$user_active_datas[$this->user_active];
 	return $return_str;
 	
}

//获取用户等级
function get_user_level(){
	$level_datas=CV::$USER_LEVEL; 
	return $level_datas[$this->level];
}
//获得用户用户类型
function get_user_status(){
	$status_datas=array("1"=>"普通用户","2"=>"管理员");
	$extern_str="";
	if($this->status=='2'){
		if($this->permissions_type){
			$district_datas=District::model()->get_table_datas($this->permissions_type);
			$extern_str.="(".$district_datas->district_name.")";
		}else{
			$extern_str.="(主站)";
		}
	}
	return $status_datas[$this->status].$extern_str;
}


 public function validate_user_email($validate_email=""){
 	
 	$validate_email=empty($validate_email)?$this->email_validate:$validate_email;
 	
 	if($validate_email!='2'){
 		return false;
 	}else{
 		return true;
 	}
 }
 //获得用户的权限值
 public function get_user_permissions($user_id=""){
 	  $user_id=empty($user_id)?$this->id:$user_id;
 	  $user_datas=$this->get_table_datas($user_id);
 	  return $user_datas->permissions;
 }
 //获取用户的分站的id
 public function get_permissions_type($user_id=""){
 	  $user_id=empty($user_id)?$this->id:$user_id;
 	  $user_datas=$this->get_table_datas($user_id);
 	  return $user_datas->permissions_type;
 }
}
?>
