<?php
	/**
	 *
	 * Created by PhpStorm.
	 * User: knight
	 * Date: 2017/5/11
	 * Time: 13:50
	 */
	namespace app\admin\logic;

	use app\admin\model\AdminUser;
	use think\Model;

	class LoginLogic extends Model
	{
		protected  $model;
		public function __construct(AdminUser $model)
		{
			parent::__construct();
			$this->model = $model;
		}


		/**
		 * @access public
		 * @param $username
		 * @param $password
		 * @return bool
		 * @author knight
		 */
		public function login($username,$password)
		{
			$userInfo = $this->model
                ->where('username',$username)
                ->where('status',1)
                ->field(['password_hash','username','id'])->find();
			if(empty($userInfo)){
                return false;
            }
			if($this->model->checkPassword($password,$userInfo['password_hash'])){
				//密码验证成功 写cookie
				cookie('user',json_encode($userInfo,JSON_UNESCAPED_UNICODE));
				$data['last_login_time'] = time();
				$data['last_login_ip'] = $_SERVER["REMOTE_ADDR"];
				$data['id'] = $userInfo['id'];
                $this->model
                    ->allowField(['last_login_time','last_login_ip'])
                    ->save($data,['id'=>$data['id']]);
				return true;
			}
			return false;
		}


        /**
         * 检查cookie确认是否存在用户信息
         * @return bool
         */
        public function checkLoginStatus()
        {
            $user = cookie('user');
            if(empty($user)){
                return false;
            } else {
                return true;
            }
        }
	}