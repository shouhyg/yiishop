<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/31 0031
 * Time: 17:49
 */
namespace app\modules\admin\controllers;
use yii\web\Controller;
use app\models\User;
use yii;

class UserController extends Controller
{
    /**
     * 管理员列表
     */
    public function actionList(){
        $this->layout = 'layout2';
        //给公共布局添加参数
        $view=yii::$app->getView();
        $view->params['menu']='管理员列表';
        //获取参数
        $requestData = yii::$app->request->post();
        //使用模型生成数据查询对象
        $model = User::find();
        $model->orderBy(['uid'=>SORT_DESC])->where(['status'=>2]);
        if(!empty($requestData['key'])){
            $model->andWhere(['or',['like','username',$requestData['key']],['like','email',$requestData['key']],['like','phone',$requestData['key']]]);
        }
        $count = $model->count();
        //获取每页显示的条数
        $pageSize = yii::$app->params['pageSize']['User'];
        $pager = new yii\data\Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
        $users = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('list',[
                'users'=>$users,
                'pager'=>$pager,
                'requestData'=>$requestData,
        ]);
    }
    /**
     * 添加管理员
     */
    public function actionAdd(){
        $model = new User();
        if(yii::$app->request->isPost){
            //post提交
            $data = yii::$app->request->post();//print_r($data);die;
            if($model->add($data)){
                echo '添加成功';
            }

        }
       // print_r($model);
        $this->layout='layout2';
        return $this->render('add',[
            'model'=>$model,
        ]);
    }
    /**
     * 登录函数
     * @return string
     */
    public function actionLogin(){
        //如果用户已登录则直接跳回到原网页
        $session = yii::$app->session;
        if($session['isLogin'] == 1){
            $backUrl = isset(yii::$app->request->referrer) ? : ["index/index"];
            return $this->redirect( $backUrl);exit;
        }

        $model = new User;
        //验证是否为post访问
        if(yii::$app->request->isPost){
            //接收表单数据
            $data = yii::$app->request->post();
            //调用模型方法进行登录信息校验
           if($model->login($data)){
               $this->redirect(['index/index']);
           }

        }
        $model->repassword = '';
        $this->layout = false;

        return $this->render('login',['model'=>$model]);
    }
    public function actionLogout(){
        $model = new User;
        //更新登录永久保留信息
        $dataUpdate = [
            'identifier'=>'',
            'token'=>'',
            'timeout'=>'',
        ];
        $model::updateAll($dataUpdate,['uid'=>yii::$app->session['userid']]);
        Yii::$app->session->remove('username');
        Yii::$app->session->remove('isLogin');
        Yii::$app->session->remove('userid');
        setcookie("auth", "", time()-3600);//把失效日期设置为过去1小时
        unset($_COOKIE['auth']);
        if (!isset(Yii::$app->session['isLogin'])) {
            return $this->goBack(Yii::$app->request->referrer);
        }
    }
    //actions的作用主要是共用功能相同的方法
    //当用户访问index/captcha时，actions就会调用yii\captcha\CaptchaAction方法
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => null,
                //背景颜色
                'backColor' => 0x000000,
                //最大显示个数
                'maxLength' => 4,
                //最少显示个数
                'minLength' => 4,
                //间距
                'padding' => 2,
                //高度
                'height' => 30,
                //宽度
                'width' => 85,
                //字体颜色
                'foreColor' => 0xffffff,
                //设置字符偏移量
                'offset' => 4,
            ],
        ];
    }

}