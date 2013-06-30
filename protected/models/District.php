<?php

/**
 * This is the model class for table "{{district}}".
 *
 * The followings are the available columns in table '{{district}}':
 * @property string $id
 * @property string $parent_id
 * @property string $district_name
 * @property integer $district_category
 * @property string $create_id
 * @property string $create_time
 */
class District extends BaseActive
{
  public $edit_flag=true;
	public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{district}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('district_category', 'required'),
			array('district_category', 'numerical', 'integerOnly'=>true),
			array('district_name,district_en_name','required'),
			array('district_name','exist_district_name'),
			array('parent_id, create_id, create_time', 'length', 'max'=>11),
			array('district_name,district_en_name', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, district_name, district_category, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '线路区域ID',
			'parent_id' => '父区域ID',
			'district_name' => '线路区域名称',
			'district_en_name' => '英文名称',
			'district_category' => '线路区域分类',
			'create_id' => '创建者',
			'create_time' => '创建时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

  }
  
  
  	public function searchdatas()
	{

	}

	



	
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			  $this->deleteByPk($pk_id,array(),array());
			  $parent_condition['parent_id']=$pk_id;
				$this->delete_table_datas("",$parent_condition);
		}else{
			  $get_condition_datas=$this->get_table_datas("",$condition);
			  foreach($get_condition_datas as $key => $value){
			  	$this->deleteByPk($value->id,array(),array());
			  	//删除线路时间
					 $parent_condition['parent_id']=$value->id;
					 $this->delete_table_datas("",$parent_condition);
			  }
			  
		}
	}
	

	
		//插入一笔旅游的数据
	public function insert_district(){
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
	
	
	function exist_district_name(){
			
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->district_name!=$this->district_name){
			 	 $find_datas=$this->find(array(
          'select'=>'id',
          'condition'=>'district_name=:district_name ',
          'params'=>array(':district_name' => $this->district_name),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'district_name=:district_name',
         'params'=>array(':district_name' => $this->district_name),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("district_name","线路区域已存在");
     }

	
	}
		//获取parent_id的选择项
	function get_select_op(){
		$district=$this->findAll(array('condition'=>"district_category=1 OR district_category=2",'params'=>array(),'order'=>'district_en_name ASC'));
		$select_op=array();
		foreach((array)$district as $key => $value){
			$select_op[$value['id']]=$value['district_name'];
		}
		return $select_op;
	}
	
	//判断登录用户是否有权限修改
	function is_permissions_edit(){
		$user_id=Yii::app()->user->id;
		$create_id=$this->create_id;
		$user_datas=User::model()->get_table_datas($user_id);
		$user_permissions=$user_datas->permissions_type;
		$create_datas=User::model()->get_table_datas($create_id);
		$create_permissions=$create_datas->permissions_type;
		if(($user_permissions!=$create_permissions)&&$user_permissions){
			return false;
		}else{
			return true;
		}
	}
	
}