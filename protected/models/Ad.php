<?php

/**
 * This is the model class for table "{{ad}}".
 *
 * The followings are the available columns in table '{{ad}}':
 * @property string $id
 * @property string $ad_sregion_ids
 * @property string $ad_area_id
 * @property string $ad_content
 * @property string $create_time
 * @property integer $create_id
 */
class Ad extends BaseActive
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
		return '{{ad}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('ad_sregion_id,ad_area_id,ad_content,ad_type','required','message'=>'{attribute}不能为空'),
			array('create_id', 'numerical', 'integerOnly'=>true),
			array('ad_sregion_id,ad_area_id, create_time', 'length', 'max'=>11),
			array('ad_type','length','max'=>'1'),
			array('ad_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ad_sregion_id, ad_area_id, ad_content, create_time, create_id', 'safe', 'on'=>'search'),
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
		 'User'=>array(self::BELONGS_TO,'User','create_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ad_sregion_id' => '线路出发地',
			'ad_area_id' => '广告位置',
			'ad_content' => '广告内容',
			'ad_type'=>'广告类型',
			'create_time' => '创建时间',
			'create_id' => '创建人',
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
		$criteria->compare('ad_sregion_id',$this->ad_sregion_id,true);
		$criteria->compare('ad_area_id',$this->ad_area_id,true);
		$criteria->compare('ad_content',$this->ad_content,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_id',$this->create_id);

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
    $ad_area_id=$_REQUEST['ad_area_id'];
    $ad_sregion_id=$_REQUEST['ad_sregion_id'];
    $ad_type=$_REQUEST['ad_type'];
    if(!empty($ad_area_id)){
			 array_push($conditions,"t.ad_area_id=:ad_area_id");
			 $params[':ad_area_id']=$ad_area_id;
			 $page_params['ad_area_id']=$ad_area_id;
		}
		if(!empty($ad_sregion_id)){
			 array_push($conditions," ad_sregion_id=:ad_sregion_id");
			 $params[':ad_sregion_id']=$ad_sregion_id;
			 $page_params['ad_sregion_id']=$ad_sregion_id;
		}
		if(!empty($ad_type)){
			 array_push($conditions,"t.ad_type=:ad_type");
			 $params[':ad_type']=$ad_type;
			 $page_params['ad_type']=$ad_type;
		}
		
		$user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
		}
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
		$criteria=new CDbCriteria;
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

		//插入一笔旅游的数据
	public function insert_ad(){
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
	
	
	
	public function get_areas_list()
	{
		$list = array();
		$areas = CV::$AD_AREAS;
		foreach ($areas as $id => $value ) {
			if (is_array($value)) {
				if (isset($value['label']))
					$label = $value['label'];
				else 
					$label = $id;
				if (isset($value['width'])) {
					$size .= '宽:' . $value['width'];		
				}
				if (isset($value['height'])) {
					$size .= ' 高:' . $value['height'];		
				}
				if (isset($size)) {
					$label .= '(' . $size . ')';
				}
			} else {
				$label = $value;
			}
			
			$list[$id] = $label;
			unset($label, $size);
		}
		return $list;
	}
	
	public function get_area_by_id($id)
	{
		$list = $this->get_areas_list($id);
		if (isset($list[$id]))
			return $list[$id];
	}
	
	public function get_trave_sregion_by_ids($ids=array())
	{
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
	
	
	public function get_ad_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}
	
	public function get_ad_area_name($ad_area_id=""){
		$ad_area_id=empty($ad_area_id)?$this->ad_area_id:$ad_area_id;
		$areas_list=$this->get_areas_list();
		return $areas_list[$ad_area_id];
		
	}
	
	public function get_ad_type($ad_type=""){
		$ad_type=empty($ad_type)?$this->ad_type:$ad_type;
		$ad_type_datas=CV::$AD_TYPE;
		return $ad_type_datas[$ad_type];
	}
}