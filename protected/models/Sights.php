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
class Sights extends BaseActive
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
		return '{{sights}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('sights_name,sights_address,sights_phone,linkman,resale_price,group_price,mark_price','required','message'=>'{attribute}不能为空'),
			array('sights_name', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			array('sights_desc,sights_comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sights_name, sights_address, sights_phone, linkman, mark_price, resale_price, group_price, sights_desc, sights_comment, create_id, create_time', 'safe', 'on'=>'search'),
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
			'sights_name' => '名称',
			'sights_address' => '景区地址',
			'sights_phone' => '景区电话',
			'linkman' => '联系人',
			'mark_price' => '挂牌价格',
			'resale_price' => '散客价格',
			'group_price' => '团队价格',
			'sights_desc' => '景区简介',
			'sights_comment' => '备注',
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
		$criteria->compare('sights_name',$this->sights_name,true);
		$criteria->compare('sights_address',$this->sights_address,true);
		$criteria->compare('sights_phone',$this->sights_phone,true);
		$criteria->compare('linkman',$this->linkman,true);
		$criteria->compare('mark_price',$this->mark_price,true);
		$criteria->compare('resale_price',$this->resale_price,true);
		$criteria->compare('group_price',$this->group_price,true);
		$criteria->compare('sights_desc',$this->sights_desc,true);
		$criteria->compare('sights_comment',$this->sights_comment,true);
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
		$sights_name=$_REQUEST['sights_name'];
    	if(!empty($sights_name)){
			 array_push($conditions,"sights_name LIKE :sights_name");
			 $params[':sights_name']="%$sights_name%";
			 $page_params['sights_name']=$sights_name;
		}
		$user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
		}
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
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
	public function insert_sights(){
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

	
	function get_sights_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $validate_user_flag=Yii::app()->getController()->validate_user_operate($this->create_id);
		   $return_str.=CHtml::link('修改/详情',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		   $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}

}