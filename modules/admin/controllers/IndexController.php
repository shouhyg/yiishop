<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/31 0031
 * Time: 17:49
 */
namespace app\modules\admin\controllers;
use Faker\Provider\Base;
use yii\web\Controller;
use app\models\User;
use yii;


class IndexController extends BaseController
{
    /**
     * 后台首页
     */
    public function actionIndex(){
        $this->layout = 'layout1';
        /**
         * 不能通过 render 函数给公共的布局文件赋变量
         * 只能通过以下两步为布局文件传递变量 在公共布局文件中 直接使用 $this->prams['menu'] 来使用变量值
         */
        $view=yii::$app->getView();
        $view->params['menu']='后台首页';
        return  $this->render('index');
    }
    /**
     * 欢迎页面
     */
    public function actionWelcome(){
       $this->layout = 'layout2';
        return  $this->render('welcome');
    }
}