<?php

/**
 * This is the model class for table "{{images}}".
 *
 * The followings are the available columns in table '{{images}}':
 * @property string $id
 * @property integer $image_category
 * @property string $image_title
 * @property string $image_src
 * @property string $image_desc
 * @property string $create_id
 * @property string $create_time
 */
class Images extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Images the static model class
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
		return '{{images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('image_title,image_category','required','message'=>'{attribute}不能为空'),
			array('image_category', 'numerical', 'integerOnly'=>true),
			array('image_title', 'length', 'max'=>30),
			array('image_src', 'length', 'max'=>100),
			array('create_id, create_time', 'length', 'max'=>11),
			array('image_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, image_category, image_title, image_src, image_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
			'image_category' => '图片分类',
			'image_title' => '图片名称',
			'image_src' => '图片链接',
			'image_desc' => '图片描述',
			'create_id' => '创建人',
			'create_time' => '创建时间',
		);
	}
	
	
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$this->delete_image($pk_id);
			
			$trave_condition['image_id']=$pk_id;
			$traveimage=new Traveimage();
			$traveimage->delete_table_datas("",$trave_condition);
			$this->deleteByPk($pk_id,"",array());

		}else{
			$images_datas=$this->get_table_datas("",$condition);
			$traveimage=new Traveimage();
			foreach($images_datas as $key => $value){
				$this->delete_image($value->id);
				$trave_condition['image_id']=$value->id;
			  $traveimage->delete_table_datas("",$trave_condition);
			
			}
			 $com_condition=$this->com_condititions($condition);
       $datas=$this->deleteAll($com_condition['condition'],$com_condition['params']);
		}
		return $datas;
	}
	
	function delete_image($pk_id){
	
		$images_datas=$this->findByPk($pk_id,"",array());
		$image_src=$images_datas->image_src;
		$image_path=$this->get_image_path($pk_id);
		$trave_big_image_name=$image_path.$image_src;
		Util::delete_file($trave_big_image_name);
		$trave_75_image_name=Util::rename_thumb_file(75,75,$image_path,$image_src);
		Util::delete_file($trave_75_image_name);
		$trave_145_image_name=Util::rename_thumb_file(145,80,$image_path,$image_src);
		Util::delete_file($trave_145_image_name);
		$trave_60_image_name=Util::rename_thumb_file(60,30,$image_path,$image_src);
		Util::delete_file($trave_60_image_name);
		$trave_320_image_name=Util::rename_thumb_file(310,285,$image_path,$image_src);
		Util::delete_file($trave_320_image_name);
		$trave_160_image_name=Util::rename_thumb_file(160,120,$image_path,$image_src);
		Util::delete_file($trave_160_image_name);
		
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
		$criteria->compare('image_category',$this->image_category);
		$criteria->compare('image_title',$this->image_title,true);
		$criteria->compare('image_src',$this->image_src,true);
		$criteria->compare('image_desc',$this->image_desc,true);
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
		$image_category=$_REQUEST['image_category'];
		$image_title=$_REQUEST['image_title'];
    if(!empty($image_category)){
			 array_push($conditions,"image_category LIKE :image_category");
			 $params[':image_category']=$image_category;
			 $page_params['image_category']=$image_category;
		}
		
		if(!empty($image_title)){
			 array_push($conditions,"image_title LIKE :image_title");
			 $params[':image_title']="%$image_title%";
			 $page_params['image_title']=$image_title;
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
	
	
		//插入新景区的数据
	public function insert_images(){
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


	function get_images_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $validate_user_flag=Yii::app()->getController()->validate_user_operate($this->create_id);
		  if($validate_user_flag){
		   $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>''))."|";
		   $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>''));
		  }
		  return $return_str;
	}
		//重命名文件名
	function rename_file($file_name){
		if(empty($file_name))
			return;
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		array_push($implode_array,time());
		array_push($implode_array,end($explode_array));
		return implode('.',$implode_array);
	}

	
		//获得图片保存的路径
	function get_image_path($id=""){
		$images_datas=$this->findByPk(empty($id)?$this->id:$id,"",array());
		if($images_datas){
			$image_path="upload/images/".$images_datas->image_category."/";
			if(!is_dir($image_path)){
				Util::makeDirectory($image_path);
			}
			return $image_path;
		}
	}
	
	
		//获得线路的图片
	function get_image(){
		$image_path=$this->get_image_path();
		$image_path="/".$image_path;
		$image_name=Util::rename_thumb_file(75,75,$image_path,$this->image_src);
		$big_image_name=Util::rename_thumb_file(160,120,$image_path,$this->image_src);
		return CHtml::image($image_name,$this->image_title,array("class"=>"hover_image","big_image"=>$big_image_name,"id"=>"show_image_src"));

	}
	
	//获得图片分类的名称
	function get_image_category(){
		$image_category=new ImageCategory();
		$image_category_datas=$image_category->get_category_select();
		return $image_category_datas[$this->image_category];
	}
	
	
}