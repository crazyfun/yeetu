<?php

/**
 * This is the model class for table "{{bbs_threads}}".
 *
 * The followings are the available columns in table '{{bbs_threads}}':
 * @property string $id
 * @property string $title
 * @property string $short_desc
 * @property string $title_href
 * @property integer $sort
 * @property integer $bbs_type
 * @property string $image_src
 * @property string $create_time
 */
class TraveThreads extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BbsThreads the static model class
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
		return '{{trave_threads}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  

			array('trave_id,title,title_href,image_src,short_desc','required','message'=>'{attribute}不能为空'),

			array('sort', 'numerical', 'integerOnly'=>true),
			array('title, image_src', 'length', 'max'=>100),
			array('auther','length','max'=>50),
			array('title_href', 'length', 'max'=>200),
			array('create_id,create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('trave_id,id,title,title_href,sort,image_src,create_id,create_time,short_desc', 'safe', 'on'=>'search'),
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
		  'Trave'=>array(self::BELONGS_TO,'Trave','trave_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'trave_id'=>'线路名称',
			'title' => '主题名称',
			'auther'=>'作者',
			'title_href' => '主题链接',
			'sort' => '排序',
			'image_src' => '主题图片',
			'create_id'=>'创建人',
			'short_desc'=>'简短描述',
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
		$criteria->compare('trave_id',$this->trave_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('title_href',$this->title_href,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('image_src',$this->image_src,true);
		$criteria->compare('short_desc',$this->short_desc,true);
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
		$trave_id=$_REQUEST['trave_id'];
		$title=$_REQUEST['title'];
		if(!empty($trave_id)){
			 array_push($conditions," t.trave_id=:trave_id");
			 $params[':trave_id']=$trave_id;
			 $page_params['trave_id']=$trave_id;
		}
		if(!empty($title)){
			 array_push($conditions," t.title LIKE :title");
			 $params[':title']='%'.$title.'%';
			 $page_params['title']=$title;
		}
		
		$user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
		}
		$criteria=new CDbCriteria;
		$page_params=array();

		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.sort ASC";
  	$sort->params=$page_params;

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
				'condition'=>implode(' AND ',$conditions),
				'params'=>$params,
				'with'=>array("User"=>array('select'=>'id,user_login,permissions_type','condition'=>'(1=1)'.$user_permissions_type,'params'=>array(),'together'=>true),'Trave'),
			),

			'pagination'=>array(
				'pageSize'=>'20',
				'params'=> $page_params,
			),

			'sort'=>$sort,

		));
	}
	
	
			//?
	public function insert_tthreads(){
		return $this->save();
	}

	function beforeSave(){
		if(parent::beforeSave()){
			$this->create_id=Yii::app()->user->id;
			$this->create_time=Util::current_time('timestamp');
			return true;
		}
	}
	
	
			//??
	function get_threads_operate(){
		$controller_id=Yii::app()->getController()->getId();
		$return_str="";
		$return_str.=CHtml::link("修改",array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		$return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		return $return_str;
	}
	
			//?
	function rename_file($file_name){
		if(empty($file_name))
			return;
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		array_push($implode_array,time());
		array_push($implode_array,end($explode_array));
		return implode('.',$implode_array);
	}
	
	
		//??
	function get_image_path(){
			$flash_image_path="upload/tthreads/";
			if(!is_dir($flash_image_path)){
				Util::makeDirectory($flash_image_path);
			}
			return $flash_image_path;
	}
	
	
		//??
	function get_threads_image(){
		$image_path=$this->get_image_path();
		$image_path="/".$image_path;
		return CHtml::image(Util::rename_thumb_file(75,75,$image_path,$this->image_src),$this->title,array("class"=>"hover_image","big_image"=>$image_path.$this->image_src,"id"=>"show_image_src",'width'=>'75','height'=>'75'));

	}
	
	
	function get_show_threads_image(){
		$image_path=$this->get_image_path();
		$image_path="/".$image_path;
		return CHtml::image(Util::rename_thumb_file(75,75,$image_path,$this->image_src),$this->title,array('width'=>'75','height'=>'75'));
	}
	
	
	
	
	
	
}