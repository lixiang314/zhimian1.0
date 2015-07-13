<?php 
include("public/connect.php");
include("public/function.php");

$id = $_GET['id'];
// echo "<script>alert('$id');</script>";
$sql="SELECT *,user.id as uid FROM user left join heartbeat on user.id=heartbeat.userId where user.id = $id order by heartbeat.id desc limit 1";
$result=sqlQuery($sql);
if(!$result)
	{echo "<script>alert('没有此人记录!');history.go(-1);</script>";}

$name     =$result['userName'];
$age      =$result['age'];
$gender   =$result['gender'];
$buildId  =$result['buildId'];
$roomId   =$result['roomId'];
$bedId    =$result['bedId'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>智能床分析监控报警系统</title>

	<link rel="stylesheet" href="css/main-style.css">
	<script type="text/javascript" src="js/main.js"></script>

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
				<li class="active">
					<a href="health-monitor.php">
						<div class="icon_heart_focus"></div>
							
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
								<td><span><?php echo"$gender";?></span></td>
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
						<p style="color:#777;">心率曲线变化图
							<span>
								<button class="btn btn-primary" style="float:right;">查看历史记录</button>
							</span>
						</p>            
						<!-- <canvas id="heart-chart"></canvas>   -->
						<div id="heart-chart"  style="width: 550px; height: 230px; margin: 0 0 0 -20px;"></div>      

					</div>

					<div class="heart-info-table">
						<table width="90%">
							<tr>
								<td>当前心率：</td>
								<td><span id="currentHeartBeat">52</span><span class="rateUnit">次/分</span></td>
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
						<p style="color:#777;">呼吸率曲线变化图
							<span>
								<button class="btn btn-primary" style="float:right;">查看历史记录</button>
							</span>
						</p>            
						<div id="breath-chart"  style="width: 550px; height: 230px; margin: 0 0 0 -20px;"></div>                      
					</div>

					<div class="breath-info-table">
						<table width="90%">
							<tr>
								<td>当前呼吸率：</td>
								<td><span id="currentBreathRate">17</span><span class="rateUnit">次/分</span></td>
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
						<p style="color:#777;">体动曲线变化图
							<span>
								<button class="btn btn-primary" style="float:right;">查看历史记录</button>
							</span>
						</p>            
						<div id="move-chart"  style="width: 550px; height: 230px; margin: 0 0 0 -20px;"></div>                       
					</div>

					<div class="move-info-table">
						<table width="90%">
							<tr>
								<td>当前体动状态：</td>
								<td><span id="currentMoveRate">17</span><span class="rateUnit">次/分</span></td>
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
	<script type="text/javascript" src="js/highcharts.js"></script> 
	<!--定义的标准值变量-->
	<script type="text/javascript" src="js/standard.js"></script> 


	<script type="text/javascript"> 
		$("span.rateUnit").css("fontSize","17px");
		$("span.rateUnit").css("color","#1aba9c");
		var chart1; // global
		var chart2; // global
		var today=new Date();
		var rndString=today.getMilliseconds();
		
		function requestData1() {

			$.ajax({
				url: 'echojson/echojson-heartrate.php?id='+<?php echo $id?>+'&rnd='+rndString, 
				success: function(point) {
					var series = chart1.series[0],
					shift = series.data.length > 20; // shift if the series is longer than 20
		
					// add the point
					chart1.series[0].addPoint(eval(point), true, shift);
					if(point[1]<HEART_LOWER || point[1]>HEART_UPPER){
						$("#currentHeartBeat").addClass("abnormal-color")
						$("#currentHeartBeat").siblings(".rateUnit").eq(0).css("color","#a00");
						
					}
					else{
						$("#currentHeartBeat").removeClass("abnormal-color");
					}
						
					$("#currentHeartBeat").text(point[1]);
					// call it again after one second
					setTimeout(requestData1, 1000);	
					
				},
				cache: false
			});
		}


		function requestData2() {
			$.ajax({
				url: 'echojson/echojson-breath.php?id='+<?php echo $id?>+'&rnd='+rndString,
				success: function(point) {
					var series2 = chart2.series[0],
					shift2 = series2.data.length > 20; 
					chart2.series[0].addPoint(eval(point), true, shift2);
					//console.log(BREATH_UPPER);
					if(point[1]<BREATH_LOWER || point[1]>BREATH_UPPER){
						$("#currentBreathRate").addClass("abnormal-color");
						$("#currentBreathRate").siblings(".rateUnit").eq(0).css("color","#a00");
					}
					else{
						$("#currentBreathRate").removeClass("abnormal-color");
						//$("span.rateUnit").removeClass("abnormal-color");
					}

					$("#currentBreathRate").text(point[1]);
					setTimeout(requestData2, 1000);	
				},
				cache: false
			});

		}
		



		$(document).ready(function() {
// 心率表--------------------------------------------
			chart1 = new Highcharts.Chart({
				chart: {
					renderTo: 'heart-chart',
					defaultSeriesType: 'spline',
					events: {
						load: requestData1
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
						text: '',
						margin: 20
					}
				},
				series: [{
					name: '心率（次/分）',
					data: []
				}]
			});	


// 呼吸率表--------------------------------------------
			chart2 = new Highcharts.Chart({
				chart: {
					renderTo: 'breath-chart',
					defaultSeriesType: 'spline',
					events: {
						load: requestData2
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
						text: '',
						margin: 20
					}
				},
				series: [{
					name: '呼吸率（次/分）',
					data: []
				}]
			});	


		});
		</script>

		<script type="text/javascript">  
			Highcharts.setOptions({ global: { useUTC: false } });   
		</script> 


	

		
		
	
		



		 <script type="text/javascript"> 

		var chart3; // global
		var today=new Date();
		var rndString=today.getMilliseconds();
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function requestData3() {
			$.ajax({
				url: 'echojson/echojson-heart.php?id='+<?php echo $id?>+'&rnd='+rndString,

				success: function(data) {
					//console.log(data);
					var arrPoints=data.split(" ");
					var arrLen=arrPoints.length;
					var nowTime=new Date();
					arrLenNums=arrLen-2;
					//console.log(arrLen);
					//var point:array;
					var series3 = chart3.series[0],
					shift3 = series3.data.length > 3200;
					for(i=1;i<arrLen-1;i++)
					{
						x=nowTime.getTime()+i*1000/arrLenNums;
						y=parseInt(arrPoints[i]);
						
						point=[x,y];
						//console.log(point);
						if(i<arrLen-2)
							series3.addPoint(eval(point), false, shift3);
						else
							series3.addPoint(eval(point), true, shift3);
						//i+=2;
					}
					//setInterval(addPoint(),10);
					
					setTimeout(requestData3, 1000);	
				},
				cache: false
			});
		}
			
		$(document).ready(function() {
			chart3 = new Highcharts.Chart({
				chart: {
					renderTo: 'move-chart',
					defaultSeriesType: 'spline',
					events: {
						load: requestData3
					}
				},
				title: {
					text: ''
				},
				xAxis: {
					type: 'datetime',
					tickPixelInterval: 40,
					maxZoom: 20 * 1000
				},
				yAxis: {
					minPadding: 0.2,
					maxPadding: 0.2,
					title: {
						text: '',
						margin: 20
					}
				},
				series: [{
					name: '体动（次/秒）',
					data: []
				}]
			});		
		});
		</script>



  </body>
  </html>