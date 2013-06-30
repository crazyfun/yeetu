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
class System extends BaseActive
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
		return '{{system}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('config_name,config_value,config_desc','required','message'=>'{attribute}不能为空'),
		  array('config_name',"exist_config_name"),
			array('config_name, config_value', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			array('config_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, config_name, config_value, config_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
			'config_name' => '名称',
			'config_value' => '值',
			'config_desc' => '描述',
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
		$criteria->compare('config_name',$this->config_name,true);
		$criteria->compare('config_value',$this->config_value,true);
		$criteria->compare('config_desc',$this->config_desc,true);
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
    $config_name=$_REQUEST['config_name'];
    	if(!empty($config_name)){
			 array_push($conditions,"config_name LIKE :config_name");
			 $params[':config_name']="%$config_name%";
			 $page_params['config_name']=$config_name;
		}
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time ASC";
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
	


	
		//插入一笔旅游的数据
	public function insert_system(){
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
			if($get_table_datas->config_name!=$this->config_name){
				$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'config_name=:config_name',
         'params'=>array(':config_name' => $this->config_name),
        ));
			}
		}else{
			 $find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'config_name=:config_name',
         'params'=>array(':config_name' => $this->config_name),
        ));
		}
     if(!empty($find_datas)){
     	 $this->addError("config_name","名称已存在");
     }	
		
	}
	
	
	function get_system_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
	//获得系统变量的值
	function get_system_value($config_name){
		$conditions['config_name']=$config_name;
		$system_values=$this->get_table_datas("",$conditions);
		return $system_values[0]['config_value'];
		
	}
	
}