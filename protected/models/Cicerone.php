<?php

/**
 * This is the model class for table "{{syestem}}".
 *
 * The followings are the available columns in table '{{syestem}}':
 * @property string $id
 * @property string $config_name
 * @property string $config_value
 * @property string $config_desc
 * @property string $create_id
 * @property string $create_time
 */
 
 
class Cicerone extends BaseActive
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
		return '{{cicerone}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('cicerone_name','required','message'=>'{attribute}不能为空'),
		array('id, cicerone_name, cicerone_sex, cicerone_id, cicerone_address, cicerone_phone, cicerone_num, cicerone_desc, create_id, create_time', 'safe'),
			array('cicerone_name', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
		//	array('sights_desc,sights_comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cicerone_name, cicerone_sex, cicerone_id, cicerone_address, cicerone_phone, cicerone_num, cicerone_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'User'=>array(self::BELONGS_TO, 'User', 'create_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cicerone_name' => '导游姓名',
			'cicerone_sex' => '性别',
			'cicerone_id' => '身份证号',
			'cicerone_address' => '住宅地址',
			'cicerone_phone' => '联系电话',
			'cicerone_num' => '导游证',
			'cicerone_desc' => '导游描述',
			'create_id' => '创建用户',
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
		$criteria->compare('cicerone_name',$this->cicerone_name,true);
		$criteria->compare('cicerone_sex',$this->cicerone_sex,true);
		$criteria->compare('cicerone_id',$this->cicerone_id,true);
		$criteria->compare('cicerone_address',$this->cicerone_address,true);
		$criteria->compare('cicerone_phone',$this->cicerone_phone,true);
		$criteria->compare('cicerone_num',$this->cicerone_num,true);
		$criteria->compare('cicerone_desc',$this->cicerone_desc,true);
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
		$conditions=array();
		$params=array();
		$page_params=array();
		$cicerone_name=$_REQUEST['cicerone_name'];
    	if(!empty($cicerone_name)){
			 array_push($conditions,"cicerone_name LIKE :cicerone_name");
			 $params[':cicerone_name']="%$cicerone_name%";
			 $page_params['cicerone_name']=$cicerone_name;
		}
		$user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
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
			    'with'=>array("User"=>array('select'=>'id,user_login,permissions_type','condition'=>'(1=1)'.$user_permissions_type,'params'=>array(),'together'=>true)),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	


	
	
		//插入新景区的数据
	public function insert_cicerone(){
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
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}

	}

	
	
	function get_cicerone_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改/详情',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
	
}