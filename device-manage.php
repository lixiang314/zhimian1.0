<?php 
include("public/connect.php");
include("public/function.php");

$sql="SELECT id FROM device ORDER BY id DESC LIMIT 1";
$result=sqlQuery($sql);
@$max=$result['id'];
@$deleteId;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>智能床分析监控报警系统</title>
	<script type="text/javascript" src="js/main.js"></script>
	<link rel="stylesheet" href="css/main-style.css">
</head>



<body>
	<!-- 顶部标题 -->
	<div class="navbar navbar-inverse"  role="navigation" style="background-color:#1aba9c;border:0px;">
		<div class="navbar-header">
			<div class="logo-img"><img src="image/zhimian_logo_web.png" width="110px"></div>
			<div class="logo"><h1>智能床分析监控报警系统</h1></div>
			<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar">aaa</span>
				<span class="icon-bar">bbb</span>
				<span class="icon-bar">ccc</span>
			</button>  -->
		</div>   
	</div>

	<div class="template-page-wrapper">

		<div class="navbar-collapse collapse templatemo-sidebar">
			<ul class="templatemo-sidebar-menu">
				<li>
					<a href="health-monitor.php">
						<div class="icon_heart"></div>

						<!-- 显示消息数量 -->
						<span class="badge pull-right">1</span>		
						健康监测
					</a>
				</li>
				<li>
					<a href="people-manage.php">
						<div class="icon_people"></div>
						人员管理
					</a>
				</li>
				<li class="active">
					<a href="#">
						<div class="icon_device_focus"></div>
						设备管理
					</a>
				</li>

				<li>
					<a href="javascript:;" data-toggle="modal" data-target="#confirmModal">
						<div class="icon_signout"></div>
						退出登录
					</a>
				</li>
			</ul>
		</div>




		<!-- 主体 -->
		<div class="templatemo-content-wrapper">
			<div class="templatemo-content">

				<ul class="nav nav-tabs" role="tablist" id="templatemo-tabs">
					<li class="activecover active"><a href="#all" role="tab" data-toggle="tab">所有设备</a></li>
					<!-- <li><a href="#unusual" role="tab" data-toggle="tab" >异常床位</a></li>
					<li><a href="#notempty" role="tab" data-toggle="tab">非空床位</a></li> -->

				</ul>
				<div id="line-hr"></div>

				<!-- 查询表单 -->
				<div class="select-content">

					
					<div style="margin:0 0 20px 5px;">
						<input type="checkbox" id="checkboxAll" onclick="isAllChecked()">
						<label>全选</label>
						<input type="submit" class="btn btn-danger" value="删除选中" href="javascript:;" data-toggle="modal" data-target="#deleteCheckedModalDevice">
						<input type="button" onclick="window.location.replace('device-new.php')" class="btn btn-success" style="margin-left:10px;" value="新增设备">
					</div>
					

				</div>
				<!-- - - - -->

				<!-- Tab panes -->
				<div class="tab-content">			
					<div class="tab-pane fade in active" id="all-table">
		

						<table class="table table-striped table-hover table-bordered">
							<thead>
								<tr>
									<th width="5%"></th>
									<th width="19%">设备编号</th>
									<th width="15%">配置时间</th>
									<th width="15%">状态信息</th>
									<th width="15%">楼号与房间</th>
									<th width="10%">床号</th>
									
									<th width="7%">操作</th>
									<th width="7%"></th>
									<th width="7%"></th>
								</tr>
							</thead>

							<tbody>


								<?php  
								for ($i=$max; $i > 0; $i--) { 
									$sql="SELECT * FROM device where id=$i";
									$result =sqlQuery($sql);
									if($result==null){continue;}

									@$deviceId = $result['deviceId'];
									@$settingDate = $result['settingDate'];
									@$deviceInfo = $result['deviceInfo'];
									@$buildId = $result['buildId'];
									@$roomId = $result['roomId'];
									@$bedId = $result['bedId'];
									$deleteId = $i;


								
								echo"<tr>
									<td><input type=\"checkbox\" class=\"checkbox-style everyCheck\" id=\"checkDevice-$i\"></td>
									<td><a href=\"#\">$deviceId</a></td>
									<td>$settingDate</td>
									<td>$deviceInfo</td>
									<td><span>$buildId</span>号楼<span>$roomId</span>室</td>
									<td><span>$bedId</span>号</td>              
									<td><a href=\"#\"><div class=\"icon-check\"></div></a></td>
									<td><a href=\"#\"><div class=\"icon-edit\"></div></a></td>
									<td><div class=\"icon-remove\"  href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#deleteModal-$i\"></div></td>
								</tr>";
							}

								?>

								


							</tbody>
						</table>


						<!-- 页码 -->
						<ul class="pagination pull-right">
							<li class="disabled"><a href="#">&laquo;</a></li>

							<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>

							<li><a href="#">2 <span class="sr-only">(current)</span></a></li>

							<li><a href="#">3 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">4 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">5 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>  
					</div>





					<!-- 筛选出不正常的床位 -->
					<div class="tab-pane fade" id="unusual">
					

						</div>





						<!-- 筛选出所有非空床位 -->
						<div class="tab-pane fade" id="notempty">

							
							</div>



						</div> <!-- tab-content --> 
					</div>
				</div>


				<!-- 退出确认 Modal -->
				<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">确认要退出当前账号吗？</h4>
							</div>
							<div class="modal-footer">
								<a href="login.html" class="btn btn-primary">确认</a>
								<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
							</div>
						</div>
					</div>
				</div>


				<!-- 删除确认 Modal -->
		<?php
		for ($k=$max; $k > 0; $k--) { 
			$sqlDel="SELECT * FROM device where id=$k";
			$resultDel =sqlQuery($sqlDel);
			if($resultDel==null){continue;}
			@$deviceIdDel = $resultDel['deviceId'];

			echo"<div class=\"modal fade\" id=\"deleteModal-$k\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
			<div class=\"modal-dialog\">
			<div class=\"modal-content\">
			<div class=\"modal-header\">
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
			<h4 class=\"modal-title\" id=\"myModalLabel\">确认要删除<span style=\"color:#09a98b;\">$deviceIdDel</span>号设备的所有记录吗？（一旦删除即无法撤销！）</h4>
			</div>
			<div class=\"modal-footer\">
			<a href=\"action/action-delete-device.php?id=$k\" class=\"btn btn-danger\">确认</a>
			<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>
			</div>
			</div>
			</div>
			</div>";
		}
		?>


				<!-- 多选删除确认 Modal -->
		<div class="modal fade" id="deleteCheckedModalDevice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">确认要删除所有选中的设备记录吗？ （一旦删除即无法撤销！）</h4>
					</div>
					<div class="modal-footer">
						<!-- 这里和上面单独删除的modal不同，由于需要使用js判断选中了哪些数据，所以必须从main.js里跳转到action-delete来操作数据库。 -->
						<button onclick="deleteCheckDevice(<?php echo"$max"; ?>)" class="btn btn-danger">确认</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					</div> @
				</div>
			</div>
		</div>         




				<footer class="templatemo-footer">
					<div class="templatemo-copyright">
						<p><span style="color:#4a4;">智能床分析监控报警系统</span> made by 李响 建议使用<a>Chrome浏览器</a>打开以显示最佳效果</p>
					</div>
				</footer>

			</div>




			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/Chart.min.js"></script>
			<script src="js/templatemo_script.js"></script>
		</body>
		</html>