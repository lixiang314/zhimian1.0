/*

							神 狗 保 佑， 永 远 无 BUG


                       ::
                      :;J7,                           ::;7:
                      ,ivYi,                         ;LLLFS:
                      :iv7Yi                       :7ri;j5PL
                     ,:ivYLvr                    ,ivrrirrY2X,
                     :;r@Wwz.7r:                :ivu@kexianli.
                    :iL7::,:::iiirii:ii;::::,,irvF7rvvLujL7ur
                   ri::,:,::i:iiiiiii:i:irrv177JX7rYXqZEkvv17
                ;i:, , ::::iirrririi:i:::iiir2XXvii;L8OGJr71i
              :,, ,,:   ,::ir@mingyi.irii:i:::j1jri7ZBOS7ivv,
                 ,::,    ::rv77iiiriii:iii:i::,rvLq@huhao.Li
             ,,      ,, ,:ir7ir::,:::i;ir:::i:i::rSGGYri712:
           :::  ,v7r:: ::rrv77:, ,, ,:i7rrii:::::, ir7ri7Lri
          ,     2OBBOi,iiir;r::        ,irriiii::,, ,iv7Luur:
        ,,     i78MBBi,:,:::,:,  :7FSL: ,iriii:::i::,,:rLqXv::
        :      iuMMP: :,:::,:ii;2GY7OBB0viiii:i:iii:i:::iJqL;::
       ,     ::::i   ,,,,, ::LuBBu BBBBBErii:i:i:i:i:i:i:r77ii
      ,       :       , ,,:::rruBZ1MBBqi, :,,,:::,::::::iiriri:
     ,               ,,,,::::i:  @arqiao.       ,:,, ,:::ii;i7:
    :,       rjujLYLi   ,,:::::,:::::::::,,   ,:i,:,,,,,::i:iii
    ::      BBBBBBBBB0,    ,,::: , ,:::::: ,      ,,,, ,,:::::::
    i,  ,  ,8BMMBBBBBBi     ,,:,,     ,,, , ,   , , , :,::ii::i::
    :      iZMOMOMBBM2::::::::::,,,,     ,,,,,,:,,,::::i:irr:i:::,
    i   ,,:;u0MBMOG1L:::i::::::  ,,,::,   ,,, ::::::i:i:iirii:i:i:
    :    ,iuUuuXUkFu7i:iii:i:::, :,:,: ::::::::i:i:::::iirr7iiri::
    :     :rk@Yizero.i:::::, ,:ii:::::::i:::::i::,::::iirrriiiri::,
     :      5BMBBBBBBSr:,::rv2kuii:::iii::,:i:,, , ,,:,:i@petermu.,
          , :r50EZ8MBBBBGOBBBZP7::::i::,:::::,: :,:,::i;rrririiii::
              :jujYY7LS0ujJL7r::,::i::,::::::::::::::iirirrrrrrr:ii:
           ,:  :@kevensun.:,:,,,::::i:i:::::,,::::::iir;ii;7v77;ii;i,
           ,,,     ,,:,::::::i:iiiii:i::::,, ::::iiiir@xingjief.r;7:i,
        , , ,,,:,,::::::::iiiiiiiiii:,:,:::::::::iiir;ri7vL77rrirri::
         :,, , ::::::::i:::i:::i:i::,,,,,:,::i:i:::iir;@Secbone.ii:::

         
*/


//1.checkbox全选-----------------------------------------------------
function isAllChecked(){
	var checkall = document.getElementById("checkboxAll");
	if(checkall.checked==true){
		 selectAll();
	}
	else
		emptyAll();
}

function selectAll(){ //全选     
    // var inputs = document.getElementsByTagName("input");  
    var inputs = document.getElementsByClassName("everyCheck");     
    for(var i=0;i<inputs.length;i++){     
      if(inputs[i].getAttribute("type") == "checkbox"){     
        inputs[i].checked = true;     
      }     
    }     
  }

function emptyAll(){ //全不选     
	var inputs = document.getElementsByClassName("everyCheck");     
	for(var i=0;i<inputs.length;i++){     
	  if(inputs[i].getAttribute("type") == "checkbox"){     
	    inputs[i].checked = false;     
	  }     
	}     
}





function deleteCheckPeople(max){
	// var array = new Array();	
	var array="";
	for(var id = 1; id <= max; id++){
		var checkeId = document.getElementById("checkPeople-"+id);
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


function deleteCheckDevice(max){
	var array="";
	for(var id = 1; id <= max; id++){
		var checkeId = document.getElementById("checkDevice-"+id);
		if(checkeId!=null && checkeId.checked==true){
			array += id+"_";
		}
		else continue;
	}
	array = array.substr(0,array.length-1);//减掉最后一个_
	window.self.location = "action/action-delete-device.php?idArray="+array;
}







