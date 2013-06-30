<?php

/**
 * This is the model class for table "{{help}}".
 *
 * The followings are the available columns in table '{{help}}':
 * @property string $id
 * @property string $type_id
 * @property string $title
 * @property string $content
 * @property string $create_time
 */
class Help extends BaseActive
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
		return '{{help}}';
	}
	
	public function init()
	{
		parent::init();
		$this->onBeforeSave = array($this, 'gCreateTime');
	}
	
	/**
	 * 
	 * 生成创建时间
	 */
	public function gCreateTime()
	{
		if($this->isNewRecord){
			$this->create_time = Util::current_time('timestamp');
		}
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id', 'required', 'message'=>'类别不能为空'),
			array('type_id', 'validateType'),
			array('title, content', 'required', 'message'=>'{attribute}不能为空'),
			array('type_id, create_time', 'length', 'max'=>11),
			array('title', 'length', 'max'=>255),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_id, title, content, create_time', 'safe', 'on'=>'search'),
		);
	}
	

	/**
	 * 
	 * 验证类别是否是有效的
	 * @param string $attribute
	 * @param array $params
	 */
	public function validateType($attribute,$params)
	{
		
		if ((!empty($this->type_id)) && 
			($helpType = HelpType::model()->findByPk($this->type_id))
			) {
			return true;
		} else {
			$this->addError('type_id', '类别不是有效的');
			return false;
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'type'=>array(self::BELONGS_TO, 'HelpType', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_id' => '类别ID',
			'title' => '标题',
			'type' => '帮助类别',
			'content' => '内容',
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
    $help_type=$_REQUEST['help_type'];
		$title=$_REQUEST['title'];
		$condition=array();
		$params=array();
		$page_params=array();
		if(!empty($help_type)){
			array_push($condition,"type.name LIKE :help_type");
			$params[':help_type']="%$help_type%";
			$page_params['help_type']=$help_type;
		}
		if(!empty($title)){
			array_push($condition,"(t.title LIKE :title OR t.content LIKE :title)");
			$params[':title']="%$title%";
			$page_params['title']=$title;
		}
		$criteria=new CDbCriteria;
    $criteria->condition=implode(" AND ",$condition);
    $criteria->params=$params;
    $criteria->with=array('type');
    
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
	 * 更新帮助类别
	 */
	public function update_type_by_typeId($type_id, $des_type_id) 
	{
		
		if (empty($type_id) || empty($des_type_id))
			return false;
			
		if (!HelpType::model()->findAllByPk($des_type_id))
			return false;
		
		$type_ids = array_map('intval', (Array) $type_id);
		
		
		$this->updateAll(
			array('type_id' => $des_type_id),
			'type_id in (:type_ids)',
			array(':type_ids' => implode(',', $type_ids))
		);	
	}
	
	/**
	 * 根据类别id取得帮助列表, 默认取全部
	 * @param array $ids
	 * @return array 
	 */
	public function get_type_list($ids = array())
	{
		$list = array();
		
		$typeList = HelpType::model()->get_list($ids);
		
		if (empty($typeList))
			return $list;

		$criteria = new CDbCriteria(array(
			'select' => 'type_id, title',
			'condition' => 'type_id !=' . HelpType::DEFAULT_TYPE_ID,
			'order' => 'type_id ASC, id ASC'
		));

		if (!empty($ids) && is_array($ids)) {
			$criteria->addInCondition('type_id', $ids);
		}
		
		$rows = $this->findAll($criteria);

		foreach($rows as $row) {
			if (isset($typeList[$row['type_id']])) {
				if (!isset($list[$row['type_id']])) {
					$list[$row['type_id']]['name'] = $typeList[$row['type_id']];
					$list[$row['type_id']]['help'] = array();
				}
				$list[$row['type_id']]['help'][] = $row;
			}
		}
		return $list;
	}
	
	/**
	 * return string 编辑url
	 */
	public function get_edit_url()
	{
		return Yii::app()->createUrl('help/help_edit', array(
			'id' => $this->id
		));
	}
	
	/**
	 * return string 删除url
	 */
	public function get_delete_url()
	{
		return Yii::app()->createUrl('help/help_delete', array(
			'id' => $this->id
		));
	}
	
	/**
	 * return string 类别URL
	 */
	public function get_type_url()
	{
		return Yii::app()->createUrl('help/index', array(
			'type_id' => $this->type_id
		));
	}
	
	
	/**
	 * 
	 * return string 返回编辑和删除链接
	 */
	public function get_operate_links()
	{
		return CHtml::link('编辑', $this->get_edit_url(),array('class'=>'operate_button')) . CHtml::link('删除', $this->get_delete_url(), array('onclick'=> 'return confirm("你确定要删除\"'. $this->title .'\"这个帮助文章吗？")','class'=>'operate_dbutton'));
	}
	

}
