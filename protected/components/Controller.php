<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	
	public $token="";
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $description;
	public $keywords;
	public $user_error="";
	
	public $user_tag="";
  public $menu_tag="";
	
	function init_token(){
		
	}
	function get_token($form_name){
		if(empty($this->token))
	    $this->token=new Token();		
	 $token_key=$this->token->granteToken($form_name);
	 return $token_key;
	}
	
	function is_token($token_key,$form_name,$fromCheck){
		if(empty($this->token))
	    $this->token=new Token();
		$isToken=$this->token->isToken($token_key,$form_name,$fromCheck);
		$this->token->dropToken($_POST['token_key']);
		return $isToken;
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

  /**
    *设置页面标题
  */
    public function pt($aid=null,$datas=array()){
        $this->pageTitle = PT::_($this->id,$aid,$datas);
    }
	/**
     *设置页面描述
  */
	public function desc($str){
		$this->description= $str;
	}
	/**
     *设置页面关键字
     */
	 public function kw($str){
		$this->keywords=$str;
	 }

    /**
     *设置面包屑
     */
    public function bc($aid,$params=array()){
        $this->breadcrumbs = BC::_($this->id,$aid,$params);
    }
    
    
    //发布资源
    
    public function publish_assert($file,$file_type=""){
    	if(empty($file_type)){
    		$file_type="css";
    	}
    	if($file_type=="css"){
    		 $css=Yii::app()->getAssetManager()->publish(Yii::app()->getBasePath()."/../css/",true,-1,false);
         Yii::app()->clientScript->registerCssFile($css."/".$file.".".$file_type);
    	}else{
    		 $js=Yii::app()->getAssetManager()->publish(Yii::app()->getBasePath()."/../minijs/",true,-1,false);
         Yii::app()->clientScript->registerCssFile($js."/".$file.".".$file_type);
    	}
    }
    
	public function createUrl($route,$params=array(),$ampersand='&')
	{
     if($route==='')
			$route=$this->getId().'/'.$this->getAction()->getId();
		else if(strpos($route,'/')===false)
			$route=$this->getId().'/'.$route;
		if($route[0]!=='/' && ($module=$this->getModule())!==null)
			$route=$module->getId().'/'.$route;
	  $tem_route=$route;
	  
		$controller_array=explode("/",ltrim($tem_route,"/"));
		
	 $requestseo=CV::$REQUESTSEO;
	 $controller_name=$controller_array[0];
	 $action_name=$controller_array[1];

	 if(array_key_exists($controller_name,$requestseo)){
	 	 $action_array=$requestseo[$controller_name];
	 	 
	 	 if(in_array($action_name,$action_array)){
	 	 		if(empty($params['st'])){
	 	 			$params['st']=$this->trave_sregion_en_name;
	 	 		}
	 	}
	}

		return Yii::app()->createUrl(trim($route,'/'),$params,$ampersand);
		
	}
	
	
}
