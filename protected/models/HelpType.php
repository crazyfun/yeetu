<?php

/**
 * This is the model class for table "{{help_type}}".
 *
 * The followings are the available columns in table '{{help_type}}':
 * @property string $id
 * @property string $name
 * @property string $create_time
 */
class HelpType extends BaseActive
{
	const DEFAULT_TYPE_ID = 1;

  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{help_type}}';
	}
	
	public function beforeSave() {
		if($this->isNewRecord){
			$this->create_time = Util::current_time('timestamp');
		}
		return parent::beforeSave();
	}
	
	public function beforeDelete() {
		if ($this->id == self::DEFAULT_TYPE_ID)
			return false;
		return parent::beforeDelete();
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required', 'message'=>'{attribute}不能为空'),
			array('name', 'length', 'max'=>64),
			array('create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, create_time', 'safe', 'on'=>'search'),
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
			'id' => '类别ID',
			'name' => '类别名称',
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

	  $type_name=$_REQUEST['type_name'];
		$condition=array();
		$params=array();
		$page_params=array();
		if(!empty($type_name)){
			array_push($condition,"name LIKE :type_name");
			$params[':type_name']="%$type_name%";
			$page_params['type_name']=$type_name;
		}
		
	
		$criteria=new CDbCriteria;
    $criteria->condition=implode(" AND ",$condition);
    $criteria->params=$params;
    
    $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination'=> array(
				'pageSize' => 20,
				'params'=>$page_params
			),
			'sort'=>$sort,
		));
	}
	
	/**
	 * @param array ids 指定的ids
	 * @return array 类别的下拉列表数组
	 */
	public function get_list($ids=array())
	{	
		$criteria = new CDbCriteria();
		$criteria->select = 'id, name';
		$criteria->order = 'id ASC';
		if (!empty($ids) && is_array($ids))
			$criteria->addInCondition('id', $ids);
		
		$rows = $this->findAll($criteria);

		$list = array();
		foreach($rows as $row){
			$list[$row->id] = $row->name;
		}
		return $list; 
	}

	public function delete_by_ids($ids) {
		if (!is_array($ids))
			$ids = array($ids);
		
		foreach ($ids as $k => $v) {
			if ($v == self::DEFAULT_TYPE_ID )
				unset($ids[$k]);
		}
		
		if (empty($ids))
			return;
		
		$ids = array_map('intval', $ids);
		
		Help::model()->update_type_by_typeId($ids, self::DEFAULT_TYPE_ID);
		
		
		$this->deleteAll('id in (:ids)',
			array(':ids' => implode(',', $ids))
		);
		
	}
	
	/**
	 * return string 删除url
	 */
	public function get_delete_url()
	{
		return Yii::app()->createUrl('help/type_delete', array(
			'id' => $this->id
		));
	}
	
	/**
	 * return string 编辑url
	 */
	public function get_edit_url()
	{
		return Yii::app()->createUrl('help/type_edit', array(
			'id' => $this->id
		));
	}
	
	/**
	 * 
	 * return string 返回编辑和删除链接
	 */
	public function get_operate_links()
	{
		$edit_link = CHtml::link('编辑', $this->get_edit_url(),array('class'=>'operate_button'));
		$del_link = $this->id != self::DEFAULT_TYPE_ID ? CHtml::link('删除', $this->get_delete_url(), array('class'=>'operate_dbutton','onclick'=> 'return confirm("你确定要删除\"'. $this->name .'\"这个帮助类别吗？")')) : '';
		return $edit_link . "\t" . $del_link ;
	}
}
