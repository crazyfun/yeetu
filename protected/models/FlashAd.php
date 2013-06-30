<?php

/**
 * This is the model class for table "{{flash_ad}}".
 *
 * The followings are the available columns in table '{{flash_ad}}':
 * @property string $id
 * @property string $ad_src
 * @property string $ad_link
 * @property string $ad_name
 * @property integer $ad_sort
 * @property string $create_id
 * @property string $create_time
 */
class FlashAd extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FlashAd the static model class
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
		return '{{flash_ad}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('ad_src,ad_link,ad_name,ad_sort','required','message'=>'{attribute}不能为空'),
			array('ad_sort', 'numerical', 'integerOnly'=>true),
			array('ad_src', 'length', 'max'=>100),
			array('ad_sregion_id','length','max'=>'255'),
			array('ad_link','length','max'=>200),
			array('create_id, create_time', 'length', 'max'=>11),
			array("ad_name","length",'encoding'=>'utf-8','max'=>30,'tooLong'=>'最多只能30个字'),
 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ad_src, ad_link, ad_name, ad_sort, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '广告ID',
			'ad_sregion_id'=>'出发地',
			'ad_src' => '广告图片',
			'ad_link' => '广告连接',
			'ad_name' => '广告title',
			'ad_sort' => '广告排序',
			'create_id' => '创建人',
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
		$criteria->compare('ad_src',$this->ad_src,true);
		$criteria->compare('ad_link',$this->ad_link,true);
		$criteria->compare('ad_name',$this->ad_name,true);
		$criteria->compare('ad_sort',$this->ad_sort);
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
		$ad_sregion_id=$_REQUEST['ad_sregion_id'];
		if(!empty($ad_sregion_id)){
			 array_push($conditions," t.ad_sregion_id=:ad_sregion_id");
			 $params[':ad_sregion_id']=$ad_sregion_id;
			 $page_params['ad_sregion_id']=$ad_sregion_id;
		}
		
		$user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
		}

		$criteria=new CDbCriteria;
		$page_params=array();
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.ad_sort ASC";
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
	
	
		//һε
	public function insert_flash_ad(){
		return $this->save();
	}

	function beforeSave(){
		if(parent::beforeSave()){
			$this->create_id=Yii::app()->user->id;
			$this->create_time=Util::current_time('timestamp');
			return true;
		}
	}
	
	
		//ûѡ
	function get_ad_operate(){
		$controller_id=Yii::app()->getController()->getId();
		$return_str="";
		$return_str.=CHtml::link("修改/查看",array("$controller_id/flashadd","id"=>$this->id),array('class'=>'operate_button'));
		$return_str.=CHtml::link("删除",array("$controller_id/flashdelete","id"=>$this->id),array('class'=>'operate_dbutton'));
		return $return_str;
	}
	
		//ļ
	function rename_file($file_name){
		if(empty($file_name))
			return;
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		array_push($implode_array,time());
		array_push($implode_array,end($explode_array));
		return implode('.',$implode_array);
	}
	
	
		//ͼƬ·
	function get_image_path(){
			$flash_image_path="upload/flashad/";
			if(!is_dir($flash_image_path)){
				Util::makeDirectory($flash_image_path);
			}
			return $flash_image_path;
	}
	
	
		//·ͼƬ
	function get_flash_image(){
		$image_path=$this->get_image_path();
		$image_path="/".$image_path;
		return CHtml::image($image_path.$this->ad_src,$this->ad_name,array("class"=>"hover_image","big_image"=>$image_path.$this->ad_src,"id"=>"show_image_src",'width'=>'50','height'=>'50'));

	}
	
	function get_flash_ad_datas($sregion_id){
		  
		  $flash_ad_datas=$this->findAll(array('select'=>'ad_src,ad_link,ad_name,ad_sort','condition'=>'ad_sregion_id=:sregion_id','params'=>array(':sregion_id'=>$sregion_id),'order'=>'ad_sort ASC'));
		  $return_array=array();
		  foreach($flash_ad_datas as $key => $value){
		  	$tem_array=array();
		    $tem_array['ad_src']="/".$value->get_image_path().$value->ad_src;
		    $tem_array['ad_link']=$value->ad_link;
		    $tem_array['ad_name']=$value->ad_name;
		    array_push($return_array,$tem_array);
		  	
		  }
		  return  $return_array;
	}
	
	
	public function get_trave_sregion_by_ids($ids=array()){
		if($ids === array())
			$ids = $this->ad_sregion_id;
		if (empty($ids))
			return '';
    $criterica = new CDbCriteria();
		$criterica->select = 'district_name';
		$criterica->condition="id=:ad_sregion_id";
		$criterica->params=array(':ad_sregion_id'=>$ids);
		$models = District::model()->find($criterica);
		return $models->district_name;

	}
	
	
	
}
