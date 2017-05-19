<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"D:\wwwroot\rosManage\public/../application/admin\view\route_service\index.html";i:1495118993;s:72:"D:\wwwroot\rosManage\public/../application/admin\view\layout\layout.html";i:1495112142;s:77:"D:\wwwroot\rosManage\public/../application/admin\view\route_service\form.html";i:1495112142;}*/ ?>
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
    <button type="button" class="btn btn-warning" id="del_btn">删除</button>
    <!--<button type="button" class="btn btn-info" id="test_link">尝试连接</button>-->
</div>
<div class="table-responsive">
    <table id="service_table">
    </table>
</div>
<div class="hidden" style="clear: both" id="service_info_dlg">
    <form class="form-horizontal" id="service_info_fm">
        <input type="hidden" class="form-control" id="id" name="id" placeholder="id">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">名称:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="服务器名称">
            </div>
        </div>
        <div class="form-group">
            <label for="domain" class="col-sm-2 control-label">域名:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="domain" name="domain" placeholder="域名">
            </div>
        </div>
        <div class="form-group">
            <label for="by_domain" class="col-sm-2 control-label">备用域名:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="by_domain" name="by_domain" placeholder="备用域名多个用'|'隔开">
            </div>
        </div>
        <div class="form-group">
            <label for="port" class="col-sm-2 control-label">端口:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="port" name="port" placeholder="端口">
            </div>
        </div>
        <div class="form-group">
            <label for="max_number" class="col-sm-2 control-label">最大用户数:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="max_number" name="max_number" placeholder="ROS服务器允许最大在线人数">
            </div>
        </div>
        <div class="form-group">
            <label for="overdue" class="col-sm-2 control-label">到期时间:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form_datetime" id="overdue" name="overdue" readonly placeholder="服务器到期时间">
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="连接用户名">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">连接密码:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="连接密码">
            </div>
        </div>

        <div class="form-group">
            <label for="remark" class="col-sm-2 control-label">备注:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="remark" name="remark" placeholder="备注">
            </div>
        </div>
    </form>
</div>


<script>
    (function(){
        var $table = $("#service_table");
        var $addBtn = $('#add_btn');
        var $delBtn = $('#del_btn');
        var $addBtnDlg = $('#service_info_dlg');
        var $testLink = $('#test_link');
        var $linkDlg = $('#link_dlg');
        //服务器信息弹框
        var addDialog = new  BootstrapDialog({
            title:'新增服务器',
            message:function(){
                var msg = $addBtnDlg.html();
                $addBtnDlg.remove();
                return msg;
            },
            nl2br:false,
            data:{},
            onshown:function(dialogRef){
                var $form = $('#service_info_fm');
                if(!$.is_null(dialogRef.data)){ //修改 表单赋值
                    $form.formLoad(dialogRef.data);
                }
                var $overdue = $("#overdue");
                $overdue.datetimepicker({
                    format: 'yyyy-mm-dd hh:ii',
                    language:'zh-CN',
                    autoclose:1,
                });
            },
            buttons:[{
                id:'btn-ok',
                label:'保存',
                cssClass:'btn-primary',
                action:function(dialogRef){
                    var $form = $('#service_info_fm');
                    $form.formSubmit({
                        url:"<?php echo url('save'); ?>",
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
        //测试链接弹框
        var linkDlg = new BootstrapDialog({
            title:'连接测试',
            message:function(){
                var msg = $linkDlg.html();
                $linkDlg.remove();
                return msg;
            },
            nl2br:false,
            data:{},
            onshown:function(dialogRef){
                var $form = $('#link_form');
                var $linkDomain = $('#link_domain');
                if(!$.is_null(dialogRef.data)){ //修改 表单赋值
                    var byDomain = [];
                    $linkDomain.append('<option value="'+dialogRef.data.domain+'">'+dialogRef.data.domain+'</option>')
                    if(!$.is_null(dialogRef.data.by_domain)){
                        byDomain =  dialogRef.data.by_domain.split('|');
                        $.each(byDomain,function(k,v){
                            $linkDomain.append('<option value="'+v+'">'+v+'</option>');
                        });
                    }
                    $form.formLoad(dialogRef.data);
                }
            },
            buttons:[{
                id:'btn-ok',
                label:'连接',
                cssClass:'btn-primary',
                action:function(dialogRef){
                    var $form = $('#link_form');
                    $form.formSubmit({
                        url:"<?php echo url('testLink'); ?>",
                        success:function(result){
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
            url:"<?php echo url('/RouteService/getList'); ?>",
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
                {field:'name',title:'名称',align:'center',sortable:true},
                {field:'domain',title:'域名',align:'center',sortable:true},
                {field:'by_domain',title:'备用域名',align:'center',sortable:true},
                {field:'overdue_str',title:'到期时间',align:'center',sortable:true,formatter:function(value,row,index){
                    var date = new Date();
                    var nowTime = date.getTime()/1000;
                    if((row.overdue-nowTime) < (2 * 24 * 60 * 60)){
                        return '<span style="color:red;">'+value+'</span>';
                    }
                    return value;
                }},
                {field:'max_number',title:'允许最大在线人数',align:'center',sortable:true},
                {field:'username',title:'用户名',align:'center'},
                {field:'remark',title:'备注',align:'center'},
                {field:'create_time',title:'创建时间',align:'center',sortable:true},
                {field:'update_time',title:'更新时间',align:'center',sortable:true},
            ],
            onDblClickRow:function(row,$element,field){
                addDialog.data = row;
                addDialog.open();
                addDialog.setTitle('修改服务器信息');
            }
        });

        //新增操作
        $addBtn.click(function(){
            addDialog.data = {};
            addDialog.open();
            addDialog.setTitle('新增服务器信息');
        });

        $delBtn.click(function(){
            var selectRow = $table.bootstrapTable('getSelections');
            if($.is_null(selectRow)){
                return false;
            } else {
                var pkArr = [];
                $.each(selectRow,function(k,v){
                    pkArr.push(v.id);
                });
                $.post("<?php echo url('delData'); ?>",{pkArr:JSON.stringify(pkArr)},function(result){
                    if(result.success){
                        $table.bootstrapTable('refresh');
                    }
                    $.dialogMsg({message:result.msg});
                });
            }
        });
        //尝试连接
        $testLink.click(function(){
            var row = $table.bootstrapTable('getSelections');
            if(!row.length){
                $.dialogMsg({message:'请选择数据'})
                return false;
            } else if(row.length>1){
                $.dialogMsg({message:'最多选择一行数据'})
                return false;
            }
            linkDlg.data = row[0];
            linkDlg.open();
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