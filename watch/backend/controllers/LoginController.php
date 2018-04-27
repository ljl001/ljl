<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;

 class LoginController extends Controller
 {
 	public $layout = false;//去掉yii框架原来样式
 	public $enableCsrfValidation=false;

 	public function actionLogin(){

 		return $this->render('login');
 	}
 	public function actionLogin_next() {
 		// print_r($_POST);die;
 		$user =Yii::$app->request->post('user');
 		$pwd =Yii::$app->request->post('pwd');

 		$res = Yii::$app->db->createCommand("SELECT * FROM `a_user` WHERE u_name = '$user' and u_pwd = '$pwd' ")->queryOne();
 		$session = Yii::$app->session;
		$session->set('uid' , $res['u_id']);
 		//echo "SELECT * FROM `a_user` WHERE u_name = $user and u_pwd = $pwd";
 		// echo $session->get('uid');
 		// var_dump($session['uid']);
 		if($res) {
 			return 1;
 		}else{
 			return 0; 			
 		}
 	
 	}

}
