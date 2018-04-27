<?php
namespace backend\controllers;

use Yii;

 class AdminController extends BaseController
 {
 	// public $layout = false;
    // public $enableCsrfValidation=false;

    //权限管理展示	
 	public function actionNode()
 	{	
 		// $data = Yii::$app->db->createCommand("select * from a_user_role where r_id in(select r_id from role)")->queryAll();
 		// $arr = array();
 		// foreach($data as $key=>$val){
 		// 	$arr[$val['r_id']][] = $val['u_id'];
 		// }
 		// $array = array();
 		// foreach($arr as $key=>&$val){
 		// 	$str = '';
 		// 	for($i=0;$i<count($val);$i++){
 		// 		$data = Yii::$app->db->createCommand("select u_name from a_user where u_id = ".$val[$i])->queryOne();
 		// 		$str.=$data['u_name'].',';
 				
 		// 	}
 		// 	$str = rtrim($str,',');
 		// 	$array[$key] = $str;
 		// }
 		// $arr = Yii::$app->db->createCommand("select * from role")->queryAll();
 		// $a = array();
 		// foreach($arr as $key=>$val){
 		// 	$data = Yii::$app->db->createCommand("select n_title from node where n_id in (select n_id from role_node where role_id = ".$val['r_id'].")")->queryAll();
 		// 	$str = '';
 		// 	foreach($data as $k=>$v){
 		// 		if(!empty($v['n_title'])){
 		// 			$str.=$v['n_title'].',';
 		// 		}
 				
 		// 	}
 		// 	$str = rtrim($str,',');
 		// 		$a[$val['r_id']] = $str;
 		// }
 		

 		$data = Yii::$app->db->createCommand("select u.u_id,u.u_name,r.r_name,r.count,n.n_title from a_user as u RIGHT JOIN a_user_role as ur on u.u_id = ur.u_id RIGHT JOIN role as r on ur.r_id = r.r_id INNER JOIN role_node as rn on r.r_id = rn.role_id left JOIN node as n on rn.n_id = n.n_id")->queryAll();
 		$arr = [];
 		$c = 0;
 		foreach ($data as $key => $value) {
 			$a = [
 				'u_id'=>$value['u_id'],
 				'u_name'=>$value['u_name'],
 				'r_name'=>$value['r_name'],
 				'count' =>$value['count'],
 			];
 			if ($c != $value['u_id']) {
 				$b=[];
 				// $d=[];
 			}
 			$c = $value['u_id'];
 			$b[] = $value['n_title'];
 			// $value['u_name'] =$d[] ;
 			$a['n_title'] = $b;
 			// $a['u_name'] = $d;
 			$arr[$value['u_id']]=$a;
 		}
 		// print_r($arr);die;
 		
 		// foreach($arr as $key=>&$val){
 		// 	foreach($array as $k=>$v){
			// 	if($val['r_id'] == $k){
			// 		$val['u_name'] = $v;
 		// 		}
 		// 	}
 		// 	foreach($a as $q=>$w){
 		// 		if($val['r_id'] == $q){
 		// 			$val['n_name'] = $w;
 		// 		}
 		// 	}
 		// }
 		// foreach($arr as $key=>&$val){
 		// 	$data = Yii::$app->db->createCommand("select r_name from role where r_id = ".$val['r_id'])->queryOne();
 		// 	$val['r_name'] = $data['r_name'];

 		// }
 		 	 

 		return $this->render('admin_Competence',['data'=>$arr]);
 	}

 	//角色添加权限
 	public function actionCompetence() {
 		$aa = $_POST;

 		if (Yii::$app->request->isAjax) { 
            $roles = $aa['role'];
            $nodes = $aa['nodes'];
            $data_role = Yii::$app->db->createCommand("select n_id from `role_node` where role_id = $roles ")->queryAll();//通过指定角色id查出对应的权限的所有id
       	
      		$ab = array_column($data_role,'n_id');
            $nn = explode(',', $aa['nodes']);
            $cc = array_diff($nn,$ab);
            // print_r($cc);die;
            if($cc != null){
            	foreach ($cc as $key => $v) {
// echo $v,",";die;
            		$data_node = Yii::$app->db->createCommand()->insert('role_node', [
												    'role_id' => $roles,
												    'n_id' => $v,
												])->execute();
            	}
            	if($data_node){
            		return 1;
            	}else{
            		return 0;
            	}
            	// print_r($data_node);die;
            	// return 1;
            }else{
            	// return 0;
            	echo "已拥有权限";die;
            }
        } 

 		$arr = Yii::$app->db->createCommand("select u_id,u_name from `a_user` ")->queryAll();
 		$arrs = Yii::$app->db->createCommand("select r_id,r_name from `role` ")->queryAll();
 		$arrse = Yii::$app->db->createCommand("select n_id,n_title from `node` ")->queryAll();

 		return $this->render('add_Competence',['user'=>$arr,'role'=>$arrs,'node'=>$arrse]);
 	}
////////////////////////////////////////////////////////
 	//查看权限列表  分页搜索
 	public function actionShow_node(){
 		$page = isset($_GET['page'])?$_GET['page']:1;
 		$count = Yii::$app->db->createCommand("select * from `node`")->queryAll();
 		$count = count($count);
 		$pagesum = ceil($count/3);
 		$page = $page <= 0 ? 1 : $page;
 		$page = $page >= $pagesum ?  $pagesum : $page;
 		$start = ($page-1)*3;//偏移量
 		//echo $start;echo $end;die;
 		// $fnum = 6;//每一页显示6
 		$data = Yii::$app->db->createCommand("select * from `node` limit ".$start.",3")->queryAll();
 		return $this->render('show_node',['data'=>$data,'page'=>$page,'pagesum'=>$pagesum]);
 	}
 	//添加权限
 	public function actionNodeadd(){
 		$post = $_POST;
 		if($post){
 			$res = Yii::$app->db->createCommand('INSERT INTO `node` (n_title, cname,aname,status) VALUES("'.$post['names'].'", "'.$post['cname'].'","'.$post['aname'].'","'.$post['status'].'")')->execute();
 		// echo 'INSERT INTO `node` (n_title, cname,aname,status) VALUES("'.$post['names'].'", "'.$post['cname'].'","'.$post['aname'].'","'.$post['status'].'")';die;
 			if($res){
 				return 0;
 			}else{
 				return 1;
 			}
 		}
 		return $this->render('nodeadd');
 	}	
	//权限删除
	public function actionNode_del() {
		print_r($_GET);
	}
 	// public function actionLogin(){
 	// 	return $this->render('login');
 	// }

//////////////////////////////////////////////////////////////////////
	//管理员列表
 	public function actionAdmin(){
 		$data = Yii::$app->db->createCommand("select a.u_name,a.u_id,a.email,a.phone,c.r_name,c.r_id from a_user as a LEFT JOIN a_user_role as b on a.u_id = b.u_id LEFT JOIN role as c on b.r_id = c.r_id")->queryAll();
 		$data_type = Yii::$app->db->createCommand("select * from `role` ")->queryAll();
 		// print_r($data_type);
 		return $this->render('administrator_list',['data'=>$data,'datas'=>$data_type]);
 	}

 	//管理员添加
 	public function actionAdminadd(){

 		$data = Yii::$app->db->createCommand("select * from `role`")->queryAll();
 		return $this->render('add_administrator',['data'=>$data]);
 	}
 	public function actionBrands()
 	{	
 		// $post = Yii::$app->request->post();
 		// print_r($post);die;	
 		$users = Yii::$app->db->createCommand()->insert('a_user', [
												    'u_name' => $_POST['user'],
												    'u_pwd' => $_POST['pwd'],
												    'phone' => $_POST['phone'],
												    'email' => $_POST['email'],
												    'sex' => $_POST['sex'],
												    'count' => $_POST['count'],
												])->execute();
 		$u_id = Yii::$app->db->getLastInsertId();
 		// echo $u_id;die;
 		$u_r = Yii::$app->db->createCommand()->insert('a_user_role', [
												    'u_id' => $u_id,
												    'r_id' => $_POST['r_name'],
												])->execute();
 		if(!$u_r) {
 			return 1;
 		}else{
 			return 0;
 		}

 	}
///////////////////////////////////////////////////////////////////////
 	//个人信息
 	public function actionPersonal(){
 		return $this->render('Personal_info');
 	}
 }