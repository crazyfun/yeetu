<?php
class TopMenu extends CWidget
{
	const HOME=1;
	const USER=2;
	const USER_MANAGEMENT=3;
	const CREDIT=4; //积分明细
	const CCONSUME=5; //抵押券明细
	const ROUTE=6;
	const PERIPHERAL=7;
	const DOMESTIC=8;
	const GROUP=9;
	const NATION=10;
	const ORDER=11;
	const ORDER_MANAGEMENT=12;
	const ORDER_FLIGHT=57;
	const ORDER_HOTEL=58;
	const PAY=13;
	const INSURANCE=14;
	const FREE=15;
	const FREETC=16;
	const FREETN=17;
	const OTHER=18;
	const DISTRICT=19;
	const CATEGORY=20;
	const HOTELS=21;
	const FLIGHTS=22;
	const ROOM=23;
	const COUPON=24;
	const EMAIL_TEMPLATE=25;
	const INSURANCE_MANAGEMENT=26;
	const NEWS=27;
	const NEWS_CATEGORY=28;
	const NEWS_LIST=29;
	const GCUSTOMIZE=30;
	const VENDOR=31;
	const SIGHTS=32;
	const AGENCY=33;
	const CICERONE=34;
	const HOTEL=35;
	const MOTORCADE=36;
	const FINANCIAL=37;
	const ORDER_FINANCIAL=38;
	const HELP=39;
	const HELP_LIST=40;
	const HELP_CATEGORY=41;
	const QA=42;
	const SYSTEM_CONFIG=43;
	const SYSTEM_V=44;
	const FOOTLINK=45;
	const RECYCLE=46;
	const FINAN_FIANCIAL = 47;
	const AD=48;
	const CONSULTING=49;
	const COMMENT=50;
	const AD_POSITION=51;
	const AD_FLASH=52;
	const HOTVIEW=53;
	const FRIENDLINK=54;
	const RIGHTS=55;
	const LOGOUT=56;
	const MARKET_STATISTICS=59;
	const SEARCH_S=60;
	const SURVEY_S=61;
	const PERMISSIONS=62;
	const SET_USERP=63;
	const SEMAIL_TEMPLATE=64;
	const SINSURANCE_MANAGEMENT=65;
	const SGCUSTOMIZE=67;
	const SQA=68;
	const SRECYCLE=69;
	const SCONSULTING=70;
	const SCOMMENT=80;
	const FENZHAN=81;
	const UCENTER=82;
	const IP_FILTER=83;
	const BBS=84;
  const BBS_THREADS=85;
  const IMAGES_MANAGE=86;
  const IMAGES=87;
  const IMAGESC=88;
  const TTHREADS=89;
  const DEFAULT_INDEX=90;
  const BATCH=91;
  const BATCH_EMAIL=92;
  const BATCH_PHONE=93;
  const BATCH_MESSAGE=94;
  
  const BATCH_IMPORT_PHONE=95;

	public function run(){

  	$permissions=new Permissions();
  	$user_permissions=$permissions->get_user_permissions();
  	if(Yii::app()->user->id=='1'){
  		$menus=$this->get_menus();
  	}else{
     $menus=$this->get_top_menus($user_permissions);
    }
    
    $json_menus=array();
    foreach($menus as $key => $value){
    	$json_menus[$key]['name']=$value['name'];
    	$json_menus[$key]['subitem']=array();
    	$subitem=$value['subitem'];
    	if(!empty($subitem)){
    	foreach($subitem as $key1 => $value1){
    		$tem_subitem=array();
    		$tem_subitem['id']=$key1;
    		$tem_subitem['name']=$value1['name'];
    		$tem_subitem['url']=Yii::app()->getController()->createUrl($value1['url'],array());
    		array_push($json_menus[$key]['subitem'],$tem_subitem);
    	}
    }
    }
    $menu_json=json_encode($json_menus);
  	$this->render("top_menu",array('menus'=>$menus,'menu_json'=>$menu_json));
	}

