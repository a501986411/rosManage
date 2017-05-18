<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"E:\project\rosManage\public/../application/admin\view\admin_user\index.html";i:1495008904;s:72:"E:\project\rosManage\public/../application/admin\view\layout\layout.html";i:1495077108;s:74:"E:\project\rosManage\public/../application/admin\view\admin_user\form.html";i:1495005831;}*/ ?>
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
                <div id="service_table_btn">
    <button type="button" class="btn btn-success"  id="add_btn" >新增</button>
    <button type="button" class="btn btn-warning is-use" lab="1">启用</button>
    <button type="button" class="btn btn-danger is-use" lab="0">停用</button>
    <button type="button" class="btn btn-info" id="pwd_reset">重置密码</button>
</div>
<div class="table-responsive">
    <table id="table">
    </table>
</div>
<div class="hidden" style="clear: both" id="form_dlg">
    <form class="form-horizontal" id="dlg_fm">
        <input type="hidden" class="form-control" id="id" name="id" placeholder="id">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
            </div>
        </div>
        <div class="form-group">
            <label for="password_hash" class="col-sm-2 control-label">密码:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_hash" name="password_hash" placeholder="密码">
            </div>
        </div>
    </form>
</div>

<script>
    ;(function(){
        var $table = $("#table");
        var $addBtn = $('#add_btn');
        var $addBtnDlg = $('#form_dlg');
        var $pwdReset  = $('#pwd_reset');
        var $isUse = $('.is-use');
        //服务器信息弹框
        var addDialog = new  BootstrapDialog({
            title:'新增用户',
            message:function(){
                var msg = $addBtnDlg.html();
                $addBtnDlg.remove();
                return msg;
            },
            nl2br:false,
            data:{},
            onshown:function(dialogRef){
                var $form = $('#dlg_fm');
                if(!$.is_null(dialogRef.data)){ //修改 表单赋值
                    $form.formLoad(dialogRef.data);
                }
            },
            buttons:[{
                id:'btn-ok',
                label:'保存',
                cssClass:'btn-primary',
                action:function(dialogRef){
                    var $form = $('#dlg_fm');
                    $form.formSubmit({
                        url:"<?php echo url('/AdminUser/save'); ?>",
                        success:function(result){
                            if(result.success){
                                dialogRef.close();
                                $table.bootstrapTable('refresh');
                            }
                            $.dialogMsg({message:result.msg});
                        }
                    });
                },
            },
                {
                    id:'btn-false',
                    label:'取消',
                    cssClass:'btn-default',
                    action:function(dialogRef){
                        dialogRef.close();
                    }
                },]
        });

        $table.bootstrapTable({
            url:"<?php echo url('getList'); ?>",
            idField:'id',
            search:true,
            searchOnEnterKey:false,
            clickToSelect:true,
            striped:true,
            pagination:true,
            pageSize:15,
            toolbar:'#service_table_btn',
            columns:[
                {field:'checked',title:'选择',checkbox:true},
                {field:'username',title:'用户名',align:'center',sortable:true},
                {field:'status_name',title:'状态',align:'center',sortable:true},
                {field:'update_time',title:'更新时间',align:'center',sortable:true},
                {field:'create_time',title:'创建时间',align:'center',sortable:true},
                {field:'last_login_time_str',title:'最后一次登录时间',align:'center',sortable:true},
                {field:'last_login_ip',title:'最后一次登录IP',align:'center'},
            ],
        });
        //新增操作
        $addBtn.click(function(){
            addDialog.data = {};
            addDialog.open();
        });
        /**
         * 重置密码
         */
        $pwdReset.click(function(){
            var selectRow = $table.bootstrapTable('getSelections');
            if(selectRow.length < 1){
                $.dialogMsg({message:'请选择操作的数据'});
                return false;
            }
            if(selectRow.length > 1){
                $.dialogMsg({message:'只能选择一条数据'});
                return false;
            }
            $.post('<?php echo url("pwdReset"); ?>',{id:selectRow[0].id},function(result){
                $.dialogMsg({message:result.msg,autoClose:false});
                $table.bootstrapTable('refresh');
            });
        });

        /**
         * 启停用操作
         */
        $isUse.click(function(){
            var selectRow = $table.bootstrapTable('getSelections');
            if(selectRow.length > 0){
                var lab = $(this).attr('lab');
                var id = [];
                $.each(selectRow,function (k,v) {
                   id.push(v.id);
                });
                $.post('<?php echo url("operateStatus"); ?>',{lab:lab,id:JSON.stringify(id)},function(result){
                    if(result.success){
                        $table.bootstrapTable('refresh');
                    }
                    $.dialogMsg({message:result.msg});
                });
            } else {
                $.dialogMsg({message:'请选择数据'});
            }

        });
    })(jQuery,window,document)

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