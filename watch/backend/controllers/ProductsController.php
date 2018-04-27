<?php 

namespace backend\controllers;
use yii;
class ProductsController extends BaseController
 {
 	public function actionProducts()
 	{
 		return $this->render('products');
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



 