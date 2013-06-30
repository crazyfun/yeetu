<?php

/**
 * This is the model class for table "{{traveroute}}".
 *
 * The followings are the available columns in table '{{traveroute}}':
 * @property string $id
 * @property string $trave_id
 * @property integer $route_day
 * @property string $trave_route
 * @property string $route_describe
 * @property string $route_flight
 * @property string $route_stay
 * @property string $route_dining
 * @property string $create_id
 * @property string $create_time
 */
class Traveroute extends BaseActive
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
		return '{{traveroute}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_day,trave_route,route_describe,route_stay,route_dining', 'required'),
			array('route_day', 'numerical', 'integerOnly'=>true),
			array('route_day',"exist_route_day"),
			array('trave_id, create_id, create_time', 'length', 'max'=>11),
			array('route_flight, route_dining', 'length', 'max'=>30),
			array('trave_route','length','max'=>'100'),
			array('route_stay','length','max'=>100),
			array('route_describe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_id, route_day, trave_route, route_describe, route_flight, route_stay, route_dining, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '行程ID',
			'trave_id' => '线路名称',
			'route_day' => '第几天',
			'trave_route' => '途径',
			'route_describe' => '行程详细介绍',
			'route_flight' => '参考航班',
			'route_stay' => '住宿',
			'route_dining' => '餐饮',
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
		$criteria->compare('route_day',$this->route_day);
		$criteria->compare('trave_route',$this->trave_route,true);
		$criteria->compare('route_describe',$this->route_describe,true);
		$criteria->compare('route_flight',$this->route_flight,true);
		$criteria->compare('route_stay',$this->route_stay,true);
		$criteria->compare('route_dining',$this->route_dining,true);
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
		
		$page_params=array();
	  $page_params['trave_id']=empty($_REQUEST['trave_id'])?$this->trave_id:$_REQUEST['trave_id'];
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.route_day ASC";
  	$sort->params=$page_params;
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>'t.trave_id=:trave_id',
			    'params'=>array(':trave_id'=>$this->trave_id),
			    'with'=>array("Trave"),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}
	


	
		//插入一笔旅游的数据
	public function insert_traveroute(){
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

	public function exist_route_day(){
		$id=$this->id;
		if(!empty($id)){
			$get_table_datas=$this->get_table_datas($id,array());
			if($get_table_datas->route_day!=$this->route_day){
				$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'route_day=:route_day AND trave_id=:trave_id',
         'params'=>array(':route_day' => $this->route_day,':trave_id' => $this->trave_id),
        ));
			}
		}else{
		
			 $find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'route_day=:route_day AND trave_id=:trave_id',
         'params'=>array(':route_day' => $this->route_day,':trave_id' => $this->trave_id),
        ));
		}

     if(!empty($find_datas)){
     	 $this->addError("route_day","行程天数已存在");
     }
	}

  //获得线路的景区
    function get_trave_areas(){
     	 $travearea_model=new Travearea();
     	 $travearea_name="";
			 $travearea_datas=$travearea_model->findAll("FIND_IN_SET(id,'$this->trave_route')",array());
			 foreach((array)$travearea_datas as $key => $value){
			 	if(empty($travearea_name)){
			 		$travearea_name=$value['trave_area'];
			 	}else{
			 		$travearea_name.="->".$value['trave_area'];
			 	}
			 }
    	return $travearea_name;
    }
   //获得线路详细页的景区
   
   function get_trave_details_areas(){
   	  $travearea_model=new Travearea();
     	 $travearea_name="";
			 $travearea_datas=$travearea_model->findAll("FIND_IN_SET(id,'$this->trave_route')",array());
			 foreach((array)$travearea_datas as $key => $value){
			 	if(empty($travearea_name)){
			 		$travearea_name="<span>".$value['trave_area']."</span>";
			 	}else{
			 		$travearea_name.="<span class='wj_startdate'><img src='/css/images/plane.gif'></span>".$value['trave_area'];
			 	}
			 }
    	return $travearea_name;
  }
    
  //获取线路详细页景区的图片
  
  function get_trave_area_image(){
  	$trave_image=new Traveimage();
  	$trave_area=$this->trave_route;
  	$trave_area_explode=explode(",",$trave_area);
  	$return_str="";
  	foreach((array)$trave_area_explode as $key => $value){
  		$condition=array();
  		$trave_images_datas=$trave_image->with("Images")->findAll(array('select'=>'t.*','condition'=>'trave_area_id=:trave_area_id AND trave_id=:trave_id','params'=>array(':trave_area_id'=>$value,':trave_id'=>$this->trave_id),'limit'=>'4'));
  		foreach((array)$trave_images_datas as $key1 => $value1){
  			
  			$image_path=$value1->Images->get_image_path();
  			$image_src=$value1->Images->image_src;
  			$image_name=$value1->Images->image_title;
  			$image_path="/".$image_path;
  			
  			$return_str.="<span class='trave_route_image'>
  			<div class='img_cut'>
  			   <a href=\"javascript:show_light_box('".$value1->id."');\"><img  src='".Util::rename_thumb_file(160,120,$image_path,$image_src)."'/></a>
  			   
  			</div>
  			<div class='travel_image_name'>".$image_name."</div>
  		</span>";
  		}
  	}
  	
  	return $return_str;
  	
  }
  
  
    function get_route_day(){
    	return "第 $this->route_day 天";
    }
		function get_traveroute_operate(){
			$controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/addtraveroute","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/deletetraveroute","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}
	
	
}