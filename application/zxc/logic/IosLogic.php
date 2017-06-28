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

		}
	}