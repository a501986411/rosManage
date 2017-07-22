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
use app\zxc\model\WhcWeixinWifiRecord;
use app\zxc\model\ZxcIosApiData;
use think\Controller;
use think\Log;
use think\Request;

class Ios extends Controller{

	public function iosApi(){
		if(Request::instance()->isPost()){
			$logic = new IosLogic(new ZxcIosApiData());
			$data = input();
			if(empty($data)){
				return ['message'=>'无效数据','success'=>false];
			}
			if(isset($data['params'])){
				$data = json_decode($data['params'],true);
			}
			return $logic->doOption($data);
		} else {
			return ['message'=>'无效数据','success'=>false];
		}
	}


	public function getWeiXinData()
    {
        if(Request::instance()->has('extend')){
            $data['extend'] = input('extend');//为上文中调用呼起微信JSAPI时传递的extend参数，这里原样回传给商家主页
            $extend = explode('|',$data['extend']);
            $extends = [];
            for ($i=0;$i<count($extend);$i++){
                $value = $extend[$i];
                $val = explode('-',$value);
                $extends[$val[0]] = $val[1];
            }
            $data['openId'] = input('openId');//用户的微信openId
            $data['tid'] = input('tid');//为加密后的用户手机号码（仅作网监部门备案使用）
            $data['mac'] = $extends['mac'];//用户手机mac地址，格式冒号分隔，字符长度17个，并且字母小写，例如：00:1f:7a:ad:5c:a8
            $data['appId'] = $extends['appId'];//商家微信公众平台账号
            $data['shopId'] = $extends['shopId'];//AP设备所在门店的ID，即shop_id
            $data['ip'] = $extends['ip'];//用户手机IP
            $data['time'] = time();//连接时间
            $rosUrl = $extends['url'].'?dst=&popup=true&username='.$extends['username']."&password=".$extends['password'];
            $model = new WhcWeixinWifiRecord();
            $model->save($data);
            $this->redirect($rosUrl);

        }
    }

    public function index()
    {
        return view();
    }

}