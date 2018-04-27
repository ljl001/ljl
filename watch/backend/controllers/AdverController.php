<?php

namespace backend\controllers;

use Yii;
 class AdverController extends BaseController
 {
 	public function actionList()
 	{
 		return $this->render('Advertising_list');
 	}
 	
 	public function actionSort(){
 		return $this->render('Advertising_sort');
 	}
 }