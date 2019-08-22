<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/31 0031
 * Time: 17:49
 */
namespace app\modules\admin\controllers;
use yii\web\Controller;
use yii;


class BaseController extends Controller
{
    public function init(){
        if(!$this->checkLogin()){
            //在base控制器里面写跳转地址要写完整的模块控制器和方法
           return $this->redirect(['/admin/user/login']);
        }
    }
    public function checkLogin(){
        $session = yii::$app->session;
        if($session['isLogin'] == 1){
            return true;
        }

        $cookies = isset($_COOKIE['auth']) ? $_COOKIE['auth'] : '';
        if(empty($cookies)) return false;
        list($identifier,$token) = explode(':',$cookies);
        $UserData = Yii::$app->db->createCommand('SELECT * FROM ys_user WHERE identifier=:identifier ')
            ->bindValue(':identifier', $identifier)
            ->queryOne();

        if($UserData){
            $cookiesalt = yii::$app->params['cookiesalt'];
            //用户信息存在
            if(($UserData['token'] == $token) &&
                (time() < $UserData['timeout']) &&
                ($UserData['identifier'] ==  md5($cookiesalt.md5($UserData['username'].$cookiesalt)))
              )
            {
                return true;
            }
        }
        return false;
    }
}
