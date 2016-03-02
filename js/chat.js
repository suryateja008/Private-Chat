function sendMsg(uID,fID,sendID){

var msgID = document.getElementById("showMessages");
//msgID.innerHTML = msgID.innerHTML+document.getElementById("chatInput").value+"<br />";
msgID.scrollTop=msgID.scrollHeight;
var msg = $("#chatInput").val();
$.post("storeMsg.php", {"message": msg,"uID":uID,"fID":fID,"sendID":sendID}, function(result){
    });
$("#chatInput").val("");

 
}

function getMsg(u,f,tstamp){
    var dataShow=0;
 
    
$.post("storeMsg.php", {"u":u,"f":f,"get":tstamp}, function(res){
        dataShow = res.split("|");
        
              if(dataShow[0]==""){
                  tstamp==tstamp;}else{
                  tstamp=dataShow[1];
                  }
    
           if(tstamp=='none'){
        $("#showMessages").html(dataShow[0]);               
           }else{
               if(dataShow[0]!=""){
           $("#showMessages").append(dataShow[0]);
                  var msgID = document.getElementById("showMessages");
                  msgID.scrollTop=msgID.scrollHeight
               }
           }
    });
   
    setTimeout(function() {
      getMsg(u,f,tstamp);
}, 1000);
}


