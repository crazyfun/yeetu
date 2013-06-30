<?php
class Util{
    //过滤用户提交过来的值只能过滤到三维数组
    public static function reset_vars(){
      if(!empty($_REQUEST)){
        foreach((array)$_REQUEST as $key => $value){
            self::safe_var($key);
        }
      }
    }
    public static function safe_var($var,$var2=""){
    	if(strlen(strval($var2))){
    		 if(is_array($_REQUEST[$var][$var2])){
    		 	  foreach($_REQUEST[$var][$var2] as $key => $value){
    		 	  	$_REQUEST[$var][$var2][$key]=self::encode($value);
    		 	  }
    		}else{
           $_REQUEST[$var][$var2]=self::encode($_REQUEST[$var][$var2]);  
        }
    	}else{
         if(is_array($_REQUEST[$var])){
            foreach((array)$_REQUEST[$var] as $key => $value){
                self::safe_var($var,$key);
            }
         }else{
            $_REQUEST[$var]=self::encode($_REQUEST[$var]);
       }
     }
   }	
   
   public static function encode($val){
   	 $return_value=CHtml::encode($val);
     $return_value=stripSlashes($return_value);
     $return_value=trim($return_value);
     return $return_value;
   }
/*******************************************
    取得当前時間
********************************************/
    public static function current_time($type, $gmt = 0) {
        switch ($type) {
        case 'mysql' :
            if ($gmt)
                $d = gmdate('Y-m-d H:i:s');
            else
                $d = gmdate('Y-m-d H:i:s', time() + 28800);
            return $d;
            break;
        case 'timestamp' :
            if ($gmt)
                $d = time();
            else
                $d = time() + 28800;
            return $d;
            break;
        }
    }
    //取得左边显示的数组
    public static function get_permission_config(){
        return array(
            '1'=>array('name'=>'用户管理','url'=>'','parent_id'=>'','subitem'=>array('2'=>array('name'=>'用户管理','url'=>'/admin.php/user/index','parent_id'=>'1'),'33'=>array('name'=>'积分明细','url'=>'/admin.php/user/credit','parent_id'=>'1'),'37'=>array('name'=>'抵用劵明细','url'=>'/admin.php/user/cconsume','parent_id'=>'1'),'3'=>array('name'=>'权限管理','url'=>'','parent_id'=>'1'))),
            '4'=>array('name'=>'旅游线路','url'=>'','parent_id'=>'','subitem'=>array('5'=>array('name'=>'境外游','url'=>'/admin.php/nation/index','parent_id'=>'4'),'6'=>array('name'=>'周边游','url'=>'/admin.php/peripheral/index','parent_id'=>'4'),'7'=>array('name'=>'国内游','url'=>'/admin.php/domestic/index','parent_id'=>'4'),'8'=>array('name'=>'跟团游','url'=>'/admin.php/group/index','parent_id'=>'4'))),
            '40'=>array('name'=>'订单管理','url'=>'','parent_id'=>'','subitem'=>array('9'=>array('name'=>'订单管理','url'=>'/admin.php/order/index','parent_id'=>'40'),'41'=>array('name'=>'付款信息管理','url'=>'/admin.php/order/pay','parent_id'=>'41'))),
            '14'=>array('name'=>'自由行','url'=>'','parent_id'=>'','subitem'=>array('15'=>array('name'=>'国内机+酒','url'=>'/admin.php/freetc/index','parent_id'=>'14'),'16'=>array('name'=>'国际机+酒','url'=>'/admin.php/freetn/index','parent_id'=>'14'))),
            '10'=>array('name'=>'单项产品','url'=>'','parent_id'=>'','subitem'=>array('11'=>array('name'=>'线路区域','url'=>'/admin.php/district/index','parent_id'=>'10'),'12'=>array('name'=>'线路分类','url'=>'/admin.php/category/index','parent_id'=>'10'),'13'=>array('name'=>'酒店管理','url'=>'/admin.php/hotels/index','parent_id'=>'10'),'36'=>array('name'=>'抵用劵','url'=>'/admin.php/coupon/index','parent_id'=>'10'))),
            '17'=>array('name'=>'易途帮助','url'=>'','parent_id'=>'','subitem'=>array('18'=>array('name'=>'主题分类','url'=>'/admin.php/help/type_index','parent_id'=>'17'),'19'=>array('name'=>'帮助内容','url'=>'/admin.php/help/index','parent_id'=>'17'))),
            '20'=>array('name'=>'问答管理','url'=>'','parent_id'=>'','subitem'=>array('21'=>array('name'=>'问答列表','url'=>'/admin.php/qa/index','parent_id'=>'20'))),
        	  '22'=>array('name'=>'邮件模板管理', 'url'=>'', 'parent_id'=>'', 'subitem'=>array('23'=>array('name'=>'模板列表', 'url'=>'/admin.php/emailtemplates/index', 'parent_id'=>'22'))),
       		  '24'=>array('name'=>'保险管理', 'url'=>'', 'parent_id'=>'', 'subitem'=>array('25'=>array('name'=>'保险列表', 'url'=>'/admin.php/insurance/index', 'parent_id'=>'24'))),
			      '26'=>array('name'=>'广告管理', 'url'=>'', 'parent_id'=>'', 'subitem'=>array('27'=>array('name'=>'广告列表', 'url'=>'/admin.php/ad/index', 'parent_id'=>'26'))),
			      '28'=>array('name'=>'旅游资讯', 'url'=>'', 'parent_id'=>'', 'subitem'=>array('32'=>array('name'=>'资讯主题', 'url'=>'/admin.php/tinfor/theme', 'parent_id'=>'28'),'29'=>array('name'=>'旅游资讯', 'url'=>'/admin.php/tinfor/index', 'parent_id'=>'28'))),
			      '30'=>array('name'=>'在线咨询', 'url'=>'', 'parent_id'=>'', 'subitem'=>array('31'=>array('name'=>'在线咨询', 'url'=>'/admin.php/consulting/index', 'parent_id'=>'30'))),
			      '38'=>array('name'=>'用户评论', 'url'=>'', 'parent_id'=>'', 'subitem'=>array('39'=>array('name'=>'用户评论', 'url'=>'/admin.php/comment/index', 'parent_id'=>'38'))),
			      '34'=>array('name'=>'系统管理', 'url'=>'', 'parent_id'=>'', 'subitem'=>array(
						'35'=>array(
							'name'=>'系统变量管理', 'url'=>'/admin.php/system/index', 'parent_id'=>'34'),
						'36'=>array(
							'name'=>'底部链接管理', 'url'=>'/admin.php/footlink/index', 'parent_id'=>'34')
					)),
				  '35'=>array('name'=>'供应商管理', 'url'=>'', 'parent_id'=>'', 'subitem'=>array(
						'40'=>array(
							'name'=>'景区管理', 'url'=>'/admin.php/sights/index', 'parent_id'=>'35'),
						'41'=>array(
							'name'=>'旅行社管理', 'url'=>'/admin.php/travel_company/index', 'parent_id'=>'35'),
						'42'=>array(
							'name'=>'导游管理', 'url'=>'/admin.php/travel_guide/index', 'parent_id'=>'35'),
						'43'=>array(
							'name'=>'酒店管理', 'url'=>'/admin.php/hotel/index', 'parent_id'=>'35')
					)),

        );
    }
    
