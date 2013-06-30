<?php

/**
 * This is the model class for table "{{infor_theme}}".
 *
 * The followings are the available columns in table '{{infor_theme}}':
 * @property string $id
 * @property string $theme_name
 * @property string $create_id
 * @property string $create_time
 */
class InforTheme extends BaseActive
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
		return '{{infor_theme}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('theme_name', 'length', 'max'=>30),
			array('theme_name','exist_theme_name'),
			array('create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, theme_name, create_id, create_time', 'safe', 'on'=>'search'),
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
			'theme_name' => '主题名称',
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
		$criteria->compare('theme_name',$this->theme_name,true);
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

		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>'',
			    'params'=>array(),
			    'with'=>array("User"),

			),
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}
	
	
		//插入一笔旅游的数据
	public function insert_infor_theme(){
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
	
	//验证主题名称
	function exist_theme_name(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->theme_name!=$this->theme_name){
			 	 $find_datas=$this->find(array(
          'select'=>'theme_name',
          'condition'=>'theme_name=:theme_name',
          'params'=>array(':theme_name' => $this->theme_name),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'theme_name',
         'condition'=>'theme_name=:theme_name',
         'params'=>array(':theme_name' => $this->theme_name),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("theme_name","资讯主题已存在");
     }
	}
		function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}
	
	function get_infor_theme_select(){
	
		$infor_theme_datas=$this->get_table_datas();
		$select_theme=array();
		$select_theme['']='选择资讯主题';
		foreach($infor_theme_datas as $key => $value){
			$select_theme[$value->id]=$value->theme_name;
		}
		return $select_theme;
	}

	function get_infortheme_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/addtheme","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/deletetheme","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
		
	}
	
	
}