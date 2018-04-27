<?php 
namespace backend\controllers;
use yii;
class OrderController extends BaseController
 {
 	public function actionOrder()
 	{
 		return $this->render('order');
 	}

 	public function actionOrder_detailed()
 	{
 		return $this->render('order_detailed');
 	}

 	public function actionOrder_wuliu()
 	{
 		return $this->render('order_wuliu');
 	}
 	
 }

 ?>