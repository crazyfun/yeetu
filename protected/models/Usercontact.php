<?php

/**
 * This is the model class for table "{{usercontact}}".
 *
 * The followings are the available columns in table '{{usercontact}}':
 * @property string $id
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $contact_telephone
 * @property string $contact_address
 * @property integer $contact_type
 * @property string $create_id
 * @property string $create_time
 */
class Usercontact extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Usercontact the static model class
	 */
	 public $area_code="";

  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{usercontact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_type,contact_name,contact_address,contact_email','required','message'=>'{attribute}不能为空'),
			array('contact_phone','is_phone'),
			array('contact_type', 'numerical', 'integerOnly'=>true),
			array('contact_zip','is_contact_zip'),
			array('contact_email','is_email'),
			array('contact_name, contact_phone,contact_telephone,contact_zip', 'length', 'max'=>30),
			array('contact_email, contact_address', 'length', 'max'=>100),
			array('create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contact_name, contact_phone, contact_email, contact_telephone, contact_address, contact_type, create_id, create_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contact_name' => '收件人',
			'contact_phone' => '手机',
			'contact_email' => '邮件',
			'contact_telephone' => '固定电话',
			'contact_address' => '地址',
			'contact_zip'=>'邮编',
			'contact_type' => '类型',
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
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('contact_telephone',$this->contact_telephone,true);
		$criteria->compare('contact_address',$this->contact_address,true);
		$criteria->compare('contact_type',$this->contact_type);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
	
			//插入一笔配送人的数据
	public function insert_usercontact(){
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
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
	function afterSave(){
		  return true;
	}
	
	
	
	//手机验证
	function is_phone(){
		
		if(!empty($this->contact_phone)){
			if(!Util::is_phone($this->contact_phone,'cell')){
		  	$this->addError("contact_phone","手机号码格式不正确");
		  	return false;
		  }else{
		  	return $this->is_telephone();
		  } 
		}else{
			  $contact_telephone=(!empty($this->area_code)?($this->area_code."-"):"").$this->contact_telephone;
			  if(!empty($contact_telephone)){
			  	return $this->is_telephone();
			  }else{
			  	$this->addError("contact_phone","手机和固定电话至少填一项");
			  	return false;
			  }
		}
		return true;
	}
//座机验证
	function is_telephone(){
		$contact_telephone=(!empty($this->area_code)?($this->area_code."-"):"").$this->contact_telephone;
		if(!empty($contact_telephone)){
			if(!Util::is_phone($contact_telephone,'tele')){
		  	$this->addError("contact_telephone","电话格式不正确");
		  	return false;
		  }else{
		  	return true;
		  }
		}
		return true;
	}
	//邮编验证
	function is_contact_zip(){
		if(strlen($this->contact_zip)){
		 if(Util::validate_zip($this->contact_zip)){
			 return true;
		 }else{
			 $this->addError('contact_zip','邮编格式不正确');
			 return false;
		 }
	  }
	}
	
	function is_email(){
		if(!Util::ie($this->contact_email)){
     	 	  $this->addError("contact_email","邮箱格式不正确");
     	 	  return false;
     	 }else{
     	 	return true;
    }
		
	}
}