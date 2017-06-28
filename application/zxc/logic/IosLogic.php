<?php

	/**
	 *
	 * Created by PhpStorm.
	 * User: knight
	 * Date: 2017/6/28
	 * Time: 9:46
	 */
	namespace app\zxc\logic;
	use app\zxc\model\ZxcIosApiData;
	use think\Model;
	class IosLogic extends Model
	{
		protected $model;
		public function __construct(ZxcIosApiData $model)
		{
			$this->model = $model;
		}

		public function doOption($data)
		{
			$optionData = [];
			$optionData['adv_id'] = $data['adv_id'];
			$optionData['app_id'] = $data['app_id'];
			$optionData['key']    = $data['key'];
			$optionData['udid']    = $data['udid'];
			$optionData['open_udid']    = $data['open_udid'];
			$optionData['bill'] = is_null($data['bill']) ? '' : $data['bill'];
			$optionData['points'] = is_null($data['points']) ? '' : $data['points'];
			$optionData['ad_name'] = urldecode($data['ad_name']);
			$optionData['status'] =  is_null($data['status']) ? '' : $data['status'];
			$optionData['activate_time'] =  urldecode($data['activate_time']);
			$optionData['order_id'] =  $data['order_id'];
			$optionData['random_code'] =  $data['random_code'];
			$optionData['secret_key'] =  $data['secret_key'];
			$optionData['wapskey'] =  md5($data['adv_id'].$data['app_id'].$data['key'].$data['udid'].$data['bill'].$data['points'].urlencode($data['activate_time']).$data['order_id']);
			$optionData['create_time'] =  time();
			$ret = $this->model->save($optionData);
			if($ret){
				return ['message'=>'成功接收','success'=>true];
			}
			return ['message'=>'无效数据','success'=>false];
		}
	}