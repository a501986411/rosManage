<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/14
 * Time: 10:01
 */

namespace app\admin\logic;


use app\admin\model\RouteService;
use org\RouterosApi;
use think\image\Exception;
use think\Model;

class ServiceLogic extends Model
{
    protected $model;
    protected $offset;
    protected $limit;
    protected $sortField;
    protected $sortWay;
    protected $way = ['asc'=>SORT_ASC,'desc'=>SORT_DESC];
    public function __construct(RouteService $model,$offset=0,$limit='',$sortField='id',$sortWay='desc')
    {
        parent::__construct();
        $this->model = $model;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->sortField = $sortField;
        $this->sortWay = $sortWay;
        if(!empty($this->limit)){
            $this->model->page($this->offset,$this->limit);
        }
    }

    /**
     * 保存
     * @param $data
     * @return bool
     */
    public function saveLogic($data)
    {
        $result = $this->model->isUpdate($data['id'] ? true : false)->save($data);
        if($result === false){
            return false;
        }
        return true;
    }

    /**
     * 获取列表
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getList()
    {
        $list = $this->model
                     ->order('id','desc')
                     ->select();
        foreach ($list as $k=>$v){
            $v['overdue_str'] = $v->overdue_str;
        }
        return $list;
    }

    /**
     * 删除服务器信息
     * @param $delPk
     * @return array
     */
    public function delData($delPk)
    {
        $result = $this->model
            ->where('id','in',$delPk)
            ->delete();
        if($result===false){
            return ['success'=>false,'msg'=>lang('error server')];
        }
        return ['success'=>true,'msg'=>lang('success options')];
    }

    /**
     * 测试服务器是否能正常连接
     * @param $param
     * @return array
     */
    public function testLink($param)
    {
        $rosApi = new RouterosApi();
        $rosApi->delay=0.5;
        if($rosApi->connect($param['domain'].':'.$param['port'],$param['username'],$param['password'])) {
            $rosApi->disconnect();
            return ['success'=>true,'msg'=>'连接成功'];
        } else {
            return ['success'=>false,'msg'=>'连接失败'];
        }
    }

    /**
     * 获取服务器状态列表
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getRosStatusList(){
        $list = $this->model->select();
        $rosApi = new RouterosApi();
        foreach ($list as $k=>&$v){
            $this->getRosInfo($rosApi,$v);
        }

        if(!empty($this->sortField)){
            $list = arrayMultiSort($list,$this->sortField,$this->way[$this->sortWay]);
        }

        $total = $this->model->count('id');
        return ['rows'=>$list,'total'=>$total];
    }

    /**
     * 获取单台服务器信息
     * @access public
     * @param $rosApi
     * @param $ros
     * @return void
     * @author knight
     */
    public function getRosInfo($rosApi,&$ros){
        $rosInfo = $this->getRosCpuInfo($rosApi,$ros['domain'],$ros['port'],$ros['username'],$ros['password']);
        $ros->status = $rosInfo['status'];
        if($ros->status){
            //转换时间
            if(strpos($rosInfo['uptime'],'w')>-1){
                $w = substr($rosInfo['uptime'],0,strpos($rosInfo['uptime'],'w'));
                $d = $w * 7;
                if(strpos($rosInfo['uptime'],'d')>-1){
                    $d += substr($rosInfo['uptime'],strpos($rosInfo['uptime'],'w'),strpos($rosInfo['uptime'],'d')-strpos($rosInfo['uptime'],'w'));
                    $rosInfo['uptime'] = $d.'d'.substr($rosInfo['uptime'],strpos($rosInfo['uptime'],'d')+1);
                } else {
                    $rosInfo['uptime'] = $d.'d'.substr($rosInfo['uptime'],(strpos($rosInfo['uptime'],'w')+1));
                }
            }
            $uptime = str_replace(['w','d','h','m','s'],['周','天','小时','分','秒'],$rosInfo['uptime']);//运行时间

            $ros->uptime =$uptime;
            $ros->version = $rosInfo['version'];//ROS系统版本
            $ros->memory_ratio = round((100-($rosInfo['free-memory']/$rosInfo['total-memory']) * 100),1)."%" ;//内存占用率
            $ros->cpu_ratio = $rosInfo['cpu-load'].'%';
            $ros->free_hdd_space = round($rosInfo['free-hdd-space']/(1024*1024),1);
            $activeNum = $this->getPppInfo($rosApi,$ros['domain'],$ros['port'],$ros['username'],$ros['password']);
            $ros->active_ratio = round(($activeNum/(int)$ros->max_number)*100,2).'%';
            $ros->now_time = $this->getNowTime($rosApi,$ros['domain'],$ros['port'],$ros['username'],$ros['password']);
        }
    }

    /**
     * 获取ROS服务器硬件信息
     * @param $rosApi
     * @param $domain
     * @param $port
     * @param $username
     * @param $password
     * @return mixed
     */
    private function getRosCpuInfo($rosApi,$domain,$port,$username,$password)
    {
        $domain .= ':'.$port;
        if($rosApi->connect($domain,$username,$password)) {
            $rosApi->write('/system/resource/getall');
            $rosInfo = $rosApi->read(true);
            $rosApi->disconnect();
            $rosInfo[0]['status'] = true;
        } else {
            $rosInfo[0]['status'] = false;
        }
        return $rosInfo[0];
    }

    /**
     * 获取活跃用户数
     * @param $rosApi
     * @param $domain
     * @param $port
     * @param $username
     * @param $password
     * @return int
     */
    public function getPppInfo($rosApi,$domain,$port,$username,$password)
    {
        $domain .= ':'.$port;
        if($rosApi->connect($domain,$username,$password)) {
            $rosApi->write('/ppp/active/getall');
            $aUserInfo = $rosApi->read(true);
            $rosApi->disconnect();
            return count($aUserInfo);
        }
        return 0;
    }

    /**
     *  获取ROS服务器当前时间
     * @param $rosApi
     * @param $domain
     * @param $port
     * @param $username
     * @param $password
     * @return false|string
     */
    public function getNowTime($rosApi,$domain,$port,$username,$password)
    {
        $domain .= ':'.$port;
        if($rosApi->connect($domain,$username,$password)) {
            $rosApi->write('/system/clock/getall');
            $date = $rosApi->read(true);
            $rosApi->disconnect();
            $date = strtotime(enDateToCn($date[0]['date']).' '.$date[0]['time']);
            return date('Y-m-d H:i:s',$date);
        }
        return '';
    }

    /**
     * 获取一行数据
     * @access public
     * @param $id 服务器id
     * @return void
     * @author knight
     */
    public function getRowInfo($id){
        $ros = $this->model->find($id);
        $rosApi = new RouterosApi();
        $this->getRosInfo($rosApi,$ros);
        return $ros;
    }
}