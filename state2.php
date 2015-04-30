<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>智能床分析监控报警系统</title>

	<link rel="stylesheet" href="css/main-style.css">
	<script type="text/javascript" src="js/main.js"></script>

</head>

<?php 
include("public/connect.php");
include("public/function.php");

@$id = $_GET['id'];
// echo "<script>alert('$id');</script>";
$sql="SELECT * FROM user where id = $id ";
$result=sqlQuery($sql);
if($result == null)
	{echo "<script>alert('没有此人记录!');history.go(-1);</script>";}

@$name     =$result['userName'];
@$age      =$result['age'];
@$sex      =$result['sex'];
@$buildId  =$result['buildId'];
@$roomId   =$result['roomId'];
@$bedId    =$result['bedId'];
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
				<li class="active">
					<a href="health-monitor.php">
						<div class="icon_heart_focus"></div>

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
		<!-- - - - - 主体 以下- - - - - -->
		<div class="templatemo-content-wrapper">
			<div class="templatemo-content">




				<!-- 基本信息div 以下-->
				<!-- <div>健康监测 个人健康信息</div> -->
				<div class="basic-info">

					<div class="people-face">
						<img src="image/people_face/1.jpg" width="120px">
					</div>

					<div class="basic-info-table">
						<table width="100%">
							<tr>
								<td width="30%">姓名</td>
								<td width="70%"> <span><?php echo"$name";?></span></td> 
							</tr>
							<tr>
								<td>性别</td>
								<td><span><?php echo"$sex";?></span></td>
							</tr>
							<tr>
								<td>年龄</td>
								<td><span><?php echo"$age";?></span></td>
							</tr>
							<tr>
								<td>楼室</td>
								<td><span><?php echo"$buildId";?></span>号楼<span><?php echo"$roomId";?></span>室</td>
							</tr>
							<tr>
								<td>床位</td>
								<td><span><?php echo"$bedId";?></span>号</td>
							</tr>
							<!-- <tr>
								<td>病史</td>
								<td><span>高血压</span></td>
							</tr> -->
						</table>
					</div>

					<div class="relative-info">
						<div style="margin-bottom:20px;">
							<span style="color:#777;">家属联系方式</span>
							<input type="button" class="btn btn-success" style="float:right;" href="javascript:;" data-toggle="modal" data-target="#familyModal" value="新增">
						</div>

						<div class="relative-info-table">

							<table width="100%">
								<?php 
								$sql2="SELECT id FROM family where userId = $id ORDER BY id DESC LIMIT 1";
								$result2=sqlQuery($sql2);
								@$max2=$result2['id'];

								for ($i=1; $i <= $max2; $i++) {
									$sqlf="SELECT * FROM family where id=$i and userId=$id";
									$resultf =sqlQuery($sqlf);
									if($resultf==null){continue;}

									@$name = $resultf['name'];
									@$relationship = $resultf['relationship'];
									@$phone = $resultf['phone'];

									echo"
									<tr>
									<td width=\"15%\"><span> $relationship </span></td>
									<td width=\"20%\"><span> $name </span></td>
									<td width=\"45%\"><span> $phone </span></td>
									<td width=\"20%\"><a href=\"#\">发送短信</a></td>
								</tr>";

								}
								?>	

							</table>
						</div>
					</div>
				</div>
				<!-- 基本信息 以上-->


				<!-- 心率 以下-->
				<div class="heart-info">
					<div class="chart-content">
						<p style="color:#777;">今日心率曲线变化图（单位：次/分）
							<span>
								<button class="btn btn-primary" style="float:right;">查看历史记录</button>
							</span>
						</p>            
						<!-- <canvas id="heart-chart"></canvas>   -->
						<div id="container"  style="width: 550px; height: 230px; margin: 0 0 0 -20px;"></div>      

					</div>

					<div class="heart-info-table">
						<table width="90%">
							<tr>
								<td>当前心率：</td>
								<td><span>52</span>次/分</td>
							</tr>
							<tr>
								<td>今日平均心率：</td>
								<td><span>54</span>次/分</td>
							</tr>
							<tr>
								<td>三日平均心率：</td>
								<td><span>51</span>次/分</td>
							</tr>
						</table>
						
					</div>
				</div>
				<!-- 心率 以上-->


				<!-- 呼吸率 以下-->
				<div class="breath-info">
					<div class="chart-content">
						<p style="color:#777;">今日呼吸率曲线变化图（单位：次/分）
							<span>
								<button class="btn btn-primary" style="float:right;">查看历史记录</button>
							</span>
						</p>            
						<canvas id="breath-chart"></canvas>                      
					</div>

					<div class="breath-info-table">
						<table width="90%">
							<tr>
								<td>当前呼吸率：</td>
								<td><span>17</span>次/分</td>
							</tr>
							<tr>
								<td>今日平均呼吸率：</td>
								<td><span>15</span>次/分</td>
							</tr>
							<tr>
								<td>三日平均呼吸率：</td>
								<td><span>16</span>次/分</td>
							</tr>
						</table>
						
					</div>
				</div>
				<!-- 呼吸率 以上-->

				<div class="move-info">
					<div class="chart-content">
						<p style="color:#777;">今日体动曲线变化图（单位：幅度）
							<span>
								<button class="btn btn-primary" style="float:right;">查看历史记录</button>
							</span>
						</p>            
						<canvas id="move-chart"></canvas>                      
					</div>

					<div class="move-info-table">
						<table width="90%">
							<tr>
								<td>当前体动状态：</td>
								<td><span>17</span>次/分</td>
							</tr>
							<tr>
								<td>今日体动状态：</td>
								<td><span>15</span>次/分</td>
							</tr>
							<tr>
								<td>三日体动状态：</td>
								<td><span>16</span>次/分</td>
							</tr>
						</table>
						
					</div>
				</div>


			</div>
		</div>


		<!-- - - - - 主体 以上- - - - - -->

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


