//1.checkbox全选-----------------------------------------------------
function isAllChecked(){
	var checkall = document.getElementById("people-checkall");
	if(checkall.checked==true){
		 selectAll();
	}
	else
		emptyAll();
}

function selectAll(){ //全选     
    // var inputs = document.getElementsByTagName("input");  
    var inputs = document.getElementsByClassName("people-check");     
    for(var i=0;i<inputs.length;i++){     
      if(inputs[i].getAttribute("type") == "checkbox"){     
        inputs[i].checked = true;     
      }     
    }     
  }

function emptyAll(){ //全不选     
	var inputs = document.getElementsByClassName("people-check");     
	for(var i=0;i<inputs.length;i++){     
	  if(inputs[i].getAttribute("type") == "checkbox"){     
	    inputs[i].checked = false;     
	  }     
	}     
}



function deleteCheck(max){
	// var array = new Array();	
	var array="";
	for(var id = 1; id <= max; id++){
		var checkeId = document.getElementById("check-"+id);
		if(checkeId!=null && checkeId.checked==true){
			// alert(id);
			// array.push(id);
			array += id+"_";
		}
		else continue;
	}
	array = array.substr(0,array.length-1);//减掉最后一个or
	window.self.location = "action/action-delete-people.php?idArray="+array;
}





$(function () {
    $('#container').highcharts({
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        title: {
            text: 'My custom title'
        },
        series: [{
            data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        }]
    });
});