    /**
     * 
     * 取得广告的区域数组
     */
    public static function get_ad_areas()
    {

    	 return array(
    	  '' => array(
    			'label' => '选择广告位置',
    		),
    		
    '25' => array(
    			'label' => '首页左边-在线调查下面',
    			'width' => '300',
    			'height' => '130',
    		),
    		
    		
    '1' => array(
    			'label' => '首页中间--周边旅游路线热门推荐top',
    			'width' => '410',
    			'height' => '75',
    		),
		'2' => array(
    			'label' => '首页中间--国内旅游路线热门推荐top',
    			'width' => '410',
    			'height' => '75',
    		),
		'3' => array(
    			'label' => '首页中间--出境旅游路线热门推荐top',
    			'width' => '410',
    			'height' => '75',
    		),
		'4' => array(
    			'label' => '首页中间--自助旅游路线热门推荐top',
    			'width' => '410',
    			'height' => '75',
    		),
		'5' => array(
    			'label' => '首页中间--公司旅游路线热门推荐top',
    			'width' => '410',
    			'height' => '75',
    		),
    		
    		
		'6' => array(
    			'label' => '首页右边搜索--线路搜索下面',
    			'width' => '208',
    			'height' => '74',
    		),


		'9' => array(
    			'label' => '周边,国内,出境,自助,公司,特价线路右边搜索--线路搜索下面',
    			'width' => '208',
    			'height' => '74',
    		),
    		
    		
		'8' => array(
    			'label' => '周边旅游页左边--top',
    			'width' => '960',
    			'height' => '70',
    		),
    		

		'11' => array(
    			'label' => '国内旅游页左边--top',
    			'width' => '960',
    			'height' => '70',
    		),
    			

		'14' => array(
    			'label' => '出境旅游页左边--top',
    			'width' => '960',
    			'height' => '70',
    		),
    		
		'17' => array(
    			'label' => '自助旅游页左边--top',
    			'width' => '960',
    			'height' => '70',
    		),

		'18' => array(
    			'label' => '自助旅游页右边搜索--线路搜索下面',
    			'width' => '208',
    			'height' => '74',
    		),
		'20' => array(
    			'label' => '公司旅游页左边--top',
    			'width' => '960',
    			'height' => '70',
    		),

		'23' => array(
    			'label' => '特价旅游页左边--top',
    			'width' => '960',
    			'height' => '70',
    		),

		'24' => array(
    			'label' => '特价旅游页右边搜索--线路搜索下面',
    			'width' => '100',
    			'height' => '50',
    		),
    	);
    }
    //返回显示规律的月
    public static function get_regular_month(){
        return array('1'=>'每月','2'=>'一月','3'=>'二月','4'=>'三月','5'=>'四月','6'=>'五月','7'=>'六月','8'=>'七月','9'=>'八月','10'=>'九月','11'=>'十月','12'=>'十一月','13'=>'十二月');
    }

