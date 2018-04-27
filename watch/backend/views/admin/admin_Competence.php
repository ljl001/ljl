<?php 
use yii\helpers\Url;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="css/shop.css" type="text/css" rel="stylesheet" />
<link href="css/Sellerber.css" type="text/css"  rel="stylesheet" />
<link href="css/bkg_ui.css" type="text/css"  rel="stylesheet" />
<link href="font/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />
<script src="js/jquery-1.9.1.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script src="js/shopFrame.js" type="text/javascript"></script>
<script src="js/Sellerber.js" type="text/javascript"></script>
<script src="js/layer/layer.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.dataTables.bootstrap.js"></script>
<title>管理员</title>
</head>
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/css3-mediaqueries.js"  type="text/javascript"></script>
  <![endif]-->
<body>
<div class="margin Competence_style" id="page_style">	
   <div class="operation clearfix">
<button class="btn button_btn btn-danger" type="button" onclick=""><i class="fa fa-trash-o"></i>&nbsp;删除</button>
<span class="submenu"><a href="../index.php?r=admin/competence"  class="btn button_btn bg-deep-blue" title="添加权限"><i class="fa  fa-edit"></i>&nbsp;角色添加权限</a></span>
<span class="submenu"><a href="../index.php?r=admin/show_node"  class="btn button_btn bg-deep-blue" title="添加权限"><i class="fa  fa-edit"></i>&nbsp;查看权限列</a></span>
   <div class="search  clearfix">
   <input name="" type="text"  class="form-control col-xs-8"/><button class="btn button_btn bg-deep-blue " onclick=""  type="button"><i class="fa  fa-search"></i>&nbsp;搜索</button>
</div>

<div class="compete_list">
       <table id="sample-table-1" class="table table_list table_striped table-bordered dataTable no-footer">
		<thead>
			<tr>
			  <th class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
			  <th>角色名称</th>
		
              <th>用户名称</th>
			  <th class="hidden-480">权限名称</th>             
			  <th class="hidden-480">操作</th>	
             </tr>
		</thead>
             <tbody>
             	<?php foreach($data as $key =>$value):?>
             		<input type="hidden" name="hid" value="<?php echo $value['u_id'] ?>" />
				  <tr>
					<td class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
					<td><?=$value['r_name']?></td>
					<td class="hidden-480"><?=$value['u_name']?></td>
					<td><?= implode(',',$value['n_title'])?></td>
					<td>
	                 <a title="编辑" onclick="Competence_modify('560')" href="javascript:;" class="btn button_btn bg-deep-blue">编辑</a>        
	                 <a title="删除" href="javascript:;" id='del' onclick="Competence_del(this,'1')" class="btn button_btn btn-danger">删除</a>

					</td>
				   </tr>		
			   <?php endforeach;?>								
		      </tbody>
	        </table>
     </div>
</div>
</div>
</body>
</html>
<script>
	/*权限删除*/
function Competence_del(obj,id){
	layer.confirm('确认要删除吗？',{icon:0,},function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
/*******滚动条*******/
$("body").niceScroll({  
	cursorcolor:"#888888",  
	cursoropacitymax:1,  
	touchbehavior:false,  
	cursorwidth:"5px",  
	cursorborder:"0",  
	cursorborderradius:"5px"  
});
//删除
</script>
<script src="jquery-1.8.3.js" type="text/javascript"></script>
<script type="text/javascript">
	$('#del').click(function(){
		// alert(12)	
	})
</script>
