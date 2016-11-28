<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>  
    <link rel="stylesheet" href="/Public/css/pintuer.css">
    <link rel="stylesheet" href="/Public/css/admin.css">
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/pintuer.js"></script>  
</head>
<body>
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 管理员管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>管理员</th>       
        <th>邮箱</th>
        <th width="120">注册时间</th>
        <th>操作</th>       
      </tr>
      <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="t<?php echo ($vo["user_id"]); ?>">
          <td><input type="checkbox" name="id[]" value="<?php echo ($vo["user_id"]); ?>" /><?php echo ($vo["user_id"]); ?></td>
          <td><?php echo ($vo["user_name"]); ?></td>
          <td><?php echo ($vo["e_mail"]); ?></td>  
          <td><?php echo ($vo["user_time"]); ?></td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del(<?php echo ($vo["user_id"]); ?>)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <tr>
        <td colspan="8"><div class="pagelist"> <a href="">上一页</a> <span class="current">1</span><a href="">2</a><a href="">3</a><a href="">下一页</a><a href="">尾页</a> </div></td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">

function del(id){
	if(confirm("您确定要删除吗?")){
    var tr = 't'+id;
    // alert($("#t15"));
		$.ajax({
      dataType:"json",
      type:"POST",
      url :"<?php echo U('admin/del');?>",
      data:{mode:1,user_id:id},
      success:function(data)
      {
        if(data.error)
        {
          $('#'+tr).remove();
        }else{
          alert(data.msg);
        }
        console.log(data);
      },
      error:function (XMLHttpRequest, textStatus, errorThrown) {
        // 通常 textStatus 和 errorThrown 之中
        // 只有一个会包含信息
        //this; // 调用本次AJAX请求时传递的options参数
        console.log(XMLHttpRequest);
        console.log(textStatus);
        console.log(errorThrown);
      }
    })
	}
}

$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false; 		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

</script>
</body></html>