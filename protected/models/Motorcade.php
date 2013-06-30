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
class Motorcade extends BaseActive
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
		return '{{motorcade}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('motorcade_name', 'length', 'max'=>30),
			array('create_time', 'length', 'max'=>11),
			array('motorcade_link,motorcade_phone,motorcade_fax,motorcade_qq,motorcade_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, motorcade_name, motorcade_link, motorcade_phone, motorcade_fax, motorcade_qq, motorcade_desc,create_id', 'safe'),
			array('id, motorcade_name, motorcade_link, motorcade_phone, motorcade_fax, motorcade_qq, motorcade_desc', 'safe', 'on'=>'search'),
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
			'motorcade_name' => '车队名称',
			'motorcade_link' => '车队负责人',
			'motorcade_phone' => '车队联系电话',
			'motorcade_fax' => '传真',
			'motorcade_qq'=>'QQ/MSN',
			'motorcade_desc'=>'备注',
			'create_id'=>'创建人',
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
		$criteria->compare('motorcade_name',$this->motorcade_name,true);
		$criteria->compare('motorcade_link',$this->motorcade_link,true);
		$criteria->compare('motorcade_phone',$this->motorcade_phone,true);
		$criteria->compare('motorcade_fax',$this->motorcade_fax,true);
		$criteria->compare('motorcade_qq',$this->motorcade_qq,true);
		$criteria->compare('motorcade_desc',$this->motorcade_desc,true);
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
		$motorcade_name=$_REQUEST['motorcade_name'];
		if(!empty($motorcade_name)){
			array_push($conditions,"motorcade_name LIKE :motorcade_name");
			$params[':motorcade_name']="%$motorcade_name%";
			$page_params['motorcade_name']=$motorcade_name;			
		}
   $user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
		}
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
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





	//得到车队车辆
	function get_motorcade_cars(){
		$controller_id=Yii::app()->getController()->getId();
		$car_model=new Car;
		$condition['motorcade_id']=$this->id;
		$car_datas=$car_model->get_table_datas("",$condition);
		$car_num="";
		$show_num = 0;
		$just_show = false;
		foreach((array)$car_datas as $key => $value){
		  if(empty($car_num)){
			$car_num.=$value->car_num;
		  }else{
			$car_num.=",".$value->car_num;
			if($show_num > 3){
				$car_num.="……";
				$just_show = true;
			}
		  }
		  if($just_show){
			break;
		  }
		  $show_num++;
		} 
		$car_num.="&nbsp;&nbsp;".CHtml::link('增加',array("$controller_id/car","motorcade_id"=>$this->id),array('class'=>'operate_button'));
		return $car_num;
	}
	
	
		//插入新的数据
	public function insert_motorcade(){
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
				$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}

	}

	
	
	function get_motorcade_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}

	
}