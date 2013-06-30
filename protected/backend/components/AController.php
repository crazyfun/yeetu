<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
 
class AController extends CController{
	//面包屑
	public $breadcrumbs=array();

	//操作
	public $operation=array();
	
	
  public function FilteraccessControl($filterChain) {
  	
    $controller_id=$this->id;
    $action_id=$this->action->id;
    $access_operation=ucfirst($controller_id).ucfirst($action_id);
    $default_access=TopMenu::get_default_access();
    if(!in_array($access_operation,$default_access)){
		 if(!Yii::app()->user->checkAccess($access_operation))
     {
        $this->redirect($this->createUrl("error/error403"));
     }
    }
    
		$filterChain->run();
	
	}
	
    /**
     * 设置成功的提示信息
     */
   public function sf($msg){
        Yii::app()->user->setFlash(CV::SUCCESS,$msg);
    }

    /**
     * 设置失败的提示信息
     */
    public function ff($msg){
        Yii::app()->user->setFlash(CV::FAIL,$msg);
    }

    /**
     * 设置提示性的提示信息
     */
    public function tf($msg){
        Yii::app()->user->setFlash(CV::TIP,$msg);
    }

    public function check_login($msg_code="",$return_type="",$params=array()){ 
        if(Yii::app()->user->isGuest){
        	  if(!empty($msg_code)){
               $this->f($msg_code);
            }
            if(strlen($return_type)){
             $url_array=array();
             array_push($url_array,CV::$RETURN_URL[$return_type]);
             $url_array=array_merge($url_array,$params);
           
             Yii::app()->user->returnUrl=$url_array;
            }
            
            
            $this->redirect(array("site/login"));
        }
    }


	//判断是否需要搜索登录者ID
	public function validate_search_user(){
		  $user_id=Yii::app()->user->id;
		  $user_datas=User::model()->get_table_datas($user_id);
		  $permissions_type=$user_datas->permissions_type;
		  if($permissions_type){
		  	return "create_id='".$user_id."'";
		  }
	}
	
	//判断是否需要显示当前分站的的线路
	public function validate_sregion(){
		
		 $user_id=Yii::app()->user->id;
		  $user_datas=User::model()->get_table_datas($user_id);
		  $permissions_type=$user_datas->permissions_type;
		if($permissions_type){
      return "trave_sregion=$permissions_type";
		}
	}
	
	//根据创建着ID和登录ID的permissions_type判断数据是否显示
	
	public function validate_user_permissions_type(){
		  $user_id=Yii::app()->user->id;
		  $user_datas=User::model()->get_table_datas($user_id);
		  $permissions_type=$user_datas->permissions_type;
		if($permissions_type){
      return "permissions_type=$permissions_type";
		}
	}
  //根据创建着ID和登录ID的permissions_type判断数据是否可以操作
  public function validate_user_operate($validate_id){
  
  	$user=new User();
  	$user_id=Yii::app()->user->id;
  	$validate_user_datas=$user->get_table_datas($validate_id);
  	$user_datas=$user->get_table_datas($user_id);
  	if($user_datas->permissions_type){
  		if($user_datas->permissions_type!=$validate_user_datas->permissions_type){
  			return false;
  		}else{
  			return true;
  		}
  		
  	}else{
  		return true;
  	}
  }
  

	
	//初始化需要的数据
	function init_page(){
		$this->layout="none";
		Util::reset_vars();
	}
	public function bc($params){
		$this->breadcrumbs=$params;
	}
}
?>
