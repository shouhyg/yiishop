

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <form action="<?php echo yii\helpers\Url::to(['user/list']); ?>" method="post">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
        <input type="text" value="<?php  echo isset($requestData['key']) ? $requestData['key'] : '' ;?>" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="key"><button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜用户</button>

    </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a>
    <a href="<?php echo yii\helpers\Url::to(['user/add']);?>"  class="btn btn-primary radius"><i class="icon-plus"></i> 添加用户</a></span>
        <span class="r">共有数据：<strong>88</strong> 条</span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="80">ID</th>
            <th width="100">用户名</th>
            <th width="40">性别</th>
            <th width="90">手机</th>
            <th width="150">邮箱</th>

            <th width="130">加入时间</th>
            <th width="70">状态</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
        <tr class="text-c">
            <td><input type="checkbox" value="1" name=""></td>
            <td><?php echo $user->uid; ?></td>

            <td><u style="cursor:pointer" class="text-primary" onclick="user_show('10001','360','','张三','user-show.html')"><?php echo $user->username; ?></u></td>
            <td><?php echo $user->sex; ?></td>
            <td><?php echo $user->phone; ?></td>
            <td><?php echo $user->email; ?></td>

            <td><?php echo $user->create_time; ?></td>
            <td class="user-status"><span class="label label-success">已启用</span></td>
            <td class="f-14 user-manage"><a style="text-decoration:none" onClick="user_stop(this,'10001')" href="javascript:;" title="停用"><i class="icon-hand-down"></i></a> <a title="编辑" href="javascript:;" onclick="user_edit('4','550','','编辑','user-add.html')" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> <a style="text-decoration:none" class="ml-5" onClick="user_password_edit('10001','370','228','修改密码','user-password-edit.html')" href="javascript:;" title="修改密码"><i class="icon-key"></i></a> <a title="删除" href="javascript:;" onclick="user_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
        </tr>
        <?php  endforeach; ?>
        </tbody>
    </table>

    <div class="pagination pull-right">
        <?php echo yii\widgets\LinkPager::widget([
            'pagination' => $pager,
            'prevPageLabel' => '&#8249;',
            'nextPageLabel' => '&#8250;',
        ]); ?>
    </div>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/assets/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    window.onload = (function(){
        // optional set
        pageNav.pre="&lt;上一页";
        pageNav.next="下一页&gt;";
        // p,当前页码,pn,总页面
        pageNav.fn = function(p,pn){$("#pageinfo").text("当前页:"+p+" 总页: "+pn);};
        //重写分页状态,跳到第三页,总页33页
        pageNav.go(1,13);
    });
    $('.table-sort').dataTable({
        "lengthMenu":false,//显示数量选择
        "bFilter": false,//过滤功能
        "bPaginate": false,//翻页信息
        "bInfo": false,//数量信息
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
        ]
    });
</script>

