<?php

	/**
	 *
	 * Created by PhpStorm.
	 * User: knight
	 * Date: 2017/5/26
	 * Time: 13:35
	 */
	namespace app\index\controller;
	use app\index\Logic\MacLogic;
	use think\Controller;
	use think\Exception;
	use think\Request;

	class Index extends Controller
	{
		public function __construct(){
			parent::__construct();
		}

		public function index()
		{
			$logic = new MacLogic();
			$ipBindList = $logic->getMacList();
			return $this->fetch('',['list'=>$ipBindList]);
		}

		/**
		 *
		 * @access public
		 * @return void
		 * @author knight
		 */
		public function edit()
		{
			return $this->fetch('form');
		}

		public function form()
		{
			if(Request::instance()->isPost()){

			}else{
				throw new Exception(lang('error param'));
			}
		}
	}