<?php

	/**
	 *
	 * Created by PhpStorm.
	 * User: knight
	 * Date: 2017/5/26
	 * Time: 15:35
	 */
	namespace app\index\Logic;
	use org\RouterosInfo;
	use think\Model;


	class MacLogic extends Model
	{
		protected $domain = 'home.webok.me';
		protected $port = '8728';
		protected $user = 'api';
		protected $pwd = 'api';
		public function __construct(){
			parent::__construct();
		}

		public function getMacList()
		{
			$ros = new RouterosInfo($this->domain,$this->port,$this->user,$this->pwd);
			$ipBindInfo = $ros->getIpBindInfo();
			return $ipBindInfo;
		}
	}