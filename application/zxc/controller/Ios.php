<?php
	/**
	 *
	 * Created by PhpStorm.
	 * User: knight
	 * Date: 2017/6/28
	 * Time: 9:42
	 */
namespace app\zxc\controller;
use app\zxc\logic\IosLogic;
use app\zxc\model\ZxcIosApiData;
use think\Controller;
use think\Request;

class Ios extends Controller{

	public function iosApi(){
		if(Request::instance()->isPost()){
			$logic = new IosLogic(new ZxcIosApiData());
			$data = input();
			if(isset($data['params'])){
				$data = json_decode($data['params'],true);
			}
			return $logic->doOption($data);
		} else {
			return ['message'=>'无效数据','success'=>false];
		}
	}
}