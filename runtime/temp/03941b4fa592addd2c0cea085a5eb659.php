<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:82:"E:\project\rosManage\public/../application/admin\view\route_service\ros_index.html";i:1495549198;s:72:"E:\project\rosManage\public/../application/admin\view\layout\layout.html";i:1495077108;s:77:"E:\project\rosManage\public/../application/admin\view\route_service\form.html";i:1494846626;s:82:"E:\project\rosManage\public/../application/admin\view\route_service\link_form.html";i:1494983978;}*/ ?>
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
    <button type="button" class="btn btn-info" id="test_link">尝试连接</button>
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

<div class="hidden" style="clear: both" id="link_dlg">
    <form class="form-horizontal" id="link_form">
        <div class="form-group">
            <label for="link_domain" class="col-sm-2 control-label">选择测试域名:</label>
            <div class="col-sm-10">
                <select class="form-control" name="domain" id="link_domain">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="port" class="col-sm-2 control-label">端口:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="port" name="port" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">连接密码:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" readonly>
            </div>
        </div>
    </form>
</div>

<script>
    (function(){
        var $table = $("#service_table");
        var $testLink = $('#test_link');
        var $linkDlg = $('#link_dlg');
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
            url:"<?php echo url('/RouteService/getRosStatus'); ?>",
            idField:'id',
            uniqueId:'id',
            search:true,
            searchOnEnterKey:false,
            clickToSelect:true,
            striped:true,
            pagination:true,
            pageSize:10,
//            sidePagination:'server',
//            totalField:'total',
//            dataField:'rows',
            searchAlign:'right',
            toolbar:'#service_table_btn',
            singleSelect:true,
            onDblClickRow:function(row,$element,field){
                var data = $table.bootstrapTable('getData',true);
                $.post("<?php echo url('getRowInfo'); ?>",{id:row.id},function(result){
                    $table.bootstrapTable('updateByUniqueId',{id:result.id, row:result});
                });
            },

            columns:[
                {field:'checked',title:'选择',checkbox:true},
                {field:'status',title:'是否正常',sortable:true,sortName:'status',align:'center',formatter:function(value,row,index){
                    if(value)
                    {
                        return '是';
                    } else {
                        return '<sapn style="color:red">否</sapn>';
                    }
                }},

                {field:'id',title:'id',align:'center',visible:false},
                {field:'domain',title:'域名',align:'center'},
                {field:'name',title:'名称',align:'center'},
                {field:'cpu_ratio',title:'CPU占用率',align:'center',sortable:true,sortName:'cpu_float'},
                {field:'memory_ratio',title:'内存占用率',align:'center',sortable:true,sortName:'memory_float'},
                {field:'free_hdd_space',title:'剩余空间(M)',align:'center',sortable:true},
                {field:'active_ratio',title:'在线用户率',align:'center',sortable:true,sortName:'active_float'},
                {field:'now_time',title:'系统当前时间',align:'center'},
                {field:'version',title:'系统版本号',align:'center'},
                {field:'uptime',title:'运行时间',align:'center'},
            ],
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