<?php
class ImportAction extends  BaseAction{
    public function beforeAction(){
        $this->controller->layout="iframe";
        return true;
    }
    protected function do_action(){
    	if(isset($_POST['button_ok'])){
    		$get=$_GET;
    		$model_name=$get['model'];
    		$model=new $model_name();
    		$file_name="excellfile";
    		$errors=array();
    		if(!empty($_FILES[$file_name]['name'])){
    			$upload_file_name=$_FILES[$file_name]['name'];
    			$ext=end(explode(".",$upload_file_name));
    			if($ext!='xls'){
    				$errors[$file_name]="请上传.xls后缀的文件";
    			}else{
    				$file_dir="upload/excels";
            $excell_file=Util::UploadFile($file_name,$file_dir);
    			}
    		}else{
    			  $errors[$file_name]="请上传导入的文件";
    		}
        
        
        $start=$_POST['start'];
        $end=$_POST['end'];
        $CFG=$_POST['CFG'];
        if(!empty($start)&&!is_numeric($start)){
        	$errors['start']="开始行数必须是数字";
        }
        
        if(!empty($end)&&!is_numeric($end)){
        	$errors['end']="结束行数必须是数字";
        }
        if(empty($CFG)){
        	$errors['CFG']="请选择导入规则";
        }
        if(empty($errors)){
			  spl_autoload_unregister(array('YiiBase','autoload'));
        require_once Yii::app()->basePath.'/extensions/excel/PHPExcel.php';
        require_once Yii::app()->basePath.'/extensions/excel/PHPExcel/Reader/Excel5.php';    // Ͱ汾xls
        
        // or
        //require_once 'PHPExcel/Writer/Excel2007.php'; //  excel-2007 ʽ
        // һʵ
         
          
        // ļʽдʵ, uncomment
          $objReader =  new PHPExcel_Reader_Excel5();    // 汾ʽ
          spl_autoload_register(array('YiiBase','autoload'));
          $uploadfile="";
  			  $objPHPExcel = $objReader->load($excell_file);
   				$sheet = $objPHPExcel->getSheet(0);
   				$highestRow = empty($end)?$sheet->getHighestRow():$end; // ȡ
   				$highestColumn = $sheet->getHighestColumn(); // ȡ
   				$start=empty($start)?2:$start;
   			  
   				for($j=$start;$j<=$highestRow;$j++)
          {
           $insert_datas=array();
           $str="";
           for($k='A';$k<=$highestColumn;$k++){
           	 foreach($CFG as $key => $value){
           	    if(!empty($value)&&($value==$k)){
           	    	$insert_datas[$key]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
           	    }	
           	 }
           }
           
           if(!empty($insert_datas)){
           	 $model->setIsNewRecord(true);
           	 $model->id=NULL; 
             foreach($insert_datas as $key => $value){
              	$model->$key=$value;
             }
             if($model->validate()){
             	  $model->save();
             }
           }
          }
          
          $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
        	$this->display('import',array('model'=>$model,'errors'=>$errors,'start'=>$start,'end'=>$end,'CFG'=>$CFG));
        }else{
        	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
        	$this->display('import',array('model'=>$model,'errors'=>$errors,'start'=>$start,'end'=>$end,'CFG'=>$CFG));
        }  
        
    		
    	}else{
    	  $model=$_REQUEST['model'];
    	  $model=new $model();
        $this->display('import',array('model'=>$model));
      }
    } 
}
?>
