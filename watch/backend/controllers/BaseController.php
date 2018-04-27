<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use \common\helps\common;//使用工具类

class BaseController extends Controller
{
	public $enableCsrfValidation=false;
	public $layout = 'base';
	public function init()
	{
		parent::init();
		common::hello();//直接进行调用
	}
}