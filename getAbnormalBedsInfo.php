<?php
	include("public/connect.php");
	include("public/function.php");
	
	$sql="SELECT *,user.id as uid FROM user left join heartbeat on user.id=heartbeat.userId ORDER BY buildId,roomId,bedId";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)<1)
	{
		echo "empty";
	}
	else
	{
		$output="";
		$count=0;
		$uid=0;
		while($row=mysql_fetch_array($rs)){
			if($uid!=$row["uid"])
			{
				$uid=$row["uid"];
				$bAlert=false;
				$heartStatus=$HEART_NORMAL;
				$breathStatus=$BREATH_NORMAL;
				if($row["heartRate"]<$HEART_LOWER){
					//心率偏慢
					$heartStatus=$HEART_LOWER_ALERT;
					$bAlert=true;
				}
				else if($row["heartRate"]>$HEART_UPPER){
					//心率偏快
					$heartStatus=$HEART_UPPER_ALERT;
					$bAlert=true;
				}
				
				else if($row["heartRate"]==$HEART_ZERO){
					//无心跳
					$heartStatus=$HEART_ALERT;
					$bAlert=true;
				}

				if($row["breathRate"]<$BREATH_LOWER){
					//呼吸偏慢
					$breathStatus=$BREATH_LOWER_ALERT;
					$bAlert=true;
				}
				else if($row["breathRate"]>$BREATH_UPPER){
					//呼吸偏快
					$breathStatus=$BREATH_UPPER_ALERT;
					$bAlert=true;
				}
				
				else if($row["breathRate"]==$BREATH_ZERO){
					//无呼吸
					$breathStatus=$BREATH_ALERT;
					$bAlert=true;
				}
				
				if($bAlert){
					//异常床位
					$id=$row["uid"];
					$output.="<a href='people-state.php?id=$id'>";
					$output.="<div class='bed-modal bed-error'>";
					$output.="<div class='bed-info'>";
					$output.="<div>".$row["userName"]."</div>";
					$output.="<div>".$row["buildId"]."-".$row["roomId"]."室</div>";
					$output.="<div>".$row["bedId"]."号床位</div>";
					if($heartStatus==$HEART_NORMAL){
						$output.="<div class='bed-state-normal'>$heartStatus</div>";
					}
					else{
						$output.="<div class='bed-state-error'>$heartStatus</div>";
					}
					if($breathStatus==$BREATH_NORMAL){
						$output.="<div class='bed-state-normal'>$breathStatus</div>";
					}
					else{
						$output.="<div class='bed-state-error'>$breathStatus</div>";
					}
					//$output.="<div class='bed-state-error'>$heartStatus<br/>$breathStatus</div>";
					$output.="</div>";
					$output.="</div>";
					$output.="</a>";

					$count++;

				}
			}
			else{
				continue;
			}
			
			
		}
		echo $output."#".$count;
	}
	


?>