    //返回显示规律的日

    public static function get_regular_day(){
        return array('1'=>'天天','2'=>'星期一','3'=>'星期二','4'=>'星期三','5'=>'星期四','6'=>'星期五','7'=>'星期六','8'=>'星期天');
    }
    
    
    //返回酒店的星级
    public static function get_hotel_level(){
    	
    	return array('5'=>'五星','4'=>'四星','3'=>'三星','2'=>'二星','1'=>'一星');
    }
    
    //得到酒店的房型
    public static function get_room_name(){
    	return array('1'=>'标准间','2'=>'豪华间');
    }
    
    //得到酒店床型
    public static function get_room_bed(){
    	return array('1'=>'双床','2'=>'单床','3'=>'大/双床');
    }
    
    //得到酒店房型的居住人数
    public static function get_room_people(){
    	return array('1'=>'1人','2'=>'2人','3'=>'3人','4'=>'4人');
    }
    
    //得到酒店的早餐
    public static function get_room_dinning(){
    	return array('1'=>'无','2'=>'双早');
    }
    
    //得到酒店的宽带
    
    public static function get_room_broadband(){
    	return array('1'=>'免费','2'=>'收费','3'=>'无');
    }
    
    
    //是否是套餐
    
    public static function get_package(){
    	return array('1'=>'是','2'=>'不是');
    }
    
      //返回评论的选择项 
  public static function get_rating_values(){
  	return array('5'=>'很好','4'=>'好','3'=>'还行','2'=>'差','1'=>'很差');
  }
  
  //返回评论的搜索的选择项 
  public static function get_search_rating_values(){
  	return array(''=>'评分','5'=>'很好','4'=>'好','3'=>'还行','2'=>'差','1'=>'很差');
  }
  
  
  
  //获得预算的选择项
  public static function get_budget_datas(){
  	return array(''=>'预算','0-1000'=>'小于1000','1000-2000'=>'1000-2000元','2000-3000'=>'2000-3000元','3000-'=>'大于3000元');
  }
  
  //获得出行天数的搜索项
  public static function get_trave_route_number(){
  	return array(''=>'天数','1'=>'一天','2'=>'两天','3'=>'三天','4-6'=>'4天-6天','6-10'=>'6天-10天','10-'=>'大于10天');
  }
  
  //获得订单搜索的总价钱
  public static function get_order_price(){
  	  	return array(''=>'订单总价','0-1000'=>'小于1000','1000-2000'=>'1000-2000元','2000-3000'=>'2000-3000元','3000-'=>'大于3000元');

  }
  //获得订单的处理状态
  public static function get_order_status(){
  	return array(''=>'订单状态','1'=>'等待处理','2'=>'等待计调确认','3'=>'等待客服联系','4'=>'等待客户答复','5'=>'已发确认书','6'=>'转成正式订单','7'=>'已发团通知书','8'=>'取消订单');
  }
  
  //获得订单的预定状态
  public static function get_pay_status(){
  	return array(''=>'付款状态','1'=>'未付款','2'=>'已付款');
  }
  
  //获得支付方式
  public static function get_pay_style(){
  	return array(''=>'支付方式','1'=>'现金','2'=>'支付宝','3'=>'易宝','4'=>'汇款');
  }
  //获得线略的类别
  public static function get_trave_category(){
  	  	return array(''=>'线路类别','1'=>'出境游','2'=>'周边游','3'=>'国内游','4'=>'团队游','5'=>'自由行');
  }
  
  //获得下单方式
  public static function get_order_style(){
  	return array(''=>'下单方式','1'=>'网络预定','2'=>'电话预定','3'=>'门市预定');
  }
  
  //获得来源地
  public static function get_order_source(){
    return array(''=>'来源地','1'=>'网络','2'=>'报纸','3'=>'老客户','4'=>'朋友介绍','5'=>'传单');
  }
  
  //获得订单等级
  public static function get_order_level(){
    return array(''=>'订单等级','1'=>'加急','2'=>'急','3'=>'一般','4'=>'不急');
  }
  
  //获得在线调查
  public static function get_online_survey_datas(){
  	return array('1'=>'出游时间','2'=>'线路价格','3'=>'餐饮和住宿','4'=>'景点和行程安排','5'=>'导游讲解和服务');
  }
  
  //获得用户的等级
  public static function get_user_level(){
  	return array(''=>'用户等级','1'=>'普通会员','2'=>'高级会员','3'=>'黄金会员','4'=>'钻石会员');
  }
  
  //获得用户的等级搜索项
  public static function get_user_level_search(){
  	return array('1'=>'普通会员','2'=>'高级会员','3'=>'黄金会员','4'=>'钻石会员');
  }
  
  //获得积分类型
  public static function get_credit_type(){
  	return array(''=>'操作动作','1'=>'增加','2'=>'减少');
  }
  
