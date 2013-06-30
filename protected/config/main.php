<?php

// uncomment the following to define a path alias
//Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//require_once(dirname(__FILE__)."/../components/Util.php");
//require_once(dirname(__FILE__)."/../extensions/ipconvert/IpConvert.php");
//require_once(dirname(__FILE__)."/../models/Trave.php");
//require_once(dirname(__FILE__)."/../models/District.php");
//session_start();
//$sregion_session=$_SESSION['sregion_datas'];
//if(empty($sregion_session)){
	//$sregion_session=array('id'=>'59','name'=>'上海市','en_name'=>'shs');
//}
//$en_name=$sregion_session['en_name'];

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'_易途旅行网',
  'homeUrl'=>'http://yeetu.bxtrip.cn',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.qa.*',
		'application.components.*',
		'application.components.widgets.*',
		'application.components.payment.*',
		'application.components.qa.*',
		'application.extensions.image.*',
		'application.extensions.phpmail.*',
		'application.extensions.ipconvert.*',
		'application.extensions.LinkListPager.*',
		'application.extensions.yiidebugtb.*',
		'application.helpers.*',
	),

	'language'=>'zh_cn',
    'theme'=>'default',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Wneddr!Gt@Vza9Iu1W2eer',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('site/login'),
		),
	/*
        'cache'=>array(
            'class'=>'system.caching.CMemCache',
                'servers'=>array(
                   array('host'=>'192.168.1.100', 'port'=>12000, 'weight'=>60),
                   //array('host'=>'server2', 'port'=>11211, 'weight'=>40),
                ),
        ),
	
      */
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix'=>'.html',
			'showScriptName'=>false,
			'rules'=>array(
			 "<st>/site/index"=>"site/index",
			 '<st>/travel/detail/<id>/<n>'=>'travel/detail',
			 '<st>/travel/detail/<id>'=>'travel/detail',
			 '<st>/travel/detail/<id>/<n>/<sr>'=>'travel/detail',
			 '<st>/travel/detail/<id>/<n>/<con>'=>'travel/detail',
			 '<st>/travel/detail/<id>/<con>'=>'travel/detail',
			 '<st>/travel/detail/<id>/<n>/<tc>'=>'travel/detail',
			 '<st>/travel/detail/<id>/<tc>'=>'travel/detail',
			 "<st>/travel/zhoubianyou"=>'travel/peripheral',
			 "<st>/travel/guoneiyou"=>'travel/domestic',
			 "<st>/travel/chujingyou"=>'travel/nation',
			 "<st>/travel/zizhuyou"=>'travel/free',
			 "<st>/travel/tuanduiyou"=>'travel/group',
			 "<st>/travel/tejia"=>'travel/bargain',
			 
			 //"traveinfor/details/<id>"=>'traveinfor/details',
			 // "traveinfor/details/<id>/<n>"=>'traveinfor/details',
			 //"help/index/<cid>/*"=>'help/index',
			 //"statics/index/<cid>/*"=>'statics/index',
			 //"register/repeatactive/<user_id>"=>'register/repeatactive',
			 //"qa/view/<id>"=>'qa/view',
			 //"qa/category/<id>"=>'qa/category',
			 //"qa/self/<user_id>"=>'qa/self',
			 //"user/repeatactive/<user_id>"=>'user/repeatactive',
			 //"search/index/<pub_sort>/<trave_route_number>/<budget>/<trave_characteristic>/<advance_flag>/<did>/<tcid>/<pdid>/<trave_sregion>/<trave_region>/<trave_name>"=>"search/index",
       //"search/index/<order_sort>/<trave_route_number>/<budget>/<trave_characteristic>/<advance_flag>/<did>/<tcid>/<pdid>/<trave_sregion>/<trave_region>/<trave_name>"=>"search/index",
       //$en_name."/search/index/<time_sort>/<trave_route_number>/<budget>/<trave_characteristic>/<advance_flag>/<did>/<tcid>/<pdid>/<trave_sregion>/<trave_region>/<trave_name>"=>"search/index",
       //$en_name."/search/index/<did>/<pdid>/<tcid>"=>"search/index",
       //$en_name."/search/index/<did>/<tcid>"=>"search/index",
			 //$en_name."/search/index/cf/<trave_sregion>"=>"search/index",
			 //$en_name."/search/index/fl/<tcid>"=>"search/index",
			 //$en_name."/search/index/md/<did>"=>'search/index',
			 //$en_name."/search/index/ts/<trave_characteristic>"=>'search/index',
			 //'http://'.$en_name.'.yeetu2.com/index.php/travel/detail'=>'travel/detail',
			 // '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		
			),
			
		),

		// uncomment the following to use a MySQL database
		'db'=>array(
		  'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=zhongyuan',
			'emulatePrepare'=> true,
			'username' => 'zhongyuan',
			'password' => 'zhongyuan@2013',
			'charset' => 'utf8',
			'tablePrefix'=>'yt_',
			'schemaCachingDuration'=>3600,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'error/error404',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning,trace',
				),
				
                array( // configuration for the toolbar
                    'class'=>'XWebDebugRouter',
                    'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle', 
                    'levels'=>'error, warning, trace, profile, info',
                    'allowedIPs'=>array('127.0.0.1','::1','192.168.1.54','192\.168\.1[0-5]\.[0-9]{3}'),
                ),
                
                                
	/*
								 array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace',     //级别为trace
                    'categories'=>'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句
          
                 ),
                 
                 */
           
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
    'request'=>array(
          'enableCookieValidation'=>true,
        	'enableCsrfValidation'=>false,
        ),
		'session'=>array(
			'class'=>'CDbHttpSession',
			'connectionID' => 'db',
            'sessionTableName' => 'dbsession',
		),

		'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
           
            'driver'=>'GD',
            
        ),
	),

 'params'=>array(
		
    'phone_name'=>"",
    'phone_password'=>"",
		// this is used in contact page
		'pal_account'=>'',
		'pal_passwd' =>'',
		'pal_sign' => '',
		'pal_return'=>'travel/palreturn',
		'pal_cancel'=>'travel/palcancel',
		//alipay
		'seller_email' =>'',
		'partner' => '',
		'security_code' => '',
		'_input_charset' => 'UTF-8',
		'sign_type' => 'MD5',
		'transport' => 'https',
		'notify_url' => 'travel/alinotify',
		'return_url' => 'travel/alireturn',
		'show_url'  => 'http://yeetu.bxtrip.cn',
		//yeepay
		'merID' => '10001054067',
		//'merID' => '10000432521',
		'merchantKey' => '02HYb381TI9S6xl45w77bG2i7uwKSyR947H8036zb0vW3vCr1Sz1A60l7I61',
		

	),
	
/*
	'clientScript'=>array(
     'scriptMap'=>array(
      'global.css'=>'/assets/56c897c1/global.css',
     ),
   ),
*/


);
