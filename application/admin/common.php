<?php
	/**
	 *
	 * Created by PhpStorm.
	 * User: knight
	 * Date: 2017/5/17
	 * Time: 17:52
	 */
	/**
	 * 返回错误信息
	 * @access public
	 * @param $msg='' 返回提示信息
	 * @return array
	 * @author knight
	 */
	function retFalse($msg=''){
		if(empty($msg)){
			$msg = lang('error server');
		}
		return ['success'=>false,'msg'=>$msg];
	}
	/**
	 * 返回操作成功信息
	 * @access public
	 * @param $msg='' 返回提示信息
	 * @return array
	 * @author knight
	 */
	function retTrue($msg=''){
		if(empty($msg)){
			$msg = lang('success options');
		}
		return ['success'=>true,'msg'=>$msg];
	}

	/**
	 * 提取二维数组中的某些列作为一个新的数组
	 * @access public
	 * @param $source 数据源
	 * @param array $columns 需要保留的字段
	 * @param string $keyColumns 新数组的key 默认为自然苏
	 * @return array
	 * @author knight
	 */
	function arrayColumns($source, $columns=[], $keyColumns='')
	{
		$result = [];
		foreach ($source as $k => $v) {
			if(!empty($columns)){
				foreach ($v as $k1=>$v1 ) {
					if (in_array($k1, $columns) && !empty($keyColumns)){
						$result[$v[$keyColumns]][$k1] = $v1;
					}elseif (in_array($k1, $columns) && empty($keyColumns)){
						$result[$k][$k1] = $v1;
					}
				}
			} else {
				if(!empty($keyColumns)){
					$result[$v[$keyColumns]] = $v;
				} else {
					$result[] =$v;
				}
			}
		}
		return $result;
	}

	/**
	 * 二位数组排序
	 * @access public
	 * @param $array 待排序数据
	 * @param $key 排序key
	 * @param string $way 排序方式 （SORT_ASC，SORT_DESC）
	 * @return mixed
	 * @author knight
	 */
	function arrayMultiSort($array,$key,$way=SORT_ASC){
		$tmp = arrayColumns($array,[$key]);
		if($way == SORT_ASC){
			asort($tmp);
		}else {
			arsort($tmp);
		}
		foreach($array as $value){
			$index = array_search($value[$key],$tmp);
		}
	}