  //获得消费类型
  public static function get_coupon_category(){
  	return array(''=>'消费类型','1'=>'使用抵用劵','2'=>'管理员修改','3'=>'购买线路');
  }
  
  //获得广告类型
  
  public static function get_ad_type(){
  	return array(
  	''=>'选择广告类型',
  	'1'=>'图片',
  	'2'=>'flash',
  	'3'=>'文字',
  	);
  	
  }
  
  
  //获取footer下的帮助信息ID
  public static function get_help_index_ids(){
  	return array(2, 3, 4, 5, 6);
  }
  
  
  //获得订单游客的证件类型
  public static function get_code_type(){
  	return array('1'=>'身份证','2'=>'护照','3'=>'港澳通行证','4'=>'台胞证','5'=>'军官证','6'=>'其他');
  }
  
  //获得国家列表
  public static function get_country_lists(){
  	     return array("ALB"=>"阿尔巴尼亚","AZE"=>"阿塞拜疆","AFG"=>"阿富汗","DZA"=>"阿尔及利亚","AGO"=>"安哥拉","ATG"=>"安提瓜","ARG"=>"阿根廷","AUS"=>"澳大利亚","AUT"=>"奥地利","BLR"=>"白俄罗斯","BEN"=>"贝宁","BDI"=>"布隆迪","BHS"=>"巴哈马","BHR"=>"巴林","BRB"=>"巴巴多斯","BEL"=>"比利时","BGD"=>"孟加拉","BIH"=>"波黑","BRA"=>"巴西","BRN"=>"文莱","BGR"=>"保加利亚","CMR"=>"喀麦隆","TCD"=>"乍得","CRI"=>"哥斯达黎加","KHM"=>"柬埔寨","CAN"=>"加拿大","CYM"=>"开曼群岛","CAF"=>"中非","CHL"=>"智利","CHN"=>"中国","COL"=>"哥伦比亚","COG"=>"刚果","CIV"=>"科特迪瓦","HRV"=>"克罗地亚",
								"CUB"=>"古巴","CYP"=>"塞浦路斯","CZE"=>"捷克","DJI"=>"吉布提","PRK"=>"朝鲜","DNK"=>"丹麦","DOM"=>"多米尼加共和国","ECU"=>"厄瓜多尔","GNQ"=>"赤道几内亚","EGY"=>"埃及","EST"=>"爱沙尼亚","ETH"=>"埃塞俄比亚","FJI"=>"斐济","FIN"=>"芬兰","FRA"=>"法国","PYF"=>"法属玻利尼","GEO"=>"格鲁吉亚","GNB"=>"几内亚比绍","GAB"=>"加蓬","DEU"=>"德国","GHA"=>"加纳","GRC"=>"希腊","GRD"=>"格林纳达","GUM"=>"危地马拉","GIN"=>"几内亚","GUY"=>"圭亚那","HND"=>"洪都拉斯","HKG"=>"中国香港","HUN"=>"匈牙利","ISL"=>"冰岛","IND"=>"印度","IDN"=>"印度尼西亚","IRN"=>"伊朗","IRQ"=>"伊拉克",
								"IRL"=>"爱尔兰","ISR"=>"以色列","ITA"=>"意大利","JAM"=>"牙买加","JPN"=>"日本","JOR"=>"约旦","KAZ"=>"哈萨克斯坦共和国","KEN"=>"肯尼亚","KOR"=>"韩国","KWT"=>"科威特","KGZ"=>"吉尔吉斯斯坦","LAO"=>"老挝","LBN"=>"黎巴嫩","LSO"=>"莱索托","LBR"=>"利比里亚","LBY"=>"利比亚","LIE"=>"列支敦士登","LTU"=>"立陶宛","LUX"=>"卢森堡","MLI"=>"马里","MOZ"=>"莫桑比克","MAC"=>"澳门","MDG"=>"马达加斯加","MWI"=>"马拉维","MYS"=>"马来西亚","MDV"=>"马尔代夫","MLT"=>"马耳他","MUS"=>"毛里求斯","MEX"=>"墨西哥","MNG"=>"蒙古","MAR"=>"摩洛哥","MMR"=>"缅甸","NPL"=>"尼泊尔","NLD"=>"荷兰",
								"NCL"=>"新喀里多尼亚","NZL"=>"新西兰","NIC"=>"尼加拉瓜","NER"=>"尼日尔","NGA"=>"尼日利亚","MNP"=>"北玛里亚纳群岛","NOR"=>"挪威","OMN"=>"阿曼","PAK"=>"巴基斯坦","PSE"=>"巴勒斯坦","PAN"=>"巴拿马","PNG"=>"巴布亚新几内亚","PRY"=>"巴拉圭","PER"=>"秘鲁","PHL"=>"菲律宾","POL"=>"波兰","PRT"=>"葡萄牙","PRI"=>"波多黎各","QAT"=>"卡塔尔","RWA"=>"卢旺达","SLE"=>"塞拉里昂共和国","ROU"=>"罗马尼亚","RUS"=>"俄罗斯","SRB"=>"塞尔维亚","LCA"=>"圣卢西亚","SAU"=>"沙特阿拉伯","SGP"=>"新加坡","SVK"=>"斯洛伐克","SVN"=>"斯洛文尼亚","SOM"=>"索马里","ZAF"=>"南非",
								"ESP"=>"西班牙","LKA"=>"斯里兰卡","SDN"=>"苏丹","SUR"=>"苏里南","SWE"=>"瑞典","CHE"=>"瑞士","SYR"=>"叙利亚","TJK"=>"塔吉克斯坦","TGO"=>"多哥","TWN"=>"中华台湾","TZA"=>"坦桑尼亚","THA"=>"泰国","LVA"=>"拉脱维亚","MKD"=>"马其顿","SEN"=>"塞内加尔共和国","SYC"=>"塞舌尔共和国","MDA"=>"摩尔多瓦共和国","TTO"=>"特立尼达和多巴哥","TUN"=>"突尼斯","TUR"=>"土耳其","TKM"=>"土库曼斯坦","TCA"=>"特克斯和凯科斯群岛","URY"=>"乌拉圭","UGA"=>"乌干达","UKR"=>"乌克兰","ARE"=>"阿联酋","GBR"=>"英国","USA"=>"美国","UZB"=>"乌兹别克斯坦","VEN"=>"委内瑞拉",
								"VNM"=>"越南","YEM"=>"也门","DRC"=>"扎伊尔","ZMB"=>"赞比亚","ZWE"=>"津巴布韦","BLZ"=>"伯利兹","AND"=>"安道尔","AIA"=>"安圭拉","ARM"=>"亚美尼亚","ANT"=>"荷属安的列斯","ATA"=>"南极洲","ASM"=>"美属萨摩亚","ABW"=>"阿鲁巴","ALA"=>"奥兰群岛","BFA"=>"布基纳法索","BLM"=>"圣巴泰勒米岛","BMU"=>"百慕大","BOL"=>"玻利维亚","BTN"=>"不丹","BVT"=>"布韦岛","BWA"=>"博茨瓦纳","CCK"=>"科科斯群岛","COD"=>"刚果（金）；刚果民主共和国","COK"=>"库克群岛","CPV"=>"佛得角","CXR"=>"圣诞岛","DMA"=>"多米尼克","ESH"=>"西撒哈拉","ERI"=>"厄立特里亚","FLK"=>"马尔维纳斯群岛（福克兰群岛）",
								"FSM"=>"密克罗尼西亚联邦","FRO"=>"法罗群岛","GUF"=>"法属圭亚那","GGY"=>"格恩西岛","GIB"=>"直布罗陀","GRL"=>"格陵兰","GMB"=>"冈比亚","GLP"=>"瓜德罗普","SGS"=>"南乔治亚岛和南桑威奇群岛","GTM"=>"危地马拉","HMD"=>"赫德岛和麦克唐纳群岛","HTI"=>"海地","IMN"=>"马恩岛","IOT"=>"英属印度洋领地","JEY"=>"泽西岛","KIR"=>"基里巴斯","COM"=>"科摩罗","KNA"=>"圣基茨和尼维斯","MCO"=>"摩纳哥","MNE"=>"黑山","MAF"=>"法属圣马丁岛","MHL"=>"马绍尔群岛","MTQ"=>"马提尼克","MRT"=>"毛里塔尼亚","MSR"=>"蒙特塞拉特","NAM"=>"纳米比亚","NFK"=>"诺福克岛","NRU"=>"瑙鲁","NIU"=>"纽埃",
								"SPM"=>"圣皮埃尔和密克隆","PCN"=>"皮特凯恩群岛","PLW"=>"帕劳","REU"=>"留尼汪","SLB"=>"所罗门群岛","SHN"=>"圣赫勒拿","SJM"=>"斯瓦尔巴群岛和扬马延岛","SMR"=>"圣马力诺","STP"=>"圣多美和普林西比","SLV"=>"萨尔瓦多","SWZ"=>"斯威士兰","ATF"=>"法属南部领地","TKL"=>"托克劳","TLS"=>"东帝汶","TON"=>"汤加","TUV"=>"图瓦卢","UMI"=>"美国本土外小岛屿","VAT"=>"梵蒂冈","VCT"=>"圣文森特和格林纳丁斯","VGB"=>"英属维尔京群岛","VIR"=>"美属维尔京群岛","VUT"=>"瓦努阿图","WLF"=>"瓦利斯和富图纳","WSM"=>"萨摩亚","MYT"=>"马约特");
	  }
    //获取线路时间的选择项
    public static function get_trave_start_date($start_date){
        $explode_start_date=explode(",",$start_date);
        $return_date=array();
        if(strlen($explode_start_date[0])){
            $return_date['s']=$explode_start_date[0];
        }

        if(strlen($explode_start_date[1])){
            $return_date['m']=$explode_start_date[1];
        }

        if(strlen($explode_start_date[2])){
            $return_date['d']=$explode_start_date[2];
        }
        return $return_date;

    }
    //获取线路时间的显示字符串
    public static function get_trave_start_date_name($start_date){
        $explode_start_date=explode(",",$start_date);
        $return_date="";
        if(strlen($explode_start_date[0])){
            $return_date.=$explode_start_date[0]."&nbsp;&nbsp;";
        }

        if(strlen($explode_start_date[1])){
            $regular_month=self::get_regular_month();
            $return_date.=$regular_month[$explode_start_date[1]];
        }

        if(strlen($explode_start_date[2])){
            $regular_day=self::get_regular_day();
            $return_date.=$regular_day[$explode_start_date[2]];
        }
        return $return_date;
    }

