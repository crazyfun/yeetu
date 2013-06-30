<?php
class ExportAction extends  BaseAction{
    public function beforeAction(){
        $this->controller->layout="iframe";
        return true;
    }
    protected function do_action(){
    	if(isset($_POST['button_ok'])){
    		$get=$_GET;
    		$model=new $get['model']();
    		unset($get['model']);
    		$attributes=$_POST['attributes'];
    		$user=new User();
    		$user_id=Yii::app()->user->id;
    		$user_data=$user->find(array('select'=>'user_login','condition'=>'id=:id','params'=>array(':id'=>$user_id)));
    		$com_conditions=$model->com_condititions($get);
    		$model_datas=$model->findAll($com_conditions['condition'],$com_conditions['params']);
    	  $cell_arr=CV::$cell_arr;
    	  $errors=array();
    	  if(empty($attributes)){
    	  	$errors['attributes']="请选择导出字段";
    	  	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
    	  	$this->display('export',array('model'=>$model,'errors'=>$errors));
    	  }else{
			  spl_autoload_unregister(array('YiiBase','autoload'));
        require_once Yii::app()->basePath.'/extensions/excel/PHPExcel.php';
        require_once Yii::app()->basePath.'/extensions/excel/PHPExcel/Writer/Excel5.php';    // 用于其他低版本xls
        // or
        //require_once 'PHPExcel/Writer/Excel2007.php'; // 用于 excel-2007 格式
        // 创建一个处理对象实例
        $objExcel = new PHPExcel();
        // 创建文件格式写入对象实例, uncomment
        $objWriter = new PHPExcel_Writer_Excel5($objExcel);    // 用于其他版本格式
        // or
        //$objWriter = new PHPExcel_Writer_Excel2007($objExcel); // 用于 2007 格式
        //$objWriter->setOffice2003Compatibility(true);
        //*************************************
        spl_autoload_register(array('YiiBase','autoload'));
        //设置文档基本属性
        $objProps = $objExcel->getProperties();
        $objProps->setCreator($user_data->user_login);
        $objProps->setLastModifiedBy($user_data->user_login);
        //$objProps->setTitle();
        //$objProps->setSubject();
        //$objProps->setDescription();
        //$objProps->setKeywords();
        //$objProps->setCategory();
        //*************************************
        //设置当前的sheet索引，用于后续的内容操作。
        //一般只有在使用多个sheet的时候才需要显示调用。
        //缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
        $objExcel->setActiveSheetIndex(0);
        $objActSheet = $objExcel->getActiveSheet();
        //设置当前活动sheet的名称
        $objActSheet->setTitle('Sheet');
        foreach($attributes as $key => $value){
        	$objActSheet->setCellValue($cell_arr[$key+1]."1",$model->getAttributeLabel($value));  // 字符串内容
        }
        $cell_nums=2;
        foreach($model_datas as $key => $value){
        	foreach($attributes as $key1 => $value1){
        		$objActSheet->setCellValue($cell_arr[$key1+1].strval($cell_nums),$value->show_attribute($value1));  // 字符串内容
        	}

        	$cell_nums++;
        }
    
        //*************************************
        //设置单元格内容
        //由PHPExcel根据传入内容自动判断单元格内容类型
        
        //$objActSheet->setCellValue('A2', 26);            // 数值
        //$objActSheet->setCellValue('A3', true);          // 布尔值
        //$objActSheet->setCellValue('A4', '=SUM(A2:A2)'); // 公式
        //显式指定内容类型
        //$objActSheet->setCellValueExplicit('A5', '847475847857487584',PHPExcel_Cell_DataType::TYPE_STRING);
        //合并单元格
        //$objActSheet->mergeCells('B1:C22');
        //分离单元格
        //$objActSheet->unmergeCells('B1:C22');
        //*************************************
        //设置单元格样式
        //设置宽度
        //$objActSheet->getColumnDimension('B')->setAutoSize(true);
        //$objActSheet->getColumnDimension('A')->setWidth(30);
        //$objStyleA5 = $objActSheet->getStyle('A5');
        //设置单元格内容的数字格式。
        //如果使用了 PHPExcel_Writer_Excel5 来生成内容的话，
        //这里需要注意，在 PHPExcel_Style_NumberFormat 类的 const 变量定义的
        //各种自定义格式化方式中，其它类型都可以正常使用，但当setFormatCode
        //为 FORMAT_NUMBER 的时候，实际出来的效果被没有把格式设置为"0"。需要
        //修改 PHPExcel_Writer_Excel5_Format 类源代码中的 getXf($style) 方法，
        //在 if ($this->_BIFF_version == 0x0500) { （第363行附近）前面增加一
        //行代码: 
        //if($ifmt === '0') $ifmt = 1;
        //设置格式为PHPExcel_Style_NumberFormat::FORMAT_NUMBER，避免某些大数字
        //被使用科学记数方式显示，配合下面的 setAutoSize 方法可以让每一行的内容
        //都按原始内容全部显示出来。
        //$objStyleA5
        //    ->getNumberFormat()
        //    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        //设置字体
        //$objFontA5 = $objStyleA5->getFont();
        //$objFontA5->setName('Courier New');
        //$objFontA5->setSize(10);
        //$objFontA5->setBold(true);
        //$objFontA5->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
        //$objFontA5->getColor()->setARGB('FF999999');
        //设置对齐方式
        //$objAlignA5 = $objStyleA5->getAlignment();
        //$objAlignA5->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        //$objAlignA5->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //设置边框
        //$objBorderA5 = $objStyleA5->getBorders();
        //$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //$objBorderA5->getTop()->getColor()->setARGB('FFFF0000'); // color
        //$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //$objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //$objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //设置填充颜色
        //$objFillA5 = $objStyleA5->getFill();
        //$objFillA5->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        //$objFillA5->getStartColor()->setARGB('FFEEEEEE');
        //从指定的单元格复制样式信息.
        //$objActSheet->duplicateStyle($objStyleA5, 'B1:C22');
        //*************************************
        //添加图片
        //$objDrawing = new PHPExcel_Worksheet_Drawing();
        //$objDrawing->setName('ZealImg');
        //$objDrawing->setDescription('Image inserted by Zeal');
        //$objDrawing->setPath('./zeali.net.logo.gif');
        //$objDrawing->setHeight(36);
        //$objDrawing->setCoordinates('C23');
        //$objDrawing->setOffsetX(10);
        //$objDrawing->setRotation(15);
        //$objDrawing->getShadow()->setVisible(true);
        //$objDrawing->getShadow()->setDirection(36);
        //$objDrawing->setWorksheet($objActSheet);
        //添加一个新的worksheet
        //$objExcel->createSheet();
        //$objExcel->getSheet(1)->setTitle('测试2');
        //保护单元格
        //$objExcel->getSheet(1)->getProtection()->setSheet(true);
        //$objExcel->getSheet(1)->protectCells('A1:C22', 'PHPExcel');
        //*************************************
        //输出内容
        $outputFileName = "export.xls";
        //到文件
        //$objWriter->save($outputFileName);
        //or
        //到浏览器
        header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
        header('Content-Disposition: attachment;filename='.$outputFileName.'');  
        header('Cache-Control: max-age=0');  
        $objWriter->save('php://output');   
       }


    	  }else{
    	    $request=$_REQUEST;
    	    $model=$request['model'];
    	    $model=new $model();
    	    
    	    $this->display('export',array('model'=>$model));
    	 }
    } 
}
?>
