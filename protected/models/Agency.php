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
class Agency extends BaseActive
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
		return '{{agency}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('agency_name','required','message'=>'{attribute}不能为空'),
		//  array('agency_name',"exist_agency_name"),
			array('id, agency_name, agency_address, agency_link, agency_phone, agency_fax, agency_qq_msn, agency_desc, create_id, create_time','safe'),
			array('agency_name', 'length', 'encoding'=>'utf-8','max'=>30,'tooLong'=>'最多只能30个字'),
			array('create_id, create_time', 'length', 'max'=>11),
		//	array('sights_desc,sights_comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, agency_name, agency_address, agency_link, agency_phone, agency_fax, agency_qq_msn, agency_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
			'agency_name' => '旅行社名称',
			'agency_address' => '旅行社地址',
			'agency_link' => '联系人',
			'agency_phone' => '联系电话',
			'agency_fax' => '传真',
			'agency_qq_msn' => 'QQ/MSN',
			'agency_desc' => '旅行社描述',
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
		$criteria->compare('agency_name',$this->agency_name,true);
		$criteria->compare('agency_address',$this->agency_address,true);
		$criteria->compare('agency_link',$this->agency_link,true);
		$criteria->compare('agency_phone',$this->agency_phone,true);
		$criteria->compare('agency_fax',$this->agency_fax,true);
		$criteria->compare('agency_qq_msn',$this->agency_qq_msn,true);
		$criteria->compare('agency_desc',$this->agency_desc,true);
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
		$agency_name=$_REQUEST['agency_name'];
		$agency_address=$_REQUEST['agency_address'];
		$agency_link=$_REQUEST['agency_link'];
    	if(!empty($agency_name)){
			 array_push($conditions,"agency_name LIKE :agency_name");
			 $params[':agency_name']="%$agency_name%";
			 $page_params['agency_name']=$agency_name;
		}
		if(!empty($agency_address)){
			array_push($conditions,"agency_address LIKE :agency_address");
			$params[':agency_address']="%$agency_address";
			$page_params['agency_address']=$agency_address;
		}
		if(!empty($agency_link)){
			array_push($conditions,"agency_link LIKE :agency_link");
			$params[':agency_link']="%$agency_link";
			$page_params['agency_link']=$agency_link;
		
		}
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$conditions),
			    'params'=>$params,
			    'with'=>array("User"),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	


	
	
		//插入新景区的数据
	public function insert_agency(){
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
		//判断名称是否重复
	function exist_config_name(){
	   $id=$this->id;
		if(!empty($id)){
			$get_table_datas=$this->get_table_datas($id,array());
			if($get_table_datas->agency_name!=$this->agency_name){
				$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'agency_name=:agency_name',
         'params'=>array(':agency_name' => $this->agency_name),
        ));
			}
		}else{
			 $find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'agency_name=:agency_name',
         'params'=>array(':agency_name' => $this->agency_name),
        ));
		}
     if(!empty($find_datas)){
     	 $this->addError("agency_name","名称已存在");
     }	
		
	}
	
	
	function get_agency_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $validate_user_flag=Yii::app()->getController()->validate_user_operate($this->create_id);
		  if($validate_user_flag){
		   $return_str.=CHtml::link('修改/详情',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		   $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  }
		  return $return_str;
	}
	
	
}