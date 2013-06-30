<?php

/**
 * This is the model class for table "{{fenzhan}}".
 *
 * The followings are the available columns in table '{{fenzhan}}':
 * @property string $id
 * @property string $region_id
 * @property string $create_id
 * @property string $create_time
 */
class Cfenzhan extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Fenzhan the static model class
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
		return '{{cfenzhan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('region_id','required','message'=>'{attribute}不能为空'),
		  array('region_id',"exist_region_id"),
			array('region_id, create_id, create_time', 'length', 'max'=>11),
			array('status','length','max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, region_id, create_id, create_time', 'safe', 'on'=>'search'),
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
			'District'=>array(self::BELONGS_TO,'District','region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'region_id' => '分站名称',
			'create_id' => '创建者',
			'status'=>'发布状态',
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
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	public function searchdatas(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$conditions=array();
		$params=array();
		$page_params=array();
		$criteria=new CDbCriteria;
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time ASC";
  	$sort->params=$page_params;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>'',
			    'params'=>array(),
			    'with'=>array("User","District"),
			),
			'pagination'=>array(
              'pageSize'=>'20',
              'params'=> $page_params,
           ),
      'sort'=>$sort,
		));
	}
	
			//插入一笔旅游的数据
	public function insert_fenzhan(){
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
		function get_fenzhan_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  if($this->status=='1')
		    $return_str.=CHtml::link('不发布',array("$controller_id/status","id"=>$this->id,'status'=>''),array('class'=>'operate_button'));
		  else
		    $return_str.=CHtml::link('发布',array("$controller_id/status","id"=>$this->id,'status'=>'1'),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
	
			//判断名称是否重复
	function exist_region_id(){
	   $id=$this->id;
		if(!empty($id)){
			$get_table_datas=$this->get_table_datas($id,array());
			if($get_table_datas->region_id!=$this->region_id){
				$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'region_id=:region_id',
         'params'=>array(':region_id' => $this->region_id),
        ));
			}
		}else{
			 $find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'region_id=:region_id',
         'params'=>array(':region_id' => $this->region_id),
        ));
		}
     if(!empty($find_datas)){
     	 $this->addError("region_id","分站名称已存在");
     }	
	}
//得到分站的选择项
	function get_fenzhan_select(){
		$fenzhan_datas=$this->findAll();
		$fenzhan_select=array();
	  foreach($fenzhan_datas as $key => $value){
		  $fenzhan_select[$value->region_id]=$value->District->district_name;
	  }
	  return $fenzhan_select;
	}
	
	//得到分站的已发布的选择项
	function get_sfenzhan_select(){
		$fenzhan_datas=$this->findAll(array('condition'=>'status=:status','params'=>array(':status'=>'1')));
		$fenzhan_select=array();
	  foreach($fenzhan_datas as $key => $value){
		  $fenzhan_select[$value->region_id]=$value->District->district_name;
	  }
	  return $fenzhan_select;
	}
	//得到分站的搜索项
	function get_fenzhan_search(){
		$fenzhan_datas=$this->findAll();
		$fenzhan_select['']="出发地";
	  foreach($fenzhan_datas as $key => $value){
		  $fenzhan_select[$value->region_id]=$value->District->district_name;
	  }
	  return $fenzhan_select;
	}
	//得到登录是分站的选择项
	function get_fenzhan_login(){
		$fenzhan_datas=$this->findAll();
		$fenzhan_select['0']="主站";
	  foreach($fenzhan_datas as $key => $value){
		  $fenzhan_select[$value->region_id]=$value->District->district_name;
	  }
	  return $fenzhan_select;
	}
	//得到权限分站的选择项
	function get_fenzhan_permissions(){
		$user_id=Yii::app()->user->id;
		$user_datas=User::model()->get_table_datas($user_id);
		$permissions_type=$user_datas->permissions_type;
		if($permissions_type){
			$fenzhan_datas=$this->findAll(array('condition'=>'region_id=:region_id','params'=>array(':region_id'=>$permissions_type)));
		}else{  
		  $fenzhan_datas=$this->findAll();
		}
		$fenzhan_select=array();
	  foreach($fenzhan_datas as $key => $value){
		  $fenzhan_select[$value->region_id]=$value->District->district_name;
	  }
	  return $fenzhan_select;
	}
	
	
		//得到权限分站的搜索项
	function get_fenzhan_permissions_search(){
		$user_id=Yii::app()->user->id;
		$user_datas=User::model()->get_table_datas($user_id);
		$permissions_type=$user_datas->permissions_type;
		if($permissions_type){
			$fenzhan_datas=$this->findAll(array('condition'=>'region_id=:region_id','params'=>array(':region_id'=>$permissions_type)));
		}else{  
		  $fenzhan_datas=$this->findAll();
		}
		$fenzhan_select['']="出发地";
	  foreach($fenzhan_datas as $key => $value){
		  $fenzhan_select[$value->region_id]=$value->District->district_name;
	  }
	  return $fenzhan_select;
	}
	
	
	//获得发布的状态
	function get_status(){
		 $fenzhan_status=CV::$FENZHAN_STATUS;
		 $status=$this->status;
		 return $fenzhan_status[$status];
	}
	
}
?>