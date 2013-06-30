<?php

/**
 * This is the model class for table "{{ordercontact}}".
 *
 * The followings are the available columns in table '{{ordercontact}}':
 * @property string $id
 * @property string $trave_order_id
 * @property string $trave_id
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $contact_telephone
 * @property string $contact_address
 * @property integer $contact_code_type
 * @property string $contact_code
 * @property integer $contact_sex
 * @property integer $main_contact
 * @property string $create_id
 * @property string $create_time
 */
class Ordercontact extends BaseActive
{
	
	public $area_code="";
	public $user_telephone="";
	public $order_agree="";
	public $error_user_code="";
	public $year="";
	public $month="";
	public $day="";
	public $valid_year="";
	public $valid_month="";
	public $valid_day="";

  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ordercontact}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('contact_name,contact_phone,contact_email,contact_address','required','message'=>'{attribute}不能为空','on'=>"OrderContact"),
		  array('contact_email',"is_email",'on'=>"OrderContact"),
		  array('contact_phone',"is_phone",'on'=>"OrderContact"),
		  array('user_telephone',"is_telephone",'on'=>"OrderContact"),
		  array('contact_birthday','length','max'=>'20'),
		  array('order_agree','compare','compareValue'=>'1','message'=>'未同意易途旅游协议','on'=>"OrderContact"),
			array('contact_code_type, contact_sex, main_contact', 'safe'),
			array('contact_code_type, contact_sex, main_contact', 'numerical', 'integerOnly'=>true),
			array('trave_order_id, trave_id, create_id, create_time', 'length', 'max'=>11),
			array('contact_name, contact_phone, valid_date,nation,contact_telephone, contact_code', 'length', 'max'=>30),
			array('contact_email, contact_address', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_order_id, trave_id, contact_name, contact_phone, contact_email, contact_telephone, contact_address, contact_code_type, contact_code, contact_sex, main_contact, create_id, create_time', 'safe', 'on'=>'search'),
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
			'trave' => array(self::BELONGS_TO, 'Trave', 'trave_id'),
			'user' => array(self::BELONGS_TO,'User','create_id'),
			'relation'=>array(self::BELONGS_TO,'User','relation_id'),
			'traveorder'=>array(self::BELONGS_TO,'Traveorder','trave_order_id'),
	//		'relation'=>array(self::BELONGS_TO,'traveorder','insurance_ids'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '联系人ID',
			'trave_order_id' => '订单ID',
			'trave_id' => '线路ID',
			'contact_name' => '联系人名字',
			'contact_phone' => '手机号码',
			'contact_email' => '邮件',
			'contact_telephone' => '座机号码',
			'contact_address' => '地址',
			'contact_code_type' => '证件类型',
			'contact_code' => '证件号码',
			'valid_date'=>'有效期',
			'nation'=>'国籍',
			'contact_sex' => '性别',
			'main_contact' => '主要联系人',
			'create_id' => '创建者ID',
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
		$criteria->compare('trave_order_id',$this->trave_order_id,true);
		$criteria->compare('trave_id',$this->trave_id,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('contact_telephone',$this->contact_telephone,true);
		$criteria->compare('contact_address',$this->contact_address,true);
		$criteria->compare('contact_code_type',$this->contact_code_type);
		$criteria->compare('contact_code',$this->contact_code,true);
		$criteria->compare('contact_sex',$this->contact_sex);
		$criteria->compare('main_contact',$this->main_contact);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function searchdatas()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$conditions=array();
		$params=array();
		$page_params=array();
		$trave_order_id=$_REQUEST['trave_order_id'];
		$trave_name=$_REQUEST['trave_name'];
		$order_user=$_REQUEST['order_user'];
		$contact_name=$_REQUEST['contact_name'];
		$insurance_id=$_REQUEST['insurance_id'];
    	if(!empty($trave_order_id)){
			 array_push($conditions,"trave_order_id = :trave_order_id");
			 $params[':trave_order_id']=$trave_order_id;
			 $page_params['trave_order_id']=$trave_order_id;
		}
		if(!empty($trave_name)){
			

			 array_push($conditions,"trave.trave_name LIKE :trave_name");
			 $params[':trave_name']="%$trave_name%";
			 $page_params['trave_name']=$trave_name;
		}
		if(!empty($order_user)){
			
			array_push($conditions,"user.user_login LIKE :user_login");
			$params[':user_login']="%$order_user%";
			$page_params['order_user']=$order_user;
		}
		if(!empty($contact_name)){
			 array_push($conditions,"contact_name LIKE :contact_name");
			 $params[':contact_name']="%$contact_name%";
			 $page_params['contact_name']=$contact_name;
		}
		
		if(!empty($insurance_id)){
			 array_push($conditions,"FIND_IN_SET(:insurance_id,traveorder.insurance_ids)>0");
			 $params[':insurance_id']=$insurance_id;
			 $page_params['insurance_id']=$insurance_id;
		}
    array_push($conditions,"main_contact<>:main_contact");
		$params[':main_contact']=1;
    array_push($conditions,"traveorder.insurance_ids<>''");
    $validate_sregion=Yii::app()->getController()->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
	  
	  
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$conditions),
			    'params'=>$params,
			    'with'=>array('trave'=>array('select'=>'trave.trave_name,trave.trave_category,trave.trave_sregion,trave.trave_region','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true),'user'=>array('select'=>"user.user_login"),'traveorder'=>array('select'=>"traveorder.insurance_ids,traveorder.id,traveorder.start_date")),
	
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}


	
	
		//插入一笔旅游的数据
	public function insert_ordercontact(){
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
			}
			return true;
		}else{
			return false;
		}
	}
	
	function is_email(){
		  if(!Util::ie($this->contact_email)){
		  	$this->addError("contact_email","邮件格式不正确");
		  	return false;
		  }else{
		  	return true;
		  }
	}
	
	function is_phone(){
		if(!Util::is_phone($this->contact_phone,'cell')){
		  	$this->addError("contact_phone","手机号码格式不正确");
		  	return false;
		  }else{
		  	return true;
		  }
		  
	}
	
	
	function is_telephone(){
		 $user_telephone=(!empty($this->area_code)?($this->area_code."-"):"").$this->user_telephone;
		if(!empty($user_telephone)){
			if(!Util::is_phone($user_telephone,'tele')){
		  	$this->addError("user_telephone","电话格式不正确");
		  	return false;
		  }else{
		  	return true;
		  }
		}
	}
	
	
	function get_insurance_datas($insurance_ids=""){
		 $insurance_ids=empty($insurance_ids)?$this->traveorder->insurance_ids:$insurance_ids;
		 if(!empty($insurance_ids)){
		  $insurance_ids_array=explode(",",$insurance_ids);
		  $insurance=new Insurance();
		  $insurance_names=array();
		  foreach((array)$insurance_ids_array as $key => $value){
		 	  $insurance_datas="";
		 	  $insurance_datas=$insurance->get_table_datas($value);
		 	  array_push($insurance_names,$insurance_datas->insurance_name."(".$insurance_datas->insurance_pice.",".$insurance_datas->insurance_period.")");
		 	
		  }
		 return implode(",",$insurance_names);
	 }else{
	 	 return null;
	 }
	}
	
	
	function get_contact_code_type(){
		$code_type_array=CV::$CODE_TYPE;
		return $code_type_array[$this->contact_code_type];
		
	}
	
}