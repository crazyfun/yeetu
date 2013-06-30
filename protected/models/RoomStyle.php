<?php

/**
 * This is the model class for table "{{room_style}}".
 *
 * The followings are the available columns in table '{{room_style}}':
 * @property string $id
 * @property string $room_style
 * @property string $room_style_desc
 * @property string $create_id
 * @property string $create_time
 */
class RoomStyle extends BaseActive
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
		return '{{room_style}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('room_style','required','message'=>'{attribute}不能为空'),
		  array('room_style',"exist_room_style"),
			array('room_style', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			array('room_style_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, room_style, room_style_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
			'room_style' => '房型名称',
			'room_style_desc' => '房型描述',
			'create_id' => '创建者',
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
		$criteria->compare('room_style',$this->room_style,true);
		$criteria->compare('room_style_desc',$this->room_style_desc,true);
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
    $room_style=$_REQUEST['room_style'];
    if(!empty($room_style)){
			 array_push($conditions,"room_style LIKE :room_style");
			 $params[':room_style']="%$room_style%";
			 $page_params['room_style']=$room_style;
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
			    'with'=>array("User"),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	

	

	
		//插入一笔旅游的数据
	public function insert_room_style(){
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
		//判断名称是否重复
	function exist_room_style(){
	   $id=$this->id;
		if(!empty($id)){
			$get_table_datas=$this->get_table_datas($id,array());
			if($get_table_datas->room_style!=$this->room_style){
				$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'room_style=:room_style',
         'params'=>array(':room_style' => $this->room_style),
        ));
			}
		}else{
			 $find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'room_style=:room_style',
         'params'=>array(':room_style' => $this->room_style),
        ));
		}
     if(!empty($find_datas)){
     	 $this->addError("room_style","房型名称已存在");
     }	
	}
	function get_room_style_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $validate_user_flag=Yii::app()->getController()->validate_user_operate($this->create_id);
		  if($validate_user_flag){
		   $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		   $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  }
		  return $return_str;
	}
	
	function get_room_style_select(){
		$room_style_datas=$this->get_table_datas();
		$select_room_style=array();
		foreach($room_style_datas as $key => $value){
			$select_room_style[$value->id]=$value->room_style;
		}
		return $select_room_style;
	}
}