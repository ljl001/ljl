<?php
namespace common\helps;
use Yii;
use yii\web\Session;;
use yii\web\Controller;
/*
 * 自定义全局公共方法
 */
class common{
    public static function hello(){
        $session = Yii::$app->session;
		$uid = $session['uid'];
		// print_r($uid);
		if(!isset($uid)){
			echo "<script>alert('请先登录');location.href='?r=login/login'</script>";die;
		}
//根据用户id得到用户角色
		$roid = Yii::$app->db->createCommand("select * from a_user_role where u_id ='$uid'")->queryAll();
		// print_r($roid);die;
		$roid_id = array();
		foreach($roid as $k => $v){
			array_push($roid_id,$v['r_id']);
		}
		// print_r($roid_id);die;
//根据角色id得到权限的id
		$roid_id = implode(',',$roid_id);
		// print_r($roid_id);die;
		$node = Yii::$app->db->createCommand("select * from role_node where role_id  in($roid_id)")->queryAll();
		// echo "select * from role_permission where r_id  in($roid_id)";die;
		// print_r($node);die;
		$node_id = array();
		foreach($node as $ke =>$val){
			// print_r($val);
			array_push($node_id, $val['n_id']);
		}
		$node_id = implode(',', $node_id);
		// print_r($node_id);
//根据权限id得到权限的详细信息	
		if(!$node_id) {
			echo "<script>alert('没有权限');location.href='?r=index/index'</script>";die;
			// return $this->redirect(array('login/login'));die;
		}else{
			$node_xx = Yii::$app->db->createCommand("select * from node where n_id in($node_id)")->queryAll();	
		}
		
// print_r($node_xx);die;
		$controllerID=Yii::$app->requestedRoute;
		$aa = explode("/",$controllerID);//把字符串分割成数组
		// echo $controllerID; die; 
		// print_r($aa);die;		
		// $controllerID = Yii::$app->controller->id;
		// $actionID = Yii::$app->controller->action->id;
		$controllerID = $aa[0];
		$actionID = $aa[1];
		// echo $controllerID ."/".$actionID;die;
		//定义一个变量
		$flag = false;
		foreach ($node_xx as $key => $value) 
		{
			// echo strtolower($value['c_name']) .'=='. strtolower($controllerID) .'=='. strtolower($value['a_name']) .'=='. strtolower($actionID).'...';
			// echo "</br>";die;
			if(strtolower($value['cname']) == strtolower($controllerID) && strtolower($value['aname']) == strtolower($actionID))
			{
				$flag=true;
			}			
		}
		// print_r($flag);die;
		if(!$flag){
			// echo '没有权限';die;
			echo "<script>alert('没有权限');location.href='?r=index/index'</script>";die;
			// $this->redirect(['index/index']);
				
		}



    }

    // //文件上传
    //  public static function myUpload($model, $field, $path = '')
    // {
	   //      $upload_path = \Yii::$app->params['upload_path'];
	   //      $path = $path ? $path . "/" : '';
	   //      if (\Yii::$app->request->isPost) {
	   //          $file = UploadedFile::getInstanceByName($field);
	   //          $model->file = $file;
	   //          //文件上传存放的目录
	   //          $dir = $upload_path . $path . date("Ymd");
	   //          if ( !is_dir($dir)) {
	   //              mkdir($dir, 0777, true);
	   //              chmod($dir, 0777);
	   //          }
	   //          if ($model->validate()) {
	   //              //生成文件名
	   //              $rand_name = rand(1000, 9999);
	   //              $fileName = date("YmdHis") . $rand_name . '_' . $model->file->baseName . "." . $model->file->extension;
	   //              $save_dir = $dir . "/" . $fileName;
	   //              $model->file->saveAs($save_dir);
	   //              $uploadSuccessPath = $path . date("Ymd") . "/" . $fileName;
	   //              $result['file_name'] = $model->file->baseName;
	   //              $result['file_path'] = $uploadSuccessPath;
	   //          } else {
	   //              //上传失败记录日志
	   //              self::recordLog($model->errors, $field, 'Upload');
	                
	   //              return false;
	   //          }
	   //      } else {
	   //          return false;
    //     }
}


