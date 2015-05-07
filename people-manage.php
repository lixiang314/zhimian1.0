<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>智能床分析监控报警系统</title>
	<script type="text/javascript" src="js/main.js"></script>
	<link rel="stylesheet" href="css/main-style.css">
</head>

<?php 
include("public/connect.php");
include("public/function.php");

$sql="SELECT id FROM user ORDER BY id DESC LIMIT 1";
$result=sqlQuery($sql);
@$max=$result['id'];
@$deleteId;
?>

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
				<li  class="active">
					<a href="#">
						<div class="icon_people_focus"></div>
						人员管理
					</a>
				</li>
				<li>
					<a href="device-manage.php">
						<div class="icon_device"></div>
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
					<li class="activecover active"><a href="#all" role="tab" data-toggle="tab">所有人员</a></li>
					<!-- <li><a href="#unusual" role="tab" data-toggle="tab" >异常床位</a></li>
					<li><a href="#notempty" role="tab" data-toggle="tab">非空床位</a></li> -->

				</ul>
				<div id="line-hr"></div>

				<!-- 查询表单 -->
				<div class="select-content">

					
					<div style="margin:0 0 20px 5px;">
						<input type="checkbox" id="checkboxAll" onclick="isAllChecked()">
						<label>全选</label>
						<input type="submit" class="btn btn-danger" value="删除选中" href="javascript:;" data-toggle="modal" data-target="#deleteCheckedModal">
						<input type="button" onclick="window.location.replace('people-new.php')" class="btn btn-success" style="margin-left:10px;" value="新增人员">
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
									<th width="10%">姓名</th>
									<th width="10%">性别</th>
									<th width="10%">年龄</th>
									<th width="15%">楼号与房间</th>
									<th width="10%">床号</th>
									<th width="19%">家属联系方式</th>
									<th width="7%">操作</th>
									<th width="7%"></th>
									<th width="7%"></th>
								</tr>
							</thead>

							<tbody>

								<?php  
								for ($i=$max; $i > 0; $i--) { 
									$sql="SELECT * FROM user where id=$i";
									$result =sqlQuery($sql);
									if($result==null){continue;}

									@$name = $result['userName'];
									@$gender = $result['gender'];
									@$age = $result['age'];
									@$buildId = $result['buildId'];
									@$roomId = $result['roomId'];
									@$bedId = $result['bedId'];
									$deleteId = $i;

									echo"
									<tr>
									<td><input type=\"checkbox\" class=\"checkbox-style everyCheck\" id=\"checkPeople-$i\"></td>
									<td><a href=\"state.php?id=$i\">  $name </a></td>
									<td>				$gender          		</td>
									<td>				$age  					</td>
									<td>				$buildId<span>号楼</span>$roomId<span>室</span></td>
									<td>				$bedId<span>号</span>	</td>              
									<td>
									<div class=\"btn-group\">

									<button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
									查看&nbsp;<span class=\"caret\"></span>
									<span class=\"sr-only\">Toggle Dropdown</span>
									</button>
									<ul class=\"dropdown-menu\" role=\"menu\" style=\"min-width:14em;\">";

									$sql2="SELECT id FROM family where userId = $i ORDER BY id DESC LIMIT 1";
									$result2=sqlQuery($sql2);
									@$max2=$result2['id'];

									for($j=1; $j <= $max2; $j++) {
										$sqlf="SELECT * FROM family where id=$j and userId=$i";
										$resultf =sqlQuery($sqlf);
										if($resultf==null){continue;}

										@$name = $resultf['name'];
										@$relationship = $resultf['relationship'];
										@$phone = $resultf['phone'];

										echo"<li style=\"float:right;\"> $name($relationship)-$phone &nbsp;&nbsp;</li>";
									}

									echo"</ul>
									</div>
									</td>
									<td><a href=\"people-state.php?id=$i\"><div class=\"icon-check\"></div></a></td>
									<td><a href=\"people-update.php?id=$i\"><div class=\"icon-edit\"></div></a></td>
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
							<li><a href="#">2</a></li>
							<li><a href="#">3 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">4 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">5 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>  
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
			$sqlD="SELECT * FROM user where id=$k";
			$resultD =sqlQuery($sqlD);
			if($resultD==null){continue;}
			@$nameD = $resultD['userName'];

			echo"<div class=\"modal fade\" id=\"deleteModal-$k\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
			<div class=\"modal-dialog\">
			<div class=\"modal-content\">
			<div class=\"modal-header\">
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
			<h4 class=\"modal-title\" id=\"myModalLabel\">确认要删除<span style=\"color:#09a98b;\">$nameD</span>的所有记录吗？（一旦删除即无法撤销！）</h4>
			</div>
			<div class=\"modal-footer\">
			<a href=\"action/action-delete-people.php?id=$k\" class=\"btn btn-danger\">确认</a>
			<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>
			</div>
			</div>
			</div>
			</div>";
		}
		?>


				<!-- 多选删除确认 Modal -->
		<div class="modal fade" id="deleteCheckedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">确认要删除所有选中的人员记录吗？ （一旦删除即无法撤销！）</h4>
					</div>
					<div class="modal-footer">
						<!-- 这里和上面单独删除的modal不同，由于需要使用js判断选中了哪些数据，所以必须从main.js里跳转到action-delete来操作数据库。 -->
						<button onclick="deleteCheckPeople(<?php echo"$max"; ?>)" class="btn btn-danger">确认</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					</div>
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