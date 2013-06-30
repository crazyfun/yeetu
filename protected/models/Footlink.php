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
class Footlink extends BaseActive
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
		return '{{footlink}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('footlink_name,footlink_order,footlink_desc','required','message'=>'{attribute}不能为空'),
		//  array('footlink_name',"exist_footlink_name"),
			array('footlink_name', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			array('footlink_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, footlink_name, footlink_order, footlink_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
			'footlink_name' => '名称',
			'footlink_order' => '显示顺序',
			'footlink_desc' => '描述',
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
		$criteria->compare('footlink_name',$this->footlink_name,true);
		$criteria->compare('footlink_order',$this->footlink_order,true);
		$criteria->compare('footlink_desc',$this->footlink_desc,true);
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
		$footlink_name=$_REQUEST['footlink_name'];
    	if(!empty($footlink_name)){
			 array_push($conditions,"footlink_name LIKE :footlink_name");
			 $params[':footlink_name']="%$footlink_name%";
			 $page_params['footlink_name']=$footlink_name;
		}
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.footlink_order ASC";
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
	
	
		//插入新链接的数据
	public function insert_footlink(){
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
			if($get_table_datas->footlink_name!=$this->footlink_name){
				$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'footlink_name=:footlink_name',
         'params'=>array(':footlink_name' => $this->footlink_name),
        ));
			}
		}else{
			 $find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'footlink_name=:footlink_name',
         'params'=>array(':footlink_name' => $this->footlink_name),
        ));
		}
     if(!empty($find_datas)){
     	 $this->addError("footlink_name","名称已存在");
     }	
		
	}
	
	
	function get_footlink_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
	//获得系统变量的值
	function get_footlink_value($footlink_name){
		$conditions['footlink_name']=$footlink_name;
		$system_values=$this->get_table_datas("",$conditions);
		return $system_values[0]['id'];
		
	}
	
	function get_footlink_content(){
       $criteria=new CDbCriteria;
	   $criteria->select="id,footlink_name";
	   $criteria->order="t.footlink_order ASC";
	   $foot_link_content=$this->findAll($criteria);
	   return $foot_link_content;

	   
	}
}