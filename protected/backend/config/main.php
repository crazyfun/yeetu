<?php
$fenzhan=dirname(dirname(__FILE__));
$frontend=dirname($fenzhan);
Yii::setPathOfAlias('backend', $fenzhan);
$frontendArray=require($frontend.'/config/main.php');
$fenzhanArray=array(
    'name'=>'网站后台管理系统',
    'basePath' => $frontend,
    'controllerPath' => $fenzhan.'/controllers',
    'viewPath' => $fenzhan.'/../../themes/backend/views',
    'runtimePath' => $fenzhan.'/runtime',
	  'theme'=>'backend',
    // autoloading model and component classes
    'language'=>'zh',
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.components.widgets.*',
        'application.extensions.*',
		    'application.helpers.*',
		    'application.extensions.phpmail.*',
		    'application.extensions.LinkListPager.*',
		    'application.extensions.yiidebugtb.*',
		    'application.modules.*',
		    'application.modules.srbac.*',
		    'application.modules.srbac.controllers.*',
		    'application.modules.srbac.components.*',
        'backend.models.*',
        'backend.components.*', //这里的先后顺序一定要搞清
    ),

   'modules'=>array(
   /*
       'srbac'=>array(
           'userclass'=>'User',
           'userid'=>'id',
           'username'=>'user_login',
           'debug'=>false,
           'pageSize'=>25,
           'superUser'=>'admin',
           'css'=>'srbac.css',
           'layout'=>'webroot.themes.admin.views.layouts.main',
           'notAuthorizedView'=>'srbac.views.authitem.unauthorized',
           'alwaysAllowed'=>array(),
           //'userActions'=>array('show','View','List'),
           'listBoxNumberOfLines'=>15,
           'imagesPath'=>'srbac.images',
           'imagesPack'=>'noia',
           'iconText'=>false,
           'header'=>'srbac.views.authitem.header',
           'footer'=>'srbac.views.authitem.footer',
           'showHeader'=>true,
           'showFooter'=>true,
           'alwaysAllowedPath'=>'srbac.components',
       ),
       */
   ),
   

    'components'=>array(
    
	    'authManager'=>array(
         'class'=>'CDbAuthManager',//认证类名称
         'defaultRoles'=>array('guest'),//默认角色
         'itemTable' => 'yt_authitem',//认证项表名称
         'itemChildTable' => 'yt_authitemchild',//认证项父子关系
         'assignmentTable' => 'yt_authassignment',//认证项赋权关系
       ),
 
	   
		/*
		 'request'=>array(
            'enableCookieValidation'=>true,
        	'enableCsrfValidation'=>false,
        ),
		 */
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>true,
		)

    ),

    // main is the default layout
    //'layout'=>'main',
    // alternate layoutPath
    'layoutPath'=>dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'../../themes/backend/views'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR,
);
if(!function_exists('w3_array_union_recursive'))
{
    function w3_array_union_recursive($array1,$array2)
    {
        $retval=$array1+$array2;
        foreach($array1 as $key=>$value)
        {
            if(is_array($array1[$key]) && is_array($array2[$key]))
                $retval[$key]=w3_array_union_recursive($array1[$key],$array2[$key]);
        }
        return $retval;
    }
}

return w3_array_union_recursive($fenzhanArray,$frontendArray);
