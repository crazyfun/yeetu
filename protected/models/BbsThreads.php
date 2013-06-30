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
class BbsThreads extends BaseActive
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
		return '{{bbs_threads}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  
			array('title,auther,title_href,image_src,bbs_type','required','message'=>'{attribute}不能为空'),
			array('sort, bbs_type', 'numerical', 'integerOnly'=>true),
			array('title, image_src', 'length', 'max'=>100),
			array('auther','length','max'=>50),
			array('title_href', 'length', 'max'=>200),
			array('create_id,create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, title_href, sort, bbs_type, image_src, create_id,create_time', 'safe', 'on'=>'search'),
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
			'title' => '主题名称',
			'auther'=>'作者',
			'title_href' => '主题链接',
			'sort' => '排序',
			'bbs_type' => '主题类型',
			'image_src' => '主题图片',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('title_href',$this->title_href,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('bbs_type',$this->bbs_type);
		$criteria->compare('image_src',$this->image_src,true);
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
		$bbs_type=$_REQUEST['bbs_type'];
		if(!empty($bbs_type)){
			 array_push($conditions," t.bbs_type=:bbs_type");
			 $params[':bbs_type']=$bbs_type;
			 $page_params['bbs_type']=$bbs_type;
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
				'with'=>array("User"),
		
			),

			'pagination'=>array(
				'pageSize'=>'20',
				'params'=> $page_params,
			),
			'sort'=>$sort,
		));
	}
	
	
			//?
	public function insert_threads(){
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
			$flash_image_path="upload/threads/";
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
	
	
	function get_threads_by_type($thread_type){
		$threads_datas=$this->findAll(array('select'=>'id,title,auther,title_href,image_src','condition'=>'bbs_type=:bbs_type','params'=>array(':bbs_type'=>$thread_type),'order'=>'sort ASC','limit'=>'10'));
		return $threads_datas;
	}
	
	
	
	
}