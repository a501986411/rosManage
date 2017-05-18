<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/14
 * Time: 10:04
 */

namespace app\admin\model;


use think\Model;

class RouteService extends Model
{
    protected $autoWriteTimestamp = true;//自动写入时间戳
    protected $auto = ['overdue'];
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 转时间戳
     * @param $value
     * @param $data
     * @return false|int
     */
    protected function setOverdueAttr($value,$data){
        return strtotime($value);
    }

    /**
     *  时间戳转字符串
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getOverdueStrAttr($value,$data){
        return date('Y-m-d H:i:s',$data['overdue']);
    }
}