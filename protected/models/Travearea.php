<?php

/**
 * This is the model class for table "{{travearea}}".
 *
 * The followings are the available columns in table '{{travearea}}':
 * @property string $id
 * @property string $trave_id
 * @property string $trave_area
 * @property integer $trave_status
 * @property string $create_id
 * @property string $create_time
 */
class Travearea extends BaseActive
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
		return '{{travearea}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trave_status', 'safe'),
			array('trave_status', 'numerical', 'integerOnly'=>true),
			array('trave_id, create_id, create_time', 'length', 'max'=>11),
			array('trave_area', 'length', 'max'=>50),
			array('trave_area','required'),
			array('trave_area','exit_trave_area'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_id, trave_area, trave_status, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'Trave'=>array(self::BELONGS_TO, 'Trave', 'trave_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '区域ID',
			'trave_id'=>'线路名称',
			'trave_area' => '区域名',
			'trave_status' => '区域状态',
			'create_id' => '创建人',
			'create_time' => '创建时间',
		);
	}



    public function primaryKey()
    {
       return 'id';
    // 对于复合主键，要返回一个类似如下的数组
    // return array('pk1', 'pk2');
   }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchdatas()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	  $page_params=array();
	  $page_params['trave_id']=empty($_REQUEST['trave_id'])?$this->trave_id:$_REQUEST['trave_id'];
	  $page_params['trave_area']=empty($_REQUEST['trave_area'])?$this->trave_area:$_REQUEST['trave_area'];
	  
	  
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>'t.trave_id=:trave_id AND t.trave_area LIKE :trave_area',
			    'params'=>array(':trave_id'=>$this->trave_id,':trave_area'=>"%$this->trave_area%"),
			    'with'=>array("Trave"),

			),
			
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=>$page_params,
      ),
       'sort'=>$sort,
		));
	}
	



	
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
		  $trave_image=new Traveimage();
		  $image_condition=array("trave_area_id"=>$pk_id);
		  $trave_image->delete_table_datas("",$image_condition);
			$datas=$this->deleteByPk($pk_id,"",array());
		}else{
			 $trave_areas=$this->get_table_datas("",$condition);
			 $trave_image=new Traveimage();
			 foreach($trave_areas as $key => $value){
			 	 $image_condition=array("trave_area_id"=>$value->id);
			 	 $trave_image->delete_table_datas("",$image_condition);
			 }
			 $com_condition=$this->com_condititions($condition);
       $datas=$this->deleteAll($com_condition['condition'],$com_condition['params']);
		}
		return $datas;
		
	}

		//插入一笔旅游的数据
	public function insert_travearea(){
		if(!$this->hasErrors()){
        $datas=$this->save();
			  return $datas;
		}
	}
	

	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				  $this->trave_status=1;
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
	public function exit_trave_area(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->trave_area!=$this->trave_area){
			 	 $find_datas=$this->find(array(
          'select'=>'id',
          'condition'=>'trave_area=:trave_area AND trave_id=:trave_id',
          'params'=>array(':trave_area' => $this->trave_area,':trave_id' => $this->trave_id),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'trave_area=:trave_area AND trave_id=:trave_id',
         'params'=>array(':trave_area' => $this->trave_area,':trave_id' => $this->trave_id),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("trave_area","线路区域已存在");
     }
	}

		function get_travearea_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/addtravearea","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_button'));
		 if($this->trave_status == '1')
		   $return_str.=CHtml::link("关闭",array("$controller_id/closetravearea","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_button'));
		 else
		   $return_str.=CHtml::link("启用",array("$controller_id/opentravearea","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("添加景区图片",array("$controller_id/traveimage","trave_id"=>$this->trave_id,'trave_area_id'=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/deletetravearea","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}
	
	function get_trave_area_op($trave_id){
		$condition['trave_id']=$trave_id;
		$condition['trave_status']='1';
		$datas=$this->get_table_datas("",$condition);
		$trave_area_op=array();
		foreach($datas as $key => $value){
			$trave_area_op[$value->id]=$value->trave_area;
			
		}
		return $trave_area_op;
	}
	
		function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}

}