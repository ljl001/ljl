<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

 class IndexController extends BaseController
 {
 	// public $layout = 'base';
 	//首页
 	public function actionIndex()
 	{
 		return $this->render('index');
 	}

 	
 	
 }