    //建目录函数，其中参数$directoryName最后没有"/"，
    //要是有的话，以'/'打散为数组的时候，最后将会出现一个空值
    public static function makeDirectory($directoryName) {
        $directoryName = str_replace("\\","/",$directoryName);
        $dirNames = explode('/', $directoryName);
        $total = count($dirNames) ;
        $temp = '';
        for($i=0; $i < $total; $i++) {
            $temp .= $dirNames[$i].'/';
            if (!is_dir($temp)) {
                $oldmask = umask(0);
                if (!mkdir($temp, 0777)) exit("不能建立目录 $temp"); 
                umask($oldmask);
            }
        }
        return true;
    }
    
    //删除文件
    public static function delete_file($file_name,$file_path=""){
    	$file=$file_path.$file_name;
    	if(is_file($file)&&file_exists($file)){
    		unlink($file);
    	}
    }

    //组合搜索语句 	
    public static function com_search_condition($com_search_value=array()){
        $return_search_condition="";
        foreach((array)$com_search_value as $key => $value){
            if(strlen($value)){
                $search_value=$key;
                $return_search_condition.=str_replace("w%",$value,$search_value)."&nbsp;&nbsp;";
            }
        }
        return $return_search_condition;
    }


    //格式化货币
    public static function fc($c) {
        return Yii::app ()->numberFormatter->formatCurrency ( $c, "¥");
    }

