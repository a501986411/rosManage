<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"E:\project\rosManage\public/../application/admin\view\admin_user\updatePwd.html";i:1495072066;s:72:"E:\project\rosManage\public/../application/admin\view\layout\layout.html";i:1495077108;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>ROS管理系统</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>bootstrap-table/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/bootstrap-dialog.min.css">
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/common.css">
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/menu.css">


    <script type="text/javascript" src="<?php echo STATIC_PATH; ?>js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo STATIC_PATH; ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo STATIC_PATH; ?>bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo STATIC_PATH; ?>bootstrap-table/dist/locale/bootstrap-table-zh-CN.min.js"></script>
    <script type="text/javascript" src="<?php echo STATIC_PATH; ?>js/bootstrap-dialog.min.js"></script>
    <script type="text/javascript" src="<?php echo STATIC_PATH; ?>js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo STATIC_PATH; ?>js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript" src="<?php echo STATIC_PATH; ?>js/jqUnitCookie.js"></script>
    <script type="text/javascript" src="<?php echo STATIC_PATH; ?>js/jq-tool.js"></script>

</head>

<body>
<!--顶部导航条-->
<nav class="navbar best-top-menu">
    <div class="container-fluid">
        <div class="navbar-collapse collapse extend-width no-pd-lf no-pd-rt">
            <ul class="nav navbar-nav fr menu-font-color">
                <li><a href="<?php echo url('/Login/loginOut'); ?>" class="menu-font-color">安全退出</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php
    use think\Db;
    use org\PhpTree;
    $menuList = Db::query('select * from admin_menu where status=1');
    $tree = new PhpTree();
    $menuTree = $tree->makeTree($menuList);
?>
<nav class="navbar no-bd-tp no-mg-bt no-bd-bt no-bd-lf no-bd-rt">
    <div class="container-fluid no-pd-lf no-pd-rt no-mg-rt">
        <div id="navbarTop2" class="navbar-collapse collapse extend-width no-pd-lf no-pd-rt first-menu-bg-color">
            <ul class="nav navbar-nav navbar-left">
                <?php
                    foreach($menuTree as $k=>$value){
                        if($value['pid'] == 0){
                        echo '<li class="first-menu" data-id="'.$value['id'].'"><a href="javascript:void(0);" class="menu-font-color">'.$value['name'].'</a></li>';
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container no-mg-lf no-mg-rt extend-width">
    <div class="row">
        <div class="col-sm-3 col-md-1 sidebar no-pd-lf no-pd-rt">
            <?php foreach($menuTree as $k=>$v):?>
            <ul class="nav nav-sidebar hidden pid-<?php echo $v['id']; ?>">
                <?php if(isset($v['children']) && !empty($v['children'])):foreach($v['children'] as $k1=>$v1):?>
                    <li class="active second-menu "><a href="<?php echo url($v1['url'],['menuId'=>$v1['pid']]); ?>"><?php echo $v1['name']; ?></a></li>
                    <?php endforeach; endif;?>
            </ul>
            <?php endforeach;?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-2 main no-mg-lf no-pd-rt">
            <div class="panel">
                <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/admin_user/updateRwd.css">
<div class="content" >
    <form class="form-horizontal" id="form">
        <!--<input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />-->
        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>" placeholder="id">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="用户名" value="<?php echo $username; ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="old_password_hash" class="col-sm-2 control-label">密码:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="old_password_hash" name="old_password_hash" placeholder="密码">
            </div>
        </div>
        <div class="form-group">
            <label for="new_password_hash1" class="col-sm-2 control-label">新密码:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="new_password_hash1" name="new_password_hash1" placeholder="新密码">
            </div>
        </div>
        <div class="form-group">
            <label for="new_password_hash2" class="col-sm-2 control-label">确认密码:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="new_password_hash2" name="new_password_hash2" placeholder="再次输入密码确认">
            </div>
        </div>
    </form>
    <button  class="btn bg-primary"  id="btn">保&nbsp;&nbsp;&nbsp;存</button>
</div>
<script>
    ;(function(){
        var $fm = $('#form');
        var $btn = $('#btn');
        $btn.click(function(){
            $fm.formSubmit({
               url:'<?php echo url("updatePwd"); ?>',
                success:function(result){
                    $.dialogMsg({message:result.msg});
                    if(result.success){
                        location.reload();
                    }
                }
            });
        });

    })(jQuery,window,document);
</script>

            </div>

        </div>
    </div>
</div>

</body>

<script>

    $('.first-menu').click(function(){
        var secondClass = $(this).data('id');
        var oldClass = $('.pid-'+secondClass).hasClass('hidden');
        if(oldClass){
            $('.second-menu').parent('ul').addClass('hidden');
            $('.pid-'+secondClass).removeClass('hidden');
        }
    });

    /**
     * 二级菜单联动
     */
    $(document).ready(function(){
        var menuId = $.cookie('admin_menuId');
        var oldClass = $('.pid-'+menuId).hasClass('hidden');
        if(oldClass){
            $('.second-menu').parent('ul').addClass('hidden');
            $('.pid-'+menuId).removeClass('hidden');
        }
    });
</script>
</html>