  public function get_top_menus($user_permissions){
  	$top_menus=$this->get_menus();
  	$fin_top_menus=array();

  	foreach($user_permissions as $key => $value){
  		$fin_top_menus[$key]['name']=$top_menus[$key]['name'];
  		$fin_top_menus[$key]['url']=$top_menus[$key]['url'];
  		$subitems=$value['subitem'];
  		if(!empty($subitems)){
  		  foreach($subitems as $key1=>$value1){
  			  $fin_top_menus[$key]['subitem'][$key1]=$top_menus[$key]['subitem'][$key1];
  		  }
  		 }
  	}
  	
  	return $fin_top_menus;
  	
  }


	static public function get_menus(){
		return array(
			self::HOME=>array('name'=>'首页',
			  'subitem'=>array(
          self::DEFAULT_INDEX=>array('name'=>'首页','url'=>'/site/default','item'=>'SiteDefault'),
			     
			  ),
			),
			self::USER=>array('name'=>'用户',
				'subitem'=>array(
					self::USER_MANAGEMENT=>array('name'=>'用户管理','url'=>'/user/index','item'=>'UserIndex,UserActive,UserAdd,UserDelete,UserEditcoupon,UserEditcredit,UserSearch,UserSetadmin'),
					self::CREDIT=>array('name'=>'积分明细','url'=>'/user/credit','item'=>'UserCredit'),
					self::CCONSUME=>array('name'=>'抵用劵明细','url'=>'/user/cconsume','item'=>'UserCconsume'),
				),
			),

			self::ROUTE=>array('name'=>'线路',
				'subitem'=>array(
					self::PERIPHERAL=>array('name'=>'周边游','url'=>'/peripheral/index','item'=>'PeripheralAdd,PeripheralAddperipheral,PeripheralAddtravearea,PeripheralAddtravedate,PeripheralAddtraveimage,PeripheralAddtraveroute,PeripheralAjaxtarea,PeripheralBargain,PeripheralClosetravearea,PeripheralClosetravedate,PeripheralDelete,PeripheralDeletetravearea,PeripheralDeletetravedate,PeripheralDeletetraveimage,PeripheralDeletetraveroute,PeripheralDistrict,PeripheralIndex,PeripheralInserttravearea,PeripheralInserttravedate,PeripheralInserttraveimage,PeripheralInserttraveroute,PeripheralLine,PeripheralOpentravearea,PeripheralOpentravedate,PeripheralPublish,PeripheralRecommend,PeripheralRecycle,PeripheralSearch,PeripheralSearchtravearea,PeripheralSearchtravedate,PeripheralSubdistrict,PeripheralSubline,PeripheralTravearea,PeripheralTravedate,PeripheralTraveimage,PeripheralTraveroute,PeripheralHot'),
					self::DOMESTIC=>array('name'=>'国内游','url'=>'/domestic/index','item'=>'DomesticAdd,DomesticAdddomestic,DomesticAddtravearea,DomesticAddtravedate,DomesticAddtraveimage,DomesticAddtraveroute,DomesticAjaxtarea,DomesticBargain,DomesticClosetravearea,DomesticClosetravedate,DomesticDelete,DomesticDeletetravearea,DomesticDeletetravedate,DomesticDeletetraveimage,DomesticDeletetraveroute,DomesticDistrict,DomesticIndex,DomesticInserttravearea,DomesticInserttravedate,DomesticInserttraveimage,DomesticInserttraveroute,DomesticLine,DomesticOpentravearea,DomesticOpentravedate,DomesticPublish,DomesticRecommend,DomesticRecycle,DomesticSearch,DomesticSearchtravearea,DomesticSearchtravedate,DomesticSubdistrict,DomesticSubline,DomesticTravearea,DomesticTravedate,DomesticTraveimage,DomesticTraveroute,DomesticHot'),
					self::GROUP=>array('name'=>'跟团游','url'=>'/group/index','item'=>'GroupAdd,GroupAddgroup,GroupAddtravearea,GroupAddtravedate,GroupAddtraveimage,GroupAddtraveroute,GroupAjaxtarea,GroupBargain,GroupClosetravearea,GroupClosetravedate,GroupDelete,GroupDeletetravearea,GroupDeletetravedate,GroupDeletetraveimage,GroupDeletetraveroute,GroupDistrict,GroupIndex,GroupInserttravearea,GroupInserttravedate,GroupInserttraveimage,GroupInserttraveroute,GroupLine,GroupOpentravearea,GroupOpentravedate,GroupPublish,GroupRecommend,GroupRecycle,GroupSearch,GroupSearchtravearea,GroupSearchtravedate,GroupSubdistrict,GroupSubline,GroupTravearea,GroupTravedate,GroupTraveimage,GroupTraveroute,GroupHot'),
					self::NATION=>array('name'=>'境外游','url'=>'/nation/index','item'=>'NationAdd,NationAddnation,NationAddtravearea,NationAddtravedate,NationAddtraveimage,NationAddtraveroute,NationAjaxtarea,NationBargain,NationClosetravearea,NationClosetravedate,NationDelete,NationDeletetravearea,NationDeletetravedate,NationDeletetraveimage,NationDeletetraveroute,NationDistrict,NationIndex,NationInserttravearea,NationInserttravedate,NationInserttraveimage,NationInserttraveroute,NationLine,NationOpentravearea,NationOpentravedate,NationPublish,NationRecommend,NationRecycle,NationSearch,NationSearchtravearea,NationSearchtravedate,NationSubdistrict,NationSubline,NationTravearea,NationTravedate,NationTraveimage,NationTraveroute,NationHot'),
					self::FREETC=>array('name'=>'国内机+酒','url'=>'/freetc/index','item'=>'FreetcAdd,FreetcAddfreetc,FreetcAddtravearea,FreetcAddtravedate,FreetcAddtraveflight,FreetcAddtraveimage,FreetcAjaxtarea,FreetcBargain,FreetcClosetravearea,FreetcClosetravedate,FreetcClosetraveflight,FreetcDelete,FreetcDeletetravearea,FreetcDeletetravedate,FreetcDeletetraveflight,FreetcDeletetraveimage,FreetcDistrict,FreetcHoteldefault,FreetcIndex,FreetcInserttravearea,FreetcInserttravedate,FreetcInserttraveflight,FreetcInserttraveimage,FreetcLine,FreetcOpentravearea,FreetcOpentravedate,FreetcOpentraveflight,FreetcPublish,FreetcRecommend,FreetcRecycle,FreetcSearch,FreetcSearchth,FreetcSearchtravearea,FreetcSearchtravedate,FreetcSearchtraveflight,FreetcSubdistrict,FreetcSubline,FreetcTravearea,FreetcTravedate,FreetcTraveflight,FreetcTravehotels,FreetcTraveimage,FreetcHot'),
					self::FREETN=>array('name'=>'国际机+酒','url'=>'/freetn/index','item'=>'FreetnAdd,FreetnAddfreetn,FreetnAddtravearea,FreetnAddtravedate,FreetnAddtraveflight,FreetnAddtraveimage,FreetnAjaxtarea,FreetnBargain,FreetnClosetravearea,FreetnClosetravedate,FreetnClosetraveflight,FreetnDelete,FreetnDeletetravearea,FreetnDeletetravedate,FreetnDeletetraveflight,FreetnDeletetraveimage,FreetnDistrict,FreetnHoteldefault,FreetnIndex,FreetnInserttravearea,FreetnInserttravedate,FreetnInserttraveflight,FreetnInserttraveimage,FreetnLine,FreetnOpentravearea,FreetnOpentravedate,FreetnOpentraveflight,FreetnPublish,FreetnRecommend,FreetnRecycle,FreetnSearch,FreetnSearchth,FreetnSearchtravearea,FreetnSearchtravedate,FreetnSearchtraveflight,FreetnSubdistrict,FreetnSubline,FreetnTravearea,FreetnTravedate,FreetnTraveflight,FreetnTravehotels,FreetnTraveimage,FreetnHot'),
				),
			),
			self::ORDER=>array('name'=>'订单',
				'subitem'=>array(
					self::ORDER_MANAGEMENT=>array('name'=>'订单管理','url'=>'/order/index','item'=>'OrderAdd,OrderAdminpay,OrderDelete,OrderIndex,OrderSearch,OrderSeparate,OrderStatus,OrderView'),
					self::PAY=>array('name'=>'付款信息管理','url'=>'/order/pay','item'=>'OrderPay,OrderSearchpay'),
					self::INSURANCE=>array('name'=>'订单保险信息','url'=>'/order/insurance','item'=>'OrderInsurance,OrderSearch1'),
					self::ORDER_FLIGHT=>array('name'=>'订单航班管理','url'=>'/order/orderhf','item'=>'OrderOrderhf'),
					self::ORDER_HOTEL=>array('name'=>'订单酒店管理','url'=>'/order/orderhh','item'=>'OrderOrderhh'),
				),
			),
      
			self::OTHER=>array('name'=>'单项产品',
				'subitem'=>array(
					self::DISTRICT=>array('name'=>'线路区域','url'=>'/district/index','item'=>'DistrictAdd,DistrictAdddistrict,DistrictDelete,DistrictIndex,DistrictSearch,DistrictSubdistrict'),
					self::CATEGORY=>array('name'=>'线路分类','url'=>'/category/index','item'=>'CategoryAdd,CategoryAddcategory,CategoryDelete,CategoryIndex,CategorySearch,CategorySubcategory'),
					self::HOTELS=>array('name'=>'酒店管理','url'=>'/hotels/index','item'=>'HotelsAdd,HotelsAddhotel,HotelsAddroom,HotelsDefaultroom,HotelsDelete,HotelsDeleteroom,HotelsIndex,HotelsRoom,HotelsSearch'),
					self::FLIGHTS=>array('name'=>'航班管理','url'=>'/flights/traveflight','item'=>'FlightsAddtraveflight,FlightsDeletetraveflight,FlightsInserttraveflight,FlightsSearchtraveflight,FlightsTraveflight'),
					self::ROOM=>array('name'=>'酒店房型管理','url'=>'/roomstyle/index','item'=>'RoomstyleAdd,RoomstyleDelete,RoomstyleIndex,RoomstyleSearch'),
					self::COUPON=>array('name'=>'抵用劵','url'=>'/coupon/index','item'=>'CouponAdd,CouponDelete,CouponIndex,CouponSearch'),
				),
			),
			
			self::GCUSTOMIZE=>array('name'=>'公司旅游',
			   'subitem'=>array(
			     self::SGCUSTOMIZE=>array('name'=>'公司旅游','url'=>'/gcustomize/index','item'=>'GcustomizeAdd,GcustomizeDelete,GcustomizeIndex,GcustomizeProcess,GcustomizeSearch'),
			   ),
			),
			
			self::VENDOR=>array('name'=>'供应商',
				'subitem'=>array(
					self::SIGHTS=>array('name'=>'景区管理','url'=>'/sights/index','item'=>'SightsAdd,SightsDelete,SightsIndex,SightsSearch'),
					self::AGENCY=>array('name'=>'旅行社管理','url'=>'/agency/index','item'=>'AgencyAdd,AgencyDelete,AgencyIndex,AgencySearch'),
					self::CICERONE=>array('name'=>'导游管理','url'=>'/cicerone/index','item'=>'CiceroneAdd,CiceroneDelete,CiceroneIndex,CiceroneSearch'),
					self::HOTEL=>array('name'=>'酒店管理','url'=>'/hotel/index','item'=>'HotelAdd,HotelDelete,HotelIndex,HotelSearch'),
					self::MOTORCADE=>array('name'=>'车队管理','url'=>'/motorcade/index','item'=>'MotorcadeAdd,MotorcadeAddcar,MotorcadeCar,MotorcadeDelete,MotorcadeDeletecar,MotorcadeIndex,MotorcadeInsertcar,MotorcadeSearch,MotorcadeSearchcar,MotorcadeSettle'),
				),
			),
			self::INSURANCE_MANAGEMENT=>array('name'=>'保险管理',
			   'subitem'=>array(
			      self::SINSURANCE_MANAGEMENT=>array('name'=>'保险管理','url'=>'/insurance/index','item'=>'InsuranceAdd,InsuranceDelete,InsuranceEdit,InsuranceIndex'),
			 ),
			),
			
			self::FINANCIAL=>array('name'=>'财务',
				'subitem'=>array(
					self::ORDER_FINANCIAL=>array('name'=>'订单财务','url'=>'/financial/order','item'=>'FinancialAdminfinan,FinancialOrder'),
					self::FINAN_FIANCIAL=>array('name'=>'结算信息','url'=>'/financial/finan','item'=>'FinancialFinan,FinancialSearchf'),
				),
			),
			

			self::MARKET_STATISTICS=>array('name'=>'市场统计',
			 'subitem'=>array(
				 self::SEARCH_S=>array('name'=>'搜索关键字维护','url'=>'/market/keywords','item'=>'MarketDeletek,MarketKeywords'),
				 self::SURVEY_S=>array('name'=>'在线调查','url'=>'/market/survey','item'=>'MarketDeletes,MarketSurvey'),

				),

			),
			
			self::NEWS=>array('name'=>'资讯',
				'subitem'=>array(
				  self::NEWS_LIST=>array('name'=>'资讯列表','url'=>'/tinfor/index','item'=>'TinforAdd,TinforDelete,TinforIndex,TinforPublish,TinforSearch'),
				  self::NEWS_CATEGORY=>array('name'=>'资讯分类','url'=>'/tinfor/theme','item'=>'TinforAddtheme,TinforDeletetheme,TinforTheme'),
				),
				
			),
			
			self::CONSULTING=>array('name'=>'在线咨询',
			   'subitem'=>array(
			     self::SCONSULTING=>array('name'=>'在线咨询管理','url'=>'/consulting/index','item'=>'ConsultingAdd,ConsultingDelete,ConsultingIndex,ConsultingSearch'),
			   ),
			  
			),
			
			self::COMMENT=>array('name'=>'用户评论',
			   'subitem'=>array(
			      self::SCOMMENT=>array('name'=>'用户评论管理','url'=>'/comment/index','item'=>'CommentAdd,CommentDelete,CommentIndex,CommentSearch,CommentShitcomment'),
			    ),
			    
			 ),
			 
			 self::QA=>array('name'=>'问答',
			  'subitem'=>array(
			    self::SQA=>array('name'=>'问答管理','url'=>'/qa/index','item'=>'QaCancel_best,QaClose,QaDelete_answer,QaDelete_question,QaEdit_answer,QaEdit_question,QaIndex,QaOpen,QaSearch,QaSetshit,QaSet_best,QaShitquestion,QaView'),
			  ),
			  
			),
			
			self::HELP=>array('name'=>'帮助',
				'subitem'=>array(
					self::HELP_LIST=>array('name'=>'帮助列表','url'=>'/help/index','item'=>'HelpHelp_add,HelpHelp_delete,HelpHelp_edit,HelpIndex'),
					self::HELP_CATEGORY=>array('name'=>'帮助分类','url'=>'/help/type_index','item'=>'HelpType_add,HelpType_delete,HelpType_edit,HelpType_index'),
				),
				
			),
			
			self::BBS=>array('name'=>'游记/攻略',
			  'subitem'=>array(
			     self::TTHREADS=>array('name'=>'线路游记/攻略','url'=>'/tthreads/index','item'=>'TthreadsAdd,TthreadsDelete,TthreadsIndex'),
			     self::BBS_THREADS=>array('name'=>'论坛游记/攻略','url'=>'/threads/index','item'=>'ThreadsAdd,ThreadsDelete,ThreadsIndex'),
			     
			  ),
			  
			),
			
			self::IMAGES_MANAGE=>array('name'=>'图片',
        'subitem'=>array(
           self::IMAGES=>array('name'=>'图片','url'=>'/images/index','item'=>'ImagesIndex,ImagesAdd,ImagesDelete'),
           self::IMAGESC=>array('name'=>'图片分类','url'=>'/images/category','item'=>'ImagesCategory,ImagesAddc,ImagesDeletec'),
        ),
        
      ),
			self::EMAIL_TEMPLATE=>array('name'=>'邮件模板',
			  'subitem'=>array(
			    self::SEMAIL_TEMPLATE=>array('name'=>'邮件模版管理','url'=>'/emailtemplates/index','item'=>'EmailtemplatesAdd,EmailtemplatesDelete,EmailtemplatesEdit,EmailtemplatesIndex'),
			
			 ),
			
			),
			
			self::BATCH=>array('name'=>'邮件/短信',
			  'subitem'=>array(
			    self::BATCH_IMPORT_PHONE=>array('name'=>'导入短信号码','url'=>'/batch/importp','item'=>'BatchImportp,BatchImportpEdit,BatchImportpDelete'),
			    self::BATCH_EMAIL=>array('name'=>'邮件管理','url'=>'/batch/email','item'=>'BatchEmail,BatchEdite,BatchDeletee'),
			    self::BATCH_PHONE=>array('name'=>'短信管理','url'=>'/batch/phone','item'=>'BatchPhone,BatchEditp,BatchDeletep'),
			    self::BATCH_MESSAGE=>array('name'=>'信息管理','url'=>'/batch/message','item'=>'BatchMessage,BatchView,BatchDeletem')
			 ),
			
			),
			
			self::PERMISSIONS=>array('name'=>'权限',
				'subitem'=>array(
				  //self::RIGHTS=>array('name'=>'权限管理','url'=>'/srbac'),
				  self::RIGHTS=>array('name'=>'权限管理','url'=>'/permissions/index','item'=>'PermissionsIndex,PermissionsSearch,PermissionsAdd,PermissionsDelete'),
				  self::SET_USERP=>array('name'=>'设置用户权限','url'=>'/permissions/userindex','item'=>'PermissionsUserindex,PermissionsUsersearch,PermissionsSetadmin,PermissionsSetpermissions,PermissionsSetfp'),
				),
				
			),

			self::AD=>array('name'=>'广告',
			  'subitem'=>array(
			     self::AD_POSITION=>array('name'=>'广告位管理','url'=>'/ad/index','item'=>'AdAdd,AdDelete,AdIndex,AdSearch'),
			     self::AD_FLASH=>array('name'=>'首页flash广告管理','url'=>'/ad/flashindex','item'=>'AdFlashadd,AdFlashdelete,AdFlashindex'),
			     self::HOTVIEW=>array('name'=>'首页热景/主题管理','url'=>'/hotview/index','item'=>'HotviewAdd,HotviewDelete,HotviewIndex'), 
			  ),
			),
			
			self::SYSTEM_CONFIG=>array('name'=>'系统设置',
				'subitem'=>array(
				  self::SYSTEM_V=>array('name'=>'系统变量设置','url'=>'/system/index','item'=>'SystemAdd,SystemIndex,SystemDelete,SystemSearch'),
				  self::FOOTLINK=>array('name'=>'底部链接','url'=>'/footlink/index','item'=>'FootlinkAdd,FootlinkDelete,FootlinkIndex,FootlinkSearch'),
				  self::FRIENDLINK=>array('name'=>'友情链接','url'=>'/friend/index','item'=>'FriendAdd,FriendDelete,FriendIndex'),
				  self::IP_FILTER=>array('name'=>'限制IP','url'=>'/ip_filter/index','item'=>'Ip_filterAdd,Ip_filterDelete,Ip_filterIndex'),
				  self::FENZHAN=>array('name'=>'分站设置','url'=>'/setfenzhan/index','item'=>'SetfenzhanAdd,SetfenzhanDelete,SetfenzhanIndex,SetfenzhanStatus'),
				),
			),

			self::RECYCLE=>array('name'=>'回收站',
			  'subitem'=>array(
			    self::SRECYCLE=>array('name'=>'线路回收站','url'=>'/recycletrave/index','item'=>'RecycletraveDelet,RecycletraveIndex,RecycletraveRestore,RecycletraveSearch'),
			  ),
			  
			)

		);
	}
	//不需要进行权限控制的
	static function get_default_access(){
		return array('ErrorError404','ErrorError403','SiteImagecode','SiteIndex','SiteLogin','SiteLogout','MainAddistrict','MainAjaxtarea','MainAjaxorder','MainClone','MainMessage','MainImportp','MainCompeleteflight','MainCompeletesuppliers','MainCompeletetrave','MainCompeleteuser','MainDistrict','MainLine','MainSubdistrict','MainSubLine','MainSubtravehotel','MainTravedate','MainTraveflight','MainTravehotel','MainTravehotels','MainImport','MainExport','OrderOrderprint','ImagesTraveimage');
		
	}
}