<!-- 家属人员注册 Modal -->
		<div class="modal fade" id="familyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">新增家属</h4>
					</div>

					<div class="modal-footer">
						<div class="newfamily-form">
							<form action="action/action-new-family.php" method="post">
								<table><tbody>
									<tr>
										<td><label for="name">姓名</label></td>
										<td><input type="text" class="form-control" name="family-name"></td>
									</tr>
									<tr>
										<td><label for="name">与老人关系</label></td>
										<td><input type="text" class="form-control" name="family-relationship"></td>
									</tr>
									<tr>
										<td><label for="name">手机号码</label></td>
										<td><input type="text" class="form-control" name="family-phone"></td>
									</tr>
									<?php echo"<input type=\"hidden\" name=\"family-userId\" value=\"$id\">" ?>
								</tbody></table>

								<!-- <a href="login.html" class="btn btn-primary">确认</a> -->
								<input type="submit" class="btn btn-success" value="提交" >
								<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
							</div>
						</form>
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
	<!-- <script type="text/javascript" src="jquery-1.10.1.js"></script>-->
	<script type="text/javascript" src="highcharts.js"></script> 
	<script type="text/javascript"> 
	

	var heartChartData = {
		labels : ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00"],
		datasets : [
		{
			label: "My Second dataset",
			fillColor : "rgba(151,187,205,0.2)",
			strokeColor : "rgba(151,187,205,1)",
			pointColor : "rgba(151,187,205,1)",
			pointStrokeColor : "#fff",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(151,187,205,1)",
			data : [52,54,49,51,53,50,53,51,57,55,55,54,56]
		}
		]

      } // heartChartData

      var breathChartData = {
      	labels : ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00"],
      	datasets : [
      	{
      		label: "My Second dataset",
      		fillColor : "rgba(151,187,205,0.2)",
      		strokeColor : "rgba(151,187,205,1)",
      		pointColor : "rgba(151,187,205,1)",
      		pointStrokeColor : "#fff",
      		pointHighlightFill : "#fff",
      		pointHighlightStroke : "rgba(151,187,205,1)",
      		data : [15,16,15,16,17,16,16,17,16,16,15,17,16]
      	}
      	]

      } // breathChartData

      var moveChartData = {
      	labels : ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00"],
      	datasets : [
      	{
      		label: "My Second dataset",
      		fillColor : "rgba(151,187,205,0.2)",
      		strokeColor : "rgba(151,187,205,1)",
      		pointColor : "rgba(151,187,205,1)",
      		pointStrokeColor : "#fff",
      		pointHighlightFill : "#fff",
      		pointHighlightStroke : "rgba(151,187,205,1)",
      		data : [85,84,78,71,85,88,89,91,90,92,85,86,84]
      	}
      	]

      } // moveChartData

      window.onload = function(){
      	var h_line = document.getElementById("heart-chart").getContext("2d");
      	var b_line = document.getElementById("breath-chart").getContext("2d");
      	var m_line = document.getElementById("move-chart").getContext("2d");

      	window.myLine = new Chart(h_line).Line(heartChartData, {
      		responsive: true
      	});
      	window.myLine = new Chart(b_line).Line(breathChartData, {
      		responsive: true
      	});
      	window.myLine = new Chart(m_line).Line(moveChartData, {
      		responsive: true
      	});
      }
      </script>





      <script>
		var chart; // global
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function requestData() {
			$.ajax({
				url: 'echojson.php', 
				success: function(point) {
					var series = chart.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					// add the point
					chart.series[0].addPoint(eval(point), true, shift);
					
					// call it again after one second
					setTimeout(requestData, 1000);	
				},
				cache: false
			});
		}
			
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					defaultSeriesType: 'spline',
					events: {
						load: requestData
					}
				},
				title: {
					text: ''
				},
				xAxis: {
					type: 'datetime',
					tickPixelInterval: 150,
					maxZoom: 20 * 1000
				},
				yAxis: {
					minPadding: 0.2,
					maxPadding: 0.2,
					title: {
						text: '心率（次/分）',
						margin: 20
					}
				},
				series: [{
					name: '-',
					data: []
				}]
			});		
		});
		</script>
  </body>
  </html>