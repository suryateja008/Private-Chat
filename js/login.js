function chatUser(fid,uid,uname) {
    window.open("http://localhost:8888/webChat/chat.php?fid="+fid+"&uid="+uid+"&uname="+uname);
}

$("")
    function addUser(fiD,uiD){
    
    
    $.post("addFriends.php", {"uiD":uiD,"fiD":fiD}, function(result){
         location.reload(); 
    });

}

function visible(){
     if($("#add_friends").css("visibility")=='hidden'){
     $("#add_friends").css("visibility", "visible");
     $("#pending_requests").css("visibility", "hidden");
     }else{
         $("#add_friends").css("visibility", "hidden");
     }

}


function acceptFriend(f,u){
    
  $.post("friendRequest.php", {"uiD":u,"fiD":f,"accept":"yes"}, function(result){
         location.reload(); 
    });
}

function rejectFriend(fiD,uiD){
 
      $.post("friendRequest.php", {"uiD":uiD,"fiD":fiD,"reject":"yes"}, function(result){
         location.reload(); 
    });
}

function cancleReq(fiD,uiD){
    
    $.post("friendRequest.php", {"uiD":uiD,"fiD":fiD,"cancle":"yes"}, function(result){
        alert(result);
         location.reload(); 
    });
}


function pendingReq(){
    
    if($("#pending_requests").css("visibility")=='hidden'){
     $("#add_friends").css("visibility", "hidden");
     $("#pending_requests").css("visibility", "visible");
     }else{
         $("#pending_requests").css("visibility", "hidden");
     }

}


