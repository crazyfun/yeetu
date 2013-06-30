<?php

/**
 * This is the model class for table "{{hotels}}".
 *
 * The followings are the available columns in table '{{hotels}}':
 * @property string $id
 * @property string $hotel_name
 * @property string $hotel_city
 * @property string $hotel_information
 * @property string $hotel_facilities
 * @property string $hotel_booknotice
 * @property integer $hotel_type
 * @property integer $hotel_level
 * @property string $hotel_address_desc
 * @property string $hotel_address
 * @property string $hotel_img
 * @property string $create_id
 * @property string $create_time
 */
class Hotels extends BaseActive
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
		return '{{hotels}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hotel_name,hotel_city,hotel_information,hotel_type,hotel_level,hotel_url', 'required'),
			array('hotel_type, hotel_level', 'numerical', 'integerOnly'=>true),
			array('hotel_name, hotel_address, hotel_img,hotel_url', 'length', 'max'=>100),
			array('hotel_city, create_id, create_time', 'length', 'max'=>11),
			array('hotel_information, hotel_facilities, hotel_booknotice, hotel_address_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hotel_name, hotel_city, hotel_information, hotel_facilities, hotel_booknotice, hotel_type, hotel_level, hotel_address_desc, hotel_address, hotel_img, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '酒店ID',
			'hotel_name' => '酒店名称',
			'hotel_url' =>'酒店链接',
			'hotel_city' => '酒店所在城市',
			'hotel_information' => '酒店信息',
			'hotel_facilities' => '酒店设施',
			'hotel_booknotice' => '预订须知',
			'hotel_type' => '酒店类型',
			'hotel_level' => '酒店星级',
			'hotel_address_desc' => '酒店地理位置',
			'hotel_address' => '酒店详细地址',
			'hotel_img' => '酒店图片',
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
		$criteria->compare('hotel_name',$this->hotel_name,true);
		$criteria->compare('hotel_city',$this->hotel_city,true);
		$criteria->compare('hotel_information',$this->hotel_information,true);
		$criteria->compare('hotel_facilities',$this->hotel_facilities,true);
		$criteria->compare('hotel_booknotice',$this->hotel_booknotice,true);
		$criteria->compare('hotel_type',$this->hotel_type);
		$criteria->compare('hotel_level',$this->hotel_level);
		$criteria->compare('hotel_address_desc',$this->hotel_address_desc,true);
		$criteria->compare('hotel_address',$this->hotel_address,true);
		$criteria->compare('hotel_img',$this->hotel_img,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	

	
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$delete_datas=$this->get_table_datas($pk_id);
			$this->delete_hotel_image($pk_id,$delete_datas->hotel_img);
			$datas=$this->deleteByPk($pk_id,"",array());
		}else{
			 $delete_datas=$this->get_table_datas("",$condition);
			 foreach($delete_datas as $key => $value){
			 	 $this->delete_hotel_image($value->id,$value->hotel_img);
			 }
			 $com_condition=$this->com_condititions($condition);
       $datas=$this->deleteAll($com_condition['condition'],$com_condition['params']);
		}
		return $datas;
		
	}


		//插入一笔旅游的数据
	public function insert_hotel(){
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
	
	
 function delete_hotel_image($id,$image_src){
    $image_path=$this->get_image_path($id);
		Util::delete_file($image_src,$image_path);
		$trave_hotel_img=Util::rename_thumb_file(39,49,$image_path,$image_src);
		Util::delete_file($trave_hotel_img);
		$trave_hotel_img=Util::rename_thumb_file(120,90,$image_path,$image_src);
		Util::delete_file($trave_hotel_img);
	}
		//获得图片保存的路径
	function get_image_path($id=""){
		$hotel_id=empty($id)?$this->id:$id;
		if(!empty($hotel_id)){
		  $hotel_image_path="upload/hotels/".$hotel_id."/";
		  if(!is_dir($hotel_image_path)){
			 Util::makeDirectory($hotel_image_path);
		 }
		 return $hotel_image_path;
		}
	}

	//重命名文件名
	function rename_file($file_name){
		if(empty($file_name))
		   return;
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		array_push($implode_array,time());
		array_push($implode_array,end($explode_array));
	  return implode('.',$implode_array);
	}
	
	function get_hotel_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $validate_user_flag=Yii::app()->getController()->validate_user_operate($this->create_id);
		 if($validate_user_flag){
		   $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		   $return_str.=CHtml::link('房型管理',array("$controller_id/room","hotel_id"=>$this->id),array('class'=>'operate_button'));
		   $return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 }
		 return $return_str;
	}
	
	
	function get_trave_hotel_operate($trave_id){
		
		$controller_id=Yii::app()->getController()->getId();
		$trave=new Trave();
		$trave_datas=$trave->get_table_datas($trave_id);
		$default_hotel=$trave_datas->default_hotel;
		$is_package=$trave_datas->is_package;
		 $return_str="";
   
		if(!empty($is_package)){
			if($default_hotel!=$this->id){
		   $return_str.=CHtml::link('设为默认',array("$controller_id/hoteldefault","hotel_id"=>$this->id,'trave_id'=>$trave_id),array('class'=>'operate_button'));
		 }else{
		 	 $return_str.=CHtml::link('取消默认',array("$controller_id/hoteldefault","hotel_id"=>"",'trave_id'=>$trave_id),array('class'=>'operate_button'));
		  }
		}
		 
		 return $return_str;
	}

	function get_belong_user_name(){
		$get_datas=$this->with("User")->findByPk($this->id,"",array());
		$user_login=$get_datas->User->user_login;
		return $user_login;
	}
	
	
 function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}
	
	
		//获得酒店的图片
	function get_hotel_image(){
		  $image_path=$this->get_image_path();
		  $image_path="/".$image_path;
		  $trave_image_name=Util::rename_thumb_file(39,49,$image_path,$this->hotel_img);
		  $trave_big_image_name=Util::rename_thumb_file(120,90,$image_path,$this->hotel_img);
		  return CHtml::image($trave_image_name,$this->hotel_name,array("class"=>"hover_image","big_image"=>$trave_big_image_name,"id"=>"show_image_src"));
		  
	}
	//获得前台酒店图片
	function get_travel_hotel_image(){
			$image_path=$this->get_image_path();
			$image_path="/".$image_path;
		  $trave_big_image_name=Util::rename_thumb_file(120,90,$image_path,$this->hotel_img);
		  return CHtml::image($trave_big_image_name,$this->hotel_name,array("width"=>"120","height"=>"90"));
	}
	
	//得到酒店所在城市
	function get_hotel_city($hotel_city=""){
		   $hotel_city=empty($hotel_city)?$this->hotel_city:$hotel_city;
		   $hotel_city_name="";
		   $district_model=new District();
			 $district_datas= $district_model->findAll("id=:hotel_city",array(':hotel_city'=>$hotel_city));
			 foreach((array)$district_datas as $key => $value){
			 	if(empty($hotel_city_name)){
			 		$hotel_city_name=$value['district_name'];
			 	}
      }
      return $hotel_city_name;
      
	}
	
	function get_hotel_type(){
		$hotel_type=array('1'=>'国内','2'=>'国际');
		return $hotel_type[$this->hotel_type];
	}
	
	function get_hotel_level(){
		$hotel_level=CV::$HOTEL_LEVEL;
		return $hotel_level[$this->hotel_level];
		
	}
	
	
	function get_hotel_rooms($hotel_id=""){
		$hotel_id=empty($hotel_id)?$this->id:$hotel_id;
		$hotel_room=new HotelRoom();
		$condition['hotel_id']=$hotel_id;
		$hotel_room_datas=$hotel_room->get_table_datas("",$condition);
		return $hotel_room_datas;
		
	}
	
	
	function get_default_hotel_rooms($hotel_id=""){
		$hotel_id=empty($hotel_id)?$this->id:$hotel_id;
		$hotel_room=new HotelRoom();
		$condition['hotel_id']=$hotel_id;
		$condition['is_default']=1;
		$hotel_room_datas=$hotel_room->get_table_datas("",$condition);
		return $hotel_room_datas;
		
	}
	
	
	function get_trave_name($trave_id){
		$trave=new Trave();
		$trave_datas=$trave->get_table_datas($trave_id,array());
		return $trave_datas->trave_name;
	}
	
	
	
}