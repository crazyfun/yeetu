<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property string $id
 * @property string $parent_id
 * @property string $category_name
 * @property string $create_id
 * @property string $create_time
 */
class Category extends BaseActive
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
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, create_id, create_time, sort_id', 'length', 'max'=>11),
			array('category_name', 'length', 'max'=>50),
			array('category_name','required'),
			//array('category_name','exist_category_name'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, sort_id, category_name, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '分类ID',
			'parent_id' => '父分类ID',
			'sort_id' => '前台排序',
			'category_name' => '分类名称',
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
	}

	 public function primaryKey()
    {
       return 'id';
    // 对于复合主键，要返回一个类似如下的数组
    // return array('pk1', 'pk2');
   }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
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
	public function insert_category(){
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
	
	
	function exist_category_name(){
			
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->category_name!=$this->category_name){
			 	 $find_datas=$this->find(array(
          'select'=>'id',
          'condition'=>'category_name=:category_name ',
          'params'=>array(':category_name' => $this->category_name),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'category_name=:category_name',
         'params'=>array(':category_name' => $this->category_name),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("category_name","线路分类已存在");
     }

	
	}
	
	
	
		//获取parent_id的选择项
	function get_select_op(){
		$condition['parent_id']="'0'";
		$category=$this->get_table_datas("",$condition);
		$select_op=array();
		foreach((array)$category as $key => $value){
			$select_op[$value['id']]=$value['category_name'];
		}
		return $select_op;
	}
	
	//获得特色的分类
	function get_trave_characteristic(){
		$category_id='337';
		$conditions['parent_id']=$category_id;
		$category_datas=$this->get_table_datas("",$conditions);
		$return_array=array();
		$return_array['']="不限";
		foreach($category_datas as $key => $value){
			$return_array[$value->id]=$value->category_name;
		}
		return $return_array;
	}
}