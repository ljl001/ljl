<?php 

namespace backend\controllers;
use yii;
class PayController extends BaseController
 {
 	public function actionPay()
 	{
 		return $this->render('pay');
 	}

 	public function actionBrand()
 	{
 		return $this->render('brand');
 	}

 	public function actionCate()
 	{
 		return $this->render('cate');
 	}

 	
 }



 