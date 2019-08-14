<?php
namespace app\models;
use yii\db\ActiveRecord;
use yii;
class User extends ActiveRecord
{
    public $repassword;
    public $verify;
    public $userid='';



    public static function  tableName(){

        return "{{%user}}";
    }
    public function rules(){
        return [
            ['username','required','message'=>'用户名不能为空','on'=>['login']],
            //注意captchaAction的设置，指向你显示验证码的action，这里我们的是user/captcha caseSensitive 是否区分大小写
            ['verify', 'captcha', 'captchaAction' => 'admin/user/captcha', 'caseSensitive' => false, 'message' => '验证码错误','on'=>['login']],
            ['password','required','message'=>'密码不能为空'],
            ['password','validatePass','on'=>['login']],//validatePass  为自定义的方法名称
        ];
    }

    /**
     * 登录验证
     * @param $data
     * @return bool
     */
    public function login($data){
        $this->scenario = 'login';
        /**
         * load 函数 ： 该函数会将传入放数组的对应值 赋值给 rules 中的校验对应字段，rule 中没有的不赋值
         * @return string
         */
        if($this->load($data) && $this->validate()){
          $lifetime = isset($data['User']['rememerMe']) ? time() + 3600*24*7 : 0;
          if($lifetime > 0){
              $cookiesalt = yii::$app->params['cookiesalt'];
              //客户选择记住我 实现永久登录
              //通过对用户名结合加密因子加密的方式 生成cookie的加密参数
              $identifier = md5($cookiesalt.md5($this->username.$cookiesalt));
              //生成tokie 用于标记客户是否是 永久登录（也可设置标记账户的单点登录）
              $token = md5(uniqid(rand(),true));
              setcookie('auth',"$identifier:$token",$lifetime);
              //将数据插入到数据表
              $dataUpdate = [
                  'identifier'=>$identifier,
                  'token'=>$token,
                  'timeout'=>$lifetime,
                  'last_time'=>time(),
                  'last_ip'=>Yii::$app->request->userIP,
              ];
              self::updateAll( $dataUpdate,['uid'=>$this->userid]);
          }

          $session = yii::$app->session;
          $session['username'] = $this->username;
          $session['userid'] = $this->userid;
          $session['isLogin'] = 1;
          return true;
        }
        return false;

    }
    public function validatePass(){
        if(!$this->hasErrors()){
            $loginname = 'username';
            if(preg_match('/@/',$this->username)){
                //邮箱登录
                $loginname = 'email';
            }
            // data 返回当前模型的对象 如果要在当前模型自定义属性，不要与字段名重复，否则可能会去到自定义的值而不是字段值
            $data = self::find()->where($loginname.'=:username and password=:password',[':username'=>$this->username,':password'=>$this->password])->one();

           if(is_null($data)){
               $this->addError('password','用户名或密码错误！');
           }else{
               $this->userid=$data->uid;
           }
        }

    }

}