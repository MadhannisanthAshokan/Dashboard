<!DOCTYPE html>
<html>
<head>
<title>Try jQuery Online</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$('.give').click(function(){
   console.log('clicked');
   
var root = "https://jsonplaceholder.typicode.com/comments";

    $.ajax ({
        dataType: "json",
        method: 'GET',
        url:root,
        success: function(response){
            $.each(response,function(index,item){
                
           
            var userId = item.postId;
            var title = item.email;
           // var title = $(response).filter('email');
            // var $info1=$("<table></table>");
            var $info = $("<tr><td></td></tr>").text("Post id is: " + userId + " email is " + title);
            $(".myid").append($info);
            });
            // console.log(response);
        },
        error: function(request,errorType, errorMsg){
            alert("Ajax Fehlfunktion:" + errorMsg);
        }, 
    });
});
});

</script>
<style>
.selected { 
    color:red; 
}
.highlight { 
    background:yellow; 
}
</style>
</head>
<body>
<div title="Bold and Brave" class='give'>This is first paragraph.</div>
<table class="myid">

</table>
</body>
</html>
