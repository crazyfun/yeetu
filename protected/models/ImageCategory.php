<?php

/**
 * This is the model class for table "{{image_category}}".
 *
 * The followings are the available columns in table '{{image_category}}':
 * @property string $id
 * @property string $category_title
 * @property string $create_id
 * @property string $create_time
 */
class ImageCategory extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ImageCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{image_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('category_title','required','message'=>'{attribute}不能为空'),
		  array('category_title','exist_category_title'),
			array('category_title', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			array('id, category_title, create_id, create_time', 'safe', 'on'=>'search'),
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
			'category_title' => '图片分类名称',
			'create_id' => '创建人',
			'create_time' => '创建时间',
		);
	}
	
	
		//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
		  $image_condition['image_category']=$pk_id;
		  $images=new Images();
		  $images->delete_table_datas("",$image_condition);
			$this->deleteByPk($pk_id,"",array());
			@rmdir("upload/images/".$pk_id);
		}else{
			 $images_category_datas=$this->get_table_datas("",$condition);
			 $images=new Images();
			 foreach($images_category_datas as $key => $value){
			 	$image_condition['image_category']=$value->id;
			 	$images->delete_table_datas("",$image_condition);
			 	@rmdir("upload/images/".$value->id);
			 }
       $com_condition=$this->com_condititions($condition);
       $datas=$this->deleteAll($com_condition['condition'],$com_condition['params']);
		}
		return $datas;
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
		$criteria->compare('category_title',$this->category_title,true);
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
		$category_title=$_REQUEST['category_title'];
    if(!empty($category_title)){
			 array_push($conditions,"category_title LIKE :category_title");
			 $params[':category_title']='%'.$category_title.'%';
			 $page_params['category_title']=$category_title;
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
			    'with'=>array("User"=>array('select'=>'id,user_login,permissions_type','condition'=>'','params'=>array(),'together'=>true)),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	
	function exist_category_title(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->category_title!=$this->category_title){
			 	 $find_datas=$this->find(array(
          'select'=>'category_title',
          'condition'=>'category_title=:category_title',
          'params'=>array(':category_title' => $this->category_title),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'category_title',
         'condition'=>'category_title=:category_title',
         'params'=>array(':category_title' => $this->category_title),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("category_title","分类名已存在");
     	 return false;
     }
     return true;
	}
	
			//插入新景区的数据
	public function insert_images_category(){
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
	function get_category_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $validate_user_flag=Yii::app()->getController()->validate_user_operate($this->create_id);
		  if($validate_user_flag){
		   $return_str.=CHtml::link('修改/详情',array("$controller_id/addc","id"=>$this->id),array('class'=>'operate_button'));
		   if($this->id!=1){
		     $return_str.=CHtml::link('删除',array("$controller_id/deletec","id"=>$this->id),array('class'=>'operate_dbutton'));
		   }
		  }
		  return $return_str;
	}
	
	//获得图片分类的选择项
	function get_category_select(){
		$category_datas=$this->findAll(array('select'=>'id,category_title','condition'=>'','params'=>array(),'order'=>"id ASC"));
		$category_select=array();
		$category_select['']="请选择图片分类";
		foreach($category_datas as $key => $value){
			$category_select[$value->id]=$value->category_title;
		}
		return $category_select;
	}
}