    //hash内容
    public static function hc($content, $salt=null) {
        if(strlen($salt)){
            return md5 ( $salt . md5 ( $content ) );
        }else {
            return md5($content);
        }
    }

    /*-------------------------------------------
     # 产生随机字串，可用来自动生成密码
     # 默认长度6位 字母和数字混合
     # $format ALL NUMBER CHAR 字串组成格式
     */
    public static  function randStr($len = 6, $format = 'ALL') {
        switch ($format) {
        case 'ALL' :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
            break;
        case 'CHAR' :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
            break;
        case 'NUMBER' :
            $chars = '0123456789';
            break;
        default :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        }
        mt_srand ( ( double ) microtime () * 1000000 * getmypid () );
        $password = "";
        while ( strlen ( $password ) < $len )
            $password .= substr ( $chars, (mt_rand () % strlen ( $chars )), 1 );
        return $password;
    }
    //判断是否为Email
    public static function ie($user_email) {
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if (strpos ( $user_email, '@' ) !== false && strpos ( $user_email, '.' ) !== false) {
            if (preg_match ( $chars, $user_email )) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //验证号码时候是手机号码或者电话号码$phone_type:All:全部验证 cell:手机 tele:座机 tc:小灵通
    public static function is_phone($user_phone,$phone_type='All'){
    	
    	switch($phone_type){
    		case 'tele':
    		    //座机验证规则
    	     $telephone=preg_match("/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/",$user_phone);
    	     if($telephone)
    	        return true;
    	     else
    	        return false;
    		   break;
    		case 'cell':
    		   //手机号码验证规则
    	    $cell_phone =preg_match("/(?:13\d{1}|1[548][0173689])\d{8}$/",$user_phone);
    	    if($cell_phone)
    	      return true;
    	    else
    	      return false;
    		   break;
    		case 'tc':
    		   	//小灵通验证规则
          	$tcphone=preg_match("/^1[3,5]\d{9}$/",$user_phone);
          	if($tcphone)
          	  return true;
          	else
          	  return false;
    		   break;
    		default:
    		   //手机号码验证规则
    	    $telephone=preg_match("/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/",$user_phone);
        	//座机验证规则
        	$cell_phone=preg_match("/(?:13\d{1}|1[548][0173689])\d{8}$/",$user_phone);
        	//小灵通验证规则
         	$tcphone=preg_match("/^1[3,5]\d{9}$/",$user_phone);
         	if($cell_phone||$telephone||$tcphone){
         		return true;
         	}else{
         		return false;
         	}
    		   break;
    	}
   }
   
 //验证邮编
 
 function validate_zip($user_zip){
 	$zip=preg_match("/^[0-9]{6}$/",$user_zip);
 	return $zip;
}
    
//验证省份证号码    
function validation_filter_id_card($id_card)
{
	  
		if(strlen($id_card) == 18)
		{
			return self::idcard_checksum18($id_card);
		}elseif((strlen($id_card) == 15)){
			$id_card = self::idcard_15to18($id_card);
			return self::idcard_checksum18($id_card);
		}else{
		  return false;
		}
		
 }
// 计算身份证校验码，根据国家标准GB 11643-1999
function idcard_verify_number($idcard_base)
{
	if(strlen($idcard_base) != 17)
	{
		return false;
	}
	//加权因子
	$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
	//校验码对应值
	$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
	$checksum = 0;
	for ($i = 0; $i < strlen($idcard_base); $i++)
	{
		$checksum += substr($idcard_base, $i, 1) * $factor[$i];
	}
	$mod = $checksum % 11;
	$verify_number = $verify_number_list[$mod];
	return $verify_number;
}
// 将15位身份证升级到18位
function idcard_15to18($idcard){
	if (strlen($idcard) != 15){
		return false;
	}else{
		// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
		if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
			$idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9);
		}else{
			$idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9);
		}
	}
	$idcard = $idcard . self::idcard_verify_number($idcard);
	return $idcard;
}
// 18位身份证校验码有效性检查
function idcard_checksum18($idcard){
	if (strlen($idcard) != 18){ return false; }
		$idcard_base = substr($idcard, 0, 17);
	if (self::idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
		return false;
	}else{
		return true;
	}
} 
    //写数据库时，对数据进行引用
    public static  function q($value) {
        return Yii::app ()->db->quoteValue ( $value );
    }

    // 截取中文字符串
    //$sourcestr 是要处理的字符串
    //$cutlength 为截取的长度(即字数)
    public static function cs($sourcestr, $cutlength) {
        $returnstr = '';
        $i = 0;
        $n = 0;
        $str_length = strlen ( $sourcestr ); //字符串的字节数
        while ( ($n < $cutlength) and ($i <= $str_length) ) {
            $temp_str = substr ( $sourcestr, $i, 1 );
            $ascnum = Ord ( $temp_str ); //得到字符串中第$i位字符的ascii码
            if ($ascnum >= 224) //如果ASCII位高与224，
            {
                $returnstr = $returnstr . substr ( $sourcestr, $i, 3 ); //根据UTF-8编码规范，将3个连续的字符计为单个字符
                $i = $i + 3; //实际Byte计为3
                $n ++; //字串长度计1
            } elseif ($ascnum >= 192) //如果ASCII位高与192，
            {
                $returnstr = $returnstr . substr ( $sourcestr, $i, 2 ); //根据UTF-8编码规范，将2个连续的字符计为单个字符
                $i = $i + 2; //实际Byte计为2
                $n ++; //字串长度计1
            } elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
            {
                $returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
                $i = $i + 1; //实际的Byte数仍计1个
                $n ++; //但考虑整体美观，大写字母计成一个高位字符
            } else //其他情况下，包括小写字母和半角标点符号，
            {
                $returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
                $i = $i + 1; //实际的Byte数计1个
                $n = $n + 0.5; //小写字母和半角标点等与半个高位字符宽...
            }
        }
        //与i相比较 字节数比较
        if ($str_length > $i) {
            $returnstr = $returnstr . "..."; //超过长度时在尾处加上省略号
        }
        return $returnstr;
    }



  //PHP获取字符串中英文混合长度

  function strLength($sourcestr,$charset=''){
  	$str_length = mb_strlen($sourcestr,'UTF8'); //字符串的字节数
  	return $str_length;
  	/*
      if($charset=='utf-8') $str = iconv('utf-8','gb2312',$str);
    $num = strlen($str);
    $cnNum = 0;
    for($i=0;$i<$num;$i++){
        if(ord(substr($str,$i+1,1))>127){
            $cnNum++;
            $i++;
        }
    }
    
    $enNum = $num-($cnNum*2);
    $number = ($enNum)+$cnNum*2;
    return ceil($number);
    */
    
    /*
     $i = 0;
    if($charset=='utf-8'){
    	  $sourcestr = iconv('utf-8','gb2312',$sourcestr);
     }
     $str_length = strlen ( $sourcestr ); //字符串的字节数
     while ( $i <= $str_length ) {
            $temp_str = substr ( $sourcestr, $i, 1 );
            $ascnum = Ord ( $temp_str ); //得到字符串中第$i位字符的ascii码
            
            if ($ascnum >= 224) //如果ASCII位高与224，
            {
               //根据UTF-8编码规范，将3个连续的字符计为单个字符
                $i = $i + 3; //实际Byte计为3
                
            } elseif ($ascnum >= 192) //如果ASCII位高与192，
            {
                 //根据UTF-8编码规范，将2个连续的字符计为单个字符
                $i = $i + 2; //实际Byte计为2
               
            } elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
            {
                $i = $i + 1; //实际的Byte数仍计1个
                
            } else //其他情况下，包括小写字母和半角标点符号，
            { 
                $i = $i + 1; //实际的Byte数计1个
            }
        }
      
        return ceil($i);
        */
 }
    /*----- session ------*/
    //setSession
    public static function ss($key,$value){
        Yii::app ()->session->add ( $key, $value );
    }

    //getSession
    public static function gs($key){
        return Yii::app ()->session [$key];
    }

    //unsetSesion
    public static function us($key){
        Yii::app ()->session->add ( $key, null );
    }


    //等比例剪切图片
    public static function cut_trave_image($width,$height,$image_path,$image_name){

        $image = Yii::app()->image->load($image_path.$image_name);
        $image->resize($width, $height);
        $image->save(self::rename_thumb_file($width,$height,$image_path,$image_name)); 
    }
    
    
     //剪切一定宽度和高度的图片
    public static function crop_trave_image($width,$height,$image_path,$image_name,$top = 'center', $left = 'center'){
        $image = Yii::app()->image->load($image_path.$image_name);
        $image->crop($width, $height, $top, $left);
        $image->save(self::rename_thumb_file($width,$height,$image_path,$image_name)); 
    }

    //重命名剪切的图片
    public static function rename_thumb_file($width,$height,$file_path,$file_name){
        $explode_array=explode(".",$file_name);
        $implode_array=array();
        $thumb_name=$file_path."_".$width."_".$height."_".$explode_array[0]."_thumb";
        array_push($implode_array,$thumb_name);
        array_push($implode_array,end($explode_array));
        return implode('.',$implode_array);
    }
    //获取客户端的IP
   function static getip(){
			if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
					$ip = getenv("HTTP_CLIENT_IP");
		  else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
					$ip = getenv("HTTP_X_FORWARDED_FOR");
			else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
					$ip = getenv("REMOTE_ADDR");
			else if (strlen($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
					$ip = $_SERVER['REMOTE_ADDR'];
			else
					$ip = "unknown";
			return($ip);
  } 
  
  //放大第一个字母
  public static function enlarge_first($string){
  	$string=substr_replace($string, "<span class='enlarge_font'>".$string[0]."</span>", 0, 1); 
  	return $string;
  }
    

  //得到评论的图片
  public static function get_rating_img($comment_total){
   switch($comment_total){
			 case '1':
			    return '<span class="item-rank-rst irr-star10"></span>';
			    break;
			 case '2':
			    return '<span class="item-rank-rst irr-star20"></span>';
			    break;
			 case '3':
			    return '<span class="item-rank-rst irr-star30"></span>';
			    break;
			 case '4':
			    return '<span class="item-rank-rst irr-star40"></span>';
			    break;
			 case '5':
			    return '<span class="item-rank-rst irr-star50"></span>';
			    break;
			 default:
			    return '<span class="item-rank-rst irr-star"></span>';
			    break;
		}
	}
    public static function ajax_msg($code,$msg,$params=array()){
        $result = array();
        $result['code'] = $code;
        $result["msg"] = $msg;
        if(empty($params)){
            $result['params'] = $params;
        }
        return json_encode($result);
    }
    /**
     *填写内容的时候登录返回页面的内容
     */
    public static function record_return_content($content){
        if(strlen($content)){
            $key = md5(time().self::randStr(10).$content);
            self::ss($key,$content);
            return $key;
        }
    }
    public static function get_return_content($key){
        return self::gs($key);
    }
    public static function replace_search_keyword($conent,$keyword){
        $keyword = trim($keyword);
        if(strlen($keyword)){
            $replace = "<span style='color:#FF6600'>".$keyword."</span>";
            return str_ireplace($keyword,$replace,$conent);
        }
        return $content;
    }

    
    //获得出发的地点
    public static function get_sregion(){
    	$sregion_session=Yii::app()->session->get('sregion_datas');
    	if(empty($sregion_session)){
    	 $remote_ip=self::getip();
    	 $ip_convert=new IpConvert();
    	 //"58.48.146.189"
    	 $ip_content=$ip_convert->get_sregion_id("58.48.146.189");
    	 $sregion_datas=array('id'=>$ip_content->id,'name'=>$ip_content->district_name);
    	 Yii::app()->session->add('sregion_datas',$sregion_datas);
    	  echo $sregion_datas['name'];
    	}else{
    		echo $sregion_session['name'];
    	}
    }
    
    //获得首页的广告位置
    public static function get_ad($ad_area_id,$ad_type="",$sregion_id=""){
    	if(empty($ad_area_id))
    	  return;
    	if(empty($sregion_id)){
    		$sregion_session=Yii::app()->session->get('sregion_datas');
		    $sregion_id=$sregion_session['id'];
    	}
    	$conditions=array();
    	$params=array();
    	array_push($conditions,"ad_area_id=:ad_area_id");
    	$params[':ad_area_id']=$ad_area_id;
    	if(!empty($ad_type)){
    		array_push($conditions,"ad_type=:ad_type");
    	  $params[':ad_type']=$ad_type;
    	}
    	
    	array_push($conditions,"FIND_IN_SET(:sregion_id,ad_sregion_id)>0");
    	$params[':sregion_id']=$sregion_id;
    	$ad=new Ad();
    	$ad_datas=$ad->find(implode(" AND ",$conditions),$params);
    	return $ad_datas->ad_content;

    	
    }
   

}










?>
