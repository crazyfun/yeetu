<?php

/**
 * This is the model class for table "{{permissions}}".
 *
 * The followings are the available columns in table '{{permissions}}':
 * @property string $id
 * @property string $permissions_name
 * @property string $permissions_value
 * @property string $create_id
 */
class Permissions extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Permissions the static model class
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
		return '{{permissions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('permissions_name,permissions_value','required','message'=>'{attribute}不能为空'),
		  array('permissions_name','exist_permissions_name'),
			array('permissions_name', 'length', 'max'=>100),
			array('permissions_value', 'length', 'max'=>200),
			array('create_id,create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, permissions_name, permissions_value, create_id,create_time', 'safe', 'on'=>'search'),
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
			'id' => '权限ID',
			'permissions_name' => '权限名称',
			'permissions_value' => '权限值',
			'create_id' => '创建人',
			'create_time'=>'创建时间',
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
		$criteria->compare('permissions_name',$this->permissions_name,true);
		$criteria->compare('permissions_value',$this->permissions_value,true);
		$criteria->compare('create_id',$this->create_id,true);

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
    $permissions_name=$_REQUEST['permissions_name'];
    	if(!empty($permissions_name)){
			 array_push($conditions,"permissions_name LIKE :permissions_name");
			 $params[':permissions_name']="%$permissions_name%";
			 $page_params['permissions_name']=$permissions_name;
		}
		
		$validate_search_user=Yii::app()->getController()->validate_search_user();
		if(!empty($validate_search_user)){
			 array_push($conditions,$validate_search_user);
		}
		$criteria=new CDbCriteria;
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id ASC";
  	$sort->params=$page_params;
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
	public function insert_permissions(){
		if(!$this->hasErrors()){
				$datas=$this->save();
			  return $datas;
		}
	}
	

	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->permissions_name=Yii::app()->user->getName()."_".$this->permissions_name;
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
	function exist_permissions_name(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->permissions_name!=$this->permissions_name){
			 	 $find_datas=$this->find(array(
          'select'=>'permissions_name',
          'condition'=>'permissions_name=:permissions_name',
          'params'=>array(':permissions_name' => $this->permissions_name),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'permissions_name',
         'condition'=>'permissions_name=:permissions_name',
         'params'=>array(':permissions_name' => $this->permissions_name),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("permissions_name","权限名字重复");
     }
	}
	
	
	function get_permissions_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	//获取权限组的名称
	function get_permissions_value(){
		$permissions_value=$this->permissions_value;
		$auther_operation=$this->get_auther_subitem();
		$permissions_value_array=explode(",",$permissions_value);
		$permissions_value_name="";
		foreach($permissions_value_array as $key => $value){
			if(empty($permissions_value_name)){
				$permissions_value_name=$auther_operation[$value]['name'];
			}else{
				$permissions_value_name.=",".$auther_operation[$value]['name'];
			}
		}
		return $permissions_value_name;
	}

	
  //得到权限配置项的子项
	 function get_auther_subitem(){
		$auther_operation=TopMenu::get_menus();
		$subitem_array=array();
		foreach($auther_operation as $key => $value){
			$auther_subitem=$value['subitem'];
			foreach($auther_subitem as $key1 => $value1){
				$subitem_array[$key1]=$value1;
			}
			
		}
		return $subitem_array;
	}
	
	//获得用户的权限数组
	function get_user_permissions(){
		$user_id=Yii::app()->user->id;
		$user_permissions=array();
		if($user_id=='1'){
			$user_permissions=TopMenu::get_menus();
		}else{
		  $permissions=User::model()->get_user_permissions($user_id);
		  $permissions_datas=$this->findAll(array('select'=>'id,permissions_value','condition'=>"FIND_IN_SET(id,:permissions)>0",'params'=>array(':permissions'=>$permissions)));
		  foreach($permissions_datas as $key => $value){
		  	  $tem_user_permissions=$this->match_permissions_value($value->permissions_value);
		  	  foreach($tem_user_permissions as $key1 => $value1){
		  	  	$auther_subitem=$value1['subitem'];
		 	      foreach($auther_subitem as $key2 => $value2){
		 	      	$user_permissions[$key1]['name']=$value1['name'];
		 	      	$user_permissions[$key1]['subitem'][$key2]=$value2;
		 	      }
		  	  }
		  }
		}
		return $user_permissions;
	}
	
	//根据permissions_value得到权限的数组 用户用户分配他所拥有的权限
	function match_permissions_value($permissions_value){
		 $permissions_value=explode(",",$permissions_value);
		 $auther_operation=TopMenu::get_menus();
		 $match_permissions=array();
		 foreach($auther_operation as $key => $value){
		 	 $auther_subitem=$value['subitem'];
		 	 foreach($auther_subitem as $key1 => $value1){
		 	 	  if(in_array($key1,$permissions_value)){
		 	 	  	$match_permissions[$key]['name']=$value['name'];
		 	 	  	$match_permissions[$key]['subitem'][$key1]=$value1;
		 	 	  }
		 	 }
		}
		return $match_permissions;
	}
	
	//获得用户设置的权限
	function get_user_setpermissions($user_id=""){
		$user_id=empty($user_id)?Yii::app()->user->id:$user_id;
		$permission_datas=$this->get_table_datas("",array('create_id'=>$user_id));
		$return_permissions=array();
		foreach($permission_datas as $key => $value){
			$return_permissions[$value->id]=$value->permissions_name;
		}
		return $return_permissions;
		
	}
	
	//设置用户权限
	function set_user_permissions($user_id,$permissions_ids){
		$auth=Yii::app()->authManager;
		$roles_array=$auth->getRoles($user_id);
		$roles_array_keys=array_keys($roles_array);
		$permissions_names=array();
		foreach($permissions_ids as $p_key => $p_value){
			$permissions_id=$p_value;
		  $permissions_datas=$this->get_table_datas($permissions_id);
		  $permissions_name=$permissions_datas->permissions_name;
		  array_push($permissions_names,$permissions_name);
			$is_assigned_flag=$auth->isAssigned($permissions_name,$user_id);
		  if(!$is_assigned_flag){
		  	$auth->assign($permissions_name,$user_id);
		  }
		}
		$diff_roles_array=array_diff($roles_array_keys,$permissions_names);
	  foreach($diff_roles_array as $key => $value){
		   $auth->revoke($value,$user_id);
	  }
	
	
	}
	
	
	function set_permissions($permissions_name,$permissions_ids){
		 $auth=Yii::app()->authManager;
		 $authitems=$auth->getAuthItems('2');
		 $authitems_keys=array_keys($authitems);
		 $operations_array=$auth->getOperations();
		 $operations_array_keys=array_keys($operations_array);
		 $auther_subitem=$this->get_auther_subitem();
		 if(in_array($permissions_name,$authitems_keys)){
		 	 $role=$authitems[$permissions_name];
		 }else{
		   $role=$auth->createRole($permissions_name);
		 }
		 $permissions_name_child=$auth->getItemChildren($permissions_name);
		 $operation_array_keys=array_keys($permissions_name_child);
		 $operation_names=array();
		foreach($permissions_ids as $p_key => $p_value){
			 $permissions_item=$auther_subitem[$p_value]['item'];
			 $permissions_item_name=$auther_subitem[$p_value]['name'];
			 $permissions_item_array=explode(",", $permissions_item);
			 foreach($permissions_item_array as $key1 => $value1){
			 	 array_push($operation_names,$value1);
			 	 if(!in_array($value1,$operations_array_keys)){
			 	    $auth->createOperation($value1,$permissions_item_name);
			   }
			   $item_child_flag=$auth->hasItemChild($permissions_name,$value1);
			   if(!$item_child_flag){
			 	    $role->addChild($value1);
			 	 }
			}
	  }
	  $diff_operation_array=array_diff($operation_array_keys,$operation_names);
	  foreach($diff_operation_array as $key => $value){
		   $auth->removeItemChild($permissions_name,$value);
	  }
	}
	
}