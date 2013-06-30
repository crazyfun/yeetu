<?php

/**
 * This is the model class for table "{{credit}}".
 *
 * The followings are the available columns in table '{{credit}}':
 * @property string $id
 * @property string $user_id
 * @property integer $credit_type
 * @property string $credit_value
 * @property string $credit_desc
 * @property string $create_id
 * @property string $create_time
 */
class Credit extends BaseActive
{
  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{credit}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('user_id,credit_type,credit_value,credit_desc','required','message'=>'{attribute}不能为空'),
			array('credit_type,credit_value', 'numerical', 'integerOnly'=>true),
			array('user_id, credit_value, create_id, create_time', 'length', 'max'=>11),
			array('credit_before,credit_after,credit_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, credit_type, credit_value, credit_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
		 'User'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '积分ID',
			'user_id' => '会员名称',
			'credit_type' => '操作动作',
			'credit_before' =>'操作前积分',
			'credit_value' => '积分',
			'credit_after'=>'操作后积分',
			'credit_desc' => '操作描述',
			'create_id' => '创建人',
			'create_time' => '创建时间',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('credit_type',$this->credit_type);
		$criteria->compare('credit_value',$this->credit_value,true);
		$criteria->compare('credit_desc',$this->credit_desc,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
	
		/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchdatas()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$user_login=$_REQUEST['user_login'];
		$credit_type=$_REQUEST['credit_type'];
		$credit_desc=$_REQUEST['credit_desc'];
		$create_time=$_REQUEST['create_time'];
		$conditions=array();
		$params=array();
		$page_params=array();
    if(!empty($user_login)){
			 array_push($conditions,"User.user_login LIKE :user_login OR User.id LIKE :user_login");
			 $params[':user_login']="%$user_login%";
			 $page_params['user_login']=$user_login;
		}
		if(!empty($credit_type)){
			array_push($conditions,"t.credit_type=:credit_type");
			$params[':credit_type']=$credit_type;
			$page_params['credit_type']=$credit_type;
		}
		
		if(!empty($credit_desc)){
			 array_push($conditions,"t.credit_desc LIKE :credit_desc");
			 $params[':credit_desc']="%$credit_desc%";
			 $page_params['credit_desc']=$credit_desc;
		}
		if(!empty($create_time)){
			 array_push($conditions,"FROM_UNIXTIME(t.create_time,'%Y-%m-%d')=:create_time");
			 $params[':create_time']=$create_time;
			 $page_params['create_time']=$create_time;
		}
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(" AND ",$conditions),
			    'params'=>$params,
			    'with'=>array("User"),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}
	

	

		//插入一笔旅游的数据
	public function insert_credit(){
		if(!$this->hasErrors()){
				$datas=$this->save();
				return $datas;
		}
	}
	

	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}else{
				//$this->create_id=Yii::app()->user->id;
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
		//插入一笔积分消费数据
	function insert_credit_consume_datas($user_id,$credit_type,$credit_value,$credit_desc){
		if(empty($user_id)){
			return;
		}
	 //$t = Yii::app()->db->beginTransaction();
	 //try{
		$user=new User();
		$user_datas=$user->get_table_datas($user_id);
		$user_credit=$user_datas->credit;
		$user_login=$user_datas->user_login;
		if($credit_type=='1'){
			$result_credit=intval($user_credit)+intval($credit_value);
		}else{
			$result_credit=intval($user_credit)-intval($credit_value);
		}
		$this->user_id=$user_id;
		$this->credit_before=$user_credit;
		$this->credit_value=$credit_value;
		$this->credit_after=$result_credit;
		$this->credit_type=$credit_type;
		$this->credit_desc=$credit_desc;
		if($this->save()){
			$attributes_datas['credit']=$result_credit;
			$result=$user->update_table_datas($user_id,$attributes_datas,array());
			if($result){
				$this->set_user_level($user_id,$result_credit);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		//$t->commit();	
		
	  //}catch(Exception $e){
				//$t->rollback();
	  //}
	}
	
	
	//设置消费积分的的系统变量
	function set_credit_vars($user_id,$system_name,$credit_type,$credit_desc){
			  $system=new System();
			  $credit_value=$system->get_system_value($system_name);
			  $this->insert_credit_consume_datas($user_id,$credit_type,$credit_value,$credit_desc);
	}

	//设置根据积分的规则设置用户的等级
	function set_user_level($user_id,$user_credits){
		$system=new System();
		$vip_user=$system->get_system_value("vip_user");
		$golden_user=$system->get_system_value("golden_user");
		$diamond_user=$system->get_system_value("diamond_user");
    if(0<=$user_credits&&$user_credits<intval($vip_user)){
    	$level='1';
    }else if(intval($vip_user) <= $user_credits&&$user_credits < intval($golden_user)){
    	$level='2';
    }else if(intval($golden_user) <= $user_credits&&$user_credit < intval($diamond_user)){
    	$level='3';
    }else if($user_credits >= intval($diamond_user)){
    	$level='4';
    }else{
    	return;
    }
    $user=new User();
    $user_datas=$user->get_table_datas($user_id);
    $old_user_level=$user_datas->level;
    $user_login=$user_datas->user_login;
    $attributes_datas['level']=$level;
		$user->update_table_datas($user_id,$attributes_datas,array());
		if($old_user_level!=$level){
			 $service_link = Yii::app()->homeUrl.'/help/index/cid/2.html#q4';
			 $user_level_array=CV::$USER_LEVEL;
			 $account_level=$user_level_array[$level];
			 $send_mail=new SendMail("Account Upgrade");
			 $validate_flag=$user_datas->validate_user_email();
		   if($validate_flag){
			    $send_mail->send_account_upgrade_mail("",$user_datas->email,$user_datas->user_login,$account_level,$service_link);
			  }
		}
		
		
	}
	
	//获得积分类型
	function get_credit_type(){
		$credit_type=CV::$CREDIT_TYPE;
		return $credit_type[$this->credit_type];
	}
	
	//获得用户名称
	function get_user_login($user_id){
		$user=new User();
		$user_datas=$user->get_table_datas($user_id);
		return $user_datas['user_login'];
	}
	
	

}