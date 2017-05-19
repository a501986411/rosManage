<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Route;
// admin子域名绑定到admin模块
Route::domain('ros.com','admin');
function enDateToCn($date)
{
    $en = ['January','February','March','April',
           'May','June','July','August','September',
           'October','November','December'];

    $cn = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    $en1 = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec'];
    return str_ireplace ($en1,$cn,str_ireplace ($en,$cn,$date));
}
