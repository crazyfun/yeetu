<?php

/**
 * This is the model class for table "{{traveimage}}".
 *
 * The followings are the available columns in table '{{traveimage}}':
 * @property string $id
 * @property string $trave_id
 * @property integer $trave_area_id
 * @property string $image_name
 * @property string $imagE_desc
 * @property string $image_src
 * @property integer $create_id
 * @property integer $create_time
 */
class Traveimage1 extends BaseActive
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
		return '{{traveimage1}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trave_id,trave_area_id,image_id','required'),
			array('trave_id,trave_area_id,image_id,create_id,create_time', 'numerical', 'integerOnly'=>true),
			array('trave_id','length','max'=>11),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id, trave_id, trave_area_id,image_id,create_id,create_time', 'safe', 'on'=>'search'),
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
			'Trave_area'=>array(self::BELONGS_TO,'Travearea','trave_area_id'),
			'Images'=>array(self::BELONGS_TO,'Images','image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '图片ID',
			'trave_id' => '线路名字',
			'trave_area_id' => '线路区域',
			'image_id'=>'图片',
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
		$criteria->compare('trave_id',$this->trave_id,true);
		$criteria->compare('trave_area_id',$this->trave_area_id);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('image_desc',$this->image_desc,true);
		$criteria->compare('image_src',$this->image_src,true);
		$criteria->compare('create_id',$this->create_id);
		$criteria->compare('create_time',$this->create_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
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
		$criteria=new CDbCriteria;
		$page_params=array();
		$page_params['trave_id']=empty($_REQUEST['trave_id'])?$this->trave_id:$_REQUEST['trave_id'];
		$page_params['trave_area_id']=empty($_REQUEST['trave_area_id'])?$this->trave_area_id:$_REQUEST['trave_area_id'];
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
				'condition'=>'t.trave_id=:trave_id AND t.trave_area_id LIKE :trave_area_id',
				'params'=>array(':trave_id'=>$this->trave_id,':trave_area_id'=>"$this->trave_area_id"),
				'with'=>array("Trave","Trave_area","Images"),
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
			$datas=$this->deleteByPk($pk_id,"",array());
		}else{
			$com_condition=$this->com_condititions($condition);
			$datas=$this->deleteAll($com_condition['condition'],$com_condition['params']);
		}
		return $datas;

	}



	//插入一笔旅游的数据
	public function insert_traveimage(){
		return $this->save();
	}
	
	public function insert_trave_area_image(){
		$trave_image_datas=$this->find(array('select'=>'id','condition'=>'trave_id=:trave_id AND trave_area_id=:trave_area_id AND image_id=:image_id','params'=>array(':trave_id'=>$this->trave_id,':trave_area_id'=>$this->trave_area_id,':image_id'=>$this->image_id)));
		if(!empty($trave_image_datas)){
			$update_datas['create_id']=Yii::app()->user->id;
			$update_datas['create_time']=Util::current_time('timestamp');
			$this->update_table_datas($trave_image_datas->id,$update_datas);
		}else{
			$this->save();
		}
	}
	
	public function get_trave_area_images($trave_id,$trave_area_id=""){
		$condition=array();
		$params=array();
		if(!empty($trave_id)){
			array_push($condition,"trave_id=:trave_id");
			$params[':trave_id']=$trave_id;
		}
		if(!empty($trave_area_id)){
			array_push($condition,"trave_area_id=:trave_area_id");
			$params[':trave_area_id']=$trave_area_id;
		}
		$trave_image_datas=$this->findAll(array('select'=>'image_id','condition'=> implode(" AND ",$condition),'params'=>$params,'order'=>'image_id ASC'));
		$return_array=array();
		foreach($trave_image_datas as $key => $value){
			array_push($return_array,$value->image_id);
		}
		return $return_array;
	}
	

/*
	function beforeSave(){
		if(parent::beforeSave()){
			$this->create_id=Yii::app()->user->id;
			$this->create_time=Util::current_time('timestamp');
			return true;
		}
	}
*/

	//获得线路区域
	function get_trave_area(){
		$trave_area_datas=$this->with("Trave_area")->findByPk($this->id,"",array());
		return $trave_area_datas->Trave_area()->trave_area;
	}
	//获得线路的图片
	function get_trave_image(){
		return $this->Images->get_image();
	}

	//获得用户操作选项
	function get_traveimage_operate(){
		$controller_id=Yii::app()->getController()->getId();
		$return_str="";
		$return_str.=CHtml::link("删除",array("$controller_id/deletetraveimage","id"=>$this->id,"trave_id"=>$this->trave_id,"trave_area_id"=>$this->trave_area_id),array('class'=>'operate_dbutton'));
		return $return_str;
	}

	//取得线路景区的搜索条件
	function get_trave_areas($trave_id){
		$trave_area=new Travearea();
		$trave_areas_datas=$trave_area->get_trave_area_op($trave_id);
		return $trave_areas_datas;
	}
}
