<?php

/**
 * This is the model class for table "{{hot_view}}".
 *
 * The followings are the available columns in table '{{hot_view}}':
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $create_time
 * @property integer $display
 */
class HotView extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return HotView the static model class
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
		return '{{hot_view}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link', 'required'),
			array('display', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>10),
			array('type', 'length', 'max'=>1),
			array('link', 'length', 'max'=>200),
			array('ad_sregion_id,create_id,create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, link, create_time, display', 'safe', 'on'=>'search'),
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
			'ad_sregion_id'=>'出发城市',
			'name' => '名称',
			'link' => '链接',
			'create_id'=>'创建人',
			'create_time' => '创建时间',
			'type'=>'类型',
			'display' => '显示次序',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('display',$this->display);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function get_hotview_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
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
		}
		return true;
	}

	public function ts(){
		return $this->type == CV::HOT_VIEW ? '热景' : '主题';
	}


	public function getTopices(){
		return $this->_get_data(CV::TOPIC);
	}

	public function getHotViews(){
		return $this->_get_data(CV::HOT_VIEW,16);
	}


	public function _get_data($type,$count=10){
		$sregion_session=Yii::app()->session->get('sregion_datas');
		$sregion_id=$sregion_session['id'];
		$data = $this->findAll(array('limit'=>$count,'select'=>'name,link','condition'=>'ad_sregion_id=:sregion_id AND type=:type','params'=>array(':sregion_id'=>$sregion_id,':type'=>$type),'order'=>'display asc,id desc'));
		return $data;
		/*
		$first = array_slice($data,0,5);

		$second = array_slice($data,5,10);
		return array('first'=>$first,'second'=>$second);
		